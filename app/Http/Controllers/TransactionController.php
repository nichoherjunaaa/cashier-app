<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItem;
use DB;
use Illuminate\Http\Request;
use Str;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('transaction', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer',
            'total_amount' => 'required|integer',
            'payment_method' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'transaction_code' => 'TRX-' . strtoupper(Str::random(8)),
                'total' => $request->total_amount,
                'payment_method' => $request->payment_method,
                'user_id' => auth()->id()
            ]);

            foreach ($request->items as $item) {

            $itemModel = Item::where('id', $item['item_id'])
                ->lockForUpdate()
                ->first();

            if (!$itemModel) {
                throw new \Exception('Item tidak ditemukan');
            }

            if ($itemModel->stock < $item['quantity']) {
                throw new \Exception(
                    'Stok ' . $itemModel->name . ' tidak mencukupi'
                );
            }

            $itemModel->decrement('stock', $item['quantity']);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'item_code' => $itemModel->item_code,
                'qty' => $item['quantity'],
                'subtotal' => $item['quantity'] * $item['price'],
            ]);
        }


            DB::commit();

            return response()->json([
                'message' => 'Transaksi berhasil disimpan',
                'transaction_id' => $transaction->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menyimpan transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
