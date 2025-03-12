<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Construct extends Model
{

    public $timestamps = false;

    public function representationForms()
    {
        return $this->belongsToMany('App\RepresentationForm','constructs_representation_forms','constructs_id','representation_forms_id');
    }

    public function publication()
    {
        return $this->belongsTo('App\Publication','publications_id');
    }

    public function conflicts()
    {
        return $this->belongsToMany('App\Conflicts','conflicts_constructs','constructs_id','conflict_id');
    }

}
