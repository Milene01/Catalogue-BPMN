<?php

namespace App\Http\Controllers;

use App\Category;
use App\Classification;
use App\ConflictCategory;
use App\Conflicts;
use App\Construct;
use App\Publication;
use App\Repository\CategoryRepository;
use App\Repository\PublicationRepository;
use App\RepresentationForm;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class WelcomeController extends Controller
{

    private  $publicationRepository;

    private $treeList;

    public function __construct(PublicationRepository $publicationRepository)
    {
        $this->publicationRepository = $publicationRepository;
        $this->treeList = [];
    }


    /**
     * @todo Atenção isso não é performático, trabalhei em algo melhor assim que possível
     */
    private function tree($roots)
    {
        $this->treeList = array_merge($this->treeList, $roots->toArray());
        foreach($roots as $item)
        {
            $this->tree($item->publications()
                ->select('id','descendants.root_id as parentId','short_title','title','authors','year','journal')
                ->leftJoin('descendants','publications.id','=','descendants.descendant_id')
                ->where('approved','=',true)->get());
        }
    }

    /**
     * @deprecated Switch for about in home page, for publication list use WelcomeController@publications
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        $publication = ($query) ? $this->publicationRepository->listAcceptedLikeAuthorOrTitle($query) : $this->publicationRepository->listAccepted();
        return view('welcome',[
            'publications' => $publication,
            'query' => $query
        ]);
    }

    public function treeview()
    {
            $roots = Publication::select('id','descendants.root_id as parentId','short_title','title','authors','year','journal')
                ->leftJoin('descendants','publications.id','=','descendants.descendant_id')
                ->where('publications_id','=',null)
                ->where('approved','=',true)
                ->get();
            $this->tree($roots);
            return view('angularapp.welcome',[
                'publications' => \GuzzleHttp\json_encode($this->treeList)
            ]);

    }


    public function publications(Request $request)
    {
        $query = $request->input('q');
        $filter = $request->input('f');
        $publication = ($query or $filter) ? $this->publicationRepository->listAcceptedLikeAuthorOrTitle($query,$filter) : $this->publicationRepository->listAccepted();
        return view('welcome',[
            'publications' => $publication,
            'query' => $query,
            'filter' => $filter,
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    public function constructs(Request $request)
    {
            $roots = DB::table('constructs')
                ->join('publications','constructs.publications_id','=','publications.id')
                ->leftJoin('publications_tags','constructs.publications_id','=','publications_tags.publication_id')
                ->leftJoin('tags','publications_tags.tag_id','=','tags.id')
                ->select('constructs.*',DB::raw("group_concat(tags.name SEPARATOR ', ') as tag_name"))
                ->where('publications.approved','=',true)
                ->groupBy('constructs.id')
                ->orderBy('tag_name')
                ->orderBy('priorization','desc');
            $concept = $request->input('c');
            $applicationArea = $request->input('a');
            $form = $request->input('f');
            $type = $request->input('t');
            $classification = $request->input('cl');
            if($concept) $roots->where('constructs.concept','like',"%$concept%");
            if($applicationArea) $roots->where('tags.id','=',$applicationArea);
            if($form) $roots->where('constructs.form','=',$form);
            if($type) $roots->where('constructs.type','=',$type);         
            if($classification) {
                $list = DB::table('constructs_representation_forms')->select('constructs_id')->where('representation_forms_id','=',$classification)->get();
                $ar = [];
                foreach ($list as $l){
                    $ar[] = $l->constructs_id;
                }
                $roots->whereIn('constructs.id',$ar);
            }
            return view('angularapp.constructs',[
                'constructs' => $roots->paginate(20),
                'tags'=>Tag::where('category_id','=',18)->orderBy('name')->get(),
                'forms'=>Construct::select('form')->groupBy('form')->get(),
                'classifications'=>Classification::all(),
                'types' => ['entity','relantioship'],
                'form'=>$form,
                'type'=>$type,
                'concept'=>$concept,
                'classification'=>$classification,
                'applicationArea'=>$applicationArea
            ]);
    }

    public function conflicts(Request $request)
    {
        $roots = Conflicts::orderBy('description');
        $type = $request->input('t');
        if($type) $roots->where('conflict_category_id','=',$type);
        return view('angularapp.conflicts',[
            'conflicts' => $roots->paginate(20),
            'types' => ConflictCategory::all(),
            'type'=>$type,
        ]);
    }

}
