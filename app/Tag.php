<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'name','description','category_id'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function publications()
    {
        return $this->belongsToMany('App\Publications','publications_tags');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image','images_tags','image_id','tag_id');
    }

}
