<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conflicts extends Model
{

    public $timestamps = false;

    public $fillable = ['description','conflict_category_id'];

    public function constructs()
    {
        return $this->belongsToMany('App\Construct','conflicts_constructs','conflict_id','constructs_id');
    }

    public function conflictCategory()
    {
        return $this->belongsTo('App\ConflictCategory','conflict_category_id');
    }

}
