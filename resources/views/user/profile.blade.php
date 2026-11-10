@extends('layouts.app')

@section('title', 'Profil Pengguna — SiagaManado')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-10">
    <!-- Top Button: Kembali ke Beranda -->
    <div class="mb-6">
        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 text-[#163672] text-xs font-bold border border-slate-200 shadow-2xs transition"
        >
            <span>← Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Main 2-Column Layout -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-7 items-start">
        <!-- Left Card: Avatar MH, Nama, Badges Terverifikasi & User -->
        <div class="md:col-span-4 space-y-6">
            <div class="rounded-[24px] bg-white border border-slate-200 shadow-2xs p-8 text-center relative overflow-hidden">
                <!-- Rounded Square Blue Gradient Avatar "MH" -->
                <div class="w-24 h-24 rounded-[22px] bg-gradient-to-br from-[#0e3f91] to-[#2563eb] text-white text-3xl font-extrabold flex items-center justify-center mx-auto shadow-md">
                    {{ $user['initials'] ?? 'MH' }}
                </div>

                <h1 class="mt-5 text-lg font-extrabold text-slate-900">
                    {{ $user['name'] ?? 'Muhammad Haikal' }}
                </h1>

                <div class="mt-4 flex items-center justify-center gap-2">
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-[#1d4ed8] text-[11px] font-bold">
                        <span>✓</span>
                        <span>Terverifikasi</span>
                    </span>
                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-[11px] font-bold">
                        {{ $user['role'] ?? 'User' }}
                    </span>
                </div>
            </div>

            <!-- Card Akses Cepat Riwayat Laporan -->
            <div class="rounded-[24px] bg-white border border-slate-200 shadow-2xs p-5">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-extrabold text-slate-900">
                        Riwayat Laporan Saya
                    </h2>
                    <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-[#163672] text-[11px] font-bold">
                        {{ count($reports) }} Laporan
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-3 leading-relaxed">
                    Pantau perkembangan status laporan kejadian bencana yang telah Anda kirimkan.
                </p>

                @if(count($reports) > 0)
                    <div class="space-y-2 mb-3">
                        @foreach(array_slice($reports, 0, 2) as $rpt)
                            <div class="rounded-xl bg-slate-50 border border-slate-200/80 p-2.5 flex items-center justify-between gap-2">
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-800 truncate">{{ $rpt['title'] }}</p>
                                    <p class="text-[10.5px] text-slate-500">{{ $rpt['displayDate'] }}</p>
                                </div>
                                <button
                                    type="button"
                                    onclick='openReportDetailModal(@json($rpt))'
                                    class="text-[11px] font-bold text-[#163672] hover:underline shrink-0 cursor-pointer"
                                >
                                    Detail
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <a
                    href="{{ route('reports.history') }}"
                    class="w-full py-2 rounded-xl bg-blue-50 hover:bg-blue-100 text-[#163672] text-xs font-bold flex items-center justify-center gap-1 transition"
                >
                    <span>Buka Halaman Riwayat Laporan →</span>
                </a>
            </div>
        </div>

        <!-- Right Column: Informasi Profil Form -->
        <div class="md:col-span-8 space-y-6">
            <div class="rounded-[24px] bg-white border border-slate-200 shadow-2xs p-6 sm:p-8">
                <div class="mb-6">
                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                        Informasi Profil
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Kelola informasi akun dan kontak pribadi Anda untuk layanan SiagaManado.
                    </p>
                </div>

                @if(session('profile_success'))
                    <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-xs font-bold text-emerald-800">
                        ✓ {{ session('profile_success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-5" novalidate>
                    @csrf

                    <!-- NAMA LENGKAP -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="profile_name" class="text-[11px] font-extrabold uppercase tracking-wider text-slate-700">
                                NAMA LENGKAP
                            </label>
                            <span class="text-[11px] text-slate-400">Wajib Diisi</span>
                        </div>
                        <input
                            id="profile_name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user['name'] ?? 'Muhammad Haikal') }}"
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-3 text-sm font-medium text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                        />
                        @error('name')
                            <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="profile_email" class="text-[11px] font-extrabold uppercase tracking-wider text-slate-700">
                                EMAIL
                            </label>
                            <span class="text-[10.5px] font-extrabold uppercase text-emerald-600">
                                ✓ TERVERIFIKASI
                            </span>
                        </div>
                        <input
                            id="profile_email"
                            type="email"
                            value="{{ $user['email'] ?? 'haikal@telkomuniversity.ac.id' }}"
                            readonly
                            class="w-full rounded-xl bg-slate-100 border border-slate-200 px-4 py-3 text-sm font-medium text-slate-500 cursor-not-allowed focus:outline-none"
                        />
                    </div>

                    <!-- NOMOR TELEPON / WHATSAPP -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="profile_phone" class="text-[11px] font-extrabold uppercase tracking-wider text-slate-700">
                                NOMOR TELEPON / WHATSAPP
                            </label>
                            <span class="text-[10.5px] font-semibold uppercase text-slate-400">
                                DIGUNAKAN UNTUK INFO DARURAT
                            </span>
                        </div>
                        <input
                            id="profile_phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone', $user['phone'] ?? '081234567890') }}"
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-3 text-sm font-medium text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                        />
                        @error('phone')
                            <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons Batal & Simpan Perubahan -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a
                            href="{{ route('profile') }}"
                            class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition"
                        >
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-[#163672] hover:bg-[#102959] text-white text-xs font-bold shadow-xs transition cursor-pointer"
                        >
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
