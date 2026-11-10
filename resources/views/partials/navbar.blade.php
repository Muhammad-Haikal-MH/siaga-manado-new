<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-2xs">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo SiagaManado -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-xl bg-[#163672] flex items-center justify-center text-white shadow-xs group-hover:bg-[#0e2a66] transition">
                <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="text-[19px] font-extrabold tracking-tight leading-none text-[#163672]">
                    SiagaManado
                </span>
                <span class="text-[11px] font-medium text-slate-500 tracking-wide mt-0.5">
                    Tanggap, Selamat, Bersama
                </span>
            </div>
        </a>

        <!-- Navigation Links -->
        <nav class="flex items-center gap-5 sm:gap-8">
            <a
                href="{{ route('home') }}"
                class="text-sm font-semibold transition-colors relative py-1.5 {{ request()->routeIs('home') ? 'text-[#163672] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-[#163672] after:rounded-full' : 'text-slate-600 hover:text-[#163672]' }}"
            >
                Beranda
            </a>

            <a
                href="{{ route('news.index') }}"
                class="text-sm font-semibold transition-colors relative py-1.5 {{ request()->routeIs('news.*') ? 'text-[#163672] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-[#163672] after:rounded-full' : 'text-slate-600 hover:text-[#163672]' }}"
            >
                Berita
            </a>

            <a
                href="{{ route('mitigation.index') }}"
                class="text-sm font-semibold transition-colors relative py-1.5 {{ request()->routeIs('mitigation.*') ? 'text-[#163672] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-[#163672] after:rounded-full' : 'text-slate-600 hover:text-[#163672]' }}"
            >
                Mitigasi
            </a>

            <a
                href="{{ route('reports.history') }}"
                class="text-sm font-semibold transition-colors relative py-1.5 hidden md:inline-block {{ request()->routeIs('reports.*') ? 'text-[#163672] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-[#163672] after:rounded-full' : 'text-slate-600 hover:text-[#163672]' }}"
            >
                Riwayat Laporan
            </a>

            <div class="h-5 w-[1px] bg-slate-200 hidden sm:block"></div>

            <!-- User Profile Trigger -->
            <a
                href="{{ route('profile') }}"
                class="inline-flex items-center gap-2.5 pl-2.5 pr-1.5 py-1 rounded-full border transition {{ request()->routeIs('profile') ? 'bg-blue-50 border-[#163672]/30' : 'border-slate-200 hover:bg-slate-50' }}"
                title="Profil & Riwayat Laporan Saya"
            >
                <span class="text-sm font-semibold text-slate-700 hidden sm:inline">
                    {{ $user['shortName'] ?? 'Haikal' }}
                </span>
                <div class="w-8 h-8 rounded-full bg-[#163672] text-white flex items-center justify-center text-xs font-bold shadow-2xs">
                    {{ $user['avatarInitial'] ?? 'H' }}
                </div>
            </a>
        </nav>
    </div>
</header>
