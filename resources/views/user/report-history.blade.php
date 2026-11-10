@extends('layouts.app')

@section('title', 'Riwayat Laporan Saya — SiagaManado')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-12">
    <!-- Top Back Button & Action -->
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 text-[#163672] text-xs font-bold border border-slate-200 shadow-2xs transition"
        >
            <span>← Kembali ke Beranda</span>
        </a>

        <button
            type="button"
            onclick="openReportModal()"
            class="px-5 py-2.5 rounded-xl bg-[#163672] hover:bg-[#102959] text-white text-xs font-bold shadow-xs transition cursor-pointer"
        >
            + Buat Laporan Baru
        </button>
    </div>

    <!-- Main Container Card -->
    <div class="rounded-[24px] bg-white border border-slate-200 p-6 sm:p-8 shadow-2xs">
        <div class="flex flex-wrap items-center justify-between gap-4 pb-5 border-b border-slate-100">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                    Riwayat Laporan Saya
                </h1>
                <p class="text-xs text-slate-500 mt-1">
                    Daftar seluruh laporan kejadian bencana yang dikirimkan oleh akun
                    <strong class="text-slate-700">{{ $user['name'] ?? 'Muhammad Haikal' }}</strong>
                </p>
            </div>

            <span class="px-4 py-1.5 rounded-full bg-blue-50 text-[#163672] text-xs font-extrabold">
                Total: {{ count($reports) }} Laporan
            </span>
        </div>

        @if(count($reports) === 0)
            <div class="py-12 text-center">
                <p class="text-base font-bold text-slate-800">Belum Ada Laporan Bencana</p>
                <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
                    Anda belum pernah mengirimkan laporan bencana. Klik tombol "Buat Laporan Baru" apabila melihat kejadian bencana di sekitar Anda.
                </p>
            </div>
        @else
            <div class="mt-6 space-y-4">
                @foreach($reports as $item)
                    @php
                        $mediaCount = isset($item['mediaList']) ? count($item['mediaList']) : 1;
                    @endphp
                    <div class="rounded-2xl bg-slate-50 hover:bg-blue-50/40 border border-slate-200/80 p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 transition">
                        <div class="flex items-start gap-4">
                            <img
                                src="{{ $item['photoUrl'] }}"
                                alt="{{ $item['title'] }}"
                                class="w-20 h-20 rounded-xl object-cover border border-slate-200 shrink-0 hidden sm:block"
                            />
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <span class="px-2.5 py-0.5 rounded-md bg-blue-100 text-[#163672] text-[11px] font-bold">
                                        {{ $item['disasterType'] }}
                                    </span>
                                    <span class="text-[11px] font-mono text-slate-400">
                                        #{{ $item['id'] }}
                                    </span>
                                    @if($mediaCount > 1)
                                        <span class="px-2 py-0.5 rounded bg-slate-200 text-slate-700 text-[10px] font-bold">
                                            {{ $mediaCount }} Lampiran Media
                                        </span>
                                    @endif
                                </div>
                                <h2 class="text-sm sm:text-base font-bold text-slate-900">
                                    {{ $item['title'] }}
                                </h2>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    {{ $item['displayDate'] }} ({{ $item['incidentTime'] }} WITA) • {{ $item['location'] }}
                                </p>
                                <p class="text-xs text-slate-600 mt-1.5 line-clamp-2">
                                    {{ $item['description'] }}
                                </p>
                            </div>
                        </div>

                        <div class="flex md:flex-col items-center md:items-end justify-between gap-2.5 shrink-0 border-t md:border-t-0 pt-3 md:pt-0 border-slate-200">
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-100 border border-amber-300 text-amber-800 text-xs font-bold lowercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                {{ $item['status'] ?? 'menunggu' }}
                            </span>
                            <button
                                type="button"
                                onclick='openReportDetailModal(@json($item))'
                                class="px-4 py-1.5 rounded-xl bg-white hover:bg-slate-100 text-[#163672] border border-slate-200 text-xs font-bold transition cursor-pointer"
                            >
                                Lihat Detail Laporan
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
