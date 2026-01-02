<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $table = 'transaction_items';
    protected $fillable = [
        'transaction_id',
        'item_code',
        'qty',
        'subtotal'
    ];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function item()
{
    return $this->belongsTo(Item::class, 'item_code', 'item_code');
}
}
