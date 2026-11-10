@extends('layouts.app')

@section('title', $mitigation['fullTitle'] . ' — SiagaManado')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-12">
    <!-- Top Back Navigation Button -->
    <div class="mb-6">
        <a
            href="{{ route('mitigation.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 text-[#163672] text-xs font-bold border border-slate-200 shadow-2xs transition"
        >
            <span>← Kembali ke Daftar Mitigasi</span>
        </a>
    </div>

    <!-- Hero Banner Card -->
    <div class="rounded-[24px] bg-gradient-to-br from-[#0e2a66] via-[#163672] to-[#1e428a] text-white p-7 sm:p-10 shadow-md">
        <div class="space-y-3 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-blue-100 text-[11px] font-extrabold uppercase tracking-wider">
                <span>{{ $mitigation['badgeText'] }}</span>
                <span>•</span>
                <span>{{ $mitigation['stepsLabel'] }}</span>
            </div>

            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold leading-tight">
                {{ $mitigation['fullTitle'] }}
            </h1>

            <p class="text-xs sm:text-sm text-blue-100/90 leading-relaxed">
                {{ $mitigation['summary'] }}
            </p>
        </div>
    </div>

    <!-- Phase Filter Tabs: Sebelum, Saat, Setelah Bencana -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-3">
        <button
            type="button"
            id="tabBtn_sebelum"
            onclick="switchMitigationPhase('sebelum')"
            class="p-4 rounded-2xl border text-left transition cursor-pointer flex items-start gap-3.5 bg-[#163672] text-white border-[#163672] shadow-sm"
        >
            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5 bg-white/15 font-bold text-xs">
                01
            </div>
            <div>
                <p class="text-xs sm:text-sm font-extrabold">Pra-Bencana (Sebelum)</p>
                <p class="text-[11px] mt-0.5 opacity-85">Kesiapsiagaan & Pencegahan</p>
            </div>
        </button>

        <button
            type="button"
            id="tabBtn_saat"
            onclick="switchMitigationPhase('saat')"
            class="p-4 rounded-2xl border text-left transition cursor-pointer flex items-start gap-3.5 bg-white hover:bg-slate-50 text-slate-800 border-slate-200"
        >
            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5 bg-blue-50 text-[#163672] font-bold text-xs">
                02
            </div>
            <div>
                <p class="text-xs sm:text-sm font-extrabold">Saat Kejadian Darurat</p>
                <p class="text-[11px] mt-0.5 opacity-75">Tindakan Penyelamatan & Evakuasi</p>
            </div>
        </button>

        <button
            type="button"
            id="tabBtn_setelah"
            onclick="switchMitigationPhase('setelah')"
            class="p-4 rounded-2xl border text-left transition cursor-pointer flex items-start gap-3.5 bg-white hover:bg-slate-50 text-slate-800 border-slate-200"
        >
            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5 bg-blue-50 text-[#163672] font-bold text-xs">
                03
            </div>
            <div>
                <p class="text-xs sm:text-sm font-extrabold">Pasca-Bencana (Setelah)</p>
                <p class="text-[11px] mt-0.5 opacity-75">Pemulihan & Keamanan Lingkungan</p>
            </div>
        </button>
    </div>

    <!-- Main Content Layout: Steps List (Left 7 cols) + Sidebar Checklist & Risk Areas (Right 5 cols) -->
    <div class="mt-7 grid grid-cols-1 lg:grid-cols-12 gap-7">
        <!-- Left: Actionable Steps per Phase -->
        <div class="lg:col-span-7">
            <div class="rounded-[24px] bg-white border border-slate-200 p-6 sm:p-7 shadow-2xs">
                @foreach(['sebelum', 'saat', 'setelah'] as $phaseKey)
                    <div id="phaseContent_{{ $phaseKey }}" class="{{ $phaseKey === 'sebelum' ? 'block' : 'hidden' }}">
                        <div class="mb-5 pb-3 border-b border-slate-100">
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                Panduan Keselamatan ({{ count($mitigation['phases'][$phaseKey] ?? []) }} Langkah)
                            </h2>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Ikuti urutan langkah keselamatan di bawah ini secara tenang dan terukur.
                            </p>
                        </div>

                        <div class="space-y-3.5">
                            @foreach(($mitigation['phases'][$phaseKey] ?? []) as $stepItem)
                                <div class="rounded-2xl bg-slate-50 border border-slate-200/70 p-4 flex items-start gap-4">
                                    <div class="w-7 h-7 rounded-full bg-[#163672] text-white text-xs font-extrabold flex items-center justify-center shrink-0 mt-0.5">
                                        {{ $stepItem['step'] }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900">
                                            {{ $stepItem['title'] }}
                                        </h3>
                                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                            {{ $stepItem['description'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Tas Siaga Checklist & Wilayah Perhatian di Manado (Tanpa Tombol Lapor Kejadian) -->
        <div class="lg:col-span-5 space-y-6">
            <!-- Interactive Tas Siaga Bencana Checklist -->
            <div class="rounded-[24px] bg-white border border-slate-200 p-6 shadow-2xs">
                <h3 class="text-base font-extrabold text-slate-900 mb-1">
                    Ceklis Tas Siaga Bencana
                </h3>
                <p class="text-xs text-slate-500 mb-4">
                    Perlengkapan darurat yang disarankan untuk disiapkan di rumah:
                </p>

                <div class="space-y-2.5">
                    @foreach(($mitigation['emergencyBagItems'] ?? []) as $bagItem)
                        <label class="rounded-xl p-3 border bg-slate-50 hover:bg-blue-50/40 border-slate-200/80 text-slate-700 flex items-start gap-3 cursor-pointer transition text-xs">
                            <input type="checkbox" class="mt-0.5 accent-[#163672] rounded" onchange="this.nextElementSibling.classList.toggle('line-through'); this.nextElementSibling.classList.toggle('opacity-60');" />
                            <span>{{ $bagItem }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Zona Perhatian Khusus di Kota Manado -->
            <div class="rounded-[24px] bg-white border border-slate-200 p-6 shadow-2xs">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#163672] mb-3">
                    Wilayah Perhatian di Kota Manado
                </h3>
                <ul class="space-y-2">
                    @foreach(($mitigation['riskAreas'] ?? []) as $area)
                        <li class="text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-200/70 rounded-xl px-3.5 py-2.5 flex items-center gap-2">
                            <span class="text-[#163672] font-bold">•</span>
                            <span>{{ $area }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function switchMitigationPhase(phase) {
        ['sebelum', 'saat', 'setelah'].forEach(key => {
            const content = document.getElementById('phaseContent_' + key);
            const btn = document.getElementById('tabBtn_' + key);
            if (key === phase) {
                content.classList.remove('hidden');
                content.classList.add('block');
                btn.className = 'p-4 rounded-2xl border text-left transition cursor-pointer flex items-start gap-3.5 bg-[#163672] text-white border-[#163672] shadow-sm';
            } else {
                content.classList.add('hidden');
                content.classList.remove('block');
                btn.className = 'p-4 rounded-2xl border text-left transition cursor-pointer flex items-start gap-3.5 bg-white hover:bg-slate-50 text-slate-800 border-slate-200';
            }
        });
    }
</script>
@endsection
