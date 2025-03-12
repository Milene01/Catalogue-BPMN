<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepresentationForm extends Model
{

    public $timestamps = false;
    public $table = 'representation_forms';

    public $fillable = ['classification_id','description'];

    public function construct()
    {
        return $this->belongsToMany('App\Constructs','constructs_representation_form','constructs_id','representation_form_id');
    }

    public function classification()
    {
        return $this->belongsTo('App\Classification');
    }

}
