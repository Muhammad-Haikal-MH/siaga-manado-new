@extends('layouts.app')

@section('title', 'Beranda — SiagaManado')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-12 space-y-12">

    <!-- 1. HERO SECTION (Tanpa vektor kartun, fokus ke Tombol "Laporkan") -->
    <section class="rounded-[28px] bg-gradient-to-br from-[#0e2a66] via-[#163672] to-[#1e428a] text-white p-8 sm:p-12 shadow-lg relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/15 border border-white/20 text-blue-100 text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Sistem Pelaporan & Informasi Kebencanaan Kota Manado</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold tracking-tight leading-tight">
                    Ayo Tanggap Bencana,
                    <br />
                    Bersama Selamatkan Manado
                </h1>

                <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed max-w-xl">
                    Laporkan kejadian banjir, tanah longsor, atau kondisi darurat di lingkungan Anda secara cepat agar segera ditindaklanjuti oleh tim di lapangan.
                </p>

                <div class="pt-3">
                    <button
                        type="button"
                        onclick="openReportModal()"
                        class="px-10 py-3.5 rounded-full bg-white hover:bg-blue-50 text-[#163672] text-base font-extrabold shadow-md transition cursor-pointer inline-flex items-center gap-2.5"
                    >
                        <span>Laporkan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Weather Summary Widget -->
            <div class="lg:col-span-5">
                <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-6 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/15 pb-3.5">
                        <div>
                            <p class="text-xs text-blue-200 font-medium">Pantauan Cuaca Kota Manado</p>
                            <p class="text-sm font-bold text-white mt-0.5">{{ $weather['condition'] ?? 'Hujan Lebat' }} • {{ $weather['monthYear'] ?? 'Mei 2025' }}</p>
                        </div>
                        <span class="text-3xl font-extrabold text-white">{{ $weather['temperature'] ?? '19°' }}C</span>
                    </div>

                    <p class="text-xs text-blue-100 leading-relaxed">
                        {{ $weather['subtitle'] ?? 'Potensi hujan petir disertai angin kencang di pesisir Sario & Malalayang' }}
                    </p>

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="rounded-xl bg-white/10 p-3">
                            <p class="text-blue-200 text-[11px]">Kecepatan Angin</p>
                            <p class="font-bold text-white mt-0.5">{{ $weather['windSpeed'] ?? '25 km/h' }} ({{ $weather['windDirection'] ?? 'Barat Daya' }})</p>
                        </div>
                        <div class="rounded-xl bg-white/10 p-3">
                            <p class="text-blue-200 text-[11px]">Kelembapan Udara</p>
                            <p class="font-bold text-white mt-0.5">{{ $weather['humidity'] ?? '97%' }} ({{ $weather['humidityLabel'] ?? 'Jenuh' }})</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. DUA CARD UTAMA SESUAI USE CASE & ACTIVITY DIAGRAM: Card Mitigasi & Card Berita -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
        <!-- Card Mitigasi (Alur Use Case 4.4 Langkah 1: User menekan Card Mitigasi -> Halaman Mitigasi) -->
        <a
            href="{{ route('mitigation.index') }}"
            class="group relative rounded-[26px] bg-white hover:bg-[#f8fbff] border border-slate-200/90 hover:border-[#163672]/40 p-7 sm:p-8 shadow-sm hover:shadow-xl transition flex flex-col justify-between overflow-hidden"
        >
            <div class="flex items-start justify-between gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 text-[#163672] flex items-center justify-center shrink-0 group-hover:bg-[#163672] group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>

                <div class="w-11 h-11 rounded-full bg-[#163672] group-hover:translate-x-1 text-white flex items-center justify-center transition shadow-xs shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </div>
            </div>

            <div class="mt-6">
                <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-[#163672] text-[11px] font-bold uppercase tracking-wider mb-2">
                    Edukasi & Kesiapsiagaan
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 group-hover:text-[#163672] transition">
                    Mitigasi
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                    Pelajari panduan langkah keselamatan sebelum, saat, dan setelah terjadinya bencana banjir, tanah longsor, serta gempa bumi di Kota Manado.
                </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#163672]">
                <span>3 Panduan Bencana Utama (Banjir, Longsor, Gempa)</span>
                <span class="underline underline-offset-4">Buka Mitigasi</span>
            </div>
        </a>

        <!-- Card Berita (Alur Use Case 4.2 Langkah 1: User menekan Card Berita -> Halaman Daftar Berita) -->
        <a
            href="{{ route('news.index') }}"
            class="group relative rounded-[26px] bg-white hover:bg-[#f8fbff] border border-slate-200/90 hover:border-[#163672]/40 p-7 sm:p-8 shadow-sm hover:shadow-xl transition flex flex-col justify-between overflow-hidden"
        >
            <div class="flex items-start justify-between gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 text-[#163672] flex items-center justify-center shrink-0 group-hover:bg-[#163672] group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>

                <div class="w-11 h-11 rounded-full bg-[#163672] group-hover:translate-x-1 text-white flex items-center justify-center transition shadow-xs shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </div>
            </div>

            <div class="mt-6">
                <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-[#163672] text-[11px] font-bold uppercase tracking-wider mb-2">
                    Informasi & Peringatan Dini
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 group-hover:text-[#163672] transition">
                    Berita
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                    Akses berita kebencanaan terkini, pantauan debit sungai, peringatan cuaca ekstrem, dan laporan penanganan darurat di wilayah Kota Manado.
                </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#163672]">
                <span>Update Situasi & Cuaca Terkini Kota Manado</span>
                <span class="underline underline-offset-4">Buka Berita</span>
            </div>
        </a>
    </section>

    <!-- 3. RIWAYAT LAPORAN SAYA (Use Case 4.3) -->
    <section>
        <div class="bg-white rounded-[24px] border border-slate-200/90 p-6 sm:p-8 shadow-2xs">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5 pb-4 border-b border-slate-100">
                <div>
                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-900">
                        Riwayat Laporan Saya
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Daftar laporan kejadian bencana yang dikirimkan oleh akun
                        <span class="font-bold text-slate-700">{{ $user['name'] ?? 'Muhammad Haikal' }}</span>
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-3.5 py-1 rounded-full bg-blue-50 text-[#163672] text-xs font-bold">
                        {{ count($reports) }} Laporan Aktif
                    </span>
                    <a
                        href="{{ route('reports.history') }}"
                        class="text-xs font-bold text-[#163672] hover:underline"
                    >
                        Lihat Semua →
                    </a>
                </div>
            </div>

            @if(count($reports) === 0)
                <div class="rounded-2xl bg-slate-50 border border-slate-200/70 p-8 text-center">
                    <p class="text-sm font-bold text-slate-800">Belum Ada Riwayat Laporan</p>
                    <p class="text-xs text-slate-500 mt-1">
                        Laporan kejadian bencana yang Anda kirimkan akan tampil di sini dengan status menunggu.
                    </p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach(array_slice($reports, 0, 3) as $item)
                        <div class="rounded-2xl bg-slate-50 hover:bg-blue-50/50 border border-slate-200/80 px-5 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition">
                            <div class="flex items-start gap-4">
                                <img
                                    src="{{ $item['photoUrl'] }}"
                                    alt="{{ $item['title'] }}"
                                    class="w-14 h-14 rounded-xl object-cover border border-slate-200 shrink-0 hidden sm:block"
                                />
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-0.5 rounded bg-blue-100 text-[#163672] text-[10.5px] font-bold">
                                            {{ $item['disasterType'] }}
                                        </span>
                                        <span class="text-[11px] text-slate-400">{{ $item['displayDate'] }}</span>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900">
                                        {{ $item['title'] }}
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        {{ $item['location'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex sm:flex-col items-center sm:items-end justify-between gap-2 shrink-0">
                                <span class="px-3 py-0.5 rounded-full bg-amber-100 border border-amber-300 text-amber-800 text-[11px] font-bold lowercase">
                                    {{ $item['status'] ?? 'menunggu' }}
                                </span>
                                <button
                                    type="button"
                                    onclick='openReportDetailModal(@json($item))'
                                    class="text-xs font-bold text-[#163672] hover:underline cursor-pointer"
                                >
                                    Detail
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- 4. LEBIH DEKAT & KIRIM FEEDBACK SECTION (Use Case 4.5) -->
    <section id="feedback" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        <!-- Left Info Column -->
        <div class="lg:col-span-5 rounded-[24px] bg-white border border-slate-200/90 p-6 sm:p-8 flex flex-col justify-between shadow-2xs">
            <div class="space-y-5">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">
                        Lebih Dekat
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1.5 leading-relaxed">
                        Ayo lebih dekat dengan kita Siaga Manado, berikan saran dan feedback agar aplikasi ini menjadi lebih baik.
                    </p>
                </div>

                <div class="space-y-3.5 pt-2">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#163672] flex items-center justify-center shrink-0 text-xs font-bold">
                            📍
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800">Alamat</p>
                            <p class="text-xs text-slate-600">
                                Jl. Pemuda, Sario, Kota Manado, Sulawesi Utara
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#163672] flex items-center justify-center shrink-0 text-xs font-bold">
                            📞
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800">No. Telepon</p>
                            <p class="text-xs text-slate-600">
                                (0431) 851113 / Call Center 112
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#163672] flex items-center justify-center shrink-0 text-xs font-bold">
                            ✉️
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800">Email</p>
                            <p class="text-xs text-slate-600">
                                siagamanado@telkomuniversity.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500">Ikuti Kami:</span>
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-[#163672] text-white flex items-center justify-center text-xs font-bold">f</span>
                    <span class="w-7 h-7 rounded-lg bg-[#163672] text-white flex items-center justify-center text-xs font-bold">𝕏</span>
                    <span class="w-7 h-7 rounded-lg bg-[#163672] text-white flex items-center justify-center text-[10px] font-bold">IG</span>
                </div>
            </div>
        </div>

        <!-- Right Kirim Feedback Card -->
        <div class="lg:col-span-7 rounded-[24px] bg-[#dbeafe]/65 border border-blue-200 p-6 sm:p-8 shadow-2xs flex flex-col justify-between">
            <div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-[#163672]">
                    Kirim Feedback
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 mb-5">
                    Sampaikan saran, kritik, atau masukan Anda untuk pengembangan layanan SiagaManado.
                </p>

                <form action="{{ route('feedback.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="home-feedback-input" class="sr-only">Feedback</label>
                        <textarea
                            id="home-feedback-input"
                            name="message"
                            rows="4"
                            placeholder="Tuliskan pesan atau feedback Anda di sini..."
                            class="w-full rounded-xl bg-white border border-blue-200 px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#163672] transition"
                        >{{ old('message') }}</textarea>
                    </div>

                    @error('message')
                        <div class="mb-4 rounded-xl bg-rose-50 border border-rose-200 px-4 py-2.5 text-xs font-semibold text-rose-700">
                            {{ $message }}
                        </div>
                    @enderror

                    @if(session('feedback_success'))
                        <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-2.5 text-xs font-semibold text-emerald-800">
                            {{ session('feedback_success') }}
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-7 py-2.5 rounded-xl bg-[#163672] hover:bg-[#102959] text-white text-xs sm:text-sm font-bold transition shadow-xs cursor-pointer"
                        >
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection
