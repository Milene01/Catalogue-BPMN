<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'filename','title','description','category_id','publication_id'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','images_tags','images_id','tags_id')->orderBy('category_id');
    }

}
