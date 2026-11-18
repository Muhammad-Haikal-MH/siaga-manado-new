@extends('layouts.petugas')

@section('title', 'Dashboard Petugas — SiagaManado')

@section('content')
<div class="max-w-6xl space-y-6">

    <!-- 1. TOP GREETING BAR matching Frame 50.png -->
    <div class="rounded-[22px] bg-[#131b2c] border border-slate-800/90 px-6 py-5 flex flex-col lg:flex-row lg:items-center justify-between gap-4 shadow-lg">
        <div>
            <div class="flex flex-wrap items-center gap-3">
                <h2 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                    Halo, {{ $officer['name'] ?? 'Karel Sumilat' }} 👋
                </h2>
                <span class="px-3 py-0.5 rounded-full bg-[#1e2d4a] border border-blue-400/20 text-[#60a5fa] text-[11px] font-bold">
                    {{ $officer['badgeStatus'] ?? 'Aktif Siaga' }}
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-1.5">
                Status Kesiapan: <strong class="text-slate-200">{{ $officer['readinessStatus'] ?? 'Siap Tugas' }}</strong>
                • {{ $officer['team'] ?? 'Regu Alfa' }}
                • {{ $officer['commandPost'] ?? 'Posko Komando Tikala' }}
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Shift Time Pill -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0f1624] border border-slate-800 text-xs font-semibold text-slate-300">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Piket: {{ $officer['shiftTime'] ?? '08:00 - 20:00 WITA' }}</span>
            </div>

            <!-- Check-in Radio Button -->
            <form action="{{ route('petugas.radio.checkin') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-xs font-extrabold transition shadow-md cursor-pointer {{ !empty($officer['radioCheckedIn']) ? 'bg-emerald-600 hover:bg-emerald-500 text-white' : 'bg-[#4e8cff] hover:bg-[#3b7bef] text-[#091224]' }}"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                    </svg>
                    <span>{{ !empty($officer['radioCheckedIn']) ? 'Radio Terhubung' : 'Check-in Radio' }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- 2. MAIN GRID: LEFT 8 COLS (STATS + PRIORITY DISPATCH) & RIGHT 4 COLS (WEATHER & EARLY WARNING) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- LEFT COLUMN -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Two Summary Cards matching Frame 50.png -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Card 1: PENUGASAN AKTIF -->
                <div class="rounded-[22px] bg-[#131b2c] border border-slate-800/90 p-5 flex flex-col justify-between shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">
                            PENUGASAN AKTIF
                        </span>
                        <div class="w-8 h-8 rounded-full bg-rose-500/15 border border-rose-500/30 text-rose-400 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-3 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-white">2</span>
                        <span class="text-xs font-bold text-rose-400">1 Mendesak</span>
                    </div>

                    <p class="text-[11.5px] text-slate-400 mt-1.5">
                        Sektor Banjir Tuminting & Singkil
                    </p>
                </div>

                <!-- Card 2: MENUNGGU KONFIRMASI -->
                <div class="rounded-[22px] bg-[#131b2c] border border-slate-800/90 p-5 flex flex-col justify-between shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">
                            MENUNGGU KONFIRMASI
                        </span>
                        <div class="w-8 h-8 rounded-full bg-blue-500/15 border border-blue-500/30 text-blue-400 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-3 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-white">1</span>
                        <span class="text-xs font-bold text-[#60a5fa]">Tugas Baru</span>
                    </div>

                    <p class="text-[11.5px] text-slate-400 mt-1.5">
                        Butuh respon dalam 10 menit
                    </p>
                </div>
            </div>

            <!-- Penugasan Prioritas Hari Ini Card matching Frame 50.png -->
            @if($priorityAssignment)
                <div class="rounded-[24px] bg-[#131b2c] border border-slate-800/90 p-6 shadow-lg">
                    <div class="flex items-center justify-between gap-3 mb-5">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
                            <h3 class="text-base sm:text-lg font-extrabold text-white">
                                Penugasan Prioritas Hari Ini
                            </h3>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-rose-500 text-white text-[11px] font-extrabold">
                            {{ $priorityAssignment['priorityShort'] ?? 'Prioritas Tinggi' }}
                        </span>
                    </div>

                    <div class="rounded-2xl bg-[#0e1525] border border-slate-800/80 p-4 sm:p-5 grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                        <!-- Image with "Live Feed TRC" badge -->
                        <div class="md:col-span-5 relative rounded-xl overflow-hidden h-44 bg-slate-900">
                            <img
                                src="{{ $priorityAssignment['imageUrl'] }}"
                                alt="{{ $priorityAssignment['title'] }}"
                                class="w-full h-full object-cover"
                            />
                            <div class="absolute bottom-2.5 left-2.5 px-2.5 py-1 rounded-md bg-slate-950/80 backdrop-blur-xs text-[10.5px] font-bold text-slate-200 border border-white/10">
                                Live Feed TRC
                            </div>
                        </div>

                        <!-- Right Details -->
                        <div class="md:col-span-7 space-y-2.5">
                            <p class="text-[11px] font-extrabold uppercase tracking-wider text-rose-400">
                                ⏱ {{ $priorityAssignment['dashboardCode'] }}
                            </p>

                            <h4 class="text-lg font-extrabold text-white leading-snug">
                                {{ $priorityAssignment['title'] }}
                            </h4>

                            <p class="text-xs text-slate-400 leading-relaxed">
                                {{ $priorityAssignment['summaryDashboard'] }}
                            </p>

                            <div class="pt-1 space-y-1.5 text-xs text-slate-300">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-400">📍</span>
                                    <span>{{ $priorityAssignment['locationShort'] }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-400">👥</span>
                                    <span>{{ $priorityAssignment['team'] }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons: Mulai Navigasi & Buka Detail Penugasan -->
                            <div class="pt-3 flex flex-wrap items-center gap-3">
                                <a
                                    href="https://www.google.com/maps?q={{ $priorityAssignment['latitude'] }},{{ $priorityAssignment['longitude'] }}"
                                    target="_blank"
                                    rel="noreferrer"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#4e8cff] hover:bg-[#3b7bef] text-[#091224] text-xs font-extrabold transition shadow-md"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <span>Mulai Navigasi</span>
                                </a>

                                <a
                                    href="{{ route('petugas.assignments.show', $priorityAssignment['id']) }}"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#1a2438] hover:bg-slate-700 text-slate-200 text-xs font-bold border border-slate-700/80 transition"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>Buka Detail Penugasan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- RIGHT COLUMN: Cuaca & Peringatan Dini matching Frame 50.png -->
        <div class="lg:col-span-4">
            <div class="rounded-[24px] bg-[#131b2c] border border-slate-800/90 p-6 shadow-lg space-y-4">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="text-base sm:text-lg font-extrabold text-white leading-snug">
                        Cuaca & Peringatan<br />Dini
                    </h3>
                    <span class="px-2.5 py-1 rounded-lg bg-[#0f1624] border border-slate-800 text-[10px] font-extrabold text-slate-300 uppercase tracking-wider">
                        {{ $weather['authority'] ?? 'BMKG MANADO' }}
                    </span>
                </div>

                <!-- Main Weather Box -->
                <div class="rounded-2xl bg-[#182235] border border-slate-800 p-4">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="text-blue-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16l-2 3m4-3l-2 3"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-white leading-none">
                                    {{ $weather['temperature'] ?? '26°C' }}
                                </p>
                                <p class="text-[11px] text-slate-300 mt-1">
                                    {{ $weather['condition'] ?? 'Hujan Intensitas Lebat' }}
                                </p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-[10.5px] text-slate-400">Kecepatan Angin</p>
                            <p class="text-xs font-extrabold text-white mt-0.5">
                                {{ $weather['windSpeed'] ?? '28 km/jam BD' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-3.5 pt-3 border-t border-slate-700/60 flex items-center justify-between text-[11px] text-slate-300 font-medium">
                        <span>Kelembaban: {{ $weather['humidity'] ?? '94%' }}</span>
                        <span class="font-bold text-amber-300">{{ $weather['riverStatus'] ?? 'DAS Tondano: Siaga 2' }}</span>
                    </div>
                </div>

                <!-- Warning Alerts List -->
                <div class="space-y-3">
                    @foreach(($weather['warnings'] ?? []) as $warn)
                        @if($warn['type'] === 'danger')
                            <div class="rounded-2xl bg-[#271924] border border-rose-500/25 p-4">
                                <div class="flex items-center gap-2 text-xs font-extrabold text-rose-300 mb-1">
                                    <span>🏠</span>
                                    <span>{{ $warn['title'] }}</span>
                                </div>
                                <p class="text-[11.5px] text-slate-300/90 leading-relaxed">
                                    {{ $warn['description'] }}
                                </p>
                            </div>
                        @else
                            <div class="rounded-2xl bg-[#162033] border border-blue-500/20 p-4">
                                <div class="flex items-center gap-2 text-xs font-extrabold text-blue-300 mb-1">
                                    <span>🌊</span>
                                    <span>{{ $warn['title'] }}</span>
                                </div>
                                <p class="text-[11.5px] text-slate-300/90 leading-relaxed">
                                    {{ $warn['description'] }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
