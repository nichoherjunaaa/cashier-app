@extends('layouts.cashier')
@section('title', 'Edit Barang - Sistem Transaksi')
@section('header_title', 'Edit Barang')
@section('header_subtitle', 'Perbarui informasi barang yang ada')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div id="alertMessage" class="hidden mb-6 p-4 rounded-lg"></div>

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-8">
            <div class="mb-8 pb-6 border-b">
                <h3 class="text-xl font-bold text-primary-dark mb-2">
                    <i class="fas fa-edit text-primary mr-2"></i> Edit Barang
                </h3>
                <p class="text-gray-600">Perbarui informasi barang yang ada</p>
            </div>

            <form id="barangForm" method="POST" action="{{ route('item.update', $item->id) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="text-red-500">*</span> Nama Barang
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-box text-gray-400"></i>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}"
                            class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                            placeholder="Contoh: Kopi Arabica 250g" required>
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="item_code" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="text-red-500">*</span> Kode Barang
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-barcode text-gray-400"></i>
                        </div>
                        <input type="text" id="item_code" name="item_code" value="{{ old('item_code', $item->item_code) }}"
                            class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 bg-gray-50"
                            placeholder="Kode barang" required readonly>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Kode barang tidak dapat diubah</p>
                    @error('item_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="text-red-500">*</span> Harga Jual
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" min="0"
                                step="100"
                                class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                                placeholder="0" required>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="text-red-500">*</span> Stok
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-warehouse text-gray-400"></i>
                            </div>
                            <input type="number" id="stock" name="stock" value="{{ old('stock', $item->stock) }}" min="0"
                                class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                                placeholder="0" required>
                        </div>
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="text-red-500">*</span> Kategori
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <select id="category_id" name="category_id"
                            class="w-full pl-10 pr-10 py-3 border rounded-lg appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 bg-white"
                            required>
                            <option value="">Pilih Kategori Barang</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h4 class="font-bold text-blue-800 mb-3 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i> Informasi Barang
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-700">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            <span>Ditambahkan: {{ $item->created_at->format('d F Y H:i') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar-edit mr-2"></i>
                            <span>Terakhir diubah: {{ $item->updated_at->format('d F Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-8 border-t">
                    <a href="{{ route('item') }}"
                        class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" id="submitBtn"
                        class="px-6 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i> Perbarui Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="successModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>

        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-primary-dark mb-2">Berhasil!</h3>
                    <p class="text-gray-600 mb-4">Barang berhasil diperbarui.</p>

                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('item') }}"
                            class="px-4 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg font-medium">
                            <i class="fas fa-list mr-2"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('barangForm');
            const submitBtn = document.getElementById('submitBtn');
            const successModal = document.getElementById('successModal');
            const alertMessage = document.getElementById('alertMessage');

            // Show alert function
            function showAlert(message, type = 'info') {
                alertMessage.classList.remove('hidden');

                if (type === 'error') {
                    alertMessage.className = 'mb-6 p-4 rounded-lg bg-red-100 border-l-4 border-red-500 text-red-700';
                    alertMessage.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3"></i>
                            <span>${message}</span>
                            <button onclick="this.parentElement.parentElement.classList.add('hidden')" 
                                    class="ml-auto text-red-700 hover:text-red-900">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                } else if (type === 'success') {
                    alertMessage.className = 'mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 text-green-700';
                    alertMessage.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3"></i>
                            <span>${message}</span>
                            <button onclick="this.parentElement.parentElement.classList.add('hidden')" 
                                    class="ml-auto text-green-700 hover:text-green-900">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                } else {
                    alertMessage.className = 'mb-6 p-4 rounded-lg bg-blue-100 border-l-4 border-blue-500 text-blue-700';
                    alertMessage.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            <span>${message}</span>
                            <button onclick="this.parentElement.parentElement.classList.add('hidden')" 
                                    class="ml-auto text-blue-700 hover:text-blue-900">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                }
            }

            // Form validation
            function validateForm() {
                const name = document.getElementById('name').value.trim();
                const price = document.getElementById('price').value;
                const stock = document.getElementById('stock').value;
                const categoryId = document.getElementById('category_id').value;

                // Reset alert
                alertMessage.classList.add('hidden');

                // Validate name
                if (!name) {
                    showAlert('Nama barang harus diisi', 'error');
                    document.getElementById('name').focus();
                    return false;
                }

                // Validate price
                if (!price || price <= 0) {
                    showAlert('Harga harus lebih dari 0', 'error');
                    document.getElementById('price').focus();
                    return false;
                }

                // Validate stock
                if (stock === '' || parseInt(stock) < 0) {
                    showAlert('Stok tidak boleh negatif', 'error');
                    document.getElementById('stock').focus();
                    return false;
                }

                // Validate category
                if (!categoryId) {
                    showAlert('Kategori harus dipilih', 'error');
                    document.getElementById('category_id').focus();
                    return false;
                }

                return true;
            }

            // Form submission
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                if (!validateForm()) {
                    return;
                }

                // Show loading state
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memperbarui...';
                submitBtn.disabled = true;

                try {
                    const response = await fetch(this.action, {
                        method: "POST",
                        body: new FormData(this),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        throw new Error(result.message || 'Terjadi kesalahan');
                    }

                    // Show success modal
                    successModal.classList.remove('hidden');

                } catch (error) {
                    showAlert(error.message, 'error');

                    // Jika error karena validasi Laravel
                    if (error.errors) {
                        let errorMessage = '';
                        for (const field in error.errors) {
                            errorMessage += error.errors[field][0] + '\n';
                        }
                        showAlert(errorMessage, 'error');
                    }
                } finally {
                    // Reset button state
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });

            // Close modal when clicking outside
            successModal.addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    window.location.href = "{{ route('item') }}";
                }
            });

            // Auto focus on name field
            document.getElementById('name').focus();
        });
    </script>
@endpush