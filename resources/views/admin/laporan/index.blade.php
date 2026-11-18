@extends('admin.layouts.admin')

@section('title', 'Data Pelaporan — Admin Panel SiagaManado')

@section('content')
<div class="space-y-6">
    <!-- Header Title (Matching Frame 41) -->
    <div class="flex items-center justify-between pb-2">
        <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
            Data Pelaporan
        </h1>
        <div class="text-xs text-slate-400">
            Total: <span class="text-white font-semibold">{{ count($reports) }} Laporan Masuk</span>
        </div>
    </div>

    <!-- Data Pelaporan Table (Matching Frame 41) -->
    <div class="bg-[#101728]/90 border border-[#1b253e] rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#1b253e] text-slate-300 text-sm font-bold">
                        <th class="py-5 px-6">Name Pelapor</th>
                        <th class="py-5 px-6">Jenis Bencana</th>
                        <th class="py-5 px-6">Lokasi</th>
                        <th class="py-5 px-6">Status</th>
                        <th class="py-5 px-6">Date</th>
                        <th class="py-5 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#182238] text-[15px]">
                    @forelse($reports as $report)
                        <tr class="hover:bg-slate-800/40 transition">
                            <!-- Name Pelapor -->
                            <td class="py-4 px-6 font-semibold text-slate-100">
                                {{ $report['name'] }}
                            </td>

                            <!-- Jenis Bencana -->
                            <td class="py-4 px-6 text-slate-300 capitalize">
                                {{ $report['disaster'] }}
                            </td>

                            <!-- Lokasi -->
                            <td class="py-4 px-6 text-slate-300">
                                {{ $report['location'] }}
                            </td>

                            <!-- Status (Pill Badges matching Frame 41) -->
                            <td class="py-4 px-6">
                                @if(strtolower($report['status']) === 'menunggu')
                                    <span class="inline-block px-4 py-1 rounded-full text-xs font-semibold bg-[#fef08a] text-[#713f12]">
                                        menunggu
                                    </span>
                                @elseif(strtolower($report['status']) === 'diverifikasi')
                                    <span class="inline-block px-4 py-1 rounded-full text-xs font-semibold bg-[#bfdbfe] text-[#1e3a8a]">
                                        diverifikasi
                                    </span>
                                @elseif(strtolower($report['status']) === 'ditolak')
                                    <span class="inline-block px-4 py-1 rounded-full text-xs font-semibold bg-[#fecaca] text-[#991b1b]">
                                        ditolak
                                    </span>
                                @else
                                    <span class="inline-block px-4 py-1 rounded-full text-xs font-semibold bg-slate-700 text-slate-200">
                                        {{ $report['status'] }}
                                    </span>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="py-4 px-6 text-slate-300 font-mono text-sm">
                                {{ $report['date'] }}
                            </td>

                            <!-- Actions (Matching Buttons in Frame 41) -->
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <!-- Button Verifikasi -->
                                    <button
                                        type="button"
                                        onclick="openVerifyModal(@js($report))"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#3b82f6] hover:bg-blue-600 text-white shadow transition"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Verifikasi</span>
                                    </button>

                                    <!-- Button Tolak -->
                                    <button
                                        type="button"
                                        onclick="openRejectModal(@js($report))"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#ef4444] hover:bg-red-600 text-white shadow transition"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Tolak</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                Belum ada data pelaporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL DETAIL & VERIFIKASI LAPORAN MASUK (Matching Frame 64) -->
