<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SiagaManado — Sistem Pelaporan dan Akses Informasi Kebencanaan Kota Manado')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet.js CSS & JS untuk Peta Interaktif Pelaporan -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #f4f7fb;
            color: #0f172a;
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #e2e8f0;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #163672;
        }
        .leaflet-container {
            font-family: 'Plus Jakarta Sans', sans-serif;
            z-index: 10;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#f4f7fb] text-slate-800 antialiased selection:bg-[#163672] selection:text-white">

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    @hasSection('minimal_footer')
        @yield('minimal_footer')
    @else
        @include('partials.footer')
    @endif

    <!-- Global Popup Modal Formulir Pelaporan Bencana -->
    @include('partials.report-modal')

    <!-- Global Popup Modal Detail Laporan -->
    @include('partials.report-detail-modal')

    @stack('scripts')
</body>
</html>
