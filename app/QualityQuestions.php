<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualityQuestions extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'question','intermediary_value'
    ];
    
    public function publications()
    {
        return $this->belongsToMany('App\Publications','publications_quality_questions')->withPivot(['value']);
    }
    
}
