@extends('layouts.cashier')
@section('title', 'Sistem Kasir - Barang')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Barang</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">48</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-boxes text-primary text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-secondary">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Stok Tersedia</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">1,245</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                    <i class="fas fa-warehouse text-secondary text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-accent">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Stok Menipis</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">9</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-accent text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary-dark">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Habis Stok</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">3</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-times-circle text-primary-dark text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" id="searchBarang" placeholder="Cari barang berdasarkan nama, kode, atau kategori..."
                        class="w-full pl-10 pr-4 py-3 border rounded-lg input-focus focus:outline-none">
                </div>
            </div>

            <div class="flex space-x-4">
                <div class="relative">
                    <select id="filterKategori"
                        class="border rounded-lg py-3 px-4 pr-10 appearance-none input-focus focus:outline-none">
                        <option value="">Semua Kategori</option>
                        <option value="minuman">Minuman</option>
                        <option value="makanan">Makanan</option>
                        <option value="snack">Snack</option>
                        <option value="atk">ATK</option>
                        <option value="bahan-pokok">Bahan Pokok</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-4 text-gray-400"></i>
                </div>

                <div class="relative">
                    <select id="filterStok"
                        class="border rounded-lg py-3 px-4 pr-10 appearance-none input-focus focus:outline-none">
                        <option value="">Semua Stok</option>
                        <option value="tersedia">Stok Tersedia</option>
                        <option value="menipis">Stok Menipis</option>
                        <option value="habis">Habis Stok</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-4 text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Barang -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="selectAll" class="rounded">
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Barang
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kode
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stok
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="barangTableBody">
                    <!-- Data barang akan ditambahkan melalui JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination dan Info -->
        <div class="px-6 py-4 border-t flex flex-col md:flex-row md:items-center justify-between">
            <div class="mb-4 md:mb-0">
                <p class="text-sm text-gray-700">
                    Menampilkan
                    <span id="startItem" class="font-medium">1</span> -
                    <span id="endItem" class="font-medium">10</span> dari
                    <span id="totalItem" class="font-medium">48</span> barang
                </p>
            </div>

            <div class="flex items-center space-x-2">
                <button id="prevPage"
                    class="px-3 py-1 border rounded-md text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="flex space-x-1">
                    <button class="page-btn px-3 py-1 border rounded-md bg-primary text-white">1</button>
                    <button class="page-btn px-3 py-1 border rounded-md text-gray-700">2</button>
                    <button class="page-btn px-3 py-1 border rounded-md text-gray-700">3</button>
                    <button class="page-btn px-3 py-1 border rounded-md text-gray-700">4</button>
                    <button class="page-btn px-3 py-1 border rounded-md text-gray-700">5</button>
                </div>
                <button id="nextPage" class="px-3 py-1 border rounded-md text-gray-700">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
@endsection