<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Item;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        try {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();

            if ($end->lt($start)) {
                $end = $start->copy();
            }
        } catch (\Exception $e) {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfDay();
            $startDate = $start->format('Y-m-d');
            $endDate = $end->format('Y-m-d');
        }

        // 1. Statistik Utama
        $totalTransactions = Transaction::whereBetween('created_at', [$start, $end])->count();
        $totalRevenue = Transaction::whereBetween('created_at', [$start, $end])->sum('total') ?? 0;

        // Total items sold dengan join yang benar
        $totalItemsSold = TransactionItem::join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$start, $end])
            ->sum('transaction_items.qty') ?? 0;

        $averageTransaction = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;

        // 2. Persentase perubahan dari periode sebelumnya
        $previousStart = $start->copy()->subDays($end->diffInDays($start) + 1);
        $previousEnd = $start->copy()->subDay();

        $previousTotalTransactions = Transaction::whereBetween('created_at', [$previousStart, $previousEnd])->count();
        $previousTotalRevenue = Transaction::whereBetween('created_at', [$previousStart, $previousEnd])->sum('total') ?? 0;

        $previousTotalItemsSold = TransactionItem::join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$previousStart, $previousEnd])
            ->sum('transaction_items.qty') ?? 0;

        $previousAverageTransaction = $previousTotalTransactions > 0 ? $previousTotalRevenue / $previousTotalTransactions : 0;

        // Hitung persentase perubahan
        $percentageChangeRevenue = $this->calculatePercentageChange($totalRevenue, $previousTotalRevenue);
        $percentageChangeTransactions = $this->calculatePercentageChange($totalTransactions, $previousTotalTransactions);
        $percentageChangeItems = $this->calculatePercentageChange($totalItemsSold, $previousTotalItemsSold);
        $percentageChangeAverage = $this->calculatePercentageChange($averageTransaction, $previousAverageTransaction);

        // 3. Data Grafik
        $dailyRevenue = $this->getDailyRevenueData($start, $end);
        $weeklyRevenue = $this->getWeeklyRevenueData($start, $end);
        $monthlyRevenue = $this->getMonthlyRevenueData($start, $end);

        // 4. Data Kategori dengan query yang diperbaiki
        $categorySales = $this->getCategorySalesData($start, $end);

        // 5. Data Metode Pembayaran
        $paymentMethods = $this->getPaymentMethodData($start, $end);

        // 6. Barang Terlaris dengan query yang diperbaiki
        $bestSellingItems = $this->getBestSellingItems($start, $end, 5);
        // dd($bestSellingItems->toArray());
        // 7. Transaksi Terbaru
        $latestTransactions = Transaction::with('items')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('report', compact(
            'startDate',
            'endDate',
            'totalTransactions',
            'totalRevenue',
            'totalItemsSold',
            'averageTransaction',
            'percentageChangeRevenue',
            'percentageChangeTransactions',
            'percentageChangeItems',
            'percentageChangeAverage',
            'dailyRevenue',
            'weeklyRevenue',
            'monthlyRevenue',
            'categorySales',
            'paymentMethods',
            'bestSellingItems',
            'latestTransactions'
        ));
    }

    /**
     * Calculate percentage change
     */
    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return (($current - $previous) / $previous) * 100;
    }

    /**
     * Get daily revenue data for chart
     */
    private function getDailyRevenueData($start, $end)
    {
        $days = [];
        $revenues = [];

        $current = $start->copy();
        while ($current->lte($end)) {
            $days[] = $current->format('j M');
            $revenues[] = Transaction::whereDate('created_at', $current)
                ->sum('total') ?? 0;
            $current->addDay();
        }

        return [
            'labels' => $days,
            'data' => $revenues
        ];
    }

    /**
     * Get weekly revenue data for chart
     */
    private function getWeeklyRevenueData($start, $end)
    {
        $weeks = [];
        $revenues = [];

        $weekStart = $start->copy()->startOfWeek();
        $weekEnd = $weekStart->copy()->endOfWeek();

        $weekCount = 1;
        while ($weekStart->lte($end)) {
            if ($weekStart->lte($end) && $weekEnd->gte($start)) {
                $weeks[] = "Minggu $weekCount";
                $revenues[] = Transaction::whereBetween('created_at', [
                    max($weekStart, $start),
                    min($weekEnd, $end)
                ])->sum('total') ?? 0;
                $weekCount++;
            }
            $weekStart->addWeek();
            $weekEnd = $weekStart->copy()->endOfWeek();
        }

        return [
            'labels' => $weeks,
            'data' => $revenues
        ];
    }

    /**
     * Get monthly revenue data for chart
     */
    private function getMonthlyRevenueData($start, $end)
    {
        $months = [];
        $revenues = [];

        $monthStart = $start->copy()->startOfMonth();
        $monthEnd = $monthStart->copy()->endOfMonth();

        while ($monthStart->lte($end)) {
            $months[] = $monthStart->format('M Y');
            $revenues[] = Transaction::whereBetween('created_at', [
                max($monthStart, $start),
                min($monthEnd, $end)
            ])->sum('total') ?? 0;
            $monthStart->addMonth();
            $monthEnd = $monthStart->copy()->endOfMonth();
        }

        return [
            'labels' => $months,
            'data' => $revenues
        ];
    }

    /**
     * Get sales data by category - DIPERBAIKI
     */
    private function getCategorySalesData($start, $end)
    {
        try {
            $result = DB::table('transaction_items')
                ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
                ->join('items', 'transaction_items.item_code', '=', 'items.item_code')
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->whereBetween('transactions.created_at', [$start, $end])
                ->select(
                    'categories.name',
                    DB::raw('SUM(transaction_items.qty * items.price) as total_sales')
                )
                ->groupBy('categories.name')
                ->orderByDesc('total_sales')
                ->get();

            return [
                'labels' => $result->pluck('name'),
                'data' => $result->pluck('total_sales')->map(fn($v) => (int) $v),
            ];
        } catch (\Throwable $e) {
            \Log::error('Category sales chart error: ' . $e->getMessage());

            return [
                'labels' => [],
                'data' => [],
            ];
        }
    }


    /**
     * Get payment method data
     */
    private function getPaymentMethodData($start, $end)
{
    $payments = Transaction::select(
            DB::raw('LOWER(payment_method) as method'),
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('created_at', [$start, $end])
        ->whereNotNull('payment_method')
        ->where('payment_method', '!=', '')
        ->groupBy('method')
        ->get();

    return [
        'labels' => $payments->map(fn($p) => $this->getPaymentMethodName($p->method)),
        'data' => $payments->pluck('count'),
    ];
}


    /**
     * Get best selling items - DIPERBAIKI
     */
    private function getBestSellingItems($start, $end, $limit = 10)
    {
        try {
            return TransactionItem::select(
                'item_code',
                DB::raw('SUM(qty) as total_sold')
            )
                ->groupBy('item_code')
                ->orderByDesc('total_sold')
                ->with('item')
                ->whereHas('transaction', function ($query) use ($start, $end) {
                    $query->whereBetween('created_at', [$start, $end]);
                })
                ->limit($limit)
                ->get();

        } catch (\Exception $e) {
            \Log::error('Error getting best selling items: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Convert payment method code to name
     */
    private function getPaymentMethodName($method)
    {
        $methods = [
            'debit' => 'Debit',
            'qris' => 'QRIS',
            'credit' => 'Kredit',
            'transfer' => 'Transfer',
            'tunai' => 'Tunai'
        ];

        return $methods[strtolower($method)] ?? ucfirst($method);
    }
}