<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model {

    protected $fillable = [
        'title', 'story', 'image', 'slug', 'category_id', 'user_id', 'is_published',
    ];

    public function tags() {

        return $this->belongsToMany( 'App\Tag' );
        // return $this->belongsToMany('App\Tag', 'story_tag', 'story_id', 'tag_id');
    }

    public function user() {

        return $this->belongsTo( 'App\User' );
    }

    public function category() {

        return $this->belongsTo( 'App\Category' );
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->latest();
    }
}
