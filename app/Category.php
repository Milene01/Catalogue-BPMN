<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name','description','type','total_allowed','image_category'
    ];

    public $timestamps = false;


    public function getTypes()
    {
        return ['image','text','tag'];
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }
    
    public function textFields()
    {
        return $this->hasMany('App\TextField');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }


}
