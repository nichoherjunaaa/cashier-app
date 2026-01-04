@extends('layouts.cashier')
@section('title', ' Laporan - Sistem Transaksi')
@section('header_title', 'Laporan Transaksi')
@section('header_subtitle', 'Ringkasan laporan transaksi dan analisis penjualan')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Periode Laporan</label>
                    <div class="flex space-x-2">
                        <button class="period-btn px-4 py-2 border rounded-lg bg-primary text-white"
                            data-period="today">Hari Ini</button>
                        <button class="period-btn px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50"
                            data-period="week">Minggu Ini</button>
                        <button class="period-btn px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50"
                            data-period="month">Bulan Ini</button>
                        <button class="period-btn px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50"
                            data-period="year">Tahun Ini</button>
                    </div>
                </div>
            </div>

            <div class="flex space-x-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" id="startDate" value="{{ $startDate }}"
                        class="border rounded-lg py-2 px-3 input-focus focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" id="endDate" value="{{ $endDate }}"
                        class="border rounded-lg py-2 px-3 input-focus focus:outline-none">
                </div>

                <div class="flex items-end">
                    <button id="filterBtn"
                        class="bg-secondary hover:bg-secondary-dark text-white py-2 px-6 rounded-lg h-[42px]">
                        Terapkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card-hover bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                    <p class="{{ $percentageChangeRevenue >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                        <i class="fas {{ $percentageChangeRevenue >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs(round($percentageChangeRevenue, 1)) }}% dari periode lalu
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-wallet text-primary text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Transaksi</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $totalTransactions }}</p>
                    <p class="{{ $percentageChangeTransactions >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                        <i class="fas {{ $percentageChangeTransactions >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs(round($percentageChangeTransactions, 1)) }}% dari periode lalu
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-secondary text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Rata-rata Transaksi</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">Rp
                        {{ number_format($averageTransaction, 0, ',', '.') }}
                    </p>
                    <p class="{{ $percentageChangeAverage >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                        <i class="fas {{ $percentageChangeAverage >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs(round($percentageChangeAverage, 1)) }}% dari periode lalu
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center">
                    <i class="fas fa-chart-line text-accent text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Barang Terjual</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ number_format($totalItemsSold, 0, ',', '.') }}
                    </p>
                    <p class="{{ $percentageChangeItems >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                        <i class="fas {{ $percentageChangeItems >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ abs(round($percentageChangeItems, 1)) }}% dari periode lalu
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-box text-primary-dark text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Utama -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Grafik Pendapatan -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-dark">Pendapatan Harian</h3>
            </div>
            <div class="h-72">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Grafik Kategori -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-dark">Penjualan per Kategori</h3>
                <div class="text-sm text-gray-500">
                    <i class="fas fa-calendar-alt mr-2"></i> {{ $startDate }} - {{ $endDate }}
                </div>
            </div>
            <div class="h-72">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik dan Tabel -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Grafik Metode Pembayaran -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-primary-dark mb-6">Metode Pembayaran</h3>
            <div class="h-64">
                <canvas id="paymentChart"></canvas>
            </div>
        </div>

        <!-- Barang Terlaris -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-dark">5 Barang Terlaris</h3>
                <a href="#" class="text-primary hover:text-primary-dark text-sm font-medium">
                    Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Barang
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Terjual
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pendapatan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bestSellingItems as $item)
                            <tr class="table-row-hover">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-box text-primary text-sm"></i>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->item->name ?? 'Barang Terhapus' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->total_sold }}</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-bold text-primary-dark">
                                        Rp{{ number_format($item->total_sold * ($item->item->price ?? 0), 0, ',', '.') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-gray-500">
                                    Tidak ada data barang terlaris
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-primary-dark">Transaksi Terbaru</h3>
            <a href="#" class="text-primary hover:text-primary-dark text-sm font-medium">
                Lihat semua transaksi <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No. Transaksi
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Item
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Metode
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($latestTransactions as $transaction)
                        <tr class="table-row-hover">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $transaction->transaction_code }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction->created_at->format('d M Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $transaction->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction->items->count() }} item</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary-dark">Rp
                                    {{ number_format($transaction->total, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $paymentMethod = strtolower($transaction->payment_method ?? 'tunai');
                                    $paymentClasses = [
                                        'tunai' => 'bg-blue-100 text-blue-800',
                                        'debit' => 'bg-purple-100 text-purple-800',
                                        'qris' => 'bg-green-100 text-green-800',
                                        'credit' => 'bg-yellow-100 text-yellow-800',
                                        'transfer' => 'bg-gray-100 text-gray-800'
                                    ];
                                    $paymentText = [
                                        'tunai' => 'Tunai',
                                        'debit' => 'Debit',
                                        'qris' => 'QRIS',
                                        'credit' => 'Kredit',
                                        'transfer' => 'Transfer'
                                    ];
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paymentClasses[$paymentMethod] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $paymentText[$paymentMethod] ?? $transaction->payment_method }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // console.log('Chart.js loaded:', typeof Chart !== 'undefined');
        let revenueChart = null;
        let categoryChart = null;
        let paymentChart = null;
        let currentChartPeriod = 'daily';

        const revenueData = {
            daily: {
                labels: @json($dailyRevenue['labels'] ?? []),
                data: @json($dailyRevenue['data'] ?? [])
            },
            weekly: {
                labels: @json($weeklyRevenue['labels'] ?? []),
                data: @json($weeklyRevenue['data'] ?? [])
            },
            monthly: {
                labels: @json($monthlyRevenue['labels'] ?? []),
                data: @json($monthlyRevenue['data'] ?? [])
            }
        };

        const categoryData = {
            labels: @json($categorySales['labels'] ?? []),
            data: @json($categorySales['data'] ?? [])
        };

        const paymentData = {
            labels: @json($paymentMethods['labels'] ?? []),
            data: @json($paymentMethods['data'] ?? [])
        };

        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        function initRevenueChart(period = 'daily') {
            const canvas = document.getElementById('revenueChart');
            if (!canvas) {
                console.error('Canvas revenueChart tidak ditemukan');
                return;
            }

            const ctx = canvas.getContext('2d');

            if (revenueChart) {
                revenueChart.destroy();
            }

            const data = revenueData[period];

            if (!data || data.data.length === 0) {
                console.warn('Tidak ada data untuk grafik pendapatan', period);
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = '#999';
                ctx.font = '16px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('Tidak ada data pendapatan', canvas.width / 2, canvas.height / 2);
                return;
            }

            revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Pendapatan',
                        data: data.data,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: '#3b82f6',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
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
                                    return formatRupiah(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'rb';
                                    }
                                    return formatRupiah(value);
                                }
                            },
                            grid: {
                                drawBorder: false
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

        function initCategoryChart() {
            const canvas = document.getElementById('categoryChart');
            if (!canvas) {
                console.error('Canvas categoryChart tidak ditemukan');
                return;
            }

            const ctx = canvas.getContext('2d');

            if (categoryChart) {
                categoryChart.destroy();
            }

            if (!categoryData.data || categoryData.data.length === 0) {
                console.warn('Tidak ada data untuk grafik kategori');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = '#999';
                ctx.font = '16px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('Tidak ada data kategori', canvas.width / 2, canvas.height / 2);
                return;
            }

            categoryChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: categoryData.labels,
                    datasets: [{
                        data: categoryData.data,
                        backgroundColor: [
                            '#3b82f6', 
                            '#10b981', 
                            '#f59e0b', 
                            '#8b5cf6', 
                            '#ef4444', 
                            '#6b7280', 
                            '#ec4899', 
                            '#14b8a6', 
                            '#f97316', 
                            '#84cc16'  
                        ],
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 11
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${formatRupiah(value)} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }

        function initPaymentChart() {
            const canvas = document.getElementById('paymentChart');
            if (!canvas) {
                console.error('Canvas paymentChart tidak ditemukan');
                return;
            }

            const ctx = canvas.getContext('2d');

            if (paymentChart) {
                paymentChart.destroy();
            }

            if (!paymentData.data || paymentData.data.length === 0) {
                console.warn('Tidak ada data untuk grafik metode pembayaran');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                console.log(paymentData.data);
                ctx.fillStyle = '#999';
                ctx.font = '16px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('Tidak ada data metode pembayaran', canvas.width / 2, canvas.height / 2);
                return;
            }

            paymentChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: paymentData.labels,
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: paymentData.data,
                        backgroundColor: [
                            '#3b82f6', 
                            '#8b5cf6', 
                            '#10b981', 
                            '#f59e0b', 
                            '#ef4444', 
                            '#6b7280',
                            '#ec4899',
                            '#14b8a6',  
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                drawBorder: false
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

        function updateChartPeriod(period) {
            currentChartPeriod = period;
            initRevenueChart(period);

            document.querySelectorAll('.chart-period-btn').forEach(btn => {
                if (btn.getAttribute('data-chart') === period) {
                    btn.classList.add('bg-primary', 'text-white');
                    btn.classList.remove('text-gray-700', 'hover:bg-gray-50');
                } else {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('text-gray-700', 'hover:bg-gray-50');
                }
            });
        }

        function updateReportPeriod(period) {
            const today = new Date();
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');

            let startDate = new Date();
            let endDate = new Date();

            switch (period) {
                case 'today':
                    startDate = today;
                    endDate = today;
                    break;
                case 'week':
                    const day = today.getDay();
                    const diff = today.getDate() - day + (day === 0 ? -6 : 1);
                    startDate = new Date(today.setDate(diff));
                    endDate = new Date();
                    break;
                case 'month':
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                    break;
                case 'year':
                    startDate = new Date(today.getFullYear(), 0, 1);
                    endDate = new Date(today.getFullYear(), 11, 31);
                    break;
            }

            startDateInput.value = startDate.toISOString().split('T')[0];
            endDateInput.value = endDate.toISOString().split('T')[0];
        }

        function filterReportData() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (!startDate || !endDate) {
                alert('Mohon isi kedua tanggal');
                return;
            }

            if (new Date(startDate) > new Date(endDate)) {
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir');
                return;
            }

            window.location.href = `{{ route('report') }}?start_date=${startDate}&end_date=${endDate}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM Loaded, initializing charts...');

            initRevenueChart('daily');
            initCategoryChart();
            initPaymentChart();

            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const period = this.getAttribute('data-period');

                    document.querySelectorAll('.period-btn').forEach(b => {
                        b.classList.remove('bg-primary', 'text-white');
                        b.classList.add('text-gray-700', 'hover:bg-gray-50');
                    });

                    this.classList.add('bg-primary', 'text-white');
                    this.classList.remove('text-gray-700', 'hover:bg-gray-50');

                    updateReportPeriod(period);
                });
            });

            document.getElementById('filterBtn').addEventListener('click', filterReportData);

            const urlParams = new URLSearchParams(window.location.search);
            const hasDateParams = urlParams.has('start_date') || urlParams.has('end_date');

            if (!hasDateParams) {
                document.querySelector('[data-period="today"]').classList.add('bg-primary', 'text-white');
                document.querySelector('[data-period="today"]').classList.remove('text-gray-700', 'hover:bg-gray-50');
            }


            console.log('Charts initialized successfully');
        });
        window.addEventListener('resize', function () {
            if (revenueChart) {
                revenueChart.resize();
            }
            if (categoryChart) {
                categoryChart.resize();
            }
            if (paymentChart) {
                paymentChart.resize();
            }
        });
    </script>
@endpush