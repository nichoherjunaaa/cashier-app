<div
    class="lg:hidden fixed bottom-0 left-0 right-0 bg-white-light border-t border-gray-200-light flex justify-around py-3">
    <a href={{ route('dashboard') }} class="flex flex-col items-center text-primary">
        <i class="fas fa-home text-lg"></i>
        <span class="text-xs mt-1 text-gray-700">Beranda</span>
    </a>
    <a href={{ route('transaction') }} class="flex flex-col items-center text-gray-600-light">
        <i class="fas fa-shopping-cart text-lg"></i>
        <span class="text-xs mt-1">Transaksi</span>
    </a>
    <a href={{ route('item') }} class="flex flex-col items-center text-gray-600-light">
        <i class="fas fa-qrcode text-lg"></i>
        <span class="text-xs mt-1">Barang</span>
    </a>
    <a href={{ route('report') }} class="flex flex-col items-center text-gray-600-light">
        <i class="fas fa-chart-bar text-lg"></i>
        <span class="text-xs mt-1">Laporan</span>
    </a>
</div>