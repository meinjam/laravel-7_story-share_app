<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $fillable = [
        'tag',
    ];

    public function stories() {

        return $this->belongsToMany( 'App\Story' )->latest();
    }
}