<!-- ======================================================== -->
<div id="verifyModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/75 backdrop-blur-sm p-4 sm:p-6 md:p-10 flex items-center justify-center">
    <div class="relative w-full max-w-2xl bg-[#0f172a] border border-[#1e293b] rounded-3xl shadow-2xl overflow-hidden p-6 sm:p-8 space-y-6 text-slate-100 animate-fadeIn">
        
        <!-- Header -->
        <div class="flex items-start justify-between">
            <div class="space-y-1">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span>
                    <h2 class="text-xl font-bold text-white tracking-tight">Detail & Verifikasi Laporan Masuk</h2>
                </div>
                <p class="text-xs text-slate-400">Tinjau kelengkapan laporan sebelum diverifikasi ke sistem komando</p>
            </div>
            <button onclick="closeVerifyModal()" class="text-slate-400 hover:text-white p-1 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Pelapor & Waktu Bar -->
        <div class="bg-[#141d33] border border-[#1e293b] rounded-2xl p-4 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div>
                <span class="text-slate-400 block mb-1 font-semibold uppercase tracking-wider text-[10px]">NAMA PELAPOR</span>
                <div class="flex items-center gap-1.5 font-bold text-white text-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <span id="modalReporterName">raka</span>
                </div>
            </div>

            <div>
                <span class="text-slate-400 block mb-1 font-semibold uppercase tracking-wider text-[10px]">WAKTU PELAPORAN</span>
                <div class="flex items-center gap-1.5 font-bold text-white text-xs sm:text-sm font-mono">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/>
                    </svg>
                    <span id="modalReportDate">2026-05-20 12:00:00</span>
                </div>
            </div>

            <div>
                <span class="text-slate-400 block mb-1 font-semibold uppercase tracking-wider text-[10px]">STATUS SAAT INI</span>
                <div>
                    <span id="modalStatusBadge" class="inline-block px-3 py-0.5 rounded-full text-xs font-semibold bg-[#fef08a] text-[#713f12]">
                        Menunggu Verifikasi
                    </span>
                </div>
            </div>
        </div>

        <!-- 2 Grid Boxes: Kategori Bencana & Titik Lokasi -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Box 1 -->
            <div class="bg-[#141d33] border border-[#1e293b] rounded-2xl p-4 flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-400 block mb-1.5">Kategori Bencana:</span>
                    <div class="flex items-center gap-2">
                        <span id="modalDisasterBadge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-blue-900/60 text-blue-300 border border-blue-700/50">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span id="modalDisasterName">Banjir</span>
                        </span>
                        <span class="text-xs text-slate-300 font-medium">Tingkat Darurat: <strong class="text-white" id="modalAlertLevel">Siaga 2</strong></span>
                    </div>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="bg-[#141d33] border border-[#1e293b] rounded-2xl p-4">
                <span class="text-xs text-slate-400 block mb-1.5">Titik Lokasi:</span>
                <div class="flex items-start gap-2 text-xs font-semibold text-slate-200">
                    <svg class="w-4 h-4 text-red-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                    </svg>
                    <span id="modalFullLocation">Jakarta Timur - Bidara Cina, RT 04 / RW 11</span>
                </div>
            </div>
        </div>

        <!-- Lampiran Foto Bukti Lapangan -->
        <div>
            <span class="text-xs font-semibold text-slate-300 block mb-2">Lampiran Foto Bukti Lapangan</span>
            <div class="relative rounded-2xl overflow-hidden border border-[#1e293b] bg-slate-900 h-56 group">
                <img id="modalReportPhoto" src="https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1200&q=80" alt="Bukti Foto Lapangan" class="w-full h-full object-cover">
                <div class="absolute bottom-3 left-3 bg-black/75 backdrop-blur-md px-3 py-1.5 rounded-lg text-xs font-medium text-white flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    </svg>
                    <span id="modalPhotoCaption">Foto Lapangan (Ketinggian air 60-80cm)</span>
                </div>
            </div>
        </div>

        <!-- Kronologi & Kebutuhan Darurat -->
        <div>
            <span class="text-xs font-semibold text-slate-300 block mb-2">Kronologi & Kebutuhan Darurat</span>
            <div id="modalChronology" class="bg-[#141d33] border border-[#1e293b] rounded-2xl p-4 text-xs text-slate-300 leading-relaxed">
                Air sungai mulai meluap sejak pukul 10:00 WIB akibat hujan deras semalaman. Ketinggian air saat ini telah mencapai 60-80 cm di pemukiman padat. Sejumlah warga lansia dan anak-anak membutuhkan perahu karet untuk evakuasi ke posko masjid terdekat.
            </div>
        </div>

        <!-- Form Keputusan Verifikator -->
        <form id="verifyForm" method="POST" action="" class="bg-[#141d33] border border-[#1e293b] rounded-2xl p-5 space-y-4">
            @csrf
            <input type="hidden" name="reporter_name" id="formReporterName" value="">
            <input type="hidden" name="report_id" id="formReportId" value="">

            <h3 class="text-xs font-extrabold text-white tracking-wider uppercase">
                FORM KEPUTUSAN VERIFIKATOR
            </h3>

            <!-- Checkbox validasi -->
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="validated" required checked class="w-4 h-4 rounded text-blue-600 focus:ring-0 bg-slate-800 border-slate-600">
                <span class="text-xs font-medium text-slate-200">
                    Laporan telah divalidasi kebenarannya melalui koordinasi tim relawan / Babinsa lapangan
                </span>
            </label>

            <!-- Row Ubah Status & Prioritas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                <div>
                    <label class="text-[11px] font-semibold text-slate-400 block mb-1.5">Ubah Status Laporan</label>
                    <select name="status" class="w-full bg-[#0c1222] border border-[#23314f] rounded-xl px-3.5 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-blue-500">
                        <option value="diverifikasi" selected>Terverifikasi (Valid)</option>
                        <option value="menunggu">Menunggu Verifikasi</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <div>
                    <label class="text-[11px] font-semibold text-slate-400 block mb-1.5">Prioritas Penanganan</label>
                    <select name="priority" id="selectPriority" class="w-full bg-[#0c1222] border border-[#23314f] rounded-xl px-3.5 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-blue-500">
                        <option value="Siaga 2 (Tinggi)" selected>Tinggi (Evakuasi Segera)</option>
                        <option value="Siaga 1 (Sedang)">Sedang (Normalisasi Drainase)</option>
                        <option value="Waspada (Rendah)">Rendah (Pemantauan Berkala)</option>
                    </select>
                </div>
            </div>

            <!-- Catatan Tindak Lanjut -->
            <div>
                <label class="text-[11px] font-semibold text-slate-400 block mb-1.5">Catatan Tindak Lanjut</label>
                <textarea name="action_notes" rows="2" class="w-full bg-[#0c1222] border border-[#23314f] rounded-xl p-3 text-xs text-slate-200 focus:outline-none focus:border-blue-500" placeholder="Catatan untuk tim komando/posko...">Laporan valid, tim relawan BPBD telah diterjunkan ke lokasi membawa 1 unit perahu karet.</textarea>
            </div>
        </form>

        <!-- Footer Buttons (Matching Frame 64) -->
        <div class="flex items-center justify-between pt-2">
            <button type="button" onclick="closeVerifyModal()" class="text-xs font-semibold text-slate-400 hover:text-white transition">
                Batal
            </button>

            <div class="flex items-center gap-3">
                <button
                    type="button"
                    onclick="submitRejectFromModal()"
                    class="px-5 py-2.5 rounded-xl text-xs font-bold border border-red-500/60 text-red-400 hover:bg-red-500/10 transition inline-flex items-center gap-1.5"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/>
                    </svg>
                    <span>Tolak Laporan</span>
                </button>

                <button
                    type="button"
                    onclick="submitVerifyFromModal()"
                    class="px-5 py-2.5 rounded-xl text-xs font-bold bg-[#3b82f6] hover:bg-blue-600 text-white shadow-lg transition inline-flex items-center gap-1.5"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Konfirmasi & Verifikasi</span>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL SUCCESS: VERIFIKASI BERHASIL! (Matching Html -> Body-1) -->
