<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionsOld extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions_olds';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'city',
        'province',
        'kecamatan',
        'kelurahan',
        'address',
        'postal_code',
        'total_amount',
        'points_earned',
        'points_used',
        'temp_points_used',
        'status',
        'payment_status',
        'proof_of_payment',
        'created_at',
        'updated_at',
    ];

    public function transaction_detail_old()
    {
        return $this->belongsTo(TransactionDetailsOld::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
