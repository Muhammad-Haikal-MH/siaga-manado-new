<!-- Modal Formulir Pelaporan Bencana (Use Case 4.1) -->
<div
    id="reportFormModal"
    class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-4 bg-slate-900/60 backdrop-blur-xs"
    role="dialog"
    aria-modal="true"
    aria-labelledby="form-laporan-title"
>
    <div class="relative w-full max-w-[640px] max-h-[92vh] overflow-y-auto rounded-[28px] bg-white border border-slate-200 shadow-2xl p-6 sm:p-8">
        <!-- Close Button -->
        <button
            type="button"
            onclick="closeReportModal()"
            class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition cursor-pointer"
            aria-label="Batal dan tutup formulir"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="mb-6">
            <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-[#163672] text-[11px] font-bold uppercase tracking-wider mb-1.5">
                Layanan Tanggap Darurat
            </span>
            <h2 id="form-laporan-title" class="text-2xl font-extrabold text-slate-900">
                Form Laporan Bencana
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Lengkapi informasi titik kejadian dan unggah dokumentasi foto/video di lapangan.
            </p>
        </div>

        <form id="disasterReportForm" onsubmit="submitReportForm(event)" novalidate class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Nama Pelapor (Otomatis Terisi & Read-Only) -->
                <div>
                    <label for="reporter_name_input" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Pelapor
                    </label>
                    <input
                        id="reporter_name_input"
                        type="text"
                        value="{{ $user['name'] ?? 'Muhammad Haikal' }}"
                        readonly
                        class="w-full rounded-xl bg-slate-100 border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 cursor-not-allowed focus:outline-none"
                    />
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="report_phone_input" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        No. Telepon / WhatsApp <span class="text-rose-600">*</span>
                    </label>
                    <input
                        id="report_phone_input"
                        name="phone"
                        type="tel"
                        value="{{ $user['phone'] ?? '081234567890' }}"
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                    />
                    <p id="err_phone" class="hidden mt-1 text-xs font-medium text-rose-600"></p>
                </div>
            </div>

            <!-- Pilih Bencana & Waktu Kejadian -->
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                <div class="sm:col-span-5">
                    <label for="report_disaster_type" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Jenis Bencana <span class="text-rose-600">*</span>
                    </label>
                    <select
                        id="report_disaster_type"
                        name="disaster_type"
                        class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                    >
                        @foreach(($disasterTypes ?? []) as $dt)
                            <option value="{{ $dt['id'] }}">{{ $dt['label'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-4">
                    <label for="report_incident_date" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tanggal Kejadian <span class="text-rose-600">*</span>
                    </label>
                    <input
                        id="report_incident_date"
                        name="incident_date"
                        type="date"
                        value="{{ date('Y-m-d') }}"
                        min="{{ date('Y-m-d', strtotime('-2 days')) }}"
                        max="{{ date('Y-m-d') }}"
                        class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3.5 py-2.5 text-sm text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                    />
                </div>

                <div class="sm:col-span-3">
                    <label for="report_incident_time" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Jam <span class="text-rose-600">*</span>
                    </label>
                    <input
                        id="report_incident_time"
                        name="incident_time"
                        type="time"
                        value="{{ date('H:i') }}"
                        class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2.5 text-sm text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                    />
                </div>
            </div>
            <p class="text-[11px] text-slate-500 -mt-2">
                *Default terisi hari ini. Anda dapat memilih mundur maksimal 2 hari lalu (H-2).
            </p>
            <p id="err_incident_date" class="hidden mt-1 text-xs font-medium text-rose-600"></p>

            <!-- Lokasi Kejadian + Peta Interaktif Leaflet.js -->
            <div>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-1.5">
                    <label for="report_location_input" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                        Titik Lokasi Kejadian <span class="text-rose-600">*</span>
                    </label>
                    <button
                        type="button"
                        onclick="detectCurrentUserLocation()"
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-[#163672] text-xs font-bold transition cursor-pointer"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-5.364l-1.414 1.414M8.05 15.95l-1.414 1.414m0-11.314l1.414 1.414m9.9 9.9l1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                        </svg>
                        <span id="gpsBtnLabel">Deteksi Posisi Sekarang</span>
                    </button>
                </div>

                <!-- Peta Leaflet Interaktif (Bisa Klik Peta / Geser Pin) -->
                <div class="relative rounded-2xl overflow-hidden border border-slate-200 mb-2.5 shadow-2xs">
                    <div id="reportLeafletMap" class="h-52 w-full bg-slate-100"></div>
                    <div class="bg-slate-900/80 backdrop-blur-xs text-white px-3 py-1.5 text-[11px] flex items-center justify-between">
                        <span>Geser pin merah atau klik pada peta untuk menyesuaikan titik lokasi</span>
                        <span id="mapCoordsBadge" class="font-mono font-semibold text-blue-200">1.4822° N, 124.8489° E</span>
                    </div>
                </div>

                <input type="hidden" id="report_lat_input" name="latitude" value="1.4822" />
                <input type="hidden" id="report_lng_input" name="longitude" value="124.8489" />
                <input type="hidden" id="report_coordinates_input" name="coordinates" value="1.4822° N, 124.8489° E" />

                <input
                    id="report_location_input"
                    name="location"
                    type="text"
                    placeholder="Nama jalan, kelurahan, kecamatan, atau patokan lokasi (otomatis terisi dari peta & bisa diedit)"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                />
                <p id="err_location" class="hidden mt-1.5 text-xs font-medium text-rose-600"></p>
            </div>

            <!-- Detail Kejadian (Deskripsi) -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="report_description_input" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                        Deskripsi Detail Kejadian <span class="text-rose-600">*</span>
                    </label>
                    <span id="descCharCount" class="text-[11px] text-slate-400">0/500 karakter</span>
                </div>
                <textarea
                    id="report_description_input"
                    name="description"
                    rows="3"
                    oninput="document.getElementById('descCharCount').textContent = this.value.length + '/500 karakter'"
                    placeholder="Jelaskan kondisi terkini di lokasi, perkiraan tinggi genangan/dampak, atau kebutuhan darurat warga..."
                    class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#163672]"
                ></textarea>
                <p id="err_description" class="hidden mt-1 text-xs font-medium text-rose-600"></p>
            </div>

            <!-- Bukti Kejadian (Mendukung Foto & Video, Bisa Tambah Lebih dari 1 File) -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-700">
                        Dokumentasi Kejadian (Foto / Video) <span class="text-rose-600">*</span>
                    </label>
                    <span id="mediaCountLabel" class="text-[11px] font-semibold text-slate-500">0 file dipilih</span>
                </div>

                <input
                    id="report_media_file"
                    type="file"
                    multiple
                    accept="image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime"
                    onchange="handleReportMediaSelect(event)"
                    class="hidden"
                />

                <!-- State 1: Belum ada file yang dipilih (Tampilan Dropzone Penuh) -->
                <button
                    id="mediaEmptyDropzone"
                    type="button"
                    onclick="document.getElementById('report_media_file').click()"
                    class="w-full rounded-2xl border-2 border-dashed border-slate-300 hover:border-[#163672] bg-slate-50 hover:bg-blue-50/40 px-4 py-6 text-center transition flex flex-col items-center justify-center cursor-pointer"
                >
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-[#163672] flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-[#163672]">Upload foto atau video disini</span>
                    <span class="text-xs text-slate-500 mt-0.5">Mendukung Foto (JPG, PNG, WEBP) atau Video (MP4, WEBM) — Maks 15 MB/file</span>
                </button>

                <!-- State 2: Sudah ada minimal 1 file (Grid Preview + Tombol "+ Tambah Foto/Video Lagi") -->
                <div id="mediaFilledContainer" class="hidden space-y-3">
                    <div id="mediaItemsGrid" class="grid grid-cols-2 sm:grid-cols-3 gap-3"></div>
                </div>

                <p id="err_media" class="hidden mt-1.5 text-xs font-medium text-rose-600"></p>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                <button
                    type="button"
                    onclick="closeReportModal()"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition cursor-pointer"
                >
                    Batal
                </button>
                <button
                    id="submitReportBtn"
                    type="submit"
                    class="w-full sm:w-auto px-8 py-2.5 rounded-xl bg-[#163672] hover:bg-[#102959] text-white font-bold text-sm shadow-md transition cursor-pointer"
                >
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Popup Pesan Keberhasilan: "Laporan berhasil dikirim!" + Tombol "OK" (Use Case 4.1 Langkah 5-7) -->
<div
    id="reportSuccessModal"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs"
    role="dialog"
    aria-modal="true"
    aria-labelledby="report-success-title"
>
    <div class="w-full max-w-md rounded-[28px] bg-white border border-slate-200 shadow-2xl p-7 text-center">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 id="report-success-title" class="text-xl font-extrabold text-slate-900">
            Laporan berhasil dikirim!
        </h3>
        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
            Laporan Anda telah diterima dengan status awal
            <span class="inline-block px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold">menunggu</span>
            dan dapat dipantau pada menu <strong>Riwayat Laporan</strong>.
        </p>
        <div class="mt-6">
            <button
                type="button"
                onclick="acknowledgeReportSuccess()"
                class="w-full py-3 rounded-xl bg-[#163672] hover:bg-[#102959] text-white font-bold text-sm shadow-md transition cursor-pointer"
            >
                OK
            </button>
        </div>
    </div>
</div>

<script>
    let reportMap = null;
    let reportMarker = null;
    let reportMediaFiles = []; // Array of { type: 'image'|'video', url: string, name: string, size: string }

    function initReportLeafletMap() {
        if (reportMap) {
            setTimeout(() => reportMap.invalidateSize(), 150);
            return;
        }

        const defaultLat = 1.4822;
        const defaultLng = 124.8489;

        reportMap = L.map('reportLeafletMap').setView([defaultLat, defaultLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(reportMap);

        reportMarker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(reportMap);

        // Saat marker digeser oleh user
        reportMarker.on('dragend', function(e) {
            const pos = e.target.getLatLng();
            updateSelectedMapCoordinates(pos.lat, pos.lng, true);
        });

        // Saat peta diklik langsung oleh user
        reportMap.on('click', function(e) {
            reportMarker.setLatLng(e.latlng);
            updateSelectedMapCoordinates(e.latlng.lat, e.latlng.lng, true);
        });

        setTimeout(() => reportMap.invalidateSize(), 200);
    }

    async function updateSelectedMapCoordinates(lat, lng, fetchAddress = true) {
        const latFixed = lat.toFixed(4);
        const lngFixed = lng.toFixed(4);
        const coordString = `${latFixed}° N, ${lngFixed}° E`;

        document.getElementById('report_lat_input').value = latFixed;
        document.getElementById('report_lng_input').value = lngFixed;
        document.getElementById('report_coordinates_input').value = coordString;
        document.getElementById('mapCoordsBadge').textContent = coordString;

        if (fetchAddress) {
            try {
                const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`, {
                    headers: { 'Accept-Language': 'id' }
                });
                if (res.ok) {
                    const data = await res.json();
                    if (data && data.display_name) {
                        document.getElementById('report_location_input').value = data.display_name;
                        hideFieldError('err_location');
                    }
                }
            } catch (e) {
                // Jika offline/gagal reverse geocode, biarkan user mengetik atau gunakan koordinat
                const locInput = document.getElementById('report_location_input');
                if (!locInput.value.trim()) {
                    locInput.value = `Titik Koordinat (${coordString}), Kota Manado`;
                }
            }
        }
    }

    function detectCurrentUserLocation() {
        const label = document.getElementById('gpsBtnLabel');
        label.textContent = 'Mendeteksi GPS...';

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    if (reportMap && reportMarker) {
                        reportMap.setView([lat, lng], 16);
                        reportMarker.setLatLng([lat, lng]);
                    }
                    updateSelectedMapCoordinates(lat, lng, true);
                    label.textContent = 'Posisi Terdeteksi';
                    setTimeout(() => { label.textContent = 'Deteksi Posisi Sekarang'; }, 2000);
                },
                () => {
                    // Fallback ke pusat Kota Manado jika izin lokasi ditolak browser
                    const fallbackLat = 1.4848;
                    const fallbackLng = 124.8421;
                    if (reportMap && reportMarker) {
                        reportMap.setView([fallbackLat, fallbackLng], 15);
                        reportMarker.setLatLng([fallbackLat, fallbackLng]);
                    }
                    updateSelectedMapCoordinates(fallbackLat, fallbackLng, true);
                    label.textContent = 'Deteksi Posisi Sekarang';
                },
                { enableHighAccuracy: true, timeout: 7000 }
            );
        } else {
            label.textContent = 'GPS Tidak Didukung';
        }
    }

    function openReportModal() {
        const modal = document.getElementById('reportFormModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        clearReportErrors();
        initReportLeafletMap();
    }

    function closeReportModal() {
        const modal = document.getElementById('reportFormModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function handleReportMediaSelect(event) {
        const files = Array.from(event.target.files || []);
        if (!files.length) return;

        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
        const allowedVideoTypes = ['video/mp4', 'video/webm', 'video/quicktime'];

        files.forEach((file) => {
            const isImage = allowedImageTypes.includes(file.type);
            const isVideo = allowedVideoTypes.includes(file.type);

            if (!isImage && !isVideo) {
                showFieldError('err_media', 'Format file tidak didukung. Gunakan Foto (JPG/PNG/WEBP) atau Video (MP4/WEBM).');
                return;
            }

            if (file.size > 15 * 1024 * 1024) {
                showFieldError('err_media', `Ukuran file "${file.name}" melebihi batas maksimal 15 MB.`);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const sizeMb = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                reportMediaFiles.push({
                    type: isVideo ? 'video' : 'image',
                    url: e.target.result,
                    name: file.name,
                    size: sizeMb
                });
                hideFieldError('err_media');
                renderMediaPreviewGrid();
            };
            reader.readAsDataURL(file);
        });

        // Reset input agar bisa pilih file lagi
        event.target.value = '';
    }

    function removeMediaAtIndex(idx) {
        reportMediaFiles.splice(idx, 1);
        renderMediaPreviewGrid();
    }

    function renderMediaPreviewGrid() {
        const emptyDropzone = document.getElementById('mediaEmptyDropzone');
        const filledContainer = document.getElementById('mediaFilledContainer');
        const grid = document.getElementById('mediaItemsGrid');
        const countLabel = document.getElementById('mediaCountLabel');

        countLabel.textContent = `${reportMediaFiles.length} file dipilih`;

        if (reportMediaFiles.length === 0) {
            emptyDropzone.classList.remove('hidden');
            filledContainer.classList.add('hidden');
            grid.innerHTML = '';
            return;
        }

        emptyDropzone.classList.add('hidden');
        filledContainer.classList.remove('hidden');

        let html = '';
        reportMediaFiles.forEach((item, index) => {
            const mediaPreview = item.type === 'video'
                ? `<video src="${item.url}" class="w-full h-24 object-cover rounded-lg bg-slate-900" muted playsinline></video>
                   <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-slate-900/80 text-white text-[10px] font-bold">VIDEO</span>`
                : `<img src="${item.url}" alt="${item.name}" class="w-full h-24 object-cover rounded-lg" />
                   <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-slate-900/70 text-white text-[10px] font-bold">FOTO</span>`;

            html += `
                <div class="relative rounded-xl border border-slate-200 bg-slate-50 p-2 flex flex-col justify-between group">
                    <div class="relative overflow-hidden rounded-lg">
                        ${mediaPreview}
                        <button
                            type="button"
                            onclick="removeMediaAtIndex(${index})"
                            class="absolute top-1.5 right-1.5 w-6 h-6 rounded-full bg-rose-600 text-white text-xs font-bold flex items-center justify-center shadow hover:bg-rose-700 cursor-pointer"
                            title="Hapus file ini"
                        >
                            ✕
                        </button>
                    </div>
                    <div class="mt-1.5 px-0.5">
                        <p class="text-[11px] font-bold text-slate-700 truncate">${item.name}</p>
                        <p class="text-[10px] text-slate-400">${item.size}</p>
                    </div>
                </div>
            `;
        });

        // Tombol "+ Tambah Foto / Video Lagi" sesuai permintaan
        html += `
            <button
                type="button"
                onclick="document.getElementById('report_media_file').click()"
                class="rounded-xl border-2 border-dashed border-blue-300 hover:border-[#163672] bg-blue-50/40 hover:bg-blue-50 p-3 flex flex-col items-center justify-center text-center min-h-[132px] transition cursor-pointer"
            >
                <div class="w-8 h-8 rounded-full bg-[#163672] text-white flex items-center justify-center text-lg font-bold mb-1.5">
                    +
                </div>
                <span class="text-xs font-bold text-[#163672]">Tambah Lagi</span>
                <span class="text-[10px] text-slate-500 mt-0.5">Foto / Video</span>
            </button>
        `;

        grid.innerHTML = html;
    }

    function showFieldError(id, msg) {
        const el = document.getElementById(id);
        if (el) {
            el.textContent = msg;
            el.classList.remove('hidden');
        }
    }

    function hideFieldError(id) {
        const el = document.getElementById(id);
        if (el) {
            el.textContent = '';
            el.classList.add('hidden');
        }
    }

    function clearReportErrors() {
        ['err_phone', 'err_incident_date', 'err_location', 'err_description', 'err_media'].forEach(hideFieldError);
    }

    async function submitReportForm(event) {
        event.preventDefault();
        clearReportErrors();

        const phone = document.getElementById('report_phone_input').value.trim();
        const disasterType = document.getElementById('report_disaster_type').value;
        const incidentDate = document.getElementById('report_incident_date').value;
        const incidentTime = document.getElementById('report_incident_time').value;
        const location = document.getElementById('report_location_input').value.trim();
        const latitude = document.getElementById('report_lat_input').value;
        const longitude = document.getElementById('report_lng_input').value;
        const coordinates = document.getElementById('report_coordinates_input').value;
        const description = document.getElementById('report_description_input').value.trim();

        let hasError = false;

        if (!phone) {
            showFieldError('err_phone', 'Nomor telepon wajib diisi untuk koordinasi petugas darurat.');
            hasError = true;
        } else if (!/^[0-9+]{10,15}$/.test(phone)) {
            showFieldError('err_phone', 'Format nomor telepon tidak valid (gunakan 10–15 digit angka).');
            hasError = true;
        }

        if (!location) {
            showFieldError('err_location', 'Lokasi kejadian bencana wajib diisi.');
            hasError = true;
        } else if (location.length < 8) {
            showFieldError('err_location', 'Tuliskan lokasi lebih spesifik (minimal 8 karakter).');
            hasError = true;
        }

        if (!description) {
            showFieldError('err_description', 'Deskripsi detail kejadian wajib diisi.');
            hasError = true;
        } else if (description.length < 15) {
            showFieldError('err_description', 'Deskripsi terlalu singkat (minimal 15 karakter).');
            hasError = true;
        } else if (description.length > 500) {
            showFieldError('err_description', 'Deskripsi maksimal 500 karakter.');
            hasError = true;
        }

        if (reportMediaFiles.length === 0) {
            showFieldError('err_media', 'Minimal 1 foto atau video dokumentasi wajib diunggah.');
            hasError = true;
        }

        if (hasError) return;

        const btn = document.getElementById('submitReportBtn');
        btn.disabled = true;
        btn.textContent = 'Mengirim...';

        try {
            const response = await fetch("{{ route('reports.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    phone,
                    disaster_type: disasterType,
                    incident_date: incidentDate,
                    incident_time: incidentTime,
                    location,
                    latitude,
                    longitude,
                    coordinates,
                    description,
                    media_list: reportMediaFiles
                })
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    if (data.errors.phone) showFieldError('err_phone', data.errors.phone[0]);
                    if (data.errors.incident_date) showFieldError('err_incident_date', data.errors.incident_date[0]);
                    if (data.errors.location) showFieldError('err_location', data.errors.location[0]);
                    if (data.errors.description) showFieldError('err_description', data.errors.description[0]);
                    if (data.errors.media_list) showFieldError('err_media', data.errors.media_list[0]);
                }
                return;
            }

            closeReportModal();
            const successModal = document.getElementById('reportSuccessModal');
            successModal.classList.remove('hidden');
            successModal.classList.add('flex');
        } catch (err) {
            showFieldError('err_media', 'Terjadi gangguan jaringan saat mengirim laporan.');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Kirim Laporan';
        }
    }

    function acknowledgeReportSuccess() {
        const successModal = document.getElementById('reportSuccessModal');
        successModal.classList.add('hidden');
        successModal.classList.remove('flex');
        window.location.reload();
    }
</script>
