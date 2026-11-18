@extends('admin.layouts.admin')

@section('title', 'Draft Mitigasi Bencana Alam — Admin Panel SiagaManado')

@section('content')
<div class="space-y-6">
    <!-- Header with Search (Matching Frame 46) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-[#141d33] border border-[#1e293b] flex items-center justify-center text-slate-300 shrink-0">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">Draft Mitigasi Bencana Alam</h1>
                <p class="text-xs text-slate-400 mt-0.5">Berikut adalah daftar draft dokumen dan panduan mitigasi bencana alam yang masih dalam tahap penyusunan.</p>
            </div>
        </div>

        <!-- Search Input (Matching Frame 46) -->
        <form method="GET" action="{{ route('admin.mitigasi.index') }}" class="relative w-full md:w-80">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input
                type="text"
                name="q"
                value="{{ $search ?? '' }}"
                placeholder="Cari dokumen mitigasi..."
                class="w-full bg-[#101728] border border-[#1e293b] rounded-xl pl-10 pr-4 py-2.5 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition"
            >
        </form>
    </div>

    <!-- Draft Cards List (Matching Frame 46) -->
    <div class="space-y-4">
        @forelse($mitigations as $item)
            <div class="bg-[#101728]/90 border border-[#1b253e] rounded-2xl p-4 sm:p-5 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-5 shadow-lg hover:border-slate-700/60 transition">
                <!-- Thumbnail & Content -->
                <div class="flex flex-col sm:flex-row items-start gap-4 flex-1">
                    <div class="w-full sm:w-44 h-28 rounded-xl overflow-hidden bg-slate-900 border border-[#1e293b] shrink-0">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                    </div>

                    <div class="space-y-2 flex-1">
                        <div>
                            <span class="inline-block px-3 py-0.5 rounded-md text-[11px] font-bold bg-[#1e293b] text-slate-300 border border-slate-700">
                                {{ $item['status'] }}
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-white hover:text-blue-400 transition leading-snug">
                            {{ $item['title'] }}
                        </h3>

                        <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $item['excerpt'] }}
                        </p>

                        <div class="flex items-center gap-2 text-[11px] text-slate-400 font-medium pt-1">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $item['date'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons (Publish, Edit, Delete matching Frame 46) -->
                <div class="flex items-center gap-2.5 self-end lg:self-center shrink-0">
                    <!-- Publish Button -->
                    <form method="POST" action="{{ route('admin.mitigasi.publish', $item['id']) }}">
                        @csrf
                        <button
                            type="submit"
                            onclick="return confirm('Publikasikan dokumen panduan mitigasi ini?')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#10b981] hover:bg-emerald-600 text-white shadow transition"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <span>Publish</span>
                        </button>
                    </form>

                    <!-- Edit Button -->
                    <button
                        type="button"
                        onclick="alert('Fitur edit mitigasi aktif. Dokumen: {{ addslashes($item['title']) }}')"
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#3b82f6] hover:bg-blue-600 text-white shadow transition"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Edit</span>
                    </button>

                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('admin.mitigasi.delete', $item['id']) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            onclick="return confirm('Hapus dokumen mitigasi ini?')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#ef4444] hover:bg-red-600 text-white shadow transition"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-[#101728]/80 border border-[#1b253e] rounded-2xl p-12 text-center text-slate-400">
                Tidak ada dokumen mitigasi yang sesuai dengan pencarian.
            </div>
        @endforelse
    </div>
</div>
@endsection
