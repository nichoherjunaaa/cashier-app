@extends('layouts.cashier')
@section('title', 'Beranda')

@section('content')
    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="dashboard-stat bg-white rounded-xl shadow-md p-6 border-l-4 border-primary">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Pendapatan Hari Ini</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">Rp 4.250.000</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 12% dari kemarin
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">48</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 5 transaksi lebih banyak
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">127</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 8% dari kemarin
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">9</p>
                    <p class="text-red-600 text-sm mt-1">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Perlu restock
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-exclamation text-primary-dark text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Aktivitas Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Grafik Pendapatan dengan Chart.js (Line Chart) -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-dark">Pendapatan 7 Hari Terakhir</h3>
                <div class="flex items-center space-x-2">
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-calendar-alt mr-2"></i> 12-18 Juni 2023
                    </div>
                    <button id="toggleChartBtn" class="text-primary hover:text-primary-dark text-sm">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>

            <!-- Container untuk Chart.js -->
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>

            <div class="mt-6 pt-6 border-t">
                <div class="flex justify-between items-center text-sm">
                    <div>
                        <span class="text-gray-500">Total Pendapatan Minggu Ini:</span>
                        <span class="font-bold text-primary-dark ml-2">Rp 28.450.000</span>
                    </div>
                    <div class="text-green-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i> 15% dari minggu lalu
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Terbaru -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-dark">Transaksi Terbaru</h3>
                <a href="transaksi.html" class="text-primary hover:text-primary-dark text-sm font-medium">
                    Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="space-y-4">
                <!-- Item Transaksi -->
                <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                            <i class="fas fa-receipt text-secondary text-lg"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">TRX-20230618-001</p>
                            <p class="text-sm text-gray-500">18 Juni 2023, 14:30</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-dark">Rp 850.000</p>
                        <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                    </div>
                </div>

                <!-- Item Transaksi -->
                <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-receipt text-primary text-lg"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">TRX-20230618-002</p>
                            <p class="text-sm text-gray-500">18 Juni 2023, 12:15</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-dark">Rp 420.000</p>
                        <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                    </div>
                </div>

                <!-- Item Transaksi -->
                <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center">
                            <i class="fas fa-receipt text-accent text-lg"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">TRX-20230618-003</p>
                            <p class="text-sm text-gray-500">18 Juni 2023, 10:45</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-dark">Rp 1.250.000</p>
                        <span class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Proses</span>
                    </div>
                </div>

                <!-- Item Transaksi -->
                <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-receipt text-primary text-lg"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">TRX-20230617-015</p>
                            <p class="text-sm text-gray-500">17 Juni 2023, 18:20</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-dark">Rp 320.000</p>
                        <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barang Populer & Aksi Cepat -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Barang Terlaris -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-primary-dark mb-6">Barang Terlaris</h3>

            <div class="space-y-4">
                <!-- Item Barang -->
                <div class="flex items-center p-3 border rounded-lg hover:bg-gray-50">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-box text-primary"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Kopi Arabica 250g</p>
                        <p class="text-sm text-gray-500">SKU: KP-001</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-dark">42 terjual</p>
                        <p class="text-sm text-gray-500">Stok: 28</p>
                    </div>
                </div>

                <!-- Item Barang -->
                <div class="flex items-center p-3 border rounded-lg hover:bg-gray-50">
                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center mr-4">
                        <i class="fas fa-box text-secondary"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Teh Hijau 100g</p>
                        <p class="text-sm text-gray-500">SKU: TH-005</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-dark">36 terjual</p>
                        <p class="text-sm text-gray-500">Stok: 15</p>
                    </div>
                </div>

                <!-- Item Barang -->
                <div class="flex items-center p-3 border rounded-lg hover:bg-gray-50">
                    <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center mr-4">
                        <i class="fas fa-box text-accent"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Gula Pasir 1kg</p>
                        <p class="text-sm text-gray-500">SKU: GP-010</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-dark">29 terjual</p>
                        <p class="text-sm text-gray-500">Stok: 42</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-primary-dark mb-6">Aksi Cepat</h3>

            <div class="grid grid-cols-2 gap-4">
                <a href="transaksi.html"
                    class="card-hover flex flex-col items-center justify-center p-6 border rounded-xl bg-blue-50 hover:bg-blue-100">
                    <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center mb-4">
                        <i class="fas fa-plus text-white text-xl"></i>
                    </div>
                    <p class="font-medium text-primary-dark">Transaksi Baru</p>
                    <p class="text-sm text-gray-600 text-center mt-2">Buat transaksi penjualan baru</p>
                </a>

                <a href="barang.html"
                    class="card-hover flex flex-col items-center justify-center p-6 border rounded-xl bg-green-50 hover:bg-green-100">
                    <div class="w-14 h-14 rounded-full bg-secondary flex items-center justify-center mb-4">
                        <i class="fas fa-boxes text-white text-xl"></i>
                    </div>
                    <p class="font-medium text-primary-dark">Tambah Barang</p>
                    <p class="text-sm text-gray-600 text-center mt-2">Tambah produk baru ke inventori</p>
                </a>

                <a href="laporan.html"
                    class="card-hover flex flex-col items-center justify-center p-6 border rounded-xl bg-yellow-50 hover:bg-yellow-100">
                    <div class="w-14 h-14 rounded-full bg-accent flex items-center justify-center mb-4">
                        <i class="fas fa-file-invoice-dollar text-white text-xl"></i>
                    </div>
                    <p class="font-medium text-primary-dark">Buat Laporan</p>
                    <p class="text-sm text-gray-600 text-center mt-2">Buat laporan penjualan</p>
                </a>

                <a href="laporan.html"
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