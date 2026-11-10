<!-- Modal Detail Laporan (Use Case 4.3) -->
<div
    id="reportDetailModal"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs"
    role="dialog"
    aria-modal="true"
    aria-labelledby="detail-laporan-title"
>
    <div class="relative w-full max-w-[620px] max-h-[90vh] overflow-y-auto rounded-[28px] bg-white border border-slate-200 shadow-2xl p-6 sm:p-8 text-slate-800">
        <!-- Top Header -->
        <div class="flex items-center justify-between pb-5 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <h2 id="detail-laporan-title" class="text-lg font-extrabold text-slate-900">
                    Detail Laporan Bencana
                </h2>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-100 border border-amber-300 text-amber-800 text-xs font-bold capitalize">
                    <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                    <span id="detailReportStatus">Menunggu</span>
                </span>
            </div>
            <button
                type="button"
                onclick="closeReportDetailModal()"
                class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition cursor-pointer"
                aria-label="Tutup detail laporan"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Section: INFORMASI LAPORAN -->
        <div class="mt-6">
            <p class="text-xs font-extrabold uppercase tracking-wider text-[#163672] mb-3">
                Informasi Laporan
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3.5">
                    <p class="text-xs font-medium text-slate-500 mb-1">Nama Pelapor</p>
                    <p id="detailReporterName" class="text-sm font-bold text-slate-900"></p>
                </div>

                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3.5">
                    <p class="text-xs font-medium text-slate-500 mb-1">No. Telp Pelapor</p>
                    <p id="detailReporterPhone" class="text-sm font-bold text-slate-900"></p>
                </div>

                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3.5">
                    <p class="text-xs font-medium text-slate-500 mb-1">Jenis Bencana</p>
                    <p id="detailDisasterType" class="text-sm font-bold text-[#163672]"></p>
                </div>

                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3.5">
                    <p class="text-xs font-medium text-slate-500 mb-1">Tanggal & Waktu Kejadian</p>
                    <p id="detailCreatedAt" class="text-sm font-mono font-semibold text-slate-900"></p>
                </div>
            </div>

            <!-- Lokasi Kejadian -->
            <div class="mt-3.5 bg-slate-50 border border-slate-200/80 rounded-2xl p-4">
                <div class="flex items-center justify-between gap-2 mb-1">
                    <p class="text-xs font-medium text-slate-500">Lokasi Kejadian</p>
                    <a
                        id="detailMapLink"
                        href="#"
                        target="_blank"
                        rel="noreferrer"
                        class="inline-flex items-center gap-1 text-xs font-bold text-[#163672] hover:underline"
                    >
                        <span>Buka di Google Maps ↗</span>
                    </a>
                </div>
                <p id="detailLocation" class="text-sm font-bold text-slate-900"></p>
                <p class="text-xs text-slate-500 mt-1">
                    Koordinat: <span id="detailCoordinates" class="font-mono"></span>
                </p>
            </div>
        </div>

        <!-- Section: DESKRIPSI -->
        <div class="mt-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-extrabold uppercase tracking-wider text-[#163672]">Deskripsi Kejadian</span>
                <span class="text-xs text-slate-400">Catatan Warga</span>
            </div>
            <div id="detailDescription" class="bg-slate-50 border border-slate-200/80 rounded-2xl p-4 text-sm text-slate-700 leading-relaxed">
            </div>
        </div>

        <!-- Section: DOKUMENTASI LAPORAN (Multi-Foto / Video) -->
        <div class="mt-6">
            <p class="text-xs font-extrabold uppercase tracking-wider text-[#163672] mb-3">
                Dokumentasi Kejadian
            </p>
            <div id="detailMediaContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-3"></div>
        </div>
    </div>
</div>

<script>
    function openReportDetailModal(report) {
        document.getElementById('detailReportStatus').textContent = report.status || 'menunggu';
        document.getElementById('detailReporterName').textContent = report.reporterName || '-';
        document.getElementById('detailReporterPhone').textContent = report.phone || '-';
        document.getElementById('detailDisasterType').textContent = report.disasterCategoryLabel || report.disasterType || '-';
        document.getElementById('detailCreatedAt').textContent = report.createdAt || '-';
        document.getElementById('detailLocation').textContent = report.location || '-';
        document.getElementById('detailCoordinates').textContent = report.coordinates || '1.4822° N, 124.8489° E';
        document.getElementById('detailDescription').textContent = report.description || '-';

        const lat = report.latitude || 1.4822;
        const lng = report.longitude || 124.8489;
        document.getElementById('detailMapLink').href = `https://www.google.com/maps?q=${lat},${lng}`;

        const mediaContainer = document.getElementById('detailMediaContainer');
        const mediaList = (report.mediaList && report.mediaList.length > 0)
            ? report.mediaList
            : [{ type: 'image', url: report.photoUrl, name: report.photoName || 'dokumentasi.jpg', size: report.photoSize || '1.8 MB' }];

        mediaContainer.innerHTML = mediaList.map((m) => {
            const mediaEl = m.type === 'video'
                ? `<video src="${m.url}" controls class="w-full h-40 object-cover rounded-xl bg-slate-900"></video>`
                : `<img src="${m.url}" alt="${m.name}" class="w-full h-40 object-cover rounded-xl border border-slate-200" />`;

            return `
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3">
                    ${mediaEl}
                    <p class="text-xs font-bold text-slate-800 truncate mt-2">${m.name}</p>
                    <p class="text-[11px] text-slate-500">${m.size}</p>
                </div>
            `;
        }).join('');

        const modal = document.getElementById('reportDetailModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeReportDetailModal() {
        const modal = document.getElementById('reportDetailModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
