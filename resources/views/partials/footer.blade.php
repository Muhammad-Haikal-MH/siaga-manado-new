<footer class="mt-20 pt-10 pb-12 bg-white border-t border-slate-200/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Emergency Call Banner -->
        <div class="bg-gradient-to-r from-[#0e2a66] to-[#1e428a] rounded-2xl px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-md mb-12 text-white">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-white/15 flex items-center justify-center text-white shrink-0">
                    <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m6.364.636l-1.414 1.414M21 12h-2M4 12H2m3.05-5.95L3.636 4.636M8 14a4 4 0 118 0v4H8v-4zm-2 4h12v2H6v-2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-white">
                        Panggilan Darurat Kota Manado
                    </h3>
                    <p class="text-xs text-blue-100 mt-0.5">
                        Pusat Pengendali Operasi Bencana (PUSDALOPS) & Call Center Siaga 24 Jam
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a
                    href="tel:112"
                    class="flex-1 sm:flex-initial text-center px-5 py-2.5 rounded-xl bg-white hover:bg-blue-50 text-[#163672] text-xs font-extrabold transition shadow-xs"
                >
                    112 Bebas Pulsa
                </a>
                <a
                    href="tel:0431851113"
                    class="flex-1 sm:flex-initial text-center px-5 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 text-white text-xs font-bold transition border border-white/20"
                >
                    (0431) 851113
                </a>
            </div>
        </div>

        <!-- Footer Columns -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-10 border-b border-slate-200/80">
            <div class="md:col-span-5 flex flex-col justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#163672] flex items-center justify-center text-white shadow-xs">
                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[19px] font-extrabold tracking-tight leading-none text-[#163672]">
                            SiagaManado
                        </span>
                        <span class="text-[11px] font-medium text-slate-500 tracking-wide mt-0.5">
                            Tanggap, Selamat, Bersama
                        </span>
                    </div>
                </a>
                <p class="text-xs text-slate-500 mt-3 max-w-xs leading-relaxed">
                    Sistem Pelaporan dan Akses Informasi Kebencanaan bagi Masyarakat di Kota Manado.
                </p>
            </div>

            <div class="md:col-span-3">
                <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 mb-3.5">
                    Navigasi Utama
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-[#163672] transition">Beranda</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-[#163672] transition">Berita Kebencanaan</a></li>
                    <li><a href="{{ route('mitigation.index') }}" class="hover:text-[#163672] transition">Panduan Mitigasi</a></li>
                    <li><a href="{{ route('reports.history') }}" class="hover:text-[#163672] transition">Riwayat Laporan Saya</a></li>
                </ul>
            </div>

            <div class="md:col-span-4">
                <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 mb-3.5">
                    Layanan & Bantuan
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                    <li><a href="{{ route('mitigation.show', 'banjir') }}" class="hover:text-[#163672] transition">Panduan Evakuasi Banjir & Longsor</a></li>
                    <li>
                        <button type="button" onclick="openReportModal()" class="hover:text-[#163672] transition text-left cursor-pointer">
                            Formulir Pelaporan Bencana
                        </button>
                    </li>
                    <li><a href="{{ route('profile') }}" class="hover:text-[#163672] transition">Pengaturan Profil Pengguna</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright Bottom Bar -->
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500 font-medium">
            <p>© 2025 Pemerintah Kota Manado — SiagaManado. Hak Cipta Dilindungi.</p>
            <div class="flex items-center gap-2">
                <span>Kesiapsiagaan Masyarakat</span>
                <span>•</span>
                <span>Resiliensi Pesisir & DAS</span>
            </div>
        </div>
    </div>
</footer>
