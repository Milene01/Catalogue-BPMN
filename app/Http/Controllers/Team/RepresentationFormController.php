<?php

namespace App\Http\Controllers\Team;

use App\Classification;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RepresentationForm;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class RepresentationFormController extends Controller
{

    public function __construct()
    {
        if(Gate::denies('rule','team')) return abort(403);
    }

    public function index()
    {
        return view('team.representationform.list',[
            'representations'=>RepresentationForm::orderBy('classification_id')->paginate(30)
        ]);
    }

    public function edit($id = null)
    {
        $representation = ($id) ? RepresentationForm::findOrFail($id) : new RepresentationForm();
        return view('team.representationform.form',[
            'representation'=>$representation,
            'classifications'=>Classification::all()
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'description'=>'required',
            'classification_id'=>'required'
        ]);
        if($request->input('id')) {
            $representation = RepresentationForm::findOrFail($request->input('id'));
            $category = Classification::findOrFail($request->input('classification_id'));
            $representation->description = $request->input('description');
            $representation->classification()->associate($category);
        } else {
            $representation = new RepresentationForm($request->all());
        }
        $representation->save();
        return redirect('/team/representationform')->with('status','Representation Form saved!');
    }

}
