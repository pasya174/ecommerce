<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'transaction_id',
        'product_details_id',
        'quantity',
        'created_at',
        'updated_at',
    ];

    public function transaction()
    {
        return $this->hasMany(Transactions::class, 'id', 'transaction_id');
    }

    public function product_details()
    {
        return $this->hasMany(ProductDetails::class, 'id', 'product_details_id');
    }
}
