<?php

namespace App\Http\Controllers\Admin;

use App\QualityQuestions;
use App\Repository\QualityQuestionsRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class QualityController extends Controller
{

    private $qualityQuestionsRepository;

    public function __construct(QualityQuestionsRepository $qualityQuestionsRepository)
    {
        if(Gate::denies('rule','admin')) return abort(403);
        $this->qualityQuestionsRepository = $qualityQuestionsRepository;
    }

    public function index()
    {
        return view('admin.quality.list',[
            'qualityQuestions'=>$this->qualityQuestionsRepository->listAllPaginate()
        ]);
    }

    public function edit($id = null)
    {
        $quality = ($id) ? $this->qualityQuestionsRepository->findById($id) : new QualityQuestions();
        return view('admin.quality.form',[
            'quality'=>$quality
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'question'=>'required',
            'intermediary_value'=>'required',
        ]);
        if($request->input('id')) {
            $quality = $this->qualityQuestionsRepository->findById($request->input('id'));
            $quality->question = $request->input('question');
            $quality->intermediary_value = $request->input('intermediary_value');
        } else {
            $quality = new QualityQuestions($request->all());
        }
        $quality->save();
        return redirect('/admin/quality')->with('status','Quality Question saved!');
    }
    
}
