@extends('layouts.cashier')
@section('title', 'Sistem Kasir - Tambah Barang')
@section('header_title', 'Tambah Barang')
@section('header_subtitle', 'Barang baru dapat ditambahkan ke dalam sistem untuk dikelola dan dijual.')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Alert Notification -->
        <div id="alertMessage" class="hidden mb-6 p-4 rounded-lg"></div>
        
        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-8">
            <!-- Form Header -->
            <div class="mb-8 pb-6 border-b">
                <h3 class="text-xl font-bold text-primary-dark mb-2">
                    <i class="fas fa-box text-primary mr-2"></i> Informasi Barang
                </h3>
                <p class="text-gray-600">Isi semua field yang wajib diisi</p>
            </div>
            
            <!-- Form -->
            <form id="barangForm" class="space-y-8">
                @csrf
                
                <!-- Nama Barang -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="text-red-500">*</span> Nama Barang
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-box text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="name" 
                               name="name"
                               class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                               placeholder="Contoh: Kopi Arabica 250g"
                               required>
                    </div>
                </div>
                
                <!-- Kode Barang -->
                <div>
                    <label for="item_code" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="text-red-500">*</span> Kode Barang
                    </label>
                    <div class="flex space-x-3">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-barcode text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   id="item_code" 
                                   name="item_code"
                                   class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                                   placeholder="Otomatis tergenerate"
                                   readonly>
                        </div>
                        <button type="button" 
                                id="generateCodeBtn" 
                                class="px-4 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg font-medium transition duration-200 whitespace-nowrap">
                            <i class="fas fa-sync-alt mr-2"></i> Generate
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Kode akan digenerate otomatis berdasarkan kategori</p>
                    <div id="itemCodeStatus" class="hidden mt-1">
                        <p class="text-xs flex items-center">
                            <i class="fas fa-check-circle mr-1 text-green-500"></i>
                            <span id="itemCodeMessage" class="text-green-600"></span>
                        </p>
                    </div>
                </div>
                
                <!-- Harga dan Stok -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="text-red-500">*</span> Harga Jual
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" 
                                   id="price" 
                                   name="price"
                                   min="0" 
                                   step="100"
                                   class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                                   placeholder="0"
                                   required>
                        </div>
                    </div>
                    
                    <!-- Stok -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="text-red-500">*</span> Stok Awal
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-warehouse text-gray-400"></i>
                            </div>
                            <input type="number" 
                                   id="stock" 
                                   name="stock"
                                   min="0"
                                   class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                                   placeholder="0"
                                   required>
                        </div>
                    </div>
                </div>
                
                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="text-red-500">*</span> Kategori
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <select id="category_id"
                                name="category_id"
                                class="w-full pl-10 pr-10 py-3 border rounded-lg appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 bg-white"
                                required>
                            <option value="">Pilih Kategori Barang</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" data-code="{{ $category->code_prefix }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3 pt-8 border-t">
                    
                    <button type="submit" 
                            id="submitBtn" 
                            class="px-6 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition duration-200 flex items-center disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <i class="fas fa-save mr-2"></i> Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-primary-dark mb-2">Berhasil!</h3>
                    <p class="text-gray-600 mb-4">Barang baru berhasil ditambahkan ke sistem.</p>
                    
                    <div class="flex flex-col space-y-3">
                        <button id="addMoreBtn" 
                                class="px-4 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg font-medium">
                            <i class="fas fa-plus mr-2"></i> Tambah Barang Lagi
                        </button>
                        <a href="{{ route('item') }}" 
                           class="px-4 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-list mr-2"></i> Lihat Daftar Barang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('barangForm');
        const submitBtn = document.getElementById('submitBtn');
        const successModal = document.getElementById('successModal');
        const addMoreBtn = document.getElementById('addMoreBtn');
        const generateCodeBtn = document.getElementById('generateCodeBtn');
        const categorySelect = document.getElementById('category_id');
        const itemCodeInput = document.getElementById('item_code');
        const alertMessage = document.getElementById('alertMessage');
        const itemCodeStatus = document.getElementById('itemCodeStatus');
        const itemCodeMessage = document.getElementById('itemCodeMessage');

        // Kategori prefix mapping
        const categoryPrefixes = {
            @foreach ($categories as $category)
                '{{ $category->id }}': '{{ $category->code_prefix }}',
            @endforeach
        };

        // Cek kode item di database
        async function checkItemCode(code) {
            try {
                const response = await fetch("{{ route('item.check-code') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ item_code: code })
                });

                const result = await response.json();
                return result;
            } catch (error) {
                console.error('Error checking item code:', error);
                return { exists: false, message: 'Error checking code' };
            }
        }

        // Tampilkan status kode item
        function showItemCodeStatus(message, type = 'success') {
            itemCodeStatus.classList.remove('hidden');
            itemCodeMessage.textContent = message;
            
            if (type === 'success') {
                itemCodeMessage.className = 'text-green-600';
                itemCodeStatus.querySelector('i').className = 'fas fa-check-circle mr-1 text-green-500';
            } else if (type === 'warning') {
                itemCodeMessage.className = 'text-yellow-600';
                itemCodeStatus.querySelector('i').className = 'fas fa-exclamation-triangle mr-1 text-yellow-500';
            } else {
                itemCodeMessage.className = 'text-red-600';
                itemCodeStatus.querySelector('i').className = 'fas fa-times-circle mr-1 text-red-500';
            }
        }

        // Sembunyikan status kode item
        function hideItemCodeStatus() {
            itemCodeStatus.classList.add('hidden');
        }

        // Cari kode yang belum digunakan
        async function findAvailableCode(prefix, startFrom = 1, maxAttempts = 100) {
            for (let i = startFrom; i <= maxAttempts; i++) {
                const sequence = i.toString().padStart(3, '0');
                const code = `${prefix}-${sequence}`;
                
                const result = await checkItemCode(code);
                if (!result.exists) {
                    return { code: code, sequence: i };
                }
            }
            return null;
        }

        // Generate item code berdasarkan kategori
        async function generateItemCode() {
            const categoryId = categorySelect.value;
            
            if (!categoryId) {
                showAlert('Pilih kategori terlebih dahulu', 'error');
                categorySelect.focus();
                return;
            }

            const prefix = categoryPrefixes[categoryId] || 'BRG';
            
            // Get last sequence number
            const key = `last_sequence_${prefix}`;
            let startSequence = parseInt(localStorage.getItem(key)) || 1;
            
            // Cari kode yang tersedia
            const availableCode = await findAvailableCode(prefix, startSequence);
            
            if (!availableCode) {
                showAlert('Tidak dapat menemukan kode yang tersedia. Silakan coba lagi.', 'error');
                return;
            }
            
            const { code, sequence } = availableCode;
            
            // Simpan sequence terakhir
            localStorage.setItem(key, sequence);
            
            // Set nilai input
            itemCodeInput.value = code;
            
            // Cek ulang untuk konfirmasi
            const checkResult = await checkItemCode(code);
            if (checkResult.exists) {
                // Jika ternyata ada (race condition), coba lagi dengan sequence berikutnya
                localStorage.setItem(key, sequence + 1);
                generateItemCode();
                return;
            }
            
            // Aktifkan tombol submit
            submitBtn.disabled = false;
            
            // Tampilkan status
            showItemCodeStatus(`Kode ${code} tersedia dan siap digunakan`, 'success');
            
            showAlert(`Kode barang berhasil digenerate: ${code}`, 'success');
        }

        // Auto generate ketika kategori berubah
        categorySelect.addEventListener('change', async function() {
            if (this.value && !itemCodeInput.value) {
                await generateItemCode();
            } else if (this.value && itemCodeInput.value) {
                // Jika sudah ada kode, cek apakah kode masih valid
                const currentCode = itemCodeInput.value;
                const checkResult = await checkItemCode(currentCode);
                
                if (checkResult.exists) {
                    showItemCodeStatus(`Kode ${currentCode} sudah digunakan. Generate kode baru.`, 'warning');
                    submitBtn.disabled = true;
                    
                    // Auto generate kode baru
                    setTimeout(async () => {
                        await generateItemCode();
                    }, 1000);
                }
            }
        });

        // Manual generate button
        generateCodeBtn.addEventListener('click', async function() {
            await generateItemCode();
        });

        // Validasi kode saat input manual (jika readonly dihapus)
        itemCodeInput.addEventListener('blur', async function() {
            const code = this.value.trim();
            if (code) {
                const checkResult = await checkItemCode(code);
                
                if (checkResult.exists) {
                    showItemCodeStatus(`Kode ${code} sudah digunakan di database`, 'error');
                    submitBtn.disabled = true;
                } else {
                    showItemCodeStatus(`Kode ${code} tersedia`, 'success');
                    submitBtn.disabled = false;
                }
            }
        });

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
            const code = document.getElementById('item_code').value.trim();
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

            // Validate item code
            if (!code) {
                showAlert('Kode barang harus diisi. Klik tombol "Generate"', 'error');
                generateCodeBtn.focus();
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
                showAlert('Stok tidak boleh kosong atau negatif', 'error');
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
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!validateForm()) {
                return;
            }

            // Double check kode item sebelum submit
            const code = itemCodeInput.value.trim();
            const checkResult = await checkItemCode(code);
            
            if (checkResult.exists) {
                showAlert(`Kode ${code} sudah digunakan. Silakan generate kode baru.`, 'error');
                submitBtn.disabled = true;
                showItemCodeStatus(`Kode ${code} sudah digunakan`, 'error');
                return;
            }

            // Prepare form data
            const formData = new FormData(this);

            // Show loading state
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
            submitBtn.disabled = true;

            try {
                const response = await fetch("{{ route('item.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
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
                
                // Jika error karena kode duplikat
                if (error.message.includes('kode') || error.message.includes('item_code')) {
                    submitBtn.disabled = true;
                    showItemCodeStatus('Kode sudah digunakan, generate kode baru', 'error');
                }
            } finally {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // Close modal when clicking outside
        successModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });

        // Add more button
        addMoreBtn.addEventListener('click', function() {
            successModal.classList.add('hidden');
            form.reset();
            itemCodeInput.value = '';
            hideItemCodeStatus();
            submitBtn.disabled = true;
            document.getElementById('name').focus();
        });

        // Auto generate code if category is already selected
        if (categorySelect.value) {
            generateItemCode();
        }

        // Auto focus on name field
        document.getElementById('name').focus();
    });
</script>
@endpush