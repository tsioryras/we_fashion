<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'size' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function picture()
    {
        return $this->hasOne(Picture::class);
    }
}
