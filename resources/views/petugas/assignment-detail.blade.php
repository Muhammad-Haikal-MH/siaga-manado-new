@extends('layouts.petugas')

@section('title', 'Detail Penugasan ' . $assignment['dispatchCode'] . ' — SiagaManado')

@section('content')
<div class="max-w-4xl space-y-5">

    <!-- Top Back Button matching Frame 54.png -->
    <div>
        <a
            href="{{ route('petugas.assignments') }}"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-[#161f33] hover:bg-slate-800 text-slate-300 hover:text-white text-xs font-semibold border border-slate-800 transition"
        >
            <span>Kembali ke Daftar Penugasan</span>
        </a>
    </div>

    <!-- Main Detail Card matching Frame 54.png -->
    <div class="rounded-[26px] bg-[#131b2c] border border-slate-800/90 p-6 sm:p-8 shadow-xl space-y-6">

        <!-- Header Row: Priority Badge, Code, Title & Status Pill -->
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
            <div class="space-y-2.5">
                <div class="flex flex-wrap items-center gap-2.5">
                    @if($assignment['priorityLevel'] === 'high')
                        <span class="px-3 py-1 rounded-full bg-rose-600 text-white text-[10.5px] font-extrabold uppercase tracking-wider">
                            ! PRIORITAS TINGGI
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-blue-600 text-white text-[10.5px] font-extrabold uppercase tracking-wider">
                            PRIORITAS SEDANG
                        </span>
                    @endif
                    <span class="text-xs font-mono font-bold text-slate-400">
                        {{ $assignment['dispatchCode'] }}
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    {{ $assignment['title'] }}
                </h1>

                <p class="text-xs sm:text-sm text-slate-400 flex items-center gap-1.5">
                    <span>📍</span>
                    <span>{{ $assignment['locationDetailHeader'] }}</span>
                </p>
            </div>

            <!-- Top Right Status Pill -->
            <div>
                @if($assignment['statusKey'] === 'menunggu_verifikasi')
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#253147] border border-slate-700 text-slate-200 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                        <span>{{ $assignment['statusBadgeDetail'] ?? 'Menunggu Verifikasi' }}</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>{{ $assignment['statusBadgeDetail'] ?? 'Sedang Ditangani' }}</span>
                    </span>
                @endif
            </div>
        </div>

        <!-- 3-Column Metadata Box: PELAPOR, WAKTU KEJADIAN, WAKTU LAPORAN -->
        <div class="rounded-2xl bg-[#0e1525] border border-slate-800/90 p-5 grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">
                    PELAPOR
                </p>
                <p class="text-sm font-extrabold text-white">
                    {{ $assignment['reporterName'] }}
                </p>
                <p class="text-xs text-slate-400 mt-0.5">
                    {{ $assignment['reporterPhone'] }}
                </p>
            </div>

            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">
                    WAKTU KEJADIAN
                </p>
                <p class="text-sm font-extrabold text-white">
                    {{ $assignment['incidentDate'] }}
                </p>
                <p class="text-xs text-slate-400 mt-0.5">
                    {{ $assignment['incidentTime'] }}
                </p>
            </div>

            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">
                    WAKTU LAPORAN
                </p>
                <p class="text-sm font-extrabold text-white">
                    {{ $assignment['reportDate'] }}
                </p>
                <p class="text-xs text-slate-400 mt-0.5">
                    {{ $assignment['reportTime'] }}
                </p>
            </div>
        </div>

        <!-- DESKRIPSI KEJADIAN -->
        <div>
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-2">
                DESKRIPSI KEJADIAN
            </p>
            <div class="rounded-2xl bg-[#0e1525] border border-slate-800/90 p-4 sm:p-5 text-xs sm:text-sm text-slate-200 leading-relaxed">
                {{ $assignment['descriptionDetail'] }}
            </div>
        </div>

        <!-- DOKUMENTASI BUKTI LAPANGAN matching Frame 54.png -->
        <div>
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-2">
                DOKUMENTASI BUKTI LAPANGAN
            </p>
            <div class="relative rounded-2xl overflow-hidden border border-slate-800 bg-slate-950">
                <img
                    src="{{ $assignment['imageUrl'] }}"
                    alt="{{ $assignment['title'] }}"
                    class="w-full h-64 sm:h-80 object-cover"
                />

                <!-- Top-left HUD Overlay Box matching Frame 54.png -->
                <div class="absolute top-3 left-3 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/10 p-3 text-[11px] text-slate-200 space-y-1 max-w-xs">
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-4 text-slate-400">Lokasi:</span>
                        <span class="col-span-8 font-semibold text-white">{{ $assignment['fieldLocationOverlay'] }}</span>
                    </div>
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-4 text-slate-400">Status:</span>
                        <span class="col-span-8 font-semibold text-white">{{ $assignment['fieldStatusOverlay'] }}</span>
                    </div>
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-4 text-slate-400">Prioritas:</span>
                        <span class="col-span-8 font-semibold text-white">{{ $assignment['fieldPriorityOverlay'] }}</span>
                    </div>
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-5 text-slate-400">Korban Dilaporkan:</span>
                        <span class="col-span-7 font-semibold text-white">{{ $assignment['fieldVictimsOverlay'] }}</span>
                    </div>
                </div>

                <!-- Bottom Bar on Image -->
                <div class="bg-slate-950/90 px-4 py-2.5 flex flex-wrap items-center justify-between gap-2 text-xs">
                    <span class="font-bold text-slate-200">
                        🧭 {{ $assignment['fieldFooterAddress'] }}
                    </span>
                    <span class="text-slate-400 font-semibold">
                        {{ $assignment['fieldVerifiedBy'] }}
                    </span>
                </div>
            </div>
        </div>

        <!-- INSTRUKSI TUGAS RINGKAS matching Frame 54.png -->
        <div>
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-2.5">
                INSTRUKSI TUGAS RINGKAS
            </p>
            <div class="space-y-2.5">
                @foreach(($assignment['instructions'] ?? []) as $index => $inst)
                    <div class="rounded-xl bg-[#0e1525] border border-slate-800/90 px-4 py-3 flex items-center gap-3.5">
                        <span class="w-6 h-6 rounded-full bg-[#3b82f6] text-white text-xs font-extrabold flex items-center justify-center shrink-0">
                            {{ $index + 1 }}
                        </span>
                        <p class="text-xs sm:text-sm text-slate-200">
                            {{ $inst }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Bottom Action Button: "Diterima" matching Frame 54.png -->
        <div class="pt-4 border-t border-slate-800/80 flex items-center justify-end">
            @if($assignment['statusKey'] === 'menunggu_verifikasi')
                <form action="{{ route('petugas.assignments.accept', $assignment['id']) }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="px-14 py-3 rounded-full bg-[#4e8cff] hover:bg-[#3b7bef] text-white text-sm font-extrabold shadow-lg transition cursor-pointer"
                    >
                        Diterima
                    </button>
                </form>
            @else
                <span class="px-10 py-2.5 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-extrabold">
                    ✓ Penugasan Telah Diterima
                </span>
            @endif
        </div>

    </div>

</div>
@endsection
