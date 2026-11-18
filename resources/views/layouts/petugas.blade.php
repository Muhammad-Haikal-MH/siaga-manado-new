<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Petugas BPBD — SiagaManado')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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
            background-color: #0b111e;
            color: #f8fafc;
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0b111e;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #334155;
        }
        /* Styling kalender input date di dark mode */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.8);
            cursor: pointer;
        }
    </style>
</head>
<body class="min-h-screen bg-[#0b111e] text-slate-100 antialiased selection:bg-[#4e8cff] selection:text-white">

    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- LEFT SIDEBAR (Matching Frame 50 - Frame 54) -->
        <aside class="w-full lg:w-[235px] shrink-0 bg-[#0b111e] border-b lg:border-b-0 lg:border-r border-slate-800/90 flex flex-col justify-between p-5 lg:py-8 lg:px-5">
            <div>
                <!-- Brand Title -->
                <div class="px-3 mb-8 flex items-center justify-between lg:block">
                    <a href="{{ route('petugas.dashboard') }}" class="block">
                        <h1 class="text-xl font-extrabold text-white leading-snug tracking-tight">
                            Dashboard<br class="hidden lg:inline" /> Petugas
                        </h1>
                    </a>
                </div>

                <!-- Navigation Menu Items -->
                <nav class="flex lg:flex-col gap-2 overflow-x-auto pb-1 lg:pb-0">
                    <!-- 1. Dashboard -->
                    @php
                        $isDashboard = request()->routeIs('petugas.dashboard');
                        $isAssignments = request()->routeIs('petugas.assignments*');
                        $isLeave = request()->routeIs('petugas.leave*');
                        $isNotifications = request()->routeIs('petugas.notifications*');
                    @endphp

                    <a
                        href="{{ route('petugas.dashboard') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-[13px] font-bold transition whitespace-nowrap {{ $isDashboard ? 'bg-[#d0deef] text-[#112a63] shadow-sm' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}"
                    >
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5V20a1 1 0 01-1 1h-5.5v-6h-5v6H4a1 1 0 01-1-1v-9.5z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- 2. Penugasan -->
                    <a
                        href="{{ route('petugas.assignments') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-[13px] font-bold transition whitespace-nowrap {{ $isAssignments ? 'bg-[#d0deef] text-[#112a63] shadow-sm' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}"
                    >
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1.5a4.5 4.5 0 00-3.5-4.38M9 20H2v-1.5a4.5 4.5 0 014.5-4.5h1a4.5 4.5 0 014.5 4.5V20zm3-9a3 3 0 100-6 3 3 0 000 6zm6 1a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM6 12a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/>
                        </svg>
                        <span>Penugasan</span>
                    </a>

                    <!-- 3. Pengajuan Izin -->
                    <a
                        href="{{ route('petugas.leave') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-[13px] font-bold transition whitespace-nowrap {{ $isLeave ? 'bg-[#d0deef] text-[#112a63] shadow-sm' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}"
                    >
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Pengajuan Izin</span>
                    </a>

                    <!-- 4. Notifikasi -->
                    <a
                        href="{{ route('petugas.notifications') }}"
                        class="flex items-center justify-between px-4 py-3 rounded-2xl text-xs sm:text-[13px] font-bold transition whitespace-nowrap {{ $isNotifications ? 'bg-[#d0deef] text-[#112a63] shadow-sm' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}"
                    >
                        <div class="flex items-center gap-3.5">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span>Notifikasi</span>
                        </div>
                        @if(($unreadCount ?? 0) > 0)
                            <span class="ml-2 px-1.5 py-0.5 rounded-full text-[10px] font-extrabold {{ $isNotifications ? 'bg-[#112a63] text-white' : 'bg-rose-500 text-white' }}">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                </nav>
            </div>

            <!-- Role Switcher Link back to Portal Masyarakat -->
            <div class="hidden lg:block pt-6 border-t border-slate-800/80 px-2">
                <p class="text-[10.5px] font-semibold uppercase tracking-wider text-slate-500 mb-2">
                    Akses Portal
                </p>
                <a
                    href="{{ route('home') }}"
                    class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#131b2c] hover:bg-slate-800 border border-slate-800 text-xs font-semibold text-slate-300 hover:text-white transition"
                >
                    <span>Portal Masyarakat</span>
                    <span>↗</span>
                </a>
            </div>
        </aside>

        <!-- MAIN WORKSPACE -->
        <main class="flex-1 min-w-0 p-5 sm:p-8 lg:p-10">
            @if(session('petugas_success'))
                <div class="max-w-5xl mb-6 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 px-5 py-3.5 text-xs sm:text-sm font-bold text-emerald-300 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>{{ session('petugas_success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-xs text-emerald-200 hover:underline cursor-pointer">Tutup</button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
