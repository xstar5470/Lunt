<?php

namespace App\Models;


class Post extends Model
{
    protected $table = 'posts';
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
