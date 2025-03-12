<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 06/05/16
 * Time: 15:35
 */

namespace App\Repository;


use App\QualityQuestions;
use Illuminate\Support\Facades\DB;

class QualityQuestionsRepository
{

    public function listAll()
    {
        return QualityQuestions::all();
    }

    public function listAllOrderById()
    {
        return QualityQuestions::orderBy("id")->get();
    }

    public function listAllPaginate()
    {
        return QualityQuestions::orderBy('question')->paginate(30);
    }

    public function findById($id)
    {
        return QualityQuestions::findOrFail($id);
    }

}