<?php

namespace App\Services;

class AdminMockService
{
    private const SESSION_REPORTS = 'admin_siagamanado_reports';
    private const SESSION_NEWS = 'admin_siagamanado_news';
    private const SESSION_FEEDBACKS = 'admin_siagamanado_feedbacks';
    private const SESSION_MITIGATIONS = 'admin_siagamanado_mitigations';

    public function getAdminProfile(): array
    {
        return [
            'name' => 'Petugas BPBD',
            'role' => 'Super Admin',
            'initials' => 'AD',
            'agency' => 'BPBD Kota Manado',
            'badge' => 'Admin Siagamanado',
        ];
    }

    public function getDashboardMetrics(): array
    {
        $reports = $this->getAllReports();
        $totalLaporan = count($reports);
        $laporanBaru = count(array_filter($reports, fn($r) => $r['status'] === 'menunggu'));
        $laporanSelesai = count(array_filter($reports, fn($r) => $r['status'] === 'diverifikasi'));

        return [
            'total_users' => 16,
            'total_laporan' => 29, // Sesuai Frame 40: 29
            'laporan_baru' => 19,  // Sesuai Frame 40: 19
            'laporan_selesai' => 4, // Sesuai Frame 40: 4
            'monthly_reports' => [
                'Jan' => 3,
                'Mei' => 2,
                'Okt' => 1,
                'Nov' => 1,
                'Des' => 22,
            ],
            'monthly_completed' => [
                'Des' => 4,
            ],
        ];
    }

    public function getAllReports(): array
    {
        if (!session()->has(self::SESSION_REPORTS)) {
            session()->put(self::SESSION_REPORTS, [
                [
                    'id' => 'LAP-2026-0520',
                    'name' => 'raka',
                    'disaster' => 'banjir',
                    'location' => 'jakarta',
                    'full_location' => 'Jakarta Timur - Bidara Cina, RT 04 / RW 11',
                    'alert_level' => 'Siaga 2',
                    'status' => 'menunggu',
                    'date' => '2026-05-20 12:00:00',
                    'photo' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1200&q=80',
                    'photo_caption' => 'Foto Lapangan (Ketinggian air 60-80cm)',
                    'chronology' => 'Air sungai mulai meluap sejak pukul 10:00 WIB akibat hujan deras semalaman. Ketinggian air saat ini telah mencapai 60-80 cm di pemukiman padat. Sejumlah warga lansia dan anak-anak membutuhkan perahu karet untuk evakuasi ke posko masjid terdekat.',
                    'action_notes' => 'Laporan valid, tim relawan BPBD telah diterjunkan ke lokasi membawa 1 unit perahu karet.',
                    'priority' => 'Tinggi (Evakuasi Segera)',
                ],
                [
                    'id' => 'LAP-2026-0506',
                    'name' => 'ucup',
                    'disaster' => 'banjir',
                    'location' => 'plembang',
                    'full_location' => 'Palembang - Jl. Kolonel Atmo RT 02 / RW 05',
                    'alert_level' => 'Siaga 1',
                    'status' => 'menunggu',
                    'date' => '2026-05-06 16:31:00',
                    'photo' => 'https://images.unsplash.com/photo-1515694346937-94d85e41e6f0?auto=format&fit=crop&w=1200&q=80',
                    'photo_caption' => 'Foto Lapangan (Genangan jalan utama)',
                    'chronology' => 'Hujan lebat selama 3 jam menyebabkan saluran drainase induk tersumbat sampah sehingga air meluap ke badan jalan sedalam 40 cm.',
                    'action_notes' => 'Koordinasi dengan Dinas PUPR untuk pembersihan saluran air.',
                    'priority' => 'Sedang (Normalisasi Drainase)',
                ],
                [
                    'id' => 'LAP-2026-0107-1',
                    'name' => 'hekal',
                    'disaster' => 'Banjir',
                    'location' => 'jambi',
                    'full_location' => 'Jambi - Telanaipura RT 11',
                    'alert_level' => 'Waspada',
                    'status' => 'menunggu',
                    'date' => '2026-01-07 00:00:00',
                    'photo' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1200&q=80',
                    'photo_caption' => 'Foto Lapangan (Air merembes ke teras)',
                    'chronology' => 'Debit air sungai Batanghari meningkat perlahan pasca pasang air laut malam hari.',
                    'action_notes' => 'Monitoring berkala oleh posko pemantau sungai.',
                    'priority' => 'Rendah (Pemantauan Rutin)',
                ],
                [
                    'id' => 'LAP-2026-0107-2',
                    'name' => 'haikal',
                    'disaster' => 'banjir',
                    'location' => 'plembang',
                    'full_location' => 'Palembang - Sukarami RT 08',
                    'alert_level' => 'Siaga 2',
                    'status' => 'diverifikasi',
                    'date' => '2026-01-07 19:42:00',
                    'photo' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=1200&q=80',
                    'photo_caption' => 'Foto Lapangan',
                    'chronology' => 'Laporan genangan air di jalan protokol telah ditindaklanjuti posko tim TRC dan air berangsur surut.',
                    'action_notes' => 'Petugas telah mengirim bantuan pompa air portable ke lokasi.',
                    'priority' => 'Sedang',
                ],
                [
                    'id' => 'LAP-2026-0107-3',
                    'name' => 'haikal',
                    'disaster' => 'banjir',
                    'location' => 'jakarta',
                    'full_location' => 'Jakarta Barat - Rawa Buaya',
                    'alert_level' => 'Normal',
                    'status' => 'ditolak',
                    'date' => '2026-01-07 19:37:00',
                    'photo' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1200&q=80',
                    'photo_caption' => 'Foto Lapangan',
                    'chronology' => 'Setelah dicek oleh Babinsa dan relawan setempat, genangan hanya berupa cipratan kecil di tepi selokan dan sudah surut dalam 10 menit.',
                    'action_notes' => 'Laporan ditolak: Informasi tidak memenuhi kriteria darurat bencana.',
                    'priority' => 'Tidak Prioritas',
                ],
            ]);
        }

        return session()->get(self::SESSION_REPORTS, []);
    }

