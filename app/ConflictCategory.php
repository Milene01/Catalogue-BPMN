<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConflictCategory extends Model
{

    public $timestamps = false;

    public $fillable = ['description'];

    public $table = 'conflict_categories';

    public function conflicts()
    {
        return $this->hasMany('App\Conflict','conflict_category_id');
    }

}
