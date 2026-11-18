<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel — SiagaManado')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            950: '#070b14',
                            900: '#0b1120',
                            850: '#0f172a',
                            800: '#141d33',
                            700: '#1e293b',
                            600: '#334155',
                        },
                        brand: {
                            blue: '#3b82f6',
                            hover: '#2563eb',
                            activePill: '#dce5ee',
                            activeText: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Chart.js CDN for Exact Statistics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #0c1222;
            color: #f1f5f9;
        }
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }
        ::-webkit-scrollbar-track {
            background: #0b1120;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>
<body class="min-h-screen bg-[#0c1222] text-slate-100 flex flex-col md:flex-row antialiased">

    <!-- Left Sidebar (Matching Figma Admin Panel) -->
    <aside class="w-full md:w-64 lg:w-72 bg-[#090e1a] border-r border-[#1a233a] flex flex-col justify-between shrink-0 min-h-screen">
        <div>
            <!-- Header Brand -->
            <div class="px-7 pt-9 pb-8">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold tracking-tight text-white hover:text-slate-200 transition">
                    Admin Panel
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="px-4 space-y-2">
                <!-- Dashboard Link -->
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-full text-[15px] font-semibold transition-all duration-150 {{ ($activeNav ?? '') === 'dashboard' ? 'bg-[#dce5ee] text-[#0f172a] shadow-sm font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}"
                >
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3l9 8h-3v10h-4v-6h-4v6H6V11H3l9-8z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Laporan Link -->
                <a
                    href="{{ route('admin.laporan.index') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-full text-[15px] font-semibold transition-all duration-150 {{ ($activeNav ?? '') === 'laporan' ? 'bg-[#dce5ee] text-[#0f172a] shadow-sm font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}"
                >
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                    <span>Laporan</span>
                </a>

                <!-- Berita Link -->
                <a
                    href="{{ route('admin.berita.index') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-full text-[15px] font-semibold transition-all duration-150 {{ ($activeNav ?? '') === 'berita' ? 'bg-[#dce5ee] text-[#0f172a] shadow-sm font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}"
                >
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                    <span>Berita</span>
                </a>

                <!-- Feedback Link -->
                <a
                    href="{{ route('admin.feedback.index') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-full text-[15px] font-semibold transition-all duration-150 {{ ($activeNav ?? '') === 'feedback' ? 'bg-[#dce5ee] text-[#0f172a] shadow-sm font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}"
                >
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                        <circle cx="8" cy="7" r="2"/>
                        <circle cx="16" cy="12" r="2"/>
                        <circle cx="10" cy="17" r="2"/>
                    </svg>
                    <span>Feedback</span>
                </a>

                <!-- Mitigasi Link -->
                <a
                    href="{{ route('admin.mitigasi.index') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-full text-[15px] font-semibold transition-all duration-150 {{ ($activeNav ?? '') === 'mitigasi' ? 'bg-[#dce5ee] text-[#0f172a] shadow-sm font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}"
                >
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    <span>Mitigasi</span>
                </a>
            </nav>
        </div>

        <!-- Bottom User Card (Matching Html -> Body-1) -->
        <div class="p-4 border-t border-[#1a233a] mt-auto">
            <div class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-800/40 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#1e293b] text-blue-400 font-bold flex items-center justify-center text-sm border border-slate-700">
                        {{ $profile['initials'] ?? 'AD' }}
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-white leading-tight">
                            {{ $profile['name'] ?? 'Petugas BPBD' }}
                        </div>
                        <div class="text-xs text-slate-400 font-medium">
                            {{ $profile['role'] ?? 'Super Admin' }}
                        </div>
                    </div>
                </div>

                <!-- Link to User Portal -->
                <a href="{{ route('home') }}" class="p-2 text-slate-400 hover:text-white hover:bg-slate-700/50 rounded-lg transition" title="Buka Portal Warga">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 bg-[#0c1222] min-h-screen overflow-x-hidden p-6 md:p-10">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div id="toast-success" class="mb-6 flex items-center justify-between p-4 bg-emerald-950/80 border border-emerald-600/50 text-emerald-200 rounded-xl shadow-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('toast-success').remove()" class="text-emerald-400 hover:text-white text-sm">✕</button>
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
