<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';

    public $fillable = [
        'product_name',
        'description',
        'price',
        'quantity_available',
        'lead_id'
    ];

    protected $casts = [
        'product_name' => 'string',
        'description' => 'string',
        'price' => 'float',
        'quantity_available' => 'float'
    ];

    public static array $rules = [
        'product_name' => 'required|string|max:100',
        'description' => 'nullable|string|max:65535',
        'price' => 'nullable|numeric',
        'quantity_available' => 'nullable|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'lead_id' => 'nullable'
    ];

    public function lead(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Lead::class, 'lead_id');
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Order::class, 'product_id');
    }
}
