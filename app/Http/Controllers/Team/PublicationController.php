<?php

namespace App\Http\Controllers\Team;

use App\Category;
use App\Classification;
use App\Construct;
use App\Image;
use App\Publication;
use App\QualityQuestions;
use App\Repository\CategoryRepository;
use App\Repository\PublicationRepository;
use App\RepresentationForm;
use App\Tag;
use App\TextField;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class PublicationController extends Controller
{

    private $publicationRepository;
    private $categoryRepository;

    public function __construct(PublicationRepository $publicationRepository,CategoryRepository $categoryRepository)
    {
        if(Gate::denies('rule','team')) return abort(403);
        $this->publicationRepository = $publicationRepository;
        $this->categoryRepository  = $categoryRepository;
    }

    public function index()
    {
        return view('team.publication.list',[
            'type'=>'Waiting Review',
            'publications'=>$this->publicationRepository->listWaitingReview()
        ]);
    }

    public function create()
    {
        $publication = new Publication();
        return view('publication.form',[
            'publication'=>$publication
        ]);
    }

    public function save(Request $request)
    {
        $publication = (!$request->input('id')) ? new Publication($request->all()) : Publication::findOrFail($request->input('id'));
        $publication->title = $request->input('title');
        $publication->short_title = $request->input('short_title');
        $publication->year = $request->input('year');
        $publication->journal = $request->input('journal');
        $publication->authors = $request->input('authors');
        $publication->notes = $request->input('notes');
        $publication->type = $request->input('type');
        $publication->roots()->detach();
        if($request->input('roots')) {
            foreach ($request->input('roots') as $c)
            {
                try {
                    $publication->roots()->attach(Publication::findOrFail($c));
                } catch (QueryException $e){}
            }
        }
        $publication->url = $request->input('url');
        $publication->user_id = Auth::user()->id;
        $publication->save();
        return redirect("/publication/view/{$publication->id}")->with('status',"$publication->title has saved!");
    }

    public function accepted()
    {
        return view('team.publication.list',[
            'type'=>'Accepted',
            'publications'=>$this->publicationRepository->listAccepted()
        ]);
    }
    
    public function rejected()
    {
        return view('team.publication.list',[
            'type'=>'Rejected',
            'publications'=>$this->publicationRepository->listRejected()
        ]);
    }

    public function accept($id)
    {
        $publication = $this->publicationRepository->findById($id);
        $publication->approved = true;
        $publication->save();
        return redirect("publication/view/$id")->with('status',"$publication->title was accepted!");
    }

    public function reject($id)
    {
        $publication = $this->publicationRepository->findById($id);
        $publication->approved = false;
        $publication->save();
        return redirect("publication/view/$id")->with('status',"$publication->title was rejected!");
    }

    public function edit($id)
    {
        $publication = Publication::findOrFail($id);
        return view('publication.form',[
            'publication'=>$publication
        ]);
    }

    public function insertItem($publicationId,$categoryId,$imageId = null)
    {
        $category = $this->categoryRepository->findById($categoryId);
        $publication = $this->publicationRepository->findById($publicationId);
        $image = ($imageId) ? Image::find($imageId) : new Image();
        return view("publication.item.$category->type",[
            'publication' => $publication,
            'category' => $category,
            'image' => $image
        ]);
    }


    public function saveItem(Request $request,$publicationId,$categoryId,$imageId = null)
    {
        $category = $this->categoryRepository->findById($categoryId);
        $publication = $this->publicationRepository->findById($publicationId);
        $image = Image::find($imageId);
        switch ($category->type)
        {
            case 'image' :
                $this->saveImage($category,$publication,$request);
                break;
            case 'tag';
                $this->saveTag($category,$publication,$request,$image);
                break;
            case 'text' :
                $this->saveText($category,$publication,$request,$image);
                break;
        }
        return redirect("publication/view/$publication->id");
    }

    public function quality($id)
    {
        $publication = Publication::findOrFail($id);
        $selectedQuality = [];
        foreach ($publication->qualityQuestions()->get() as $qualityQuestion) {
            $selectedQuality[$qualityQuestion->id] = $qualityQuestion->pivot->value;
        }
        if (!$selectedQuality) {
            foreach (QualityQuestions::all() as $quality) {
                $selectedQuality[$quality->id] = 0;
            }
        }
        return view("publication.item.quality",[
            'qualityQuestions'=>QualityQuestions::all(),
            'publication'=>$publication,
            'selectedQuestion'=> $selectedQuality
        ]);
    }

    public function qualitySave(Request $request)
    {
        $publication = Publication::findOrFail($request->input('publication_id'));
        $qualityQuestions = QualityQuestions::all();
        $publication->qualityQuestions()->detach();
        foreach ($qualityQuestions as $qualityQuestion) {
            $publication->qualityQuestions()->attach($qualityQuestion,['value'=>$request->input($qualityQuestion->id)]);
        }
        return redirect("publication/view/{$publication->id}");
    }

    private function saveText(Category $category,Publication $publication,Request $request,Image $image = null)
    {
        $text = $publication->textFields()->where('category_id','=',$category->id)->first();
        $text = ($text) ? $text : new TextField();
        $text->content = $request->input('text');
        $text->images_id = ($image) ? $image->id : null;
        $text->category_id = $category->id;
        $text->publication_id = $publication->id;
        $text->save();
    }

    public function insertImage($publicationId,$categoryId,$imageId = null)
    {
        $category = $this->categoryRepository->findById($categoryId);
        $publication = $this->publicationRepository->findById($publicationId);
        $image = ($imageId) ? Image::findOrFail($imageId) : new Image();
        return view("publication.item.image",[
            'publication' => $publication,
            'category' => $category,
            'image' => $image
        ]);
    }

    public function showImage($imageId)
    {
        $image = Image::findOrFail($imageId);
        return view("publication.item.showimage",[
            'categories' => $this->categoryRepository->listOnlyImageCategoryOrderByName(),
            'image' => $image,
            'publication'=>$image->publication()->first(),
            'category'=>$image->category()->first()
        ]);
    }

    public function saveImage(Request $request,$publicationId,$categoryId,$imageId = null)
    {
        $category = $this->categoryRepository->findById($categoryId);
        $publication = $this->publicationRepository->findById($publicationId);
        $image = ($imageId) ? Image::findOrFail($imageId) : new Image();
        $imageFile = Input::file('photo');
        if($imageFile) {
            $filename  = time() . '.' . $imageFile->getClientOriginalExtension();
            $path = public_path('images/' . $filename);
            \Intervention\Image\Facades\Image::make($imageFile->getRealPath())->save($path);
            $image->filename = $filename;
        }
        $image->description = $request->input('description');
        $image->title = $request->input('title');
        $image->category_id = $category->id;
        $image->publication_id = $publication->id;
        $image->save();
        return redirect("publication/view/{$publication->id}");
    }


    public function insertConstruct($publicationId,$constructId = null)
    {
        $publication = Publication::findOrFail($publicationId);
        $construct = ($constructId) ? Construct::findOrFail($constructId) : new Construct();
        return view("publication.item.construct",[
            'publication' => $publication,
            'construct' => $construct,
            'classifications'=>Classification::all()
        ]);
    }

    

    public function saveConstruct(Request $request)
    {
        $id = $request->input('id');
        $publication = $this->publicationRepository->findById($request->input('publication_id'));
        $construct = ($id) ? Construct::findOrFail($id) : new Construct();
        $imageFile = Input::file('image');
        if($imageFile) {
            $filename  = time() . '.' . $imageFile->getClientOriginalExtension();
            $path = public_path('images/' . $filename);
            \Intervention\Image\Facades\Image::make($imageFile->getRealPath())->save($path);
            $construct->image = $filename;
        }
        $exampleFile = Input::file('example_image');
        if($exampleFile) {
            $filenameb  = time() . 'b.' . $exampleFile->getClientOriginalExtension();
            $path = public_path('images/' . $filenameb);
            \Intervention\Image\Facades\Image::make($exampleFile->getRealPath())->save($path);
            $construct->example_image = $filenameb;
        }

        $construct->description = $request->input('description');
        $construct->type = $request->input('type');
        $construct->form = $request->input('form');
        $construct->concept = $request->input('concept');
        $construct->priorization = $request->input('priorization');
        $construct->publications_id = $publication->id;
        $construct->save();

        foreach ($construct->representationForms()->get() as $rep)
        {
            $construct->representationForms()->detach($rep);
        }
        if($request->input('representation')) {
            foreach ($request->input('representation') as $item) {
                $tag = RepresentationForm::findOrFail($item);
                $construct->representationForms()->attach($tag);
            }
        }
        return redirect("publication/construct/show/{$construct->id}");
    }

    private function saveTag(Category $category,Publication $publication,Request $request,$image = null)
    {
        $publication = ($image) ? $image : $publication;
        foreach ($publication->tags()->where('category_id','=',$category->id)->get() as $tag)
        {
            $publication->tags()->detach($tag);
        }
        if($request->input('item')) {
            foreach ($request->input('item') as $item) {
                $tag = Tag::findOrFail($item);
                $publication->tags()->attach($tag);
            }
        }
        if($request->input('others'))
        {
            $itens = explode(',',$request->input('others'));
            foreach ($itens as $item){
                $tag = new Tag([
                    'name' => $item,
                    'category_id' => $category->id,
                    'description' => ''
                ]);
                $tag->save();
                $publication->tags()->attach($tag);
            }
        }
    }

    public function autoComplete(Request $request)
    {
        $publications = Publication::select('id',DB::raw("concat(short_title, '|', title) as value"))->where('approved','=',true)->where(function($query) {
            $term = \Illuminate\Support\Facades\Request::input('term');
            $query->where('title','like',"%$term%")
            ->orWhere('short_title','like',"%$term%");
        })->limit(20)->get()->toArray();
        return response()->json($publications);
    }

}
