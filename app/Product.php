<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'size' => 'array'
    ];

    protected $fillable = [
        'name', 'description', 'status', 'code', 'size', 'price'
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
