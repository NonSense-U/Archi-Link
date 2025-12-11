<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function media_set()
    {
        return $this->hasOne(MediaSet::class,'id','media_set_id');
    }
}
