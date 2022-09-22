<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'user_id',
        'post_content',
        'post_image',
        'post_date',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
