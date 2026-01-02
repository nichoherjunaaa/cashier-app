<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Statistik hari ini
        $income_today = Transaction::whereDate('created_at', $today)->sum('total');
        $transactions_today = Transaction::whereDate('created_at', $today)->count();
        $items_sold_today = TransactionItem::whereDate('created_at', $today)->sum('qty');

        // Statistik kemarin
        $income_yesterday = Transaction::whereDate('created_at', $yesterday)->sum('total');
        $transactions_yesterday = Transaction::whereDate('created_at', $yesterday)->count();
        $items_sold_yesterday = TransactionItem::whereDate('created_at', $yesterday)->sum('qty');

        // Persentase perubahan
        $percentage_increase_income = $income_yesterday > 0
            ? (($income_today - $income_yesterday) / $income_yesterday) * 100
            : 100;

        $percentage_increase_transactions = $transactions_yesterday > 0
            ? (($transactions_today - $transactions_yesterday) / $transactions_yesterday) * 100
            : 100;
        $percentage_increase_items = $items_sold_yesterday > 0
            ? (($items_sold_today - $items_sold_yesterday) / $items_sold_yesterday) * 100
            : 100;

        // Stok menipis
        $item_low_stock = Item::where('stock', '>', 0)
            ->where('stock', '<=', 10)
            ->count();

        // Chart data 7 hari terakhir
        $chart_labels = [];
        $chart_data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chart_labels[] = $date->format('d/m');

            $income = Transaction::whereDate('created_at', $date)->sum('total');
            $chart_data[] = $income;
        }

        // Pendapatan minggu ini dan minggu lalu
        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->copy()->endOfWeek();
        $startOfLastWeek = $startOfWeek->copy()->subWeek();
        $endOfLastWeek = $endOfWeek->copy()->subWeek();

        $income_this_week = Transaction::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total');
        $income_last_week = Transaction::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->sum('total');

        $percentage_increase_income_weekly = $income_last_week > 0
            ? (($income_this_week - $income_last_week) / $income_last_week) * 100
            : 0;

        // Transaksi terbaru
        $latest_transactions = Transaction::with('items')
            ->latest()
            ->take(5)
            ->get();

        $best_selling = DB::table('transaction_items')
            ->join('items', 'items.item_code', '=', 'transaction_items.item_code')
            ->select(
                'items.item_code',
                'items.name',
                'items.price',
                DB::raw('SUM(transaction_items.qty) as total_sold')
            )
            ->whereDate('transaction_items.created_at', $today)
            ->groupBy('items.item_code', 'items.name', 'items.price')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();



        return view('dashboard', compact(
            'income_today',
            'transactions_today',
            'items_sold_today',
            'income_yesterday',
            'transactions_yesterday',
            'items_sold_yesterday',
            'percentage_increase_income',
            'percentage_increase_transactions',
            'percentage_increase_items',
            'item_low_stock',
            'chart_labels',
            'chart_data',
            'income_this_week',
            'income_last_week',
            'percentage_increase_income_weekly',
            'latest_transactions',
            'best_selling'
        ));
    }

    private function getRevenueLast7Days()
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(6); // 7 hari termasuk hari ini

        $results = [];

        // Generate array untuk semua hari dalam rentang
        for ($date = clone $startDate; $date <= $endDate; $date->addDay()) {
            $dayName = $this->getDayNameIndonesian($date->dayOfWeek);
            $results[$date->format('Y-m-d')] = [
                'label' => $dayName,
                'date' => $date->format('d/m'),
                'revenue' => 0
            ];
        }

        // Ambil data dari database
        $revenues = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total')
        )
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Gabungkan data dari database dengan array hasil
        foreach ($results as $date => &$data) {
            if (isset($revenues[$date])) {
                $data['revenue'] = (int) $revenues[$date]->total;
            }
        }

        // Format untuk chart
        $labels = [];
        $dataPoints = [];
        $total = 0;

        foreach ($results as $item) {
            $labels[] = $item['label'];
            $dataPoints[] = $item['revenue'];
            $total += $item['revenue'];
        }

        return [
            'labels' => $labels,
            'data' => $dataPoints,
            'total' => $total
        ];
    }

    /**
     * Konversi nomor hari ke nama hari dalam bahasa Indonesia
     */
    private function getDayNameIndonesian($dayOfWeek)
    {
        $days = [
            0 => 'Min',
            1 => 'Sen',
            2 => 'Sel',
            3 => 'Rab',
            4 => 'Kam',
            5 => 'Jum',
            6 => 'Sab',
        ];

        return $days[$dayOfWeek] ?? 'Unknown';
    }
}