@extends('layouts.cashier')
@section('title', 'Transaksi')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-full">
        <!-- Panel Kiri: Daftar Produk -->
        <div class="lg:col-span-2 flex flex-col">
            <!-- Pencarian Produk -->
            <div class="mb-6">
                <div class="flex space-x-4">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" id="searchProduct" placeholder="Cari produk berdasarkan nama atau kode..."
                            class="w-full pl-10 pr-4 py-3 border rounded-lg input-focus focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Daftar Produk dalam Tabel -->
            <div class="bg-white rounded-xl shadow-md flex-1 overflow-hidden flex flex-col">
                <h3 class="text-lg font-bold text-primary-dark p-4 border-b">Daftar Produk</h3>

                <div class="overflow-x-auto flex-1">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Produk
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stok
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Produk 1 -->
                            <tr class="table-row-hover cursor-pointer" data-id="1" data-name="Kopi Arabica 250g"
                                data-price="45000" data-stock="28">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-coffee text-primary text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Kopi Arabica 250g</div>
                                            <div class="text-sm text-gray-500">Kategori: Minuman</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">KP-001</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        28
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 45.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>

                            <!-- Produk 2 -->
                            <tr class="table-row-hover cursor-pointer" data-id="2" data-name="Teh Hijau 100g"
                                data-price="32000" data-stock="15">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-green-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-leaf text-secondary text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Teh Hijau 100g</div>
                                            <div class="text-sm text-gray-500">Kategori: Minuman</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">TH-005</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        15
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 32.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>

                            <!-- Produk 3 -->
                            <tr class="table-row-hover cursor-pointer" data-id="3" data-name="Gula Pasir 1kg"
                                data-price="18000" data-stock="42">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-yellow-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-cube text-accent text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Gula Pasir 1kg</div>
                                            <div class="text-sm text-gray-500">Kategori: Bahan Pokok</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">GP-010</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        42
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 18.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>

                            <!-- Produk 4 -->
                            <tr class="table-row-hover cursor-pointer" data-id="4" data-name="Susu UHT 1L"
                                data-price="22000" data-stock="32">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-wine-bottle text-primary text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Susu UHT 1L</div>
                                            <div class="text-sm text-gray-500">Kategori: Minuman</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">SU-007</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        32
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 22.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>

                            <!-- Produk 5 -->
                            <tr class="table-row-hover cursor-pointer" data-id="5" data-name="Biskuit Coklat 200g"
                                data-price="15000" data-stock="24">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-yellow-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-cookie text-accent text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Biskuit Coklat 200g</div>
                                            <div class="text-sm text-gray-500">Kategori: Snack</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">BC-012</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        24
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 15.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>

                            <!-- Produk 6 -->
                            <tr class="table-row-hover cursor-pointer" data-id="6" data-name="Air Mineral 600ml"
                                data-price="5000" data-stock="65">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-tint text-primary text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Air Mineral 600ml</div>
                                            <div class="text-sm text-gray-500">Kategori: Minuman</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">AM-003</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        65
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 5.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>

                            <!-- Produk 7 -->
                            <tr class="table-row-hover cursor-pointer" data-id="7" data-name="Pulpen Hitam"
                                data-price="7000" data-stock="38">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-green-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-pen text-secondary text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Pulpen Hitam</div>
                                            <div class="text-sm text-gray-500">Kategori: ATK</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">PN-008</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        38
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 7.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>

                            <!-- Produk 8 -->
                            <tr class="table-row-hover cursor-pointer" data-id="8" data-name="Buku Catatan A5"
                                data-price="12000" data-stock="19">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-yellow-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-book text-accent text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Buku Catatan A5</div>
                                            <div class="text-sm text-gray-500">Kategori: ATK</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">BK-015</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        19
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="font-bold text-primary-dark">Rp 12.000</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-1 px-3 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Panel Kanan: Keranjang Belanja -->
        <div class="flex flex-col">
            <div class="bg-white rounded-xl shadow-md p-6 flex-1 flex flex-col">
                <h3 class="text-lg font-bold text-primary-dark mb-6">Keranjang Belanja</h3>

                <!-- Info Transaksi -->
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="font-medium" id="transactionDate">18 Juni 2023, 14:30</span>
                    </div>
                </div>

                <!-- Daftar Item di Keranjang -->
                <div class="flex-1 overflow-y-auto custom-scrollbar mb-6">
                    <div id="cartItems" class="space-y-3">
                        <!-- Item keranjang akan ditambahkan di sini melalui JavaScript -->
                        <div class="text-center text-gray-500 py-8">
                            <i class="fas fa-shopping-cart text-3xl mb-3 text-gray-300"></i>
                            <p>Keranjang belanja kosong</p>
                            <p class="text-sm">Tambahkan produk dari daftar di sebelah kiri</p>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="border-t pt-6">
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-lg font-bold border-t pt-3">
                            <span>Total:</span>
                            <span class="text-primary-dark" id="total">Rp 0</span>
                        </div>
                    </div>

                    <!-- Input Pembayaran -->
                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pembayaran</label>
                            <div class="flex space-x-2 mb-2">
                                <button
                                    class="payment-method-btn flex-1 border rounded-lg py-2 px-3 text-center bg-primary text-white"
                                    data-method="cash">Tunai</button>
                                <button class="payment-method-btn flex-1 border rounded-lg py-2 px-3 text-center"
                                    data-method="debit">Debit</button>
                                <button class="payment-method-btn flex-1 border rounded-lg py-2 px-3 text-center"
                                    data-method="qris">QRIS</button>
                            </div>
                            <input type="number" id="paymentAmount" placeholder="Jumlah pembayaran"
                                class="w-full border rounded-lg py-2 px-3 input-focus focus:outline-none">
                        </div>

                        <div id="changeContainer" class="hidden">
                            <div class="flex justify-between p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-700">Kembalian:</span>
                                <span class="font-bold text-green-700" id="changeAmount">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="space-y-3">
                        <button id="saveTransactionBtn"
                            class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded-lg flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Simpan Transaksi
                        </button>
                        <button id="cancelTransactionBtn"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 rounded-lg">
                            Batalkan Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection