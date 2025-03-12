<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{

    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }

}
