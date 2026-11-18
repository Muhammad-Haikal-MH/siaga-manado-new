@extends('admin.layouts.admin')

@section('title', 'Feedback — Admin Panel SiagaManado')

@section('content')
<div class="space-y-6">
    <!-- Header Title (Matching Frame 39) -->
    <div class="pb-2">
        <h1 class="text-3xl font-extrabold text-white tracking-tight">
            Feedback
        </h1>
        <p class="text-xs text-slate-400 mt-1">Umpan balik dan saran yang dikirimkan oleh masyarakat dan pengguna sistem</p>
    </div>

    <!-- Cards Grid (Matching Frame 39) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($feedbacks as $fb)
            <div class="bg-[#12192c] border border-[#1d2740] rounded-3xl p-7 shadow-lg flex flex-col justify-between hover:border-slate-700/60 transition">
                <!-- User Info Bar -->
                <div>
                    <div class="flex items-center gap-3.5 mb-5">
                        <div class="w-12 h-12 rounded-full bg-slate-300 flex items-center justify-center text-slate-800 font-bold text-base shrink-0">
                            {{ strtoupper(substr($fb['name'], 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white leading-tight">
                                {{ $fb['name'] }}
                            </h3>
                            <span class="text-xs text-slate-400 font-medium">
                                {{ $fb['email'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Description Body -->
                    <p class="text-sm text-slate-200 leading-relaxed font-normal">
                        {{ $fb['description'] }}
                    </p>
                </div>

                <!-- Footer Date -->
                <div class="pt-6 mt-6 border-t border-[#1a243a]">
                    <span class="text-xs text-slate-400">
                        {{ $fb['submitted_at'] }}
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-[#12192c] border border-[#1d2740] rounded-3xl p-12 text-center text-slate-400">
                Belum ada feedback masuk.
            </div>
        @endforelse
    </div>
</div>
@endsection
