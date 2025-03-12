<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextField extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'content','publication_id','category_id'
    ];

    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
