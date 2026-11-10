@extends('layouts.app')

@section('title', 'Mitigasi Bencana — SiagaManado')

@section('content')
@php
    $mitigationImages = [
        'banjir' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=900&q=80',
        'longsor' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=900&q=80',
        'gempa' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
    ];
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-12">
    <!-- Header -->
    <div class="max-w-2xl mb-10">
        <span class="inline-block px-3.5 py-1 rounded-full bg-blue-50 border border-blue-200 text-[#163672] text-[11px] font-extrabold uppercase tracking-wider mb-2.5">
            Pusat Edukasi Kesiapsiagaan
        </span>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
            Panduan Mitigasi Bencana
        </h1>

        <p class="text-sm text-slate-600 mt-2.5 leading-relaxed">
            Pilih jenis bencana di bawah ini untuk mempelajari langkah-langkah kesiapsiagaan sebelum kejadian, tindakan penyelamatan saat darurat, serta pemulihan pasca-bencana di Kota Manado.
        </p>
    </div>

    <!-- Cards Grid -->
    @if(count($mitigations) === 0)
        <div class="rounded-3xl bg-white border border-slate-200 p-12 text-center">
            <h2 class="text-base font-bold text-slate-800">
                Belum Terdapat Konten Mitigasi
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Panduan mitigasi bencana sedang disiapkan dan akan segera ditampilkan di halaman ini.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($mitigations as $item)
                @php
                    $badgeClass = 'bg-blue-50 text-[#163672] border-blue-200';
                    if ($item['badgeColor'] === 'amber') {
                        $badgeClass = 'bg-amber-50 text-amber-800 border-amber-200';
                    } elseif ($item['badgeColor'] === 'rose') {
                        $badgeClass = 'bg-rose-50 text-rose-700 border-rose-200';
                    }
                    $imgUrl = $mitigationImages[$item['slug']] ?? $mitigationImages['banjir'];
                @endphp

                <a
                    href="{{ route('mitigation.show', $item['slug']) }}"
                    class="group rounded-[24px] bg-white border border-slate-200/90 overflow-hidden flex flex-col justify-between transition shadow-2xs hover:shadow-lg hover:border-blue-300"
                >
                    <div>
                        <div class="relative h-48 overflow-hidden bg-slate-100">
                            <img
                                src="{{ $imgUrl }}"
                                alt="Mitigasi {{ $item['title'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            />
                            <div class="absolute top-3.5 left-3.5">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider border shadow-2xs {{ $badgeClass }}">
                                    {{ $item['badgeText'] }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h2 class="text-xl font-extrabold text-slate-900 group-hover:text-[#163672] transition">
                                    Mitigasi {{ $item['title'] }}
                                </h2>
                                <span class="text-xs font-bold text-[#163672] bg-blue-50 px-2.5 py-1 rounded-lg">
                                    {{ $item['stepsLabel'] }}
                                </span>
                            </div>

                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-3 mt-2">
                                {{ $item['summary'] }}
                            </p>
                        </div>
                    </div>

                    <div class="px-6 pb-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#163672]">
                        <span>Buka Panduan Lengkap</span>
                        <span class="group-hover:translate-x-1 transition">→</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
