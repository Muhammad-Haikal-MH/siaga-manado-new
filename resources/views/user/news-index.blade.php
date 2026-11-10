@extends('layouts.app')

@section('title', 'Berita Terkini — SiagaManado')

@section('content')
@php
    $categories = ['Semua Berita', 'Banjir', 'Gempa', 'Longsor'];
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-12">
    <!-- Section Header: Sorotan Utama Hari Ini -->
    <div class="flex items-center gap-2.5 mb-4">
        <span class="w-1.5 h-5 rounded-full bg-[#163672]"></span>
        <h1 class="text-lg sm:text-xl font-extrabold text-slate-900">
            Sorotan Utama Hari Ini
        </h1>
    </div>

    <!-- Weather Forecast Banner Card -->
    <div class="rounded-[24px] bg-gradient-to-br from-[#0e2a66] via-[#13357a] to-[#0d2559] text-white p-6 sm:p-8 shadow-md relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3 max-w-xl">
                <span class="text-xs text-blue-200 font-medium">
                    {{ $weather['monthYear'] ?? 'Mei 2025' }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold leading-tight tracking-tight">
                    {{ $weather['title'] ?? 'Prakiraan Cuaca Manado Pagi ini hingga Malam hari' }}
                </h2>
                <p class="text-xs sm:text-sm text-blue-100/90">
                    {{ $weather['subtitle'] ?? 'Potensi hujan petir disertai angin kencang di pesisir Sario & Malalayang' }}
                </p>

                <!-- Wind & Humidity Box -->
                <div class="pt-2 inline-flex flex-wrap items-center gap-4 bg-white/10 backdrop-blur-xs border border-white/15 rounded-xl px-4 py-2.5">
                    <div class="flex items-center gap-2.5 pr-4 border-r border-white/15">
                        <div class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center text-sm">
                            💨
                        </div>
                        <div class="text-[11px] leading-tight">
                            <p class="text-blue-200">Kecepatan Angin</p>
                            <p class="font-bold text-white">{{ $weather['windSpeed'] ?? '25 km/h' }}</p>
                            <p class="font-semibold text-blue-100">{{ $weather['windDirection'] ?? 'Barat Daya' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center text-sm">
                            💧
                        </div>
                        <div class="text-[11px] leading-tight">
                            <p class="text-blue-200">Kelembapan</p>
                            <p class="font-bold text-white">{{ $weather['humidity'] ?? '97%' }}</p>
                            <p class="font-semibold text-blue-100">{{ $weather['humidityLabel'] ?? 'Jenuh' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Cloud Rain SVG -->
            <div class="hidden sm:flex flex-col items-center justify-center pr-6">
                <svg viewBox="0 0 64 64" class="w-24 h-24 text-blue-100" fill="currentColor">
                    <path d="M46 38H20a10 10 0 01-.7-19.97A14 14 0 0146 18a10 10 0 010 20z" />
                    <rect x="22" y="43" width="2.5" height="8" rx="1.25" />
                    <rect x="29" y="43" width="2.5" height="8" rx="1.25" />
                    <rect x="36" y="43" width="2.5" height="8" rx="1.25" />
                    <rect x="43" y="43" width="2.5" height="8" rx="1.25" />
                </svg>
            </div>
        </div>

        <!-- Bottom Temperature & Source Row -->
        <div class="mt-6 pt-5 border-t border-white/15 flex flex-wrap items-end justify-between gap-4">
            <div class="flex items-baseline gap-2">
                <span class="text-4xl sm:text-5xl font-extrabold tracking-tight">
                    {{ $weather['temperature'] ?? '19°' }}
                </span>
                <span class="text-lg font-bold text-blue-100">C</span>
                <span class="text-xs text-blue-100 ml-2">
                    {{ $weather['condition'] ?? 'Hujan Lebat' }}
                </span>
            </div>

            <p class="text-[11px] text-blue-200/80">
                {{ $weather['source'] ?? 'Sumber: BMKG Sulut & weather.com' }}
            </p>
        </div>
    </div>

    <!-- Search & Category Filter Row -->
    <div class="mt-8 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        <form action="{{ route('news.index') }}" method="GET" class="relative flex-1 max-w-md">
            <input type="hidden" name="kategori" value="{{ $selectedCategory }}" />
            <span class="text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 text-xs">🔍</span>
            <input
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="Cari berita bencana, cuaca, atau info pemeliharaan Manado..."
                class="w-full rounded-xl bg-white border border-slate-200 pl-10 pr-4 py-2.5 text-xs sm:text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#163672] shadow-2xs"
            />
        </form>

        <div class="flex flex-wrap items-center gap-2">
            @foreach($categories as $cat)
                @php
                    $isActive = strtolower($selectedCategory) === strtolower($cat);
                @endphp
                <a
                    href="{{ route('news.index', ['kategori' => $cat, 'q' => $search]) }}"
                    class="px-4 py-2 rounded-full text-xs font-bold transition {{ $isActive ? 'bg-[#0e2a66] text-white shadow-2xs' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}"
                >
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Section Heading: Berita terkini -->
    <div class="mt-8 mb-5">
        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
            Berita terkini
        </h2>
        <p class="text-xs text-slate-500 mt-0.5">
            Laporan dan berita terkini terkait situasi Manado
        </p>
    </div>

    <!-- News Grid (Klik Card Berita membuka Popup Modal Detail Berita sesuai Activity Diagram & detail berita.png) -->
    @if(count($newsList) === 0)
        <div class="rounded-2xl bg-white border border-slate-200 p-12 text-center my-4">
            <h3 class="text-base font-bold text-slate-900">
                Belum Ada Berita Terkini yang Sesuai
            </h3>
            <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
                Saat ini belum terdapat berita yang dipublikasikan untuk kata kunci atau kategori tersebut.
            </p>
            <a
                href="{{ route('news.index') }}"
                class="mt-4 inline-block px-5 py-2.5 rounded-xl bg-[#163672] text-white text-xs font-bold hover:bg-[#102959] transition"
            >
                Tampilkan Semua Berita
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($newsList as $item)
                <article
                    onclick='openNewsDetailModal(@json($item))'
                    class="rounded-2xl bg-white border border-slate-200/90 overflow-hidden shadow-2xs hover:shadow-lg transition flex flex-col justify-between group cursor-pointer"
                >
                    <div>
                        <div class="block overflow-hidden h-44 bg-slate-100">
                            <img
                                src="{{ $item['imageUrl'] }}"
                                alt="{{ $item['shortTitle'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            />
                        </div>

                        <div class="p-5">
                            <div class="flex items-center gap-1.5 text-[11.5px] font-medium text-slate-400 mb-2">
                                <span>{{ $item['publishedAt'] }}</span>
                                <span>•</span>
                                <span class="font-bold text-[#1d4ed8]">{{ $item['category'] }}</span>
                            </div>

                            <h3 class="text-sm font-extrabold text-slate-900 group-hover:text-[#163672] leading-snug line-clamp-2 transition">
                                {{ $item['shortTitle'] }}
                            </h3>

                            <p class="text-xs text-slate-500 mt-2 leading-relaxed line-clamp-2">
                                {{ $item['summary'] }}
                            </p>
                        </div>
                    </div>

                    <div class="px-5 pb-5">
                        <button
                            type="button"
                            class="w-full py-2 rounded-xl bg-[#f3f6fb] group-hover:bg-[#dbeafe] text-[#163672] text-xs font-bold flex items-center justify-center gap-1.5 transition cursor-pointer"
                        >
                            <span>Baca Selengkapnya</span>
                            <span>→</span>
                        </button>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination Row matching Berita.png -->
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-600">
            <p>
                Menampilkan <strong class="text-slate-900">{{ count($newsList) }}</strong> dari
                <strong class="text-slate-900">{{ count($newsList) }}</strong> warta kebencanaan terkini
            </p>

            <div class="flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400">‹</span>
                <span class="w-8 h-8 rounded-full bg-[#0e2a66] text-white text-xs font-bold flex items-center justify-center shadow-xs">1</span>
                <span class="w-8 h-8 rounded-full bg-white border border-slate-200 text-slate-700 text-xs font-bold flex items-center justify-center">2</span>
                <span class="w-8 h-8 rounded-full bg-white border border-slate-200 text-slate-700 text-xs font-bold flex items-center justify-center">3</span>
                <span class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600">›</span>
            </div>
        </div>
    @endif
</div>

<!-- POPUP MODAL DETAIL BERITA (Sesuai Activity Diagram & detail berita.png) -->
<div
    id="newsDetailModal"
    onclick="if(event.target === this) closeNewsDetailModal()"
    class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-6 bg-slate-900/60 backdrop-blur-xs"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-news-title"
>
    <div class="relative w-full max-w-[780px] max-h-[92vh] overflow-y-auto rounded-[28px] bg-white border border-slate-200 shadow-2xl overflow-hidden">
        <div class="p-6 sm:p-10">
            <!-- Top Bar: Category Pill & Close Button (X) matching detail berita.png -->
            <div class="flex items-center justify-between gap-4 mb-5">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-extrabold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                    <span id="modalNewsCategory">BANJIR</span>
                </span>

                <button
                    type="button"
                    onclick="closeNewsDetailModal()"
                    class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition cursor-pointer"
                    aria-label="Tutup popup detail berita"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Headline Title -->
            <h2 id="modal-news-title" class="text-2xl sm:text-3xl font-extrabold text-[#102e69] leading-tight tracking-tight">
            </h2>

            <!-- Author & Timestamp Bar matching detail berita.png -->
            <div class="mt-6 rounded-2xl bg-[#f1f5f9] px-4 py-3 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#0e2a66] text-white flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" class="w-4 h-4" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <span id="modalNewsAuthor" class="text-xs sm:text-sm font-bold text-slate-800">
                        Admin Siaga Manado
                    </span>
                </div>

                <div class="flex items-center gap-2 text-xs sm:text-sm font-medium text-slate-600">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span id="modalNewsTime"></span>
                </div>
            </div>

            <!-- Supporting Image -->
            <figure class="mt-6 rounded-2xl overflow-hidden bg-[#f1f5f9] border border-slate-200/70">
                <img
                    id="modalNewsImg"
                    src=""
                    alt=""
                    class="w-full max-h-[390px] object-cover"
                />
                <figcaption id="modalNewsCaption" class="px-4 py-3 text-xs text-slate-500 italic"></figcaption>
            </figure>

            <!-- Article Content Paragraphs -->
            <div id="modalNewsContent" class="mt-6 space-y-4 text-sm sm:text-[15px] text-slate-700 leading-relaxed">
            </div>
        </div>

        <!-- Bottom Bar: Bagikan Berita matching detail berita.png -->
        <div class="bg-[#f1f5f9] px-6 sm:px-10 py-4 border-t border-slate-200/80 flex items-center justify-between">
            <button
                type="button"
                id="modalShareNewsBtn"
                onclick="shareModalNews()"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-blue-50 text-[#163672] text-xs font-bold border border-slate-200/90 shadow-2xs transition cursor-pointer"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
                <span id="modalShareNewsLabel">Bagikan Berita</span>
            </button>

            <button
                type="button"
                onclick="closeNewsDetailModal()"
                class="px-5 py-2 rounded-xl bg-[#163672] hover:bg-[#102959] text-white text-xs font-bold transition cursor-pointer"
            >
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function openNewsDetailModal(article) {
        document.getElementById('modalNewsCategory').textContent = (article.category || 'BERITA').toUpperCase();
        document.getElementById('modal-news-title').textContent = article.title || article.shortTitle || '';
        document.getElementById('modalNewsAuthor').textContent = article.author || 'Admin Siaga Manado';
        document.getElementById('modalNewsTime').textContent = article.publishedTime || article.publishedAt || '';
        document.getElementById('modalNewsImg').src = article.imageUrl || '';
        document.getElementById('modalNewsImg').alt = article.title || '';

        const captionEl = document.getElementById('modalNewsCaption');
        if (article.imageCaption) {
            captionEl.textContent = article.imageCaption;
            captionEl.classList.remove('hidden');
        } else {
            captionEl.classList.add('hidden');
        }

        const contentContainer = document.getElementById('modalNewsContent');
        const paragraphs = Array.isArray(article.content) ? article.content : [article.content || article.summary || ''];
        contentContainer.innerHTML = paragraphs.map((p, idx) => {
            if (idx === 0 && p.startsWith('MANADO —')) {
                return `<p><strong class="font-extrabold text-slate-900">MANADO</strong>${p.substring(6)}</p>`;
            }
            return `<p>${p}</p>`;
        }).join('');

        document.getElementById('modalShareNewsLabel').textContent = 'Bagikan Berita';

        const modal = document.getElementById('newsDetailModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeNewsDetailModal() {
        const modal = document.getElementById('newsDetailModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function shareModalNews() {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(window.location.href);
            document.getElementById('modalShareNewsLabel').textContent = 'Tautan Disalin!';
        }
    }
</script>
@endsection
