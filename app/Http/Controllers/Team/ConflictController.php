<?php

namespace App\Http\Controllers\Team;

use App\Classification;
use App\ConflictCategory;
use App\Conflicts;
use App\Construct;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ConflictController extends Controller
{

    
    public function __construct()
    {
        if(Gate::denies('rule','team')) return abort(403);
    }

    public function index()
    {
        return view('team.conflict.list',[
            'conflicts'=>Conflicts::orderBy('description')->paginate(30)
        ]);
    }

    public function edit($id = null)
    {
        $conflict = ($id) ? Conflicts::findOrFail($id) : new Conflicts();
        return view('team.conflict.form',[
            'conflict'=>$conflict,
            'categories'=>ConflictCategory::all()
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'description'=>'required',
        ]);
        if($request->input('id')) {
            $conflicts = Conflicts::find($request->input('id'));
            $conflicts->description = $request->input('description');
            $conflicts->conflict_category_id = $request->input('conflict_category_id');
        } else {
            $conflicts = new Conflicts($request->all());
        }
        $conflicts->save();
        $conflicts->constructs()->detach();
        if($request->input('constructs')) {
            foreach ($request->input('constructs') as $c)
            {
                try {
                    $conflicts->constructs()->attach(Construct::findOrFail($c));
                } catch (QueryException $e){}
            }
        }
        return redirect('/team/conflict')->with('status','Conflict saved!');
    }

    public function autoComplete(Request $request)
    {
        $term = $request->input('term');
        $constructs = Construct::select('id','concept as value')->where('concept','like',"%$term%")->limit(20)->get()->toArray();
        return response()->json($constructs);
    }

}