    public function findReport(string $id): ?array
    {
        $reports = $this->getAllReports();
        foreach ($reports as $r) {
            if ($r['id'] === $id) {
                return $r;
            }
        }
        return null;
    }

    public function updateReportStatus(string $id, string $status, ?string $priority = null, ?string $notes = null): bool
    {
        $reports = $this->getAllReports();
        $updated = false;

        foreach ($reports as &$r) {
            if ($r['id'] === $id) {
                $r['status'] = $status;
                if ($priority) {
                    $r['priority'] = $priority;
                }
                if ($notes) {
                    $r['action_notes'] = $notes;
                }
                $updated = true;
                break;
            }
        }

        if ($updated) {
            session()->put(self::SESSION_REPORTS, $reports);
        }

        return $updated;
    }

    public function getNewsMetrics(): array
    {
        $allNews = $this->getAllNews();
        $drafts = count(array_filter($allNews, fn($n) => strtolower($n['status']) === 'draft'));
        $published = count(array_filter($allNews, fn($n) => strtolower($n['status']) === 'published'));

        return [
            'total_berita' => 6, // Sesuai Frame 42: 6
            'berita_draft' => 2, // Sesuai Frame 42: 2
            'berita_published' => 4, // Sesuai Frame 42: 4
            'monthly_total' => [
                'Mei' => 1,
                'Des' => 5,
            ],
            'monthly_published' => [
                'Des' => 4,
            ],
        ];
    }

