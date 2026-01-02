<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'transaction_code',
        'total',
        'payment_method',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y, H:i');
    }
}
