<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content',
    ];

    //Relazione con categories

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    //relazione con i tags

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
