@extends('layouts.app')

@section('title', $article['title'] . ' — SiagaManado')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
    <!-- Main Article Card matching detail berita.png -->
    <article class="rounded-[28px] bg-white border border-blue-100 shadow-xl overflow-hidden">
        <div class="p-6 sm:p-10">
            <!-- Top Bar: Category Pill & Close Button (X) -->
            <div class="flex items-center justify-between gap-4 mb-5">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-extrabold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                    {{ $article['category'] }}
                </span>

                <a
                    href="{{ route('news.index') }}"
                    class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition"
                    title="Kembali ke halaman daftar berita"
                    aria-label="Tutup detail berita"
                >
                    ✕
                </a>
            </div>

            <!-- Headline Title -->
            <h1 class="text-2xl sm:text-3xl md:text-[34px] font-extrabold text-[#102e69] leading-tight tracking-tight">
                {{ $article['title'] }}
            </h1>

            <!-- Author & Publication Timestamp Bar matching detail berita.png -->
            <div class="mt-6 rounded-2xl bg-[#f1f5f9] px-4 py-3 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#0e2a66] text-white flex items-center justify-center text-xs">
                        🛡️
                    </div>
                    <span class="text-xs sm:text-sm font-bold text-slate-800">
                        {{ $article['author'] ?? 'Admin Siaga Manado' }}
                    </span>
                </div>

                <div class="flex items-center gap-2 text-xs sm:text-sm font-medium text-slate-600">
                    <span>📅</span>
                    <span>{{ $article['publishedTime'] ?? $article['publishedAt'] }}</span>
                </div>
            </div>

            <!-- Supporting Image & Caption -->
            @if(!empty($article['imageUrl']))
                <figure class="mt-6 rounded-2xl overflow-hidden bg-[#f1f5f9] border border-slate-200/70">
                    <img
                        src="{{ $article['imageUrl'] }}"
                        alt="{{ $article['title'] }}"
                        class="w-full max-h-[420px] object-cover"
                    />
                    @if(!empty($article['imageCaption']))
                        <figcaption class="px-4 py-3 text-xs text-slate-500 italic">
                            {{ $article['imageCaption'] }}
                        </figcaption>
                    @endif
                </figure>
            @endif

            <!-- Article Paragraphs -->
            <div class="mt-7 space-y-4 text-sm sm:text-[15px] text-slate-700 leading-relaxed">
                @foreach($article['content'] as $idx => $para)
                    <p>
                        @if($idx === 0 && str_starts_with($para, 'MANADO —'))
                            <strong class="font-extrabold text-slate-900">MANADO</strong>{{ substr($para, 6) }}
                        @else
                            {{ $para }}
                        @endif
                    </p>
                @endforeach
            </div>

            <!-- Poin Penting Kewaspadaan -->
            @if(!empty($article['keyPoints']))
                <div class="mt-7 rounded-2xl bg-[#eef4fc] border border-blue-200/80 p-5">
                    <h2 class="text-xs font-extrabold uppercase tracking-wider text-[#163672] mb-2.5">
                        Poin Penting Kewaspadaan Warga
                    </h2>
                    <ul class="space-y-1.5 text-xs sm:text-sm text-slate-700 list-disc list-inside">
                        @foreach($article['keyPoints'] as $pt)
                            <li>{{ $pt }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Bottom Footer Bar matching detail berita.png ("Bagikan Berita") -->
        <div class="bg-[#f1f5f9] px-6 sm:px-10 py-4 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-3">
            <button
                type="button"
                onclick="navigator.clipboard.writeText(window.location.href); this.textContent = '✓ Tautan Berita Disalin!';"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-blue-50 text-[#163672] text-xs font-bold border border-slate-200/90 shadow-2xs transition cursor-pointer"
            >
                🔗 Bagikan Berita
            </button>

            <a
                href="{{ route('news.index') }}"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-[#163672] hover:underline"
            >
                ← Kembali ke Daftar Berita
            </a>
        </div>
    </article>
</div>
@endsection

