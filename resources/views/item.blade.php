@extends('layouts.cashier')
@section('title', 'Sistem Kasir - Barang')
@section('header_title', 'Manajemen Barang')
@section('header_subtitle', 'Kelola stok dan harga barang')

@section('content')
    <!-- Header dengan Tombol Tambah -->
    <div class="flex justify-end items-center mb-8">
        <div>
            <a href="{{ route('item.create') }}" 
               class="bg-primary hover:bg-primary-dark text-white font-medium py-3 px-6 rounded-lg flex items-center transition duration-200">
                <i class="fas fa-plus mr-2"></i> Tambah Barang
            </a>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Barang</p>
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $item_count }}</p>
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $item_stock }}</p>
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $item_low_stock }}</p>
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
                    <p class="text-2xl font-bold text-primary-dark mt-2">{{ $item_out_of_stock }}</p>
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
                    <input type="text" id="searchBarang" placeholder="Cari barang berdasarkan nama atau kode..."
                        class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                </div>
            </div>
            <div class="flex space-x-4">
                <div class="relative">
                    <select id="filterKategori"
                        class="border rounded-lg py-3 px-4 pr-10 appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-4 text-gray-400"></i>
                </div>

                <!-- Tombol Reset Filter -->
                <button type="button" id="resetFilterBtn"
                        class="px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-redo mr-2"></i> Reset
                </button>
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
                            #
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
                    @foreach ($items as $index => $item)
                        <tr class="hover:bg-gray-50 transition duration-150" data-item-id="{{ $item->id }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $items->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-box text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                        <div class="text-xs text-gray-500">Ditambah: {{ $item->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">{{ $item->item_code }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">
                                    {{ $item->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary-dark">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $item->stock ?? 'Unlimited' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    $statusText = 'Tidak Diketahui';
                                    
                                    if ($item->stock === null) {
                                        $statusClass = 'bg-blue-100 text-blue-800';
                                        $statusText = 'Unlimited';
                                    } elseif ($item->stock > 10) {
                                        $statusClass = 'bg-green-100 text-green-800';
                                        $statusText = 'Tersedia';
                                    } elseif ($item->stock > 0) {
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        $statusText = 'Menipis';
                                    } elseif ($item->stock == 0) {
                                        $statusClass = 'bg-red-100 text-red-800';
                                        $statusText = 'Habis';
                                    }
                                @endphp
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('item.edit', $item->id) }}" 
                                       class="edit-barang-btn text-blue-600 hover:text-blue-900 transition duration-200 p-2 rounded hover:bg-blue-50"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="delete-barang-btn text-red-600 hover:text-red-900 transition duration-200 p-2 rounded hover:bg-red-50"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-code="{{ $item->item_code }}"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                    @if($items->isEmpty())
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-lg mb-2">Belum ada barang</p>
                                    <p class="text-sm text-gray-400 mb-4">Mulai tambahkan barang pertama Anda</p>
                                    <a href="{{ route('item.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg transition duration-200">
                                        <i class="fas fa-plus mr-2"></i> Tambah Barang Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="px-6 py-4 border-t flex flex-col md:flex-row md:items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm text-gray-700">
                        Menampilkan
                        <span class="font-medium">{{ $items->firstItem() }}</span> -
                        <span class="font-medium">{{ $items->lastItem() }}</span> dari
                        <span class="font-medium">{{ $items->total() }}</span> barang
                    </p>
                </div>

                <div class="flex items-center space-x-2">
                    @if ($items->onFirstPage())
                        <span class="px-3 py-1 border rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $items->previousPageUrl() }}"
                            class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                        @if ($page == $items->currentPage())
                            <span class="px-3 py-1 border rounded-md bg-primary text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" 
                               class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100 transition duration-200">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($items->hasMorePages())
                        <a href="{{ $items->nextPageUrl() }}" 
                           class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 border rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="deleteConfirmModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50"></div>
    
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                
                <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Hapus Barang</h3>
                <p class="text-gray-600 text-center mb-4" id="deleteModalMessage">
                    Apakah Anda yakin ingin menghapus barang ini?
                </p>
                
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-box text-gray-400 mr-2"></i>
                        <span id="deleteItemName" class="font-medium">-</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-barcode mr-2"></i>
                        <span id="deleteItemCode">Kode: -</span>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" id="cancelDeleteBtn" 
                            class="flex-1 px-4 py-3 border rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition duration-200">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteBtn" 
                            class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .input-focus:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    table thead {
        position: sticky;
        top: 0;
        background: white;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    /* Custom Scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    /* Modal Animations */
    #deleteConfirmModal {
        transition: opacity 0.3s ease;
    }
    
    #deleteConfirmModal .bg-white {
        animation: modalSlideIn 0.3s ease-out;
    }
    
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const searchInput = document.getElementById('searchBarang');
        const kategoriFilter = document.getElementById('filterKategori');
        const resetFilterBtn = document.getElementById('resetFilterBtn');
        const rows = document.querySelectorAll('#barangTableBody tr[data-item-id]');
        
        // Modal elements
        const deleteModal = document.getElementById('deleteConfirmModal');
        const deleteModalMessage = document.getElementById('deleteModalMessage');
        const deleteItemName = document.getElementById('deleteItemName');
        const deleteItemCode = document.getElementById('deleteItemCode');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        
        // Variables for delete
        let currentDeleteItemId = null;
        let currentDeleteItemName = null;

        // Filter table function
        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const kategoriValue = kategoriFilter.value;

            rows.forEach(row => {
                const itemName = row.querySelector('td:nth-child(2) .text-sm.font-medium').textContent.toLowerCase();
                const itemCode = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const itemCategory = row.querySelector('td:nth-child(4)').textContent;

                // Search filter
                let showRow = true;
                
                if (searchTerm && !itemName.includes(searchTerm) && !itemCode.includes(searchTerm)) {
                    showRow = false;
                }

                // Kategori filter
                if (kategoriValue && itemCategory !== kategoriValue) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });

            // Update counter
            updateVisibleCount();
        }

        function updateVisibleCount() {
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            const countElement = document.querySelector('.text-sm.text-gray-700 .font-medium:last-child');
            
            if (countElement) {
                countElement.textContent = visibleRows.length;
            }
        }

        // Event listeners for filtering
        searchInput.addEventListener('input', filterTable);
        kategoriFilter.addEventListener('change', filterTable);
        
        // Reset filter
        resetFilterBtn.addEventListener('click', function() {
            searchInput.value = '';
            kategoriFilter.value = '';
            rows.forEach(row => row.style.display = '');
            updateVisibleCount();
        });

        // Delete functionality with modal
        document.querySelectorAll('.delete-barang-btn').forEach(button => {
            button.addEventListener('click', function() {
                currentDeleteItemId = this.getAttribute('data-id');
                currentDeleteItemName = this.getAttribute('data-name');
                const itemCode = this.getAttribute('data-code');
                
                // Update modal content
                deleteItemName.textContent = currentDeleteItemName;
                deleteItemCode.textContent = `Kode: ${itemCode}`;
                deleteModalMessage.textContent = `Apakah Anda yakin ingin menghapus barang "${currentDeleteItemName}"?`;
                
                // Show modal
                deleteModal.classList.remove('hidden');
            });
        });

        // Cancel delete
        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
            currentDeleteItemId = null;
            currentDeleteItemName = null;
        });

        // Confirm delete
        confirmDeleteBtn.addEventListener('click', function() {
            if (currentDeleteItemId && currentDeleteItemName) {
                // Create form for delete
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/item/${currentDeleteItemId}`;
                
                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                // Add method spoofing
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                // Submit form
                document.body.appendChild(form);
                form.submit();
                
                // Hide modal
                deleteModal.classList.add('hidden');
            }
        });

        // Close modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                currentDeleteItemId = null;
                currentDeleteItemName = null;
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                deleteModal.classList.add('hidden');
                currentDeleteItemId = null;
                currentDeleteItemName = null;
            }
        });

        // Quick stock update (optional enhancement)
        document.querySelectorAll('td:nth-child(6)').forEach(cell => {
            cell.addEventListener('dblclick', function() {
                const currentStock = this.textContent.trim();
                if (currentStock !== 'Unlimited') {
                    const input = document.createElement('input');
                    input.type = 'number';
                    input.value = parseInt(currentStock) || 0;
                    input.className = 'w-20 px-2 py-1 border rounded focus:ring-2 focus:ring-primary';
                    input.min = 0;
                    
                    const parentRow = this.closest('tr');
                    const itemId = parentRow.getAttribute('data-item-id');
                    
                    this.innerHTML = '';
                    this.appendChild(input);
                    input.focus();
                    
                    input.addEventListener('blur', async function() {
                        const newStock = parseInt(this.value) || 0;
                        const oldStock = parseInt(currentStock) || 0;
                        
                        if (newStock !== oldStock) {
                            try {
                                const response = await fetch(`/item/${itemId}/stock`, {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: JSON.stringify({ stock: newStock })
                                });
                                
                                if (response.ok) {
                                    cell.innerHTML = `<div class="text-sm font-medium text-gray-900">${newStock}</div>`;
                                    location.reload(); // Reload untuk update status
                                }
                            } catch (error) {
                                console.error('Error updating stock:', error);
                                cell.innerHTML = `<div class="text-sm font-medium text-gray-900">${oldStock}</div>`;
                            }
                        } else {
                            cell.innerHTML = `<div class="text-sm font-medium text-gray-900">${oldStock}</div>`;
                        }
                    });
                    
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            this.blur();
                        }
                    });
                }
            });
        });

        // Initialize filter on page load
        filterTable();
    });
</script>
@endpush