<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $items = Item::all();

        for ($i = 1; $i <= 10; $i++) {

            $transaction = Transaction::create([
                'transaction_code' => 'TRX-' . now()->format('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'payment_method' => collect(['tunai', 'qris'])->random(),
                'user_id' => 1,
                'total' => 0,
                'created_at' => Carbon::today()->addMinutes(rand(1, 600)),
            ]);

            $total = 0;

            $transactionItems = $items->random(rand(2, 5));

            foreach ($transactionItems as $item) {

                $qty = rand(1, 3);
                $subtotal = $qty * $item->price;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'item_code' => $item->item_code,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ]);

                $item->decrement('stock', $qty);

                $total += $subtotal;
            }

            $transaction->update([
                'total' => $total
            ]);
        }
    }
}
