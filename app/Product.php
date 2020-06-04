<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'size' => 'array'
    ];

    protected $fillable = [
        'name','reference', 'description', 'status', 'code', 'size', 'price'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function picture()
    {
        return $this->hasOne(Picture::class);
    }
}
