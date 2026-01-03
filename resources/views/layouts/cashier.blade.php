<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kasir')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
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
        @includeIf('partials.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @includeIf('partials.header')
            @includeIf('partials.mobile-nav')
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>