    public function getAllNews(): array
    {
        if (!session()->has(self::SESSION_NEWS)) {
            session()->put(self::SESSION_NEWS, [
                [
                    'id' => 1,
                    'title' => 'Hujan Deras di Manado, Warga Diminta Waspada Terhadap Genangan',
                    'category' => 'Bencana Alam',
                    'excerpt' => 'Badan Penanggulangan Bencana Daerah (BPBD) Kota Manado mengimbau masyarakat untuk tetap waspada terhadap potensi...',
                    'content' => "Badan Penanggulangan Bencana Daerah (BPBD) Kota Manado mengimbau masyarakat untuk tetap waspada terhadap potensi genangan akibat hujan deras yang terjadi pada siang hingga sore hari.\n\nKepala BPBD Kota Manado menyampaikan bahwa curah hujan yang tinggi dapat menyebabkan peningkatan debit air di beberapa titik, terutama di wilayah rawan banjir. Warga diimbau untuk selalu memantau informasi terkini dan menghindari aktivitas di sekitar sungai serta daerah rendah.",
                    'date' => '29 Sep 2026, 14:32',
                    'updated_at' => '29 Sep 2026, 16:45',
                    'image' => 'https://images.unsplash.com/photo-1515694346937-94d85e41e6f0?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
                [
                    'id' => 2,
                    'title' => 'Longsor di Jalur Trans Sulawesi, Akses Sementara Dibuka Satu Jalur',
                    'category' => 'Bencana Alam',
                    'excerpt' => 'Tim gabungan BPBD, TNI, dan warga telah melakukan pembersihan material longsor di jalur Trans Sulawesi, tepatnya di Desa...',
                    'content' => 'Tim gabungan BPBD, TNI, dan warga telah melakukan pembersihan material longsor di jalur Trans Sulawesi, tepatnya di Desa Sukamaju. Akses jalan sementara diberlakukan sistem buka-tutup satu arah.',
                    'date' => '28 Sep 2026, 16:20',
                    'updated_at' => '28 Sep 2026, 17:00',
                    'image' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
                [
                    'id' => 3,
                    'title' => 'Posko Pengungsian di Manado Mulai Terisi',
                    'category' => 'Bencana Alam',
                    'excerpt' => 'Sejumlah warga yang terdampak banjir mulai mengungsi ke posko sementara yang telah disiapkan oleh pemerintah kota...',
                    'content' => 'Sejumlah warga yang terdampak banjir di Kelurahan Ranotana mulai mengungsi ke posko sementara gereja dan balai serbaguna yang telah difasilitasi BPBD.',
                    'date' => '27 Sep 2026, 19:45',
                    'updated_at' => '27 Sep 2026, 20:10',
                    'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
                [
                    'id' => 4,
                    'title' => 'BMKG: Gelombang di Perairan Manado Masih Aman',
                    'category' => 'Peringatan Dini',
                    'excerpt' => 'Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) menginformasikan bahwa kondisi gelombang di perairan Manado masih dalam batas aman...',
                    'content' => 'Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) menginformasikan bahwa kondisi gelombang di perairan Manado dan pesisir Bunaken masih berkisar antara 0.5 hingga 1.25 meter (kategori aman).',
                    'date' => '26 Sep 2026, 11:10',
                    'updated_at' => '26 Sep 2026, 11:30',
                    'image' => 'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
                [
                    'id' => 5,
                    'title' => 'Sosialisasi Jalur Evakuasi Tsunami di Wilayah Megamas',
                    'category' => 'Informasi Umum',
                    'excerpt' => 'BPBD Kota Manado menggelar simulasi dan penandaan plang rute evakuasi vertikal di kawasan pusat niaga Megamas...',
                    'content' => 'Kawasan Megamas Manado dipasangi petunjuk rute evakuasi baru guna mempercepat evakuasi menuju perbukitan saat terjadi peringatan tsunami.',
                    'date' => '15 Sep 2026, 09:00',
                    'updated_at' => '15 Sep 2026, 12:00',
                    'image' => 'https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Published',
                ],
                [
                    'id' => 6,
                    'title' => 'Pembersihan Sampah dan Sedimentasi di Muara Sungai Sawangan',
                    'category' => 'Bencana Alam',
                    'excerpt' => 'Dinas Lingkungan Hidup bersama relawan membersihkan puluhan ton sampah muara sungai...',
                    'content' => 'Kegiatan pembersihan dilakukan untuk mengurangi risiko backwater saat pasang laut bertemu dengan debit hujan lebat hulu sungai.',
                    'date' => '10 Sep 2026, 08:30',
                    'updated_at' => '10 Sep 2026, 11:45',
                    'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Published',
                ],
            ]);
        }

        return session()->get(self::SESSION_NEWS, []);
    }

    public function getDraftNews(?string $query = null): array
    {
        $all = $this->getAllNews();
        $drafts = array_values(array_filter($all, fn($n) => strtolower($n['status']) === 'draft'));

        if ($query) {
            $q = strtolower(trim($query));
            $drafts = array_values(array_filter($drafts, function ($n) use ($q) {
                return str_contains(strtolower($n['title']), $q) || str_contains(strtolower($n['excerpt']), $q);
            }));
        }

        return $drafts;
    }

    public function findNews(int $id): ?array
    {
        $news = $this->getAllNews();
        foreach ($news as $n) {
            if ($n['id'] === $id) {
                return $n;
            }
        }
        return null;
    }

    public function updateNews(int $id, array $data): bool
    {
        $news = $this->getAllNews();
        $found = false;

        foreach ($news as &$item) {
            if ($item['id'] === $id) {
                $item['title'] = $data['title'] ?? $item['title'];
                $item['category'] = $data['category'] ?? $item['category'];
                $item['content'] = $data['content'] ?? $item['content'];
                $item['excerpt'] = mb_substr(strip_tags($item['content']), 0, 110) . '...';
                $item['date'] = $data['date'] ?? $item['date'];
                $item['updated_at'] = date('d M Y, H:i');
                if (!empty($data['image'])) {
                    $item['image'] = $data['image'];
                }
                if (!empty($data['status'])) {
                    $item['status'] = $data['status'];
                }
                $found = true;
                break;
            }
        }

        if ($found) {
            session()->put(self::SESSION_NEWS, $news);
        }

        return $found;
    }

    public function publishNews(int $id): bool
    {
        return $this->updateNews($id, ['status' => 'Published']);
    }

    public function deleteNews(int $id): bool
    {
        $news = $this->getAllNews();
        $filtered = array_values(array_filter($news, fn($n) => $n['id'] !== $id));

        if (count($filtered) !== count($news)) {
            session()->put(self::SESSION_NEWS, $filtered);
            return true;
        }

        return false;
    }

    public function getAllFeedbacks(): array
    {
        if (!session()->has(self::SESSION_FEEDBACKS)) {
            session()->put(self::SESSION_FEEDBACKS, [
                [
                    'id' => 'FB-01',
                    'name' => 'Nama Pengguna',
                    'email' => 'emailpengguna@gmail.com',
                    'description' => 'Deskripsi feedback. lorem ipsum dolor sit amet',
                    'submitted_at' => 'Tanggal di submit',
                ],
                [
                    'id' => 'FB-02',
                    'name' => 'Nama Pengguna',
                    'email' => 'emailpengguna@gmail.com',
                    'description' => 'Deskripsi feedback. lorem ipsum dolor sit amet',
                    'submitted_at' => 'Tanggal di submit',
                ],
                [
                    'id' => 'FB-03',
                    'name' => 'Haikal Mokodompit',
                    'email' => 'haikal.mkd@gmail.com',
                    'description' => 'Tampilan peta sebaran banjir sangat cepat dan akurat. Tolong pertahankan respon cepat verifikasi laporan.',
                    'submitted_at' => '12 Nov 2026, 09:20 WITA',
                ],
                [
                    'id' => 'FB-04',
                    'name' => 'Gracia Sondakh',
                    'email' => 'gracia.sndkh@gmail.com',
                    'description' => 'Sistem pelaporan darurat sangat membantu warga Malalayang saat terjadi longsor kemarin.',
                    'submitted_at' => '15 Nov 2026, 14:10 WITA',
                ],
            ]);
        }

        return session()->get(self::SESSION_FEEDBACKS, []);
    }

    public function getAllMitigations(?string $query = null): array
    {
        if (!session()->has(self::SESSION_MITIGATIONS)) {
            session()->put(self::SESSION_MITIGATIONS, [
                [
                    'id' => 1,
                    'title' => 'Rencana Kontinjensi Gempa Bumi Wilayah Manado - Bab II (Mitigasi Struktural)',
                    'excerpt' => 'Dokumen ini merinci langkah-langkah perkuatan bangunan dan infrastruktur publik di zona risiko tinggi...',
                    'date' => '25 Oct 2026, 11:30',
                    'image' => 'https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
                [
                    'id' => 2,
                    'title' => 'Pedoman Evakuasi Mandiri Erupsi Gunung Soputan',
                    'excerpt' => 'Panduan ini memuat rute evakuasi terdekat dan lokasi posko pengungsian aman bagi warga di kaki gunung...',
                    'date' => '24 Oct 2026, 09:15',
                    'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
                [
                    'id' => 3,
                    'title' => 'Draft Pemetaan Daerah Rawan Tsunami (Skala 1:10,000)',
                    'excerpt' => 'Peta tematik yang mengidentifikasi radius genangan tsunami berdasarkan model simulasi terbaru...',
                    'date' => '22 Oct 2026, 14:45',
                    'image' => 'https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
                [
                    'id' => 4,
                    'title' => 'Usulan Pemasangan Early Warning System (EWS) Longsor Baru',
                    'excerpt' => 'Rekomendasi teknis untuk jenis sensor dan lokasi pemasangan optimal di lereng bukit rawan...',
                    'date' => '20 Oct 2026, 08:30',
                    'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1000&q=80',
                    'status' => 'Draft',
                ],
            ]);
        }

        $list = session()->get(self::SESSION_MITIGATIONS, []);

        if ($query) {
            $q = strtolower(trim($query));
            $list = array_values(array_filter($list, function ($m) use ($q) {
                return str_contains(strtolower($m['title']), $q) || str_contains(strtolower($m['excerpt']), $q);
            }));
        }

        return $list;
    }

    public function publishMitigation(int $id): bool
    {
        $list = $this->getAllMitigations();
        foreach ($list as &$item) {
            if ($item['id'] === $id) {
                $item['status'] = 'Published';
                session()->put(self::SESSION_MITIGATIONS, $list);
                return true;
            }
        }
        return false;
    }

    public function deleteMitigation(int $id): bool
    {
        $list = $this->getAllMitigations();
        $filtered = array_values(array_filter($list, fn($m) => $m['id'] !== $id));
        if (count($filtered) !== count($list)) {
            session()->put(self::SESSION_MITIGATIONS, $filtered);
            return true;
        }
        return false;
    }
}
