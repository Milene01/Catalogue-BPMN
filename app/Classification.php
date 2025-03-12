<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{

    public $timestamps = false;

    public $table = 'classifications';

    public $fillable = ['description'];

    public function representationForms()
    {
       return $this->hasMany('App\RepresentationForm');
    }

}
