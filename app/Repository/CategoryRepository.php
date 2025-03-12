<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 06/05/16
 * Time: 15:35
 */

namespace App\Repository;


use App\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{

    public function listAll()
    {
        return Category::orderBy("name")->get();
    }

    public function listAllOrderById()
    {
        return Category::orderBy("id")->get();
    }


    public function listAllOrderByName($type = null)
    {
        if (in_array($type,['tag','image','category'])) {
            return Category::where('type','=',$type)->orderBy("name")->get();
        }
        return Category::orderBy("name")->get();
    }

    public function listWithoutImageOrderByName()
    {
        return Category::orderBy("name")->where('type','!=','image')->where('image_category','=',false)->get();
    }

    public function listOnlyImageOrderByName()
    {
        return Category::orderBy("name")->where('type','=','image')->where('image_category','=',false)->get();
    }

    public function listOnlyImageCategoryOrderByName()
    {
        return Category::orderBy("name")->where('image_category','=',true)->get();
    }

    public function listAllPaginate()
    {
        return Category::orderBy('name')->paginate(30);
    }

    public function listAllWhereTypeIsTag()
    {
        return Category::where('type','=','tag')->orderBy("name")->get();
    }

    public function listAllWhereTypeIsImage()
    {
        return Category::where('type','=','image')->orderBy("name")->get();
    }

    public function listAllWhereTypeIsText()
    {
        return Category::where('type','=','text')->orderBy("name")->get();
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

}