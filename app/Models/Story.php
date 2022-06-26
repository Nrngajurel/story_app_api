<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'story';
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
