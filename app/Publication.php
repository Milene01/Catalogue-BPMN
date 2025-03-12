<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    
    protected $fillable = [
        'title' ,'year', 'url', 'user_id','image','authors','journal','publication_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','publications_tags')->orderBy('category_id');
    }

    public function constructs()
    {
        return $this->hasMany('App\Construct','publications_id');
    }

    public function publication()
    {
        return $this->belongsTo('App\Publication','publications_id');
    }

    public function publications()
    {
        return $this->hasMany('App\Publication','publications_id');
    }

    public function roots()
    {
        return $this->belongsToMany('App\Publication','descendants','descendant_id','root_id');
    }

    public function suggests()
    {
        return $this->hasMany('App\Suggest');
    }

    public function qualityQuestions()
    {
        return $this->belongsToMany('App\QualityQuestions','publications_quality_questions','publication_id','quality_question_id')->withPivot('value');
    }

    public function tagByCategoryId($id)
    {
        return $this->tags()->where('category_id','=',$id);
    }


    public function textFields()
    {
        return $this->hasMany('App\TextField')->orderBy('category_id');
    }

    public function textByCategoryId($id)
    {
        return $this->textFields()->where('category_id','=',$id);
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function imageByCategoryId($id)
    {
        return $this->images()->where('category_id','=',$id);
    }


}
