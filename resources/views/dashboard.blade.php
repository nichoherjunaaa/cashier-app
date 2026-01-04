@extends('layouts.cashier')
@section('title', 'Beranda - Sistem Transaksi')
@section('header_title', 'Dashboard Beranda')
@section('header_subtitle', 'Ringkasan aktivitas dan statistik sistem kasir')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="dashboard-stat bg-white rounded-xl shadow-md p-6 border-l-4 border-primary">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Pendapatan Hari Ini</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">Rp {{ number_format($income_today, 0, ',', '.') }}</p>
                    <p class="{{ $percentage_increase_income >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                        <i class="fas {{ $percentage_increase_income >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs(round($percentage_increase_income, 1)) }}% dari kemarin
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-wallet text-primary text-xl"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-stat bg-white rounded-xl shadow-md p-6 border-l-4 border-secondary">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Transaksi</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $transactions_today }}</p>
                    <p class="{{ $percentage_increase_transactions >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                        <i class="fas {{ $percentage_increase_transactions >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs(round($percentage_increase_transactions, 1)) }}% dari kemarin
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-secondary text-xl"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-stat bg-white rounded-xl shadow-md p-6 border-l-4 border-accent">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Barang Terjual</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $items_sold_today }}</p>
                    <p class="{{ $percentage_increase_items >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                        <i class="fas {{ $percentage_increase_items >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs(round($percentage_increase_items, 1)) }}% dari kemarin
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center">
                    <i class="fas fa-box text-accent text-xl"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-stat bg-white rounded-xl shadow-md p-6 border-l-4 border-primary-dark">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Stok Menipis</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $item_low_stock }}</p>
                    @if ($item_low_stock > 0)
                        <p class="text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Periksa segera
                        </p>
                    @else
                        <p class="text-green-600 text-sm mt-1">
                            <i class="fas fa-check-circle mr-1"></i> Stok aman
                        </p>
                    @endif
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-exclamation text-primary-dark text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-dark">Pendapatan 7 Hari Terakhir</h3>
                <div class="flex items-center space-x-2">
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        {{ Carbon\Carbon::now()->subDays(6)->format('d M') }} -
                        {{ Carbon\Carbon::now()->format('d M Y') }}
                    </div>
                    <button id="toggleChartBtn" class="text-primary hover:text-primary-dark text-sm">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>

            <div class="mt-6 pt-6 border-t">
                <div class="flex justify-between items-center text-sm">
                    <div>
                        <span class="text-gray-500">Total Pendapatan Minggu Ini:</span>
                        <span class="font-bold text-primary-dark ml-2">Rp
                            {{ number_format($income_this_week, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-green-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i> {{ abs($percentage_increase_income_weekly) }}% dari minggu lalu
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-dark">Transaksi Terbaru</h3>
                <a href="{{ route('transaction') }}" class="text-primary hover:text-primary-dark text-sm font-medium">
                    Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="space-y-4">
                @forelse ($latest_transactions as $transaction)
                    <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                                <i class="fas fa-receipt text-secondary text-lg"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $transaction->transaction_code }}</p>
                                <p class="text-sm text-gray-500">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-primary-dark">Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
                            <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-shopping-cart text-3xl mb-3 text-gray-300"></i>
                        <p>Belum ada transaksi hari ini</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-primary-dark mb-6">Barang Terlaris Hari Ini</h3>

            <div class="space-y-4">
    @forelse ($best_selling as $item)
        <div class="flex items-center p-3 border rounded-lg hover:bg-gray-50">
            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mr-4">
                <i class="fas fa-box text-primary"></i>
            </div>

            <div class="flex-1">
                <p class="font-medium text-gray-800">
                    {{ $item->name ?? 'Barang Terhapus' }}
                </p>
                <p class="text-sm text-gray-500">
                    SKU: {{ $item->item_code ?? 'N/A' }}
                </p>
            </div>

            <div class="text-right">
                <p class="font-bold text-primary-dark">
                    {{ $item->total_sold }} terjual
                </p>
                <p class="text-sm text-gray-500">
                    Harga: Rp {{ number_format($item->price ?? 0) }}
                </p>
            </div>
        </div>
    @empty
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-box text-3xl mb-3 text-gray-300"></i>
            <p>Belum ada data penjualan hari ini</p>
        </div>
    @endforelse
</div>

        </div>

        <!-- Aksi Cepat -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-primary-dark mb-6">Aksi Cepat</h3>

            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('transaction') }}"
                    class="card-hover flex flex-col items-center justify-center p-6 border rounded-xl bg-blue-50 hover:bg-blue-100">
                    <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center mb-4">
                        <i class="fas fa-plus text-white text-xl"></i>
                    </div>
                    <p class="font-medium text-primary-dark">Transaksi Baru</p>
                    <p class="text-sm text-gray-600 text-center mt-2">Buat transaksi penjualan baru</p>
                </a>

                <a href="{{ route('item.create') }}"
                    class="card-hover flex flex-col items-center justify-center p-6 border rounded-xl bg-green-50 hover:bg-green-100">
                    <div class="w-14 h-14 rounded-full bg-secondary flex items-center justify-center mb-4">
                        <i class="fas fa-boxes text-white text-xl"></i>
                    </div>
                    <p class="font-medium text-primary-dark">Tambah Barang</p>
                    <p class="text-sm text-gray-600 text-center mt-2">Tambah produk baru ke inventori</p>
                </a>

                <a href="{{ route('item') }}"
                    class="card-hover flex flex-col items-center justify-center p-6 border rounded-xl bg-yellow-50 hover:bg-yellow-100">
                    <div class="w-14 h-14 rounded-full bg-accent flex items-center justify-center mb-4">
                        <i class="fas fa-clipboard-list text-white text-xl"></i>
                    </div>
                    <p class="font-medium text-primary-dark">Daftar Barang</p>
                    <p class="text-sm text-gray-600 text-center mt-2">Lihat semua barang</p>
                </a>

                <a href="{{ route('report') }}"
                    class="card-hover flex flex-col items-center justify-center p-6 border rounded-xl bg-blue-50 hover:bg-blue-100">
                    <div class="w-14 h-14 rounded-full bg-primary-dark flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <p class="font-medium text-primary-dark">Analisis</p>
                    <p class="text-sm text-gray-600 text-center mt-2">Lihat analisis penjualan</p>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let revenueChart;
    let currentChartType = 'line';
    let chartData = {
        labels: @json($chart_labels ?? []),
        datasets: [{
            label: 'Pendapatan',
            data: @json($chart_data ?? []),
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#3b82f6',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    };

    function formatRupiah(amount) {
        if (!amount) amount = 0;
        return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
    }

    function initLineChart() {
        const ctx = document.getElementById('revenueChart');
        if (!ctx) return;

        if (revenueChart) {
            revenueChart.destroy();
        }

        revenueChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#1e40af',
                        bodyColor: '#374151',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 12,
                        boxPadding: 6,
                        callbacks: {
                            label: function (context) {
                                return `Pendapatan: ${formatRupiah(context.raw)}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function (value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + 'jt';
                                }
                                return 'Rp ' + value.toLocaleString('id-ID');
                            },
                            color: '#6b7280',
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest'
                },
                elements: {
                    line: {
                        tension: 0.4
                    }
                }
            }
        });
    }

    function toggleChart() {
        if (currentChartType === 'line') {
            currentChartType = 'bar';
            initBarChart();
            document.getElementById('toggleChartBtn').innerHTML = '<i class="fas fa-chart-line"></i>';
        } else {
            currentChartType = 'line';
            initLineChart();
            document.getElementById('toggleChartBtn').innerHTML = '<i class="fas fa-chart-bar"></i>';
        }
    }

    function initBarChart() {
        const ctx = document.getElementById('revenueChart');
        if (!ctx) return;

        if (revenueChart) {
            revenueChart.destroy();
        }

        revenueChart = new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: chartData.datasets[0].data,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `Pendapatan: ${formatRupiah(context.raw)}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function (value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + 'jt';
                                }
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initLineChart();

        const statCards = document.querySelectorAll('.dashboard-stat');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.classList.add('card-hover');
            });

            card.addEventListener('mouseleave', function () {
                this.classList.remove('card-hover');
            });
        });

        const toggleBtn = document.getElementById('toggleChartBtn');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                toggleChart();
            });
        }
    });
</script>
@endpush