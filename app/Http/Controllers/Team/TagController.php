<?php

namespace App\Http\Controllers\Team;

use App\Repository\CategoryRepository;
use App\Repository\TagRepository;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class TagController extends Controller
{
    
    private $tagRepository;
    private $categoryRepository;
    
    public function __construct(TagRepository $tagRepository,CategoryRepository $categoryRepository)
    {
        if(Gate::denies('rule','team')) return abort(403);
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('team.tag.list',[
            'tags'=>$this->tagRepository->listPaginate()
        ]);
    }

    public function edit($id = null)
    {
        $tag = ($id) ? $this->tagRepository->findById($id) : new Tag();
        return view('team.tag.form',[
            'tag'=>$tag,
            'categories'=>$this->categoryRepository->listAllWhereTypeIsTag()
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'category_id'=>'required'
        ]);
        if($request->input('id')) {
            $tag = $this->tagRepository->findById($request->input('id'));
            $category = $this->categoryRepository->findById($request->input('category_id'));
            $tag->name = $request->input('name');
            $tag->description = $request->input('description');
            $tag->category()->associate($category);
        } else {
            $tag = new Tag($request->all());
        }
        $tag->save();
        return redirect('/team/tag')->with('status','Tag saved!');
    }

}
