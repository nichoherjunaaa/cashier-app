<div class="w-64 bg-white shadow-lg flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center">
                <i class="fas fa-cash-register text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-primary-dark">KasirPro</h1>
                <p class="text-xs text-gray-500">Sistem Manajemen</p>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="sidebar-link active flex items-center space-x-3 p-3 rounded-lg text-primary-dark">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaction') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:text-primary-dark">
                    <i class="fas fa-exchange-alt w-5 text-center"></i>
                    <span class="font-medium">Transaksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('item') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:text-primary-dark">
                    <i class="fas fa-box-open w-5 text-center"></i>
                    <span class="font-medium">Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('report') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:text-primary-dark">
                    <i class="fas fa-chart-bar w-5 text-center"></i>
                    <span class="font-medium">Laporan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:text-primary-dark">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span class="font-medium">Pengaturan</span>
                </a>
            </li>
        </ul>

        <!-- Info Pengguna -->
        <div class="mt-auto pt-6 border-t">
            <div class="flex items-center space-x-3 p-3">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                    <span class="text-white font-medium">AD</span>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Admin Kasir</p>
                    <p class="text-sm text-gray-500">Super Admin</p>
                </div>
            </div>
        </div>
    </nav>
</div>