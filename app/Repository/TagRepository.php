<?php
/**
 * Created by PhpStorm.
 * User: Tiago
 * Date: 06/05/2016
 * Time: 20:06
 */

namespace App\Repository;


use App\Tag;

class TagRepository
{


    public function listAll()
    {
        return Tag::orderBY('name')->get();
    }

    public function listPaginate()
    {
        return Tag::orderBY('name')->paginate(30);
    }

    public function findById($id)
    {
        return Tag::findOrFail($id);
    }

}