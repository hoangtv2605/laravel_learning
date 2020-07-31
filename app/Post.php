<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public $directory = '/images/';

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'content', 'user_id', 'path'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function photos() {
        return $this->morphMany('App\Photo', 'imageable');
    }

    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function getPathAttribute($value) {
        return $this->directory.$value;
    }
}

