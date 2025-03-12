<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        if(Gate::denies('rule','admin')) return abort(403);
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('admin.category.list',[
            'categories'=>$this->categoryRepository->listAllPaginate()
        ]);
    }

    public function edit($id = null)
    {
        $category = ($id) ? $this->categoryRepository->findById($id) : new Category();
        return view('admin.category.form',[
            'category'=>$category
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'type'=>'required',
            'total_allowed'=>'required'
        ]);
        if($request->input('type') == 'image' AND Category::where('type','=','image')->where('id','!=',$request->input('id'))->count() > 0)
        {
            return redirect('/admin/category')->with('error','Only One Image Category is enabled');
        }
        if($request->input('id')) {
            $category = $this->categoryRepository->findById($request->input('id'));
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->type = $request->input('type');
            $category->total_allowed = $request->input('total_allowed');
            $category->image_category = $request->input('image_category');
        } else {
            $category = new Category($request->all());
        }
        $category->save();
        return redirect('/admin/category')->with('status','Category saved!');
    }

}
