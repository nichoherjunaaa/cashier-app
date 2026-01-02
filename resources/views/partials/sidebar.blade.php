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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="w-full hidden">
                @csrf
            </form>
            <button type="button" 
                    onclick="showLogoutModal()"
                    class="w-full flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span class="font-medium">Logout</span>
            </button>
        </div>
    </nav>
</div>

<!-- Logout Modal -->
<div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full transform transition-all">
        <!-- Modal Header -->
        <div class="p-6 border-b">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-sign-out-alt text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Logout</h3>
                    <p class="text-sm text-gray-500">Keluar dari sistem</p>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-full bg-primary bg-opacity-10 flex items-center justify-center">
                        <span class="text-primary font-semibold text-lg">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                        </span>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-gray-700 mb-2">
                        Apakah Anda yakin ingin logout dari akun 
                        <span class="font-semibold text-primary">{{ auth()->user()->name ?? 'Admin Kasir' }}</span>?
                    </p>
                    <p class="text-sm text-gray-500">
                        Anda perlu login kembali untuk mengakses sistem.
                    </p>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="p-6 border-t bg-gray-50 rounded-b-lg">
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="hideLogoutModal()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Batal
                </button>
                <button type="button"
                        onclick="confirmLogout()"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    Ya, Logout
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan modal logout
    function showLogoutModal() {
        const modal = document.getElementById('logout-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Tambahkan class untuk mencegah scroll di body
        document.body.classList.add('overflow-hidden');
    }

    // Fungsi untuk menyembunyikan modal logout
    function hideLogoutModal() {
        const modal = document.getElementById('logout-modal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        
        // Hapus class untuk mengembalikan scroll di body
        document.body.classList.remove('overflow-hidden');
    }

    // Fungsi untuk konfirmasi logout
    function confirmLogout() {
        const form = document.getElementById('logout-form');
        form.submit();
    }

    // Tutup modal ketika klik di luar area modal
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('logout-modal');
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideLogoutModal();
            }
        });

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                hideLogoutModal();
            }
        });
    });
</script>

<style>
    #logout-modal {
        backdrop-filter: blur(4px);
    }
        
</style>