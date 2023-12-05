<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'total_amount',
        'points_earned',
        'points_used',
        'created_at',
        'updated_at',
    ];

    public function transaction_detail()
    {
        return $this->belongsTo(TransactionDetails::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
