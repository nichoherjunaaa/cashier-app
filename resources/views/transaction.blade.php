@extends('layouts.cashier')
@section('title', 'Buat Transaksi - Sistem Transaksi')
@section('header_title', 'Proses Transaksi')
@section('header_subtitle', 'Proses transaksi baru')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-full">
        <div class="lg:col-span-2 flex flex-col">
            <div class="mb-6">
                <div class="flex space-x-4">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" id="searchProduct" placeholder="Cari produk berdasarkan nama atau kode..."
                            class="w-full pl-10 pr-4 py-3 border rounded-lg input-focus focus:outline-none">
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md flex-1 overflow-hidden flex flex-col">
                <h3 class="text-lg font-bold text-primary-dark p-4 border-b">Daftar Produk</h3>
                <div class="overflow-hidden flex-1">
                    <div class="overflow-y-auto h-full" style="max-height: calc(100vh - 300px);">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0 z-10">
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
                            <tbody class="bg-white divide-y divide-gray-200" id="productTableBody">
                                @foreach ($items as $item)
                                                        <tr class="table-row-hover cursor-pointer hover:bg-gray-50" data-id="{{ $item->id }}"
                                                            data-name="{{ $item->name }}" data-price="{{ $item->price }}"
                                                            data-stock="{{ $item->stock }}" data-code="{{ $item->item_code }}">
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div>
                                                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                                                        <div class="text-sm text-gray-500">Kategori: {{ $item->category->name }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">{{ $item->item_code }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                                {{ $item->stock > 10 ? 'bg-green-100 text-green-800' :
                                    ($item->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                                    {{ $item->stock }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                                <span class="font-bold text-primary-dark item-price"
                                                                    data-price="{{ $item->price }}">
                                                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                <button
                                                                    class="add-to-cart-btn bg-primary hover:bg-primary-dark text-white py-2 px-4 rounded-md text-sm transition-colors duration-200 shadow-sm"
                                                                    data-item-id="{{ $item->id }}">
                                                                    <i class="fas fa-plus mr-1"></i> Tambah
                                                                </button>
                                                            </td>
                                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col h-full">
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col h-full" style="max-height: calc(100vh - 120px);">
                <div class="flex-shrink-0">
                    <h3 class="text-lg font-bold text-primary-dark mb-6">Keranjang Belanja</h3>

                    <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600" id="itemCount">0 item</span>
                        </div>
                    </div>
                </div>

                <div class="flex-1 overflow-hidden mb-6">
                    <div id="cartItems" class="h-full overflow-y-auto pr-2 custom-scrollbar">
                        <!-- Item keranjang akan ditambahkan di sini melalui jQuery -->
                        <div class="text-center text-gray-500 py-8 h-full flex flex-col items-center justify-center">
                            <i class="fas fa-shopping-cart text-3xl mb-3 text-gray-300"></i>
                            <p>Keranjang belanja kosong</p>
                            <p class="text-sm">Tambahkan produk dari daftar di sebelah kiri</p>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pembayaran (Tetap di Bawah) -->
                <div class="flex-shrink-0 border-t pt-6">
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium" id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Diskon:</span>
                            <span class="font-medium text-green-600" id="discount">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t pt-3">
                            <span>Total:</span>
                            <span class="text-primary-dark" id="total">Rp 0</span>
                        </div>
                    </div>

                    <!-- Input Pembayaran -->
                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                            <div class="grid grid-cols-3 gap-2 mb-2">
                                <button type="button"
                                    class="payment-method-btn border rounded-lg py-2 px-2 text-center text-sm transition-colors duration-200 bg-primary text-white"
                                    data-method="tunai">
                                    <i class="fas fa-money-bill-wave mr-1"></i> Tunai
                                </button>
                                <button type="button"
                                    class="payment-method-btn border rounded-lg py-2 px-2 text-center text-sm transition-colors duration-200 hover:bg-gray-50"
                                    data-method="debit">
                                    <i class="fas fa-credit-card mr-1"></i> Debit
                                </button>
                                <button type="button"
                                    class="payment-method-btn border rounded-lg py-2 px-2 text-center text-sm transition-colors duration-200 hover:bg-gray-50"
                                    data-method="qris">
                                    <i class="fas fa-qrcode mr-1"></i> QRIS
                                </button>
                            </div>
                            <input type="number" id="paymentAmount" placeholder="Jumlah pembayaran"
                                class="w-full border rounded-lg py-2 px-3 input-focus focus:outline-none">
                        </div>

                        <div id="changeContainer" class="hidden">
                            <div class="flex justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                                <span class="text-gray-700 flex items-center">
                                    <i class="fas fa-exchange-alt mr-2"></i> Kembalian:
                                </span>
                                <span class="font-bold text-green-700" id="changeAmount">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="space-y-3">
                        <button type="button" id="saveTransactionBtn"
                            class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded-lg flex items-center justify-center transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            <i class="fas fa-save mr-2"></i> Simpan Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Notification -->
    <div id="successNotification"
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 hidden transform transition-all duration-300 translate-x-full">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-xl mr-3"></i>
            <div>
                <p class="font-bold">Berhasil!</p>
                <p id="notificationMessage" class="text-sm"></p>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-question text-blue-600 text-xl"></i>
                    </div>
                </div>
                <h3 id="modalTitle" class="text-xl font-bold text-center text-gray-900 mb-2"></h3>
                <p id="modalMessage" class="text-gray-600 text-center mb-6"></p>
                <div class="flex space-x-3">
                    <button id="modalCancelBtn"
                        class="flex-1 border border-gray-300 text-gray-700 font-medium py-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="modalConfirmBtn"
                        class="flex-1 bg-primary text-white font-medium py-3 rounded-lg hover:bg-primary-dark transition-colors duration-200">
                        Ya, Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Informasi -->
    <div id="infoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div id="infoModalIcon" class="w-12 h-12 rounded-full flex items-center justify-center">
                        <i class="fas fa-info text-xl"></i>
                    </div>
                </div>
                <h3 id="infoModalTitle" class="text-xl font-bold text-center text-gray-900 mb-2"></h3>
                <p id="infoModalMessage" class="text-gray-600 text-center mb-6"></p>
                <div class="flex justify-center">
                    <button id="infoModalOkBtn"
                        class="bg-primary text-white font-medium py-3 px-8 rounded-lg hover:bg-primary-dark transition-colors duration-200">
                        Oke
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let cart = [];
            let selectedPaymentMethod = 'tunai';
            let totalAmount = 0;
            let pendingAction = null;
            let pendingIndex = null;

            function formatRupiah(amount) {
                if (!amount) amount = 0;
                return 'Rp ' + amount.toLocaleString('id-ID');
            }

            function showNotification(message) {
                $('#notificationMessage').text(message);
                $('#successNotification')
                    .removeClass('hidden translate-x-full')
                    .addClass('translate-x-0');

                setTimeout(function () {
                    $('#successNotification')
                        .removeClass('translate-x-0')
                        .addClass('translate-x-full');

                    setTimeout(function () {
                        $('#successNotification').addClass('hidden');
                    }, 300);
                }, 3000);
            }

            function showConfirmationModal(title, message, confirmCallback) {
                $('#modalTitle').text(title);
                $('#modalMessage').text(message);
                $('#confirmationModal').removeClass('hidden');

                $('#modalConfirmBtn').off('click').on('click', function () {
                    $('#confirmationModal').addClass('hidden');
                    if (confirmCallback) confirmCallback();
                });

                $('#modalCancelBtn').off('click').on('click', function () {
                    $('#confirmationModal').addClass('hidden');
                });
            }

            function showInfoModal(title, message, type = 'info') {
                const iconContainer = $('#infoModalIcon');
                const icon = iconContainer.find('i');

                icon.removeClass();
                if (type === 'error') {
                    iconContainer.addClass('bg-red-100');
                    icon.addClass('fas fa-exclamation-circle text-red-600 text-xl');
                } else if (type === 'warning') {
                    iconContainer.addClass('bg-yellow-100');
                    icon.addClass('fas fa-exclamation-triangle text-yellow-600 text-xl');
                } else if (type === 'success') {
                    iconContainer.addClass('bg-green-100');
                    icon.addClass('fas fa-check-circle text-green-600 text-xl');
                } else {
                    iconContainer.addClass('bg-blue-100');
                    icon.addClass('fas fa-info-circle text-blue-600 text-xl');
                }

                $('#infoModalTitle').text(title);
                $('#infoModalMessage').text(message);
                $('#infoModal').removeClass('hidden');

                $('#infoModalOkBtn').off('click').on('click', function () {
                    $('#infoModal').addClass('hidden');
                });
            }

            $(document).on('click', '.add-to-cart-btn', function () {
                const row = $(this).closest('tr');
                const itemId = parseInt(row.data('id'));
                const itemName = row.data('name');
                const itemPrice = parseInt(row.data('price'));
                const itemStock = parseInt(row.data('stock'));
                const itemCode = row.data('code');

                if (itemStock <= 0) {
                    showInfoModal('Stok Habis', 'Stok produk ini habis!', 'error');
                    return;
                }

                let existingItemIndex = -1;
                $.each(cart, function (index, item) {
                    if (item.id === itemId) {
                        existingItemIndex = index;
                        return false;
                    }
                });

                if (existingItemIndex !== -1) {
                    if (cart[existingItemIndex].quantity < itemStock) {
                        cart[existingItemIndex].quantity++;
                    } else {
                        showInfoModal('Stok Tidak Mencukupi', 'Stok tidak mencukupi!', 'warning');
                        return;
                    }
                } else {
                    cart.push({
                        id: itemId,
                        name: itemName,
                        price: itemPrice,
                        stock: itemStock,
                        code: itemCode,
                        quantity: 1
                    });
                }

                updateCartDisplay();
                showNotification(itemName + ' berhasil ditambahkan ke keranjang');
            });

            function updateCartDisplay() {
                const cartItemsContainer = $('#cartItems');
                const totalElement = $('#total');
                const subtotalElement = $('#subtotal');
                const itemCountElement = $('#itemCount');
                const saveButton = $('#saveTransactionBtn');

                if (cart.length === 0) {
                    cartItemsContainer.html(`
                            <div class="text-center text-gray-500 py-8 h-full flex flex-col items-center justify-center">
                                <i class="fas fa-shopping-cart text-3xl mb-3 text-gray-300"></i>
                                <p>Keranjang belanja kosong</p>
                                <p class="text-sm">Tambahkan produk dari daftar di sebelah kiri</p>
                            </div>
                        `);
                    totalElement.text('Rp 0');
                    subtotalElement.text('Rp 0');
                    itemCountElement.text('0 item');
                    saveButton.prop('disabled', true);
                    return;
                }

                let subtotal = 0;
                let cartItemsHtml = '';

                $.each(cart, function (index, item) {
                    const itemTotal = item.price * item.quantity;
                    subtotal += itemTotal;

                    cartItemsHtml += `
                            <div class="cart-item bg-gray-50 rounded-lg p-3 mb-2 fade-in-up text-xs">
                                <div class="flex justify-between items-center">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900 text-sm">${item.name}</div>
                                        <div class="text-[10px] text-gray-500">Kode: ${item.code}</div>
                                        <div class="text-xs font-bold text-primary-dark mt-1">
                                            ${formatRupiah(itemTotal)}
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <div class="flex items-center space-x-2 bg-white rounded-full px-2 py-0.5 border">
                                            <button class="decrease-qty text-gray-600 hover:text-primary w-5 h-5 flex items-center justify-center"
                                                    data-index="${index}">
                                                <i class="fas fa-minus text-[10px]"></i>
                                            </button>

                                            <span class="font-bold min-w-[24px] text-center text-xs">
                                                ${item.quantity}
                                            </span>

                                            <button class="increase-qty text-gray-600 hover:text-primary w-5 h-5 flex items-center justify-center"
                                                    data-index="${index}">
                                                <i class="fas fa-plus text-[10px]"></i>
                                            </button>
                                        </div>

                                        <div class="text-right">
                                            <button class="remove-item text-red-500 hover:text-red-700 text-[10px] mt-0.5"
                                                    data-index="${index}">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                });

                cartItemsContainer.html(cartItemsHtml);
                totalAmount = subtotal;
                totalElement.text(formatRupiah(totalAmount));
                subtotalElement.text(formatRupiah(subtotal));
                itemCountElement.text(cart.length + ' item' + (cart.length > 1 ? 's' : ''));
                saveButton.prop('disabled', cart.length === 0);

                calculateChange();
            }

            $(document).on('click', '.decrease-qty', function () {
                const index = parseInt($(this).data('index'));
                if (cart[index].quantity > 1) {
                    cart[index].quantity--;
                    updateCartDisplay();
                }
            });

            $(document).on('click', '.increase-qty', function () {
                const index = parseInt($(this).data('index'));
                const stock = cart[index].stock;
                if (cart[index].quantity < stock) {
                    cart[index].quantity++;
                    updateCartDisplay();
                } else {
                    showInfoModal('Stok Tidak Mencukupi', 'Stok tidak mencukupi!', 'warning');
                }
            });

            $(document).on('click', '.remove-item', function () {
                const index = parseInt($(this).data('index'));
                const itemName = cart[index].name;

                showConfirmationModal(
                    'Hapus Item',
                    `Hapus "${itemName}" dari keranjang?`,
                    function () {
                        cart.splice(index, 1);
                        updateCartDisplay();
                        showNotification(itemName + ' berhasil dihapus dari keranjang');
                    }
                );
            });

            $(document).on('click', '.payment-method-btn', function () {
                selectedPaymentMethod = $(this).data('method');

                $('.payment-method-btn').removeClass('bg-primary text-white')
                    .addClass('border-gray-300 text-gray-700 hover:bg-gray-50');

                $(this).addClass('bg-primary text-white')
                    .removeClass('border-gray-300 text-gray-700 hover:bg-gray-50');

                const paymentInput = $('#paymentAmount');
                switch (selectedPaymentMethod) {
                    case 'tunai':
                        paymentInput.attr('placeholder', 'Masukkan jumlah uang tunai');
                        break;
                    case 'debit':
                        paymentInput.attr('placeholder', 'Masukkan jumlah pembayaran debit');
                        break;
                    case 'qris':
                        paymentInput.attr('placeholder', 'Masukkan jumlah pembayaran QRIS');
                        break;
                }

                calculateChange();
            });

            function calculateChange() {
                const paymentAmount = parseFloat($('#paymentAmount').val()) || 0;
                const changeContainer = $('#changeContainer');
                const changeAmountElement = $('#changeAmount');

                if (selectedPaymentMethod === 'tunai' && paymentAmount > 0 && totalAmount > 0) {
                    if (paymentAmount >= totalAmount) {
                        const change = paymentAmount - totalAmount;
                        changeAmountElement.text(formatRupiah(change));
                        changeContainer.removeClass('hidden');
                    } else {
                        changeContainer.addClass('hidden');
                    }
                } else {
                    changeContainer.addClass('hidden');
                }
            }

            $('#searchProduct').on('input', function () {
                const searchTerm = $(this).val().toLowerCase().trim();

                $('#productTableBody tr').each(function () {
                    const $row = $(this);
                    const itemName = $row.data('name').toLowerCase();
                    const itemCode = $row.data('code').toLowerCase();

                    if (searchTerm === '' || itemName.includes(searchTerm) || itemCode.includes(searchTerm)) {
                        $row.show();
                    } else {
                        $row.hide();
                    }
                });
            });

            $('#paymentAmount').on('input', function () {
                calculateChange();
            });

            $('#saveTransactionBtn').on('click', function () {
                if (cart.length === 0) {
                    showInfoModal('Keranjang Kosong', 'Keranjang belanja kosong!', 'warning');
                    return;
                }

                const paymentAmount = parseFloat($('#paymentAmount').val()) || 0;

                if (selectedPaymentMethod === 'tunai' && paymentAmount < totalAmount) {
                    showInfoModal('Pembayaran Kurang', 'Jumlah pembayaran tunai kurang!', 'error');
                    $('#paymentAmount').focus();
                    return;
                }

                if (selectedPaymentMethod !== 'tunai' && paymentAmount <= 0) {
                    showInfoModal('Input Pembayaran', 'Masukkan jumlah pembayaran!', 'warning');
                    $('#paymentAmount').focus();
                    return;
                }

                showConfirmationModal(
                    'Konfirmasi Transaksi',
                    `Simpan transaksi dengan total ${formatRupiah(totalAmount)}?`,
                    function () {
                        const transactionData = {
                            _token: '{{ csrf_token() }}',
                            items: cart.map(item => ({
                                item_id: item.id,
                                quantity: item.quantity,
                                price: item.price
                            })),
                            total_amount: totalAmount,
                            payment_method: selectedPaymentMethod,
                            payment_amount: paymentAmount,
                            change_amount: selectedPaymentMethod === 'tunai' ? Math.max(0, paymentAmount - totalAmount) : 0
                        };

                        console.log('Saving transaction:', transactionData);

                        const $saveButton = $('#saveTransactionBtn');
                        const originalHtml = $saveButton.html();
                        $saveButton.html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...')
                            .prop('disabled', true);

                        $.ajax({
                            url: "{{ route('transactions.store') }}",
                            method: "POST",
                            data: transactionData,
                            success: function (response) {
                                $saveButton.html(originalHtml).prop('disabled', false);

                                showNotification(response.message);

                                cart = [];
                                updateCartDisplay();
                                $('#paymentAmount').val('');
                                $('#changeContainer').addClass('hidden');
                            },
                            error: function (xhr) {
                                $saveButton.html(originalHtml).prop('disabled', false);

                                const errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan transaksi';
                                showInfoModal('Kesalahan', errorMessage, 'error');
                                console.error(xhr.responseJSON);
                            }
                        });
                    }
                );
            });

            function updateDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                $('#transactionDate').text(now.toLocaleDateString('id-ID', options));
            }

            updateDateTime();

            setInterval(updateDateTime, 60000);

            $(document).on('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    $('#saveTransactionBtn').click();
                }

                if (e.key === 'Escape') {
                    if (!$('#confirmationModal').hasClass('hidden')) {
                        $('#confirmationModal').addClass('hidden');
                    }
                    if (!$('#infoModal').hasClass('hidden')) {
                        $('#infoModal').addClass('hidden');
                    }
                }
            });

            $(document).on('click', function (e) {
                if ($(e.target).is('#confirmationModal')) {
                    $('#confirmationModal').addClass('hidden');
                }
                if ($(e.target).is('#infoModal')) {
                    $('#infoModal').addClass('hidden');
                }
            });
        });
    </script>
@endsection