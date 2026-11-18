@extends('admin.layouts.admin')

@section('title', 'Edit Berita — Admin Panel SiagaManado')

@section('content')
<div class="space-y-6">
    <!-- Top Back Link (Matching Frame 45) -->
    <div>
        <a
            href="{{ route('admin.berita.draft') }}"
            class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Daftar Draft</span>
        </a>
    </div>

    <!-- Header Title & Search (Matching Frame 45) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2">
        <div class="flex items-start gap-3">
            <div class="p-2 rounded-xl bg-slate-800/80 text-blue-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">Edit Berita</h1>
                <p class="text-xs text-slate-400 mt-0.5">Ubah informasi berita yang masih dalam tahap draft. Setelah selesai, jangan lupa untuk mempublish berita.</p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="relative w-full md:w-72">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input
                type="text"
                placeholder="Cari judul berita..."
                class="w-full bg-[#101728] border border-[#1e293b] rounded-xl pl-10 pr-4 py-2 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition"
            >
        </div>
    </div>

    <!-- 2 Column Edit Layout (Matching Frame 45) -->
    <form method="POST" action="{{ route('admin.berita.update', $news['id']) }}" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf

        <!-- Left Form Column (Approx 68% / 8 cols) -->
        <div class="lg:col-span-8 bg-[#101728]/90 border border-[#1b253e] rounded-3xl p-6 md:p-8 space-y-6 shadow-xl">
            <!-- Judul Berita -->
            <div>
                <label class="block text-xs font-bold text-slate-200 mb-2">
                    Judul Berita <span class="text-red-400">*</span>
                </label>
                <input
                    type="text"
                    id="newsTitleInput"
                    name="title"
                    value="{{ $news['title'] }}"
                    maxlength="100"
                    required
                    class="w-full bg-[#0c1222] border border-[#222f4c] rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-blue-500 transition"
                    oninput="updateTitleCount()"
                >
                <div class="flex justify-end text-[11px] text-slate-400 mt-1.5">
                    <span id="titleCounter">{{ mb_strlen($news['title']) }}/100</span>
                </div>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-xs font-bold text-slate-200 mb-2">
                    Kategori
                </label>
                <div class="relative">
                    <select
                        name="category"
                        class="w-full bg-[#0c1222] border border-[#222f4c] rounded-xl px-4 py-3 text-sm text-slate-100 appearance-none focus:outline-none focus:border-blue-500 transition"
                    >
                        <option value="Bencana Alam" {{ ($news['category'] ?? '') === 'Bencana Alam' ? 'selected' : '' }}>Bencana Alam</option>
                        <option value="Peringatan Dini" {{ ($news['category'] ?? '') === 'Peringatan Dini' ? 'selected' : '' }}>Peringatan Dini</option>
                        <option value="Informasi Umum" {{ ($news['category'] ?? '') === 'Informasi Umum' ? 'selected' : '' }}>Informasi Umum</option>
                        <option value="Kegiatan BPBD" {{ ($news['category'] ?? '') === 'Kegiatan BPBD' ? 'selected' : '' }}>Kegiatan BPBD</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Isi Berita with Rich Toolbar -->
            <div>
                <label class="block text-xs font-bold text-slate-200 mb-2">
                    Isi Berita <span class="text-red-400">*</span>
                </label>

                <!-- Toolbar (Matching Frame 45: B, I, U, link, bullet, number, Paragraph) -->
                <div class="border border-[#222f4c] rounded-t-xl bg-[#141d33] px-3 py-2 flex flex-wrap items-center gap-2 border-b-0">
                    <button type="button" class="w-7 h-7 rounded hover:bg-slate-700/60 font-bold text-slate-200 text-xs">B</button>
                    <button type="button" class="w-7 h-7 rounded hover:bg-slate-700/60 italic font-serif text-slate-200 text-xs">I</button>
                    <button type="button" class="w-7 h-7 rounded hover:bg-slate-700/60 underline text-slate-200 text-xs">U</button>
                    <div class="h-4 w-px bg-slate-700 mx-1"></div>
                    <button type="button" class="p-1 rounded hover:bg-slate-700/60 text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </button>
                    <button type="button" class="p-1 rounded hover:bg-slate-700/60 text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <button type="button" class="p-1 rounded hover:bg-slate-700/60 text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 6h13M7 12h13M7 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                        </svg>
                    </button>
                    <div class="h-4 w-px bg-slate-700 mx-1"></div>
                    <span class="text-xs text-slate-300 font-medium px-2 py-0.5 rounded bg-slate-800/80">Paragraph ▾</span>
                </div>

                <!-- Textarea -->
                <textarea
                    id="newsContentInput"
                    name="content"
                    rows="8"
                    maxlength="2000"
                    required
                    class="w-full bg-[#0c1222] border border-[#222f4c] rounded-b-xl p-4 text-xs md:text-sm text-slate-200 leading-relaxed focus:outline-none focus:border-blue-500 transition"
                    oninput="updateContentCount()"
                >{{ $news['content'] }}</textarea>

                <div class="flex justify-end text-[11px] text-slate-400 mt-1.5">
                    <span id="contentCounter">{{ mb_strlen($news['content']) }}/2000</span>
                </div>
            </div>

            <!-- Tanggal Kejadian -->
            <div>
                <label class="block text-xs font-bold text-slate-200 mb-2">
                    Tanggal Kejadian <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="date"
                        value="{{ $news['date'] }}"
                        required
                        class="w-full bg-[#0c1222] border border-[#222f4c] rounded-xl pl-10 pr-4 py-3 text-sm text-slate-100 font-mono focus:outline-none focus:border-blue-500 transition"
                    >
                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Alert Box (Matching Frame 45) -->
            <div class="bg-[#121c33] border border-[#1e2d4d] rounded-2xl p-4 flex items-start gap-3 text-xs text-slate-300">
                <svg class="w-5 h-5 text-blue-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                </svg>
                <div class="leading-relaxed">
                    <strong>Berita ini masih dalam tahap draft</strong> dan belum dipublikasikan. Pastikan semua informasi <strong>sudah benar</strong> sebelum mempublish.
                </div>
            </div>

            <!-- Form Action Buttons -->
            <div class="flex items-center gap-3 pt-2">
                <button
                    type="submit"
                    name="action"
                    value="save"
                    class="px-6 py-3 rounded-xl text-xs font-bold bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition"
                >
                    Simpan Perubahan Draft
                </button>

                <button
                    type="submit"
                    name="action"
                    value="publish"
                    class="px-6 py-3 rounded-xl text-xs font-bold bg-[#10b981] hover:bg-emerald-600 text-white shadow-lg transition inline-flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <span>Publish Berita Sekarang</span>
                </button>
            </div>
        </div>

        <!-- Right Side: Image & Meta (Approx 32% / 4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Gambar Berita Card (Matching Frame 45) -->
            <div class="bg-[#101728]/90 border border-[#1b253e] rounded-3xl p-6 shadow-xl space-y-4">
                <h3 class="text-xs font-bold text-slate-200 uppercase tracking-wider">
                    Gambar Berita
                </h3>

                <!-- Image Preview with Close (X) button -->
                <div class="relative rounded-2xl overflow-hidden border border-[#1e293b] bg-slate-900 h-52 group">
                    <img id="imagePreview" src="{{ $news['image'] }}" alt="Preview" class="w-full h-full object-cover">
                    <button
                        type="button"
                        onclick="clearImage()"
                        class="absolute top-2.5 right-2.5 w-7 h-7 rounded-full bg-black/75 hover:bg-black text-white flex items-center justify-center text-xs transition"
                        title="Hapus gambar"
                    >
                        ✕
                    </button>
                </div>

                <!-- Ganti Gambar Button -->
                <button
                    type="button"
                    onclick="promptImageChange()"
                    class="w-full py-3 rounded-xl text-xs font-bold bg-[#141d33] hover:bg-slate-800 text-slate-200 border border-[#222f4c] transition inline-flex items-center justify-center gap-2"
                >
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <span>Ganti Gambar</span>
                </button>
                <input type="hidden" name="image" id="inputImage" value="{{ $news['image'] }}">

                <p class="text-[11px] text-slate-400 text-center">
                    Format: JPG, PNG. Maksimal 5MB.
                </p>
            </div>

            <!-- Detail Berita Card (Matching Frame 45) -->
            <div class="bg-[#101728]/90 border border-[#1b253e] rounded-3xl p-6 shadow-xl space-y-4">
                <h3 class="text-xs font-bold text-slate-200 uppercase tracking-wider">
                    Detail Berita
                </h3>

                <div class="space-y-3.5 text-xs">
                    <!-- Status -->
                    <div class="flex items-center justify-between pb-3 border-b border-[#1c2740]">
                        <span class="text-slate-400 font-medium">Status</span>
                        <span class="inline-block px-3 py-0.5 rounded-md text-[11px] font-bold bg-[#1e293b] text-slate-300 border border-slate-700">
                            {{ $news['status'] }}
                        </span>
                    </div>

                    <!-- Dibuat pada -->
                    <div class="flex items-center justify-between pb-3 border-b border-[#1c2740]">
                        <span class="text-slate-400 font-medium">Dibuat pada</span>
                        <span class="text-slate-200 font-medium">{{ $news['date'] }}</span>
                    </div>

                    <!-- Terakhir diubah -->
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-medium">Terakhir diubah</span>
                        <span class="text-slate-200 font-medium">{{ $news['updated_at'] ?? $news['date'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function updateTitleCount() {
        const input = document.getElementById('newsTitleInput');
        document.getElementById('titleCounter').textContent = `${input.value.length}/100`;
    }

    function updateContentCount() {
        const input = document.getElementById('newsContentInput');
        document.getElementById('contentCounter').textContent = `${input.value.length}/2000`;
    }

    function clearImage() {
        if (confirm('Kosongkan gambar saat ini?')) {
            document.getElementById('imagePreview').src = 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1000&q=80';
            document.getElementById('inputImage').value = 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1000&q=80';
        }
    }

    function promptImageChange() {
        const url = prompt('Masukkan URL gambar baru (atau biarkan default):', document.getElementById('inputImage').value);
        if (url && url.trim() !== '') {
            document.getElementById('imagePreview').src = url.trim();
            document.getElementById('inputImage').value = url.trim();
        }
    }
</script>
@endpush
