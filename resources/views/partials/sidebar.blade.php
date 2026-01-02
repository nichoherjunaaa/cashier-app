<div class="w-64 bg-white shadow-lg md:flex hidden flex-col">
    <!-- Logo -->
    <div class="p-6 border-b">
        <div class="flex items-center space-x-3">
            <div>
                <h1 class="text-xl font-bold text-primary-dark">Kasir Pro V.1</h1>
                <p class="text-xs text-gray-500">Sistem Manajemen Transaksi</p>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-700 hover:text-primary-dark' }}">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaction') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('transaction') ? 'active' : 'text-gray-700 hover:text-primary-dark' }}">
                    <i class="fas fa-exchange-alt w-5 text-center"></i>
                    <span class="font-medium">Transaksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('item') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('item') ? 'active' : 'text-gray-700 hover:text-primary-dark' }}">
                    <i class="fas fa-box-open w-5 text-center"></i>
                    <span class="font-medium">Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('report') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('report') ? 'active' : 'text-gray-700 hover:text-primary-dark' }}">
                    <i class="fas fa-chart-bar w-5 text-center"></i>
                    <span class="font-medium">Laporan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('profile.edit') ? 'active' : 'text-gray-700 hover:text-primary-dark' }}">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span class="font-medium">Pengaturan</span>
                </a>
            </li>
        </ul>

        <!-- Info Pengguna -->
        <div class="mt-auto pt-6 border-t">
            <div class="flex items-center space-x-3 p-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                    <span class="text-white font-medium">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                    </span>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-gray-800">{{ auth()->user()->name ?? 'Admin Kasir' }}</p>
                    <p class="capitalize text-sm text-gray-500">{{ auth()->user()->role ?? 'Super Admin' }}</p>
                </div>
            </div>
            
            <!-- Logout Button -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" 
                        onclick="return confirm('Apakah Anda yakin ingin logout?')"
                        class="w-full flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </nav>
</div>