<!-- ======================================================== -->
<div id="successModal" class="fixed inset-0 z-50 {{ session('verification_success') ? '' : 'hidden' }} overflow-y-auto bg-black/80 backdrop-blur-md p-4 flex items-center justify-center">
    <div class="relative w-full max-w-lg bg-[#0f172a] border border-[#1e293b] rounded-3xl shadow-2xl p-8 text-center space-y-6 text-slate-100">
        <!-- Glowing Checkmark Circle -->
        <div class="mx-auto w-20 h-20 rounded-full border-2 border-emerald-500/40 bg-emerald-950/40 flex items-center justify-center text-emerald-400 shadow-xl shadow-emerald-900/30">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <div class="space-y-2">
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Verifikasi Berhasil!</h2>
            <p class="text-xs text-slate-300 leading-relaxed px-4">
                Laporan darurat dari <strong id="successName" class="text-white">{{ session('verification_success.name') ?? 'raka' }}</strong> (<span id="successId" class="text-blue-400 font-mono">#{{ session('verification_success.id') ?? 'LAP-2026-0520' }}</span>) telah berhasil divalidasi dan diteruskan ke Tim Reaksi Cepat BPBD.
            </p>
        </div>

        <!-- Summary Card (Matching Html -> Body-1) -->
        <div class="bg-[#141d33] border border-[#1e293b] rounded-2xl p-5 text-left text-xs space-y-3.5">
            <div class="flex items-center justify-between">
                <span class="text-slate-400 font-medium">Status Baru</span>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-900/50 text-emerald-300 border border-emerald-700/50">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Diverifikasi
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-slate-400 font-medium">Prioritas</span>
                <span class="inline-flex items-center gap-1.5 font-bold text-red-400">
                    <span class="w-2 h-2 rounded-full bg-red-500 inline-block"></span>
                    <span id="successPriorityBadge">{{ session('verification_success.priority') ?? 'Siaga 2 (Tinggi)' }}</span>
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-slate-400 font-medium">Disposisi</span>
                <span class="inline-flex items-center gap-1.5 text-blue-300 font-semibold">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    TRC & Posko Terdekat Notified
                </span>
            </div>
        </div>

        <!-- Buttons -->
        <div class="space-y-3 pt-2">
            <button
                type="button"
                onclick="closeSuccessModal()"
                class="w-full py-3 rounded-xl text-sm font-bold bg-[#3b82f6] hover:bg-blue-600 text-white shadow-lg transition inline-flex items-center justify-center gap-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Selesai & Kembali</span>
            </button>

            <a
                href="{{ route('home') }}#peta-pemantauan"
                class="inline-flex items-center justify-center gap-1.5 text-xs text-slate-400 hover:text-white transition"
            >
                <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                </svg>
                <span>Pantau di Peta Kebencanaan</span>
            </a>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL TOLAK LAPORAN -->
<!-- ======================================================== -->
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/75 backdrop-blur-sm p-4 flex items-center justify-center">
    <div class="relative w-full max-w-md bg-[#0f172a] border border-[#1e293b] rounded-3xl shadow-2xl p-6 space-y-5 text-slate-100">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-white">Tolak Laporan Masuk</h3>
            <button onclick="closeRejectModal()" class="text-slate-400 hover:text-white">✕</button>
        </div>

        <p class="text-xs text-slate-300 leading-relaxed">
            Apakah Anda yakin ingin menolak laporan dari <strong id="rejectModalName" class="text-white"></strong>?
        </p>

        <form id="rejectForm" method="POST" action="" class="space-y-4">
            @csrf
            <div>
                <label class="text-[11px] font-semibold text-slate-400 block mb-1">Alasan Penolakan</label>
                <textarea name="action_notes" rows="2" class="w-full bg-[#0c1222] border border-[#23314f] rounded-xl p-3 text-xs text-slate-200" required>Setelah dicek oleh petugas/Babinsa di lapangan, kondisi tidak memenuhi kriteria darurat bencana.</textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-xs font-semibold text-slate-400 hover:text-white">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold bg-red-600 hover:bg-red-700 text-white shadow">Ya, Tolak Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentReport = null;

    function openVerifyModal(report) {
        currentReport = report;
        document.getElementById('modalReporterName').textContent = report.name;
        document.getElementById('modalReportDate').textContent = report.date;
        document.getElementById('modalDisasterName').textContent = report.disaster;
        document.getElementById('modalAlertLevel').textContent = report.alert_level || 'Siaga 2';
        document.getElementById('modalFullLocation').textContent = report.full_location || (report.location + ' - Manado');
        document.getElementById('modalReportPhoto').src = report.photo || 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1200&q=80';
        document.getElementById('modalPhotoCaption').textContent = report.photo_caption || 'Foto Lapangan';
        document.getElementById('modalChronology').textContent = report.chronology || 'Laporan bencana masuk ke sistem komando.';
        
        document.getElementById('formReporterName').value = report.name;
        document.getElementById('formReportId').value = report.id;
        document.getElementById('verifyForm').action = `/admin/laporan/${report.id}/verifikasi`;

        document.getElementById('verifyModal').classList.remove('hidden');
    }

    function closeVerifyModal() {
        document.getElementById('verifyModal').classList.add('hidden');
    }

    function submitVerifyFromModal() {
        document.getElementById('verifyForm').submit();
    }

    function submitRejectFromModal() {
        if (!currentReport) return;
        closeVerifyModal();
        openRejectModal(currentReport);
    }

    function openRejectModal(report) {
        document.getElementById('rejectModalName').textContent = report.name + ' (' + report.id + ')';
        document.getElementById('rejectForm').action = `/admin/laporan/${report.id}/tolak`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
    }
</script>
@endpush
