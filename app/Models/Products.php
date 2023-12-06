<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'description',
        'price',
        'created_at',
        'updated_at',
    ];

    public function product_detail()
    {
        return $this->belongsTo(ProductDetails::class);
    }
}
