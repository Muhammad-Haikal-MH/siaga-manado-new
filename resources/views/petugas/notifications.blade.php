@extends('layouts.petugas')

@section('title', 'Notifikasi & Peringatan Tugas — SiagaManado')

@section('content')
<div class="max-w-6xl space-y-6">

    <!-- Page Title & Subtitle matching Frame 52.png -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            Notifikasi & Peringatan Tugas
        </h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1.5 max-w-xl leading-relaxed">
            Pemberitahuan resmi penugasan bencana, perubahan status laporan operasional, dan persetujuan izin lapangan TRC Manado.
        </p>

        <!-- Top Status Pills: PRIORITAS 1 Banjir Tuminting & Kanal 04 TRC Siaga -->
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#182235] border border-slate-800 text-xs font-semibold text-slate-200">
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                <strong class="text-rose-400 font-extrabold">PRIORITAS 1</strong>
                <span>Banjir Tuminting</span>
            </span>

            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#182235] border border-slate-800 text-xs font-semibold text-slate-200">
                <span class="text-blue-400">📻</span>
                <span>{{ $officer['radioChannel'] ?? 'Kanal 04 TRC Siaga' }}</span>
            </span>
        </div>
    </div>

    <!-- Filter Tabs Bar matching Frame 52.png -->
    <div class="rounded-2xl bg-[#131b2c] border border-slate-800/90 px-4 py-2.5 flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-2">
            <a
                href="{{ route('petugas.notifications', ['tab' => 'semua']) }}"
                class="px-4 py-1.5 rounded-full text-xs font-bold transition {{ $activeTab === 'semua' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-300 hover:text-white' }}"
            >
                Semua ({{ $counts['semua'] ?? 4 }})
            </a>

            <a
                href="{{ route('petugas.notifications', ['tab' => 'belum_dibaca']) }}"
                class="px-4 py-1.5 rounded-full text-xs font-bold transition {{ $activeTab === 'belum_dibaca' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-300 hover:text-white' }}"
            >
                • Belum Dibaca ({{ $counts['belum_dibaca'] ?? 2 }})
            </a>

            <a
                href="{{ route('petugas.notifications', ['tab' => 'penugasan_baru']) }}"
                class="px-4 py-1.5 rounded-full text-xs font-bold transition {{ $activeTab === 'penugasan_baru' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-300 hover:text-white' }}"
            >
                Penugasan Baru ({{ $counts['penugasan_baru'] ?? 2 }})
            </a>

            <a
                href="{{ route('petugas.notifications', ['tab' => 'izin']) }}"
                class="px-4 py-1.5 rounded-full text-xs font-bold transition {{ $activeTab === 'izin' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-300 hover:text-white' }}"
            >
                Izin ({{ $counts['izin'] ?? 1 }})
            </a>
        </div>

        <form action="{{ route('petugas.notifications.readAll') }}" method="POST">
            @csrf
            <button
                type="submit"
                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#1a2438] hover:bg-slate-700 text-slate-300 text-[11px] font-bold border border-slate-700/70 transition cursor-pointer"
            >
                <span>✓✓ Tandai Semua Sudah Dibaca</span>
            </button>
        </form>
    </div>

    <!-- Split Layout: Left Notification Feed (7 Cols) + Right Detail Inspection Drawer (5 Cols) matching Frame 52.png -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- LEFT: Notification Feed List -->
        <div class="lg:col-span-7 space-y-4">
            @forelse($notifications as $item)
                @php
                    $isSelected = $selectedNotification && $selectedNotification['id'] === $item['id'];
                @endphp
                <a
                    href="{{ route('petugas.notifications', ['tab' => $activeTab, 'pilih' => $item['id']]) }}"
                    class="block rounded-[22px] p-5 border transition shadow-md {{ $isSelected ? 'bg-[#1a253a] border-blue-500/40' : 'bg-[#131b2c] hover:bg-[#172136] border-slate-800/90' }}"
                >
                    <div class="flex items-start gap-4">
                        <!-- Left Icon Circle -->
                        @if($item['badgeType'] === 'urgent')
                            <div class="relative w-11 h-11 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-md">
                                <span class="text-base">🚨</span>
                                @if($item['isUnread'])
                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-300 ring-2 ring-[#131b2c] absolute -top-0.5 -right-0.5"></span>
                                @endif
                            </div>
                        @elseif($item['badgeType'] === 'admin')
                            <div class="relative w-11 h-11 rounded-full bg-[#25324a] text-slate-200 flex items-center justify-center shrink-0 mt-0.5">
                                <span class="text-base">📅</span>
                                @if($item['isUnread'])
                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-300 ring-2 ring-[#131b2c] absolute -top-0.5 -right-0.5"></span>
                                @endif
                            </div>
                        @elseif($item['badgeType'] === 'done')
                            <div class="w-11 h-11 rounded-full bg-[#192336] text-slate-400 flex items-center justify-center shrink-0 mt-0.5">
                                <span class="text-base">🛡️</span>
                            </div>
                        @else
                            <div class="w-11 h-11 rounded-full bg-[#192336] text-slate-400 flex items-center justify-center shrink-0 mt-0.5">
                                <span class="text-base">ℹ️</span>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    @if($item['badgeType'] === 'urgent')
                                        <span class="px-2.5 py-0.5 rounded-full bg-rose-500 text-white text-[10px] font-extrabold uppercase tracking-wider">
                                            {{ $item['badgeText'] }}
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-[#243047] text-slate-300 text-[10px] font-extrabold uppercase tracking-wider">
                                            {{ $item['badgeText'] }}
                                        </span>
                                    @endif

                                    @if(!empty($item['code']))
                                        <span class="px-2.5 py-0.5 rounded-full bg-[#11192a] text-[#93c5fd] text-[10.5px] font-mono font-bold">
                                            {{ $item['code'] }}
                                        </span>
                                    @endif
                                </div>

                                @if($item['isUnread'] && $item['badgeType'] === 'urgent')
                                    <span class="text-[11px] font-bold text-[#93c5fd]">• Baru</span>
                                @else
                                    <span class="text-[11px] text-slate-400">{{ $item['timeText'] }}</span>
                                @endif
                            </div>

                            <h2 class="text-sm sm:text-base font-extrabold text-white leading-snug">
                                {{ $item['title'] }}
                            </h2>

                            <p class="text-xs text-slate-400 mt-1.5 leading-relaxed line-clamp-2">
                                {{ $item['summary'] }}
                            </p>

                            <div class="mt-3 pt-2.5 border-t border-slate-800/80 flex items-center justify-between text-[11.5px]">
                                @if($item['badgeType'] === 'urgent')
                                    <span class="text-slate-400">⏱ {{ $item['timeText'] }}</span>
                                @elseif($item['isUnread'])
                                    <span class="font-bold text-[#93c5fd]">• Belum Dibaca</span>
                                @else
                                    <span class="text-slate-500">✓✓ Sudah Dibaca</span>
                                @endif

                                <span class="font-bold text-[#93c5fd] hover:underline">
                                    {{ $item['actionLabel'] }} ›
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="rounded-[22px] bg-[#131b2c] border border-slate-800 p-10 text-center">
                    <p class="text-sm font-bold text-slate-300">Tidak ada notifikasi pada kategori ini.</p>
                </div>
            @endforelse
        </div>

        <!-- RIGHT: Detail Pemberitahuan Drawer matching Frame 52.png -->
        <div class="lg:col-span-5">
            @if($selectedNotification && !empty($selectedNotification['detail']))
                @php
                    $det = $selectedNotification['detail'];
                @endphp
                <div class="rounded-[24px] bg-[#131b2c] border border-blue-500/30 p-6 shadow-xl space-y-4 sticky top-6">
                    <!-- Top Drawer Header -->
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-rose-500/20 border border-rose-500/30 text-rose-300 text-[10px] font-extrabold">
                                ⚡ {{ $det['priorityBadge'] }}
                            </span>
                            <span class="text-[11px] font-mono font-bold text-slate-300">
                                {{ $det['code'] }}
                            </span>
                        </div>
                    </div>

                    <h3 class="text-base sm:text-lg font-extrabold text-white leading-snug">
                        {{ $det['headerTitle'] }}
                    </h3>

                    <!-- Image Box with Overlay Footer -->
                    <div class="relative rounded-2xl overflow-hidden border border-slate-800 h-44 bg-slate-950">
                        <img
                            src="{{ $det['imageUrl'] }}"
                            alt="{{ $det['disasterType'] }}"
                            class="w-full h-full object-cover"
                        />
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-transparent p-3 flex items-end justify-between gap-2 text-[10.5px]">
                            <span class="font-bold text-slate-200">
                                📍 {{ $det['imageLocation'] }}
                            </span>
                            <span class="font-extrabold text-rose-400 text-right">
                                {{ $det['imageWaterLevel'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Info Rows -->
                    <div class="space-y-2.5 text-xs">
                        <div class="rounded-xl bg-[#0e1525] border border-slate-800/90 px-3.5 py-2.5 flex items-center justify-between gap-2">
                            <span class="text-slate-400">Jenis Bencana</span>
                            <strong class="text-white font-bold text-right">{{ $det['disasterType'] }}</strong>
                        </div>

                        <div class="rounded-xl bg-[#0e1525] border border-slate-800/90 px-3.5 py-2.5 flex items-center justify-between gap-2">
                            <span class="text-slate-400">Lokasi Lapangan</span>
                            <div class="text-right">
                                <p class="text-white font-bold">{{ $det['locationDistrict'] }}</p>
                                <p class="text-[10.5px] text-slate-400">{{ $det['locationSub'] }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2.5">
                            <div class="rounded-xl bg-[#0e1525] border border-slate-800/90 p-3">
                                <p class="text-[10px] text-slate-400">Waktu Penugasan</p>
                                <p class="text-[11px] font-bold text-white mt-0.5">{{ $det['assignedTime'] }}</p>
                            </div>
                            <div class="rounded-xl bg-[#0e1525] border border-slate-800/90 p-3">
                                <p class="text-[10px] text-slate-400">Diterbitkan Oleh</p>
                                <p class="text-[11px] font-bold text-white mt-0.5">🛡️ {{ $det['issuedBy'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- INSTRUKSI KHUSUS & LOGISTIK -->
                    <div class="rounded-2xl bg-[#0e1525] border border-slate-800/90 p-4 space-y-2.5">
                        <p class="text-[10.5px] font-extrabold uppercase tracking-wider text-[#93c5fd]">
                            ☑ INSTRUKSI KHUSUS & LOGISTIK
                        </p>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            {{ $det['instruction'] }}
                        </p>
                        <div class="pt-1 flex flex-wrap items-center gap-3 text-[11px] font-bold text-slate-300">
                            <span>👥 {{ $det['unitTag'] }}</span>
                            <span>•</span>
                            <span>🛟 {{ $det['equipmentTag'] }}</span>
                        </div>
                    </div>

                    <!-- Drawer Buttons: Lihat Penugasan & Kembali -->
                    <div class="pt-1 grid grid-cols-2 gap-3">
                        @if(!empty($selectedNotification['assignmentId']))
                            <a
                                href="{{ route('petugas.assignments.show', $selectedNotification['assignmentId']) }}"
                                class="py-2.5 px-4 rounded-full bg-[#4e8cff] hover:bg-[#3b7bef] text-[#091224] text-xs font-extrabold flex items-center justify-center gap-1.5 transition shadow-md"
                            >
                                <span>✓ Lihat Penugasan</span>
                            </a>
                        @else
                            <a
                                href="{{ route('petugas.leave') }}"
                                class="py-2.5 px-4 rounded-full bg-[#4e8cff] hover:bg-[#3b7bef] text-[#091224] text-xs font-extrabold flex items-center justify-center gap-1.5 transition shadow-md"
                            >
                                <span>✓ Lihat Detail Izin</span>
                            </a>
                        @endif

                        <a
                            href="{{ route('petugas.dashboard') }}"
                            class="py-2.5 px-4 rounded-full bg-[#1a2438] hover:bg-slate-700 text-slate-200 text-xs font-bold flex items-center justify-center gap-1.5 border border-slate-700/80 transition"
                        >
                            <span>← Kembali</span>
                        </a>
                    </div>

                    <!-- SOP Footer Note matching Frame 52.png -->
                    <div class="rounded-xl bg-[#0e1525]/90 border border-slate-800 p-3 text-[10.5px] text-slate-400 leading-relaxed">
                        ℹ️ Sesuai protokol SOP BPBD: Notifikasi ini otomatis ditandai terbaca saat Anda membuka detail penugasan. Jika tidak dibuka, status tetap <strong class="text-rose-400">Belum dibaca</strong>.
                    </div>
                </div>
            @endif
        </div>

    </div>

</div>
@endsection
