<?php

namespace App\Http\Controllers\Team;

use App\Classification;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ClassificationController extends Controller
{
    
    private $tagRepository;
    private $categoryRepository;
    
    public function __construct()
    {
        if(Gate::denies('rule','team')) return abort(403);
    }

    public function index()
    {
        return view('team.classification.list',[
            'classifications'=>Classification::orderBY('description')->paginate(30)
        ]);
    }

    public function edit($id = null)
    {
        $classification = ($id) ? Classification::findOrFail($id) : new Classification();
        return view('team.classification.form',[
            'classification'=>$classification,
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'description'=>'required',
        ]);
        if($request->input('id')) {
            $classification = Classification::find($request->input('id'));
            $classification->description = $request->input('description');
        } else {
            $classification = new Classification($request->all());
        }
        $classification->save();
        return redirect('/team/classification')->with('status','Classification saved!');
    }

}
