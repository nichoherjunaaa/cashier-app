<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kasir')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        'primary-dark': '#1e40af',
                        secondary: '#10b981',
                        'secondary-dark': '#047857',
                        accent: '#f59e0b',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar-link.active {
            background-color: #eff6ff;
            color: #1e40af;
            border-left: 4px solid #1e40af;
        }

        .sidebar-link:hover:not(.active) {
            background-color: #f8fafc;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .dashboard-stat {
            transition: all 0.3s ease;
        }

        .dashboard-stat:hover {
            transform: scale(1.03);
        }

        /* Custom styling untuk chart */
        .chart-container {
            position: relative;
            height: 260px;
            width: 100%;
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @includeIf('partials.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @includeIf('partials.header')

            <!-- Konten Dashboard -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t p-4">
                <div class="flex justify-between items-center">
                    <p class="text-gray-600 text-sm">
                        &copy; 2023 <span class="font-bold text-primary-dark">KasirPro</span>. Sistem Manajemen Kasir.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-primary-dark text-sm">
                            <i class="fas fa-question-circle mr-1"></i> Bantuan
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary-dark text-sm">
                            <i class="fas fa-cog mr-1"></i> Pengaturan
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Variables
        let revenueChart;
        let currentChartType = 'line';
        let chartData = {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Pendapatan',
                data: [850000, 920000, 1250000, 980000, 1550000, 1380000, 1650000],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        };

        // Fungsi untuk format Rupiah
        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        // Fungsi untuk inisialisasi grafik garis
        function initLineChart() {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            // Hapus chart lama jika ada
            if (revenueChart) {
                revenueChart.destroy();
            }

            revenueChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#1e40af',
                            bodyColor: '#374151',
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            padding: 12,
                            boxPadding: 6,
                            callbacks: {
                                label: function (context) {
                                    return `Pendapatan: ${formatRupiah(context.raw)}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000) + 'jt';
                                    }
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                },
                                color: '#6b7280',
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    },
                    elements: {
                        line: {
                            tension: 0.4
                        }
                    }
                }
            });
        }

        // Fungsi untuk inisialisasi grafik batang
        function initBarChart() {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            // Hapus chart lama jika ada
            if (revenueChart) {
                revenueChart.destroy();
            }

            revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Pendapatan',
                        data: chartData.datasets[0].data,
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: '#3b82f6',
                        borderWidth: 1,
                        borderRadius: 4,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `Pendapatan: ${formatRupiah(context.raw)}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            },
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000) + 'jt';
                                    }
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Fungsi untuk toggle antara line chart dan bar chart
        function toggleChart() {
            if (currentChartType === 'line') {
                currentChartType = 'bar';
                initBarChart();
                document.getElementById('toggleChartBtn').innerHTML = '<i class="fas fa-chart-line"></i>';
            } else {
                currentChartType = 'line';
                initLineChart();
                document.getElementById('toggleChartBtn').innerHTML = '<i class="fas fa-chart-bar"></i>';
            }
        }

        // Fungsi untuk update data chart secara dinamis
        function updateChartData() {
            // Simulasi data baru (dalam implementasi nyata, ini akan dari API)
            const newData = chartData.datasets[0].data.map(value => {
                // Tambah variasi random ±15%
                const variation = Math.random() * 0.3 - 0.15;
                return Math.round(value * (1 + variation));
            });

            chartData.datasets[0].data = newData;

            // Hitung total baru
            const newTotal = newData.reduce((sum, value) => sum + value, 0);

            // Update total display
            document.querySelector('.border-t .font-bold').textContent = formatRupiah(newTotal);

            // Update chart
            revenueChart.data.datasets[0].data = newData;
            revenueChart.update();

            // Tampilkan notifikasi
            showNotification('Data grafik diperbarui');
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message) {
            // Buat elemen notifikasi
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-primary text-white p-3 rounded-lg shadow-lg z-50 transform translate-x-full opacity-0 transition-all duration-300';
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-sync-alt mr-3"></i>
                    <span class="text-sm">${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animasi masuk
            setTimeout(() => {
                notification.classList.remove('translate-x-full', 'opacity-0');
                notification.classList.add('translate-x-0', 'opacity-100');
            }, 10);

            // Animasi keluar setelah 2 detik
            setTimeout(() => {
                notification.classList.remove('translate-x-0', 'opacity-100');
                notification.classList.add('translate-x-full', 'opacity-0');

                // Hapus elemen setelah animasi selesai
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 2000);
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi grafik garis
            initLineChart();

            // Menambahkan efek hover pada kartu statistik
            const statCards = document.querySelectorAll('.dashboard-stat');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.classList.add('card-hover');
                });

                card.addEventListener('mouseleave', function () {
                    this.classList.remove('card-hover');
                });
            });

            // Event listener untuk tombol toggle chart
            document.getElementById('toggleChartBtn').addEventListener('click', function (e) {
                e.preventDefault();
                toggleChart();
            });

            // Event listener untuk update data chart (simulasi real-time)
            // Update setiap 30 detik
            setInterval(updateChartData, 30000);

            // Sidebar navigation active state
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    if (this.getAttribute('href') === '#') {
                        e.preventDefault();
                    }

                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    // Di sini nanti bisa menambahkan logika untuk mengganti halaman
                    const pageTitle = this.querySelector('span').textContent;
                    document.querySelector('header h2').textContent = `Dashboard ${pageTitle}`;
                });
            });

            // Update waktu real-time
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
                const dateTimeStr = now.toLocaleDateString('id-ID', options);

                // Simpan untuk nanti jika ingin menampilkan di header
                console.log('Waktu saat ini:', dateTimeStr);
            }

            // Update waktu setiap menit
            updateDateTime();
            setInterval(updateDateTime, 60000);
        });
    </script>
</body>

</html>