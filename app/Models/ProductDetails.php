<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'product_id',
        'category_id',
        'size',
        'color',
        'stock',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'product_id');
    }

    public function category()
    {
        return $this->hasMany(Categories::class, 'id', 'category_id');
    }
}
