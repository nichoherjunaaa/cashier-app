@extends('layouts.cashier')
@section('title', 'Sistem Kasir - Laporan')

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
                    <input type="date" id="startDate" value="2023-06-01"
                        class="border rounded-lg py-2 px-3 input-focus focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" id="endDate" value="2023-06-18"
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">Rp 28.450.000</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 15% dari periode lalu
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">312</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 8% dari periode lalu
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">Rp 91.186</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 6% dari periode lalu
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">1,245</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 12% dari periode lalu
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
                <div class="flex space-x-2">
                    <button class="chart-period-btn px-3 py-1 text-sm border rounded-lg bg-primary text-white"
                        data-chart="daily">Harian</button>
                    <button class="chart-period-btn px-3 py-1 text-sm border rounded-lg text-gray-700"
                        data-chart="weekly">Mingguan</button>
                    <button class="chart-period-btn px-3 py-1 text-sm border rounded-lg text-gray-700"
                        data-chart="monthly">Bulanan</button>
                </div>
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
                    <i class="fas fa-calendar-alt mr-2"></i> 1-18 Juni 2023
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
                <h3 class="text-lg font-bold text-primary-dark">10 Barang Terlaris</h3>
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
                        <tr class="table-row-hover">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-coffee text-primary text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Kopi Arabica 250g</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">142</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary-dark">Rp 6.390.000</div>
                            </td>
                        </tr>

                        <tr class="table-row-hover">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-green-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-leaf text-secondary text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Teh Hijau 100g</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">128</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary-dark">Rp 4.096.000</div>
                            </td>
                        </tr>

                        <tr class="table-row-hover">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-yellow-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-cube text-accent text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Gula Pasir 1kg</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">98</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary-dark">Rp 1.764.000</div>
                            </td>
                        </tr>

                        <tr class="table-row-hover">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-tint text-primary text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Air Mineral 600ml</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">87</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary-dark">Rp 435.000</div>
                            </td>
                        </tr>

                        <tr class="table-row-hover">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-wine-bottle text-primary text-sm"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Susu UHT 1L</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">76</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary-dark">Rp 1.672.000</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-primary-dark">Transaksi Terbaru</h3>
            <a href="transaksi.html" class="text-primary hover:text-primary-dark text-sm font-medium">
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
                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">TRX-20230618-005</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">18 Juni 2023</div>
                            <div class="text-sm text-gray-500">14:30</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">5 item</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-primary-dark">Rp 189.000</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Tunai
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </td>
                    </tr>

                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">TRX-20230618-004</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">18 Juni 2023</div>
                            <div class="text-sm text-gray-500">12:15</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">3 item</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-primary-dark">Rp 74.000</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                QRIS
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </td>
                    </tr>

                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">TRX-20230618-003</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">18 Juni 2023</div>
                            <div class="text-sm text-gray-500">10:45</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">8 item</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-primary-dark">Rp 256.000</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                Debit
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </td>
                    </tr>

                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">TRX-20230617-015</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">17 Juni 2023</div>
                            <div class="text-sm text-gray-500">18:20</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">2 item</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-primary-dark">Rp 32.000</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Tunai
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </td>
                    </tr>

                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">TRX-20230617-014</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">17 Juni 2023</div>
                            <div class="text-sm text-gray-500">16:10</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">6 item</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-primary-dark">Rp 142.000</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                QRIS
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Chart instances
        let revenueChart, categoryChart, paymentChart;
        let currentChartPeriod = 'daily';

        // Data untuk grafik
        const revenueData = {
            daily: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'],
                data: [850000, 920000, 780000, 950000, 1100000, 1050000, 980000, 1250000, 1150000, 1080000, 1320000, 1280000, 1400000, 1350000, 1420000, 1380000, 1550000, 1650000]
            },
            weekly: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                data: [5800000, 7200000, 8500000, 6950000]
            },
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                data: [24500000, 26800000, 31200000, 29500000, 32400000, 28450000]
            }
        };

        // Fungsi untuk format Rupiah
        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Fungsi untuk inisialisasi grafik pendapatan
        function initRevenueChart(period = 'daily') {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            if (revenueChart) {
                revenueChart.destroy();
            }

            const data = revenueData[period];

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
                                        return 'Rp ' + (value / 1000000) + 'jt';
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

        // Fungsi untuk inisialisasi grafik kategori
        function initCategoryChart() {
            const ctx = document.getElementById('categoryChart').getContext('2d');

            categoryChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Minuman', 'Makanan', 'Snack', 'ATK', 'Bahan Pokok', 'Lainnya'],
                    datasets: [{
                        data: [12500000, 5800000, 4200000, 1800000, 2900000, 900000],
                        backgroundColor: [
                            '#3b82f6', // Biru
                            '#10b981', // Hijau
                            '#f59e0b', // Kuning
                            '#8b5cf6', // Ungu
                            '#ef4444', // Merah
                            '#6b7280'  // Abu-abu
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
                                pointStyle: 'circle'
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

        // Fungsi untuk inisialisasi grafik metode pembayaran
        function initPaymentChart() {
            const ctx = document.getElementById('paymentChart').getContext('2d');

            paymentChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Tunai', 'Debit', 'QRIS', 'Kredit'],
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: [185, 74, 48, 5],
                        backgroundColor: [
                            '#3b82f6', // Biru
                            '#8b5cf6', // Ungu
                            '#10b981', // Hijau
                            '#f59e0b'  // Kuning
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

        // Fungsi untuk update grafik berdasarkan periode
        function updateChartPeriod(period) {
            currentChartPeriod = period;
            initRevenueChart(period);

            // Update tombol aktif
            document.querySelectorAll('.chart-period-btn').forEach(btn => {
                if (btn.getAttribute('data-chart') === period) {
                    btn.classList.add('bg-primary', 'text-white');
                    btn.classList.remove('text-gray-700');
                } else {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('text-gray-700');
                }
            });
        }

        // Fungsi untuk update periode laporan
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
                    // Mulai dari Senin minggu ini
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

            // Format tanggal untuk input
            startDateInput.value = startDate.toISOString().split('T')[0];
            endDateInput.value = endDate.toISOString().split('T')[0];

            // Update teks periode di modal print
            updatePrintPeriodText();

            // Simulasi filter data
            filterReportData();
        }

        // Fungsi untuk update teks periode di modal print
        function updatePrintPeriodText() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            const start = new Date(startDate);
            const end = new Date(endDate);

            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const startStr = start.toLocaleDateString('id-ID', options);
            const endStr = end.toLocaleDateString('id-ID', options);

            document.getElementById('printPeriodText').textContent =
                startStr === endStr ? startStr : `${startStr} - ${endStr}`;
        }

        // Fungsi untuk filter data laporan
        function filterReportData() {
            // Di implementasi nyata, ini akan memanggil API atau memfilter data lokal
            // Untuk sekarang kita hanya menampilkan notifikasi
            showNotification('Filter laporan diterapkan');

            // Update statistik (simulasi)
            updateStatistics();
        }

        // Fungsi untuk update statistik
        function updateStatistics() {
            // Di implementasi nyata, ini akan menghitung berdasarkan periode yang dipilih
            // Untuk sekarang kita buat statis
        }

        // Fungsi untuk menampilkan modal print
        function showPrintModal() {
            updatePrintPeriodText();
            document.getElementById('printModal').classList.remove('hidden');
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message) {
            // Buat elemen notifikasi
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-primary text-white p-4 rounded-lg shadow-lg z-50 transform translate-x-full opacity-0 transition-all duration-300';
            notification.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span>${message}</span>
                    </div>
                `;

            document.body.appendChild(notification);

            // Animasi masuk
            setTimeout(() => {
                notification.classList.remove('translate-x-full', 'opacity-0');
                notification.classList.add('translate-x-0', 'opacity-100');
            }, 10);

            // Animasi keluar setelah 3 detik
            setTimeout(() => {
                notification.classList.remove('translate-x-0', 'opacity-100');
                notification.classList.add('translate-x-full', 'opacity-0');

                // Hapus elemen setelah animasi selesai
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi semua grafik
            initRevenueChart('daily');
            initCategoryChart();
            initPaymentChart();

            // Set tanggal default
            const today = new Date();
            const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);

            document.getElementById('startDate').value = firstDay.toISOString().split('T')[0];
            document.getElementById('endDate').value = today.toISOString().split('T')[0];

            // Event listener untuk tombol periode laporan
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const period = this.getAttribute('data-period');

                    // Update tombol aktif
                    document.querySelectorAll('.period-btn').forEach(b => {
                        if (b.getAttribute('data-period') === period) {
                            b.classList.add('bg-primary', 'text-white');
                            b.classList.remove('text-gray-700');
                        } else {
                            b.classList.remove('bg-primary', 'text-white');
                            b.classList.add('text-gray-700');
                        }
                    });

                    updateReportPeriod(period);
                });
            });

            // Event listener untuk tombol periode grafik
            document.querySelectorAll('.chart-period-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const period = this.getAttribute('data-chart');
                    updateChartPeriod(period);
                });
            });

            // Event listener untuk tombol filter
            document.getElementById('filterBtn').addEventListener('click', filterReportData);

            // Event listener untuk tombol print
            document.getElementById('printReportBtn').addEventListener('click', showPrintModal);

            // Event listener untuk tombol export
            document.getElementById('exportReportBtn').addEventListener('click', function () {
                // Di implementasi nyata, ini akan mengekspor data ke Excel
                showNotification('Laporan berhasil diekspor ke Excel');
            });

            document.getElementById('exportPDFBtn').addEventListener('click', function () {
                // Di implementasi nyata, ini akan mengekspor data ke PDF
                showNotification('Laporan berhasil diekspor ke PDF');
            });

            // Event listener untuk modal print
            document.getElementById('closePrintModalBtn').addEventListener('click', function () {
                document.getElementById('printModal').classList.add('hidden');
            });

            document.getElementById('cancelPrintBtn').addEventListener('click', function () {
                document.getElementById('printModal').classList.add('hidden');
            });

            document.getElementById('printNowBtn').addEventListener('click', function () {
                const reportType = document.getElementById('reportType').value;
                const printFormat = document.querySelector('input[name="printFormat"]:checked').value;

                if (printFormat === 'preview') {
                    showNotification('Membuka pratinjau laporan...');
                    // Di implementasi nyata, ini akan membuka pratinjau cetak
                } else {
                    showNotification('Mencetak laporan...');
                    // Di implementasi nyata, ini akan langsung mencetak
                }

                document.getElementById('printModal').classList.add('hidden');
            });

            // Event listener untuk perubahan tanggal
            document.getElementById('startDate').addEventListener('change', updatePrintPeriodText);
            document.getElementById('endDate').addEventListener('change', updatePrintPeriodText);

            // Sidebar navigation active state
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    if (this.getAttribute('href') === '#') {
                        e.preventDefault();
                    }

                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endsection