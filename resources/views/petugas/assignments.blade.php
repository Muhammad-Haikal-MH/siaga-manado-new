@extends('layouts.petugas')

@section('title', 'Penugasan Petugas Lapangan — SiagaManado')

@section('content')
<div class="max-w-5xl space-y-6">

    <!-- Page Title matching Frame 51.png -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            Penugasan Petugas Lapangan
        </h1>
    </div>

    <!-- 3 Summary Stats Cards matching Frame 51.png -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <!-- Card 1: PENUGASAN AKTIF -->
        <div class="rounded-[22px] bg-[#131b2c] border border-slate-800/90 p-5 flex items-center justify-between shadow-md">
            <div>
                <p class="text-[10.5px] font-extrabold uppercase tracking-wider text-slate-400">
                    PENUGASAN AKTIF
                </p>
                <div class="mt-2 flex items-baseline gap-1.5">
                    <span class="text-3xl font-extrabold text-[#60a5fa]">2</span>
                    <span class="text-xs font-semibold text-slate-300">Tugas</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-1.5">
                    1 Prioritas Tinggi Lapangan
                </p>
            </div>
            <div class="w-11 h-11 rounded-full bg-blue-500/15 border border-blue-500/25 text-[#60a5fa] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>

        <!-- Card 2: MENUNGGU KONFIRMASI -->
        <div class="rounded-[22px] bg-[#131b2c] border border-slate-800/90 p-5 flex items-center justify-between shadow-md">
            <div>
                <p class="text-[10.5px] font-extrabold uppercase tracking-wider text-slate-400">
                    MENUNGGU KONFIRMASI
                </p>
                <div class="mt-2 flex items-baseline gap-1.5">
                    <span class="text-3xl font-extrabold text-rose-400">1</span>
                    <span class="text-xs font-semibold text-slate-300">Tugas</span>
                </div>
                <p class="text-[11px] text-rose-400/90 font-semibold mt-1.5">
                    Butuh verifikasi segera
                </p>
            </div>
            <div class="w-11 h-11 rounded-full bg-rose-500/15 border border-rose-500/25 text-rose-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
        </div>

        <!-- Card 3: PENUGASAN SELESAI -->
        <div class="rounded-[22px] bg-[#131b2c] border border-slate-800/90 p-5 flex items-center justify-between shadow-md">
            <div>
                <p class="text-[10.5px] font-extrabold uppercase tracking-wider text-slate-400">
                    PENUGASAN SELESAI
                </p>
                <div class="mt-2 flex items-baseline gap-1.5">
                    <span class="text-3xl font-extrabold text-white">18</span>
                    <span class="text-xs font-semibold text-slate-300">Tugas</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-1.5">
                    Bulan Operasional Oktober
                </p>
            </div>
            <div class="w-11 h-11 rounded-full bg-slate-800 border border-slate-700 text-slate-300 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Assignments List Cards matching Frame 51.png -->
    <div class="space-y-5">
        @foreach($assignments as $idx => $item)
            <div class="rounded-[24px] bg-[#131b2c] border border-slate-800/90 p-6 shadow-lg space-y-4">
                <!-- Card Top Metadata Bar -->
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-[#1a263d] text-[#93c5fd] text-[11px] font-mono font-bold">
                            {{ $item['dispatchCode'] }}
                        </span>

                        @if($item['priorityLevel'] === 'high')
                            <span class="px-3 py-1 rounded-full bg-rose-500 text-white text-[11px] font-extrabold">
                                ✱ {{ $item['priority'] }}
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-[#1e293b] text-slate-300 text-[11px] font-bold">
                                {{ $item['priority'] }}
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-1.5 text-xs font-medium text-slate-400">
                        <span>⏱</span>
                        <span>{{ $item['timeAgo'] }}</span>
                    </div>
                </div>

                <!-- Main Body: Thumbnail + Info -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                    <div class="md:col-span-3 relative rounded-xl overflow-hidden h-32 bg-slate-900">
                        <img
                            src="{{ $item['imageUrl'] }}"
                            alt="{{ $item['title'] }}"
                            class="w-full h-full object-cover"
                        />
                        @if($idx === 0)
                            <span class="absolute bottom-2 right-2 px-2 py-0.5 rounded bg-slate-950/80 text-[10px] font-bold text-slate-200">
                                Foto Laporan
                            </span>
                        @endif
                    </div>

                    <div class="md:col-span-9 space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="text-[#60a5fa] text-base">
                                {{ $item['disasterType'] === 'Banjir' ? '🌊' : '⛰️' }}
                            </span>
                            <h2 class="text-lg sm:text-xl font-extrabold text-white">
                                {{ $item['title'] }}
                            </h2>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 text-xs text-slate-400">
                            <span>📍 {{ $item['locationFull'] }}</span>
                            @if(!empty($item['zoneTag']))
                                <span class="px-2.5 py-0.5 rounded-md bg-rose-500/20 border border-rose-500/30 text-rose-300 text-[10.5px] font-bold">
                                    {{ $item['zoneTag'] }}
                                </span>
                            @endif
                        </div>

                        <p class="text-xs sm:text-sm text-slate-300/90 leading-relaxed">
                            {{ $item['summaryList'] }}
                        </p>
                    </div>
                </div>

                @if($item['priorityLevel'] === 'high')
                    <!-- Partner Lapangan Bar matching Frame 51.png first card -->
                    <div class="rounded-xl bg-[#0e1525] border border-slate-800/80 px-4 py-3 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#1a263d] text-blue-300 flex items-center justify-center text-xs">
                                👥
                            </div>
                            <div>
                                <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                                    PARTNER LAPANGAN
                                </p>
                                <p class="text-xs text-slate-200">
                                    <strong class="font-bold text-white">{{ $item['partnerName'] }}</strong>
                                    <span class="text-slate-400">{{ $item['partnerRole'] }}</span>
                                </p>
                            </div>
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-950/80 border border-rose-500/30 text-rose-300 text-[11px] font-bold">
                            <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                            <span>{{ $item['status'] }}</span>
                        </span>
                    </div>

                    <!-- Bottom Buttons for Priority Card -->
                    <div class="pt-1 flex flex-wrap items-center justify-end gap-3">
                        <a
                            href="https://www.google.com/maps?q={{ $item['latitude'] }},{{ $item['longitude'] }}"
                            target="_blank"
                            rel="noreferrer"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#1a2438] hover:bg-slate-700 text-slate-200 text-xs font-bold border border-slate-700/80 transition"
                        >
                            <span>🧭 Panduan Rute GPS</span>
                        </a>

                        <a
                            href="{{ route('petugas.assignments.show', $item['id']) }}"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-[#4e8cff] hover:bg-[#3b7bef] text-[#091224] text-xs font-extrabold transition shadow-md"
                        >
                            <span>Lihat Detail Penugasan →</span>
                        </a>
                    </div>
                @else
                    <!-- Bottom Bar for Medium Cards matching Frame 51.png -->
                    <div class="pt-2 flex flex-wrap items-center justify-between gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#172542] border border-blue-500/20 text-[#93c5fd] text-[11px] font-bold">
                            <span class="w-2 h-2 rounded-full bg-[#60a5fa]"></span>
                            <span>{{ $item['status'] }}</span>
                        </span>

                        <a
                            href="{{ route('petugas.assignments.show', $item['id']) }}"
                            class="inline-flex items-center gap-1.5 px-5 py-2 rounded-full bg-[#1a2438] hover:bg-slate-700 text-slate-200 text-xs font-bold border border-slate-700/80 transition"
                        >
                            <span>Lihat Detail ›</span>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

</div>
@endsection
