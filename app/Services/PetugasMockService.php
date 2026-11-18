<?php

namespace App\Services;

class PetugasMockService
{
    private const SESSION_OFFICER = 'siagamanado_petugas_profile';
    private const SESSION_ASSIGNMENTS = 'siagamanado_petugas_assignments';
    private const SESSION_LEAVES = 'siagamanado_petugas_leaves';
    private const SESSION_NOTIFICATIONS = 'siagamanado_petugas_notifications';

    public function getOfficerProfile(): array
    {
        if (!session()->has(self::SESSION_OFFICER)) {
            session()->put(self::SESSION_OFFICER, [
                'id' => 'ptg-001',
                'name' => 'Karel Sumilat',
                'badgeStatus' => 'Aktif Siaga',
                'readinessStatus' => 'Siap Tugas',
                'team' => 'Regu Alfa',
                'teamCount' => '4 Petugas',
                'commandPost' => 'Posko Komando Tikala',
                'shiftTime' => '08:00 - 20:00 WITA',
                'radioChannel' => 'Kanal 04 TRC Siaga',
                'radioCheckedIn' => false,
            ]);
        }

        return session()->get(self::SESSION_OFFICER);
    }

    public function toggleRadioCheckIn(): array
    {
        $officer = $this->getOfficerProfile();
        $officer['radioCheckedIn'] = !$officer['radioCheckedIn'];
        session()->put(self::SESSION_OFFICER, $officer);

        return $officer;
    }

    public function getWeatherAndEarlyWarning(): array
    {
        return [
            'authority' => 'BMKG MANADO',
            'temperature' => '26°C',
            'condition' => 'Hujan Intensitas Lebat',
            'windSpeed' => '28 km/jam BD',
            'humidity' => '94%',
            'riverStatus' => 'DAS Tondano: Siaga 2',
            'warnings' => [
                [
                    'type' => 'danger',
                    'title' => 'DAS Tondano & Mahasikok',
                    'description' => 'Waspada kenaikan debit air kiriman dari Minahasa. Pintu air Dendengan Dalam dipantau berkala.',
                ],
                [
                    'type' => 'info',
                    'title' => 'Pasang Air Laut Teluk Manado',
                    'description' => 'Puncak pasang laut diperkirakan 1.8m pada pukul 16:45 WITA, potensi rob pesisir Malalayang.',
                ],
            ],
        ];
    }

    public function getInitialAssignments(): array
    {
        return [
            [
                'id' => 'DISP-2024-092',
                'dispatchCode' => '#DISP-2024-092',
                'dashboardCode' => 'DISPATCH #TRC-MND-0492 • 15 MENIT LALU',
                'priority' => 'Prioritas: Tinggi',
                'priorityShort' => 'Prioritas Tinggi',
                'priorityLevel' => 'high',
                'timeAgo' => '15 Menit yang lalu',
                'title' => 'Banjir Luapan Sungai Mahasikok',
                'disasterType' => 'Banjir',
                'locationShort' => 'Kec. Tuminting, Lingkungan 3',
                'locationFull' => 'Jl. Hasanuddin, Lingkungan 4, Kel. Tuminting',
                'locationDetailHeader' => 'Kec. Tuminting, Lingkungan 4, Kota Manado',
                'zoneTag' => 'Zona Merah Hidrometeorologi',
                'team' => 'Tim: Regu Alfa (4 Petugas)',
                'partnerName' => 'Andi Pratama, S.Tr',
                'partnerRole' => '(Koordinator TRC Unit 1)',
                'status' => 'Menunggu Verifikasi Petugas',
                'statusBadgeDetail' => 'Menunggu Verifikasi',
                'statusKey' => 'menunggu_verifikasi',
                'summaryDashboard' => 'Ketinggian air mencapai 60–90 cm di pemukiman warga. Perlu evakuasi lansia dan balita di Lingkungan 3, serta penyisiran jalur...',
                'summaryList' => 'Evakuasi 6 KK warga lansia dan anak-anak terdampak luapan sungai setinggi ~60cm ke balai kelurahan. Koordinasi dengan Kepala Lingkungan 4.',
                'descriptionDetail' => 'Hujan lebat intensitas tinggi menyebabkan debit air Sungai Mahasikok meluap ke permukiman warga setinggi 60 cm dengan arus cukup deras akibat saluran drainase tersumbat. Dibutuhkan evakuasi segera untuk warga rentan.',
                'reporterName' => 'Gabriella Sondakh',
                'reporterPhone' => '0812-4421-9980',
                'incidentDate' => '24 Oktober 2024',
                'incidentTime' => '08:50 WITA',
                'reportDate' => '24 Oktober 2024',
                'reportTime' => '09:15 WITA (Tervalidasi)',
                'imageUrl' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1000&q=80',
                'fieldLocationOverlay' => 'Jl. Pogidon, Tuminting, Manado',
                'fieldStatusOverlay' => 'Darurat Banjir',
                'fieldPriorityOverlay' => 'Tinggi',
                'fieldVictimsOverlay' => '5 KK Terdahulu',
                'fieldFooterAddress' => 'Jl. Hasanuddin Lr. 4, Tuminting',
                'fieldVerifiedBy' => 'Terverifikasi Pusdalops',
                'latitude' => 1.5038,
                'longitude' => 124.8452,
                'instructions' => [
                    'Lakukan evakuasi prioritas 6 KK (lansia & balita) di sempadan sungai ke tempat aman.',
                    'Aktivasi posko darurat sementara dan titik kumpul di Balai Pertemuan Lingkungan 4.',
                    'Koordinasi langsung dengan Kepala Lingkungan 4 (Bpk. Robert Kaunang - 0811-432-889).',
                ],
            ],
            [
                'id' => 'DISP-2024-088',
                'dispatchCode' => '#DISP-2024-088',
                'dashboardCode' => 'DISPATCH #TRC-MND-0488 • HARI INI, 07:15 WITA',
                'priority' => 'Prioritas: Sedang',
                'priorityShort' => 'Prioritas Sedang',
                'priorityLevel' => 'medium',
                'timeAgo' => 'Hari ini, 07:15 WITA',
                'title' => 'Pembersihan Longsor Tebing',
                'disasterType' => 'Longsor',
                'locationShort' => 'Kel. Malalayang Satu Barat, Lingkungan 2',
                'locationFull' => 'Kel. Malalayang Satu Barat, Lingkungan 2',
                'locationDetailHeader' => 'Kel. Malalayang Satu Barat, Lingkungan 2, Kota Manado',
                'zoneTag' => null,
                'team' => 'Tim: Regu Alfa (4 Petugas)',
                'partnerName' => 'Hendrik Kalalo',
                'partnerRole' => '(Operator Alat & Logistik TRC)',
                'status' => 'Sedang Ditangani',
                'statusBadgeDetail' => 'Sedang Ditangani',
                'statusKey' => 'sedang_ditangani',
                'summaryDashboard' => 'Pembersihan material tanah longsor yang menutupi separuh akses jalan lingkungan warga. Unit cangkul dan pompa air telah dimobilisasi.',
                'summaryList' => 'Pembersihan material tanah longsor yang menutupi separuh akses jalan lingkungan warga. Unit cangkul dan pompa air telah dimobilisasi.',
                'descriptionDetail' => 'Tebing tanah setinggi 4 meter di sisi jalan lingkungan mengalami longsor pasca hujan semalam dan menutup separuh badan jalan. Tidak ada korban jiwa, namun akses kendaraan roda empat terhambat.',
                'reporterName' => 'Ronald Mokoginta',
                'reporterPhone' => '0813-5501-2219',
                'incidentDate' => '24 Oktober 2024',
                'incidentTime' => '06:30 WITA',
                'reportDate' => '24 Oktober 2024',
                'reportTime' => '06:50 WITA (Tervalidasi)',
                'imageUrl' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=1000&q=80',
                'fieldLocationOverlay' => 'Malalayang Satu Barat, Lingk. 2',
                'fieldStatusOverlay' => 'Penanganan Material',
                'fieldPriorityOverlay' => 'Sedang',
                'fieldVictimsOverlay' => 'Nihil (Akses Jalan)',
                'fieldFooterAddress' => 'Jl. Sea Malalayang Lrg. 2',
                'fieldVerifiedBy' => 'Terverifikasi Pusdalops',
                'latitude' => 1.4541,
                'longitude' => 124.8095,
                'instructions' => [
                    'Pasang rambu kerucut pengaman (traffic cone) di kedua arah jalur terdampak.',
                    'Bersihkan material lumpur dan batu menggunakan unit cangkul serta semprotan pompa air.',
                    'Pastikan drainase tepi tebing tidak tersumbat sebelum tim meninggalkan lokasi.',
                ],
            ],
            [
                'id' => 'DISP-2024-085',
                'dispatchCode' => '#DISP-2024-085',
                'dashboardCode' => 'DISPATCH #TRC-MND-0485 • HARI INI, 07:15 WITA',
                'priority' => 'Prioritas: Sedang',
                'priorityShort' => 'Prioritas Sedang',
                'priorityLevel' => 'medium',
                'timeAgo' => 'Hari ini, 07:15 WITA',
                'title' => 'Pembersihan Longsor Tebing',
                'disasterType' => 'Longsor',
                'locationShort' => 'Kel. Malalayang Satu Barat, Lingkungan 2',
                'locationFull' => 'Kel. Malalayang Satu Barat, Lingkungan 2',
                'locationDetailHeader' => 'Kel. Malalayang Satu Barat, Lingkungan 2, Kota Manado',
                'zoneTag' => null,
                'team' => 'Tim: Regu Alfa (4 Petugas)',
                'partnerName' => 'Hendrik Kalalo',
                'partnerRole' => '(Operator Alat & Logistik TRC)',
                'status' => 'Sedang Ditangani',
                'statusBadgeDetail' => 'Sedang Ditangani',
                'statusKey' => 'sedang_ditangani',
                'summaryDashboard' => 'Pembersihan material tanah longsor yang menutupi separuh akses jalan lingkungan warga. Unit cangkul dan pompa air telah dimobilisasi.',
                'summaryList' => 'Pembersihan material tanah longsor yang menutupi separuh akses jalan lingkungan warga. Unit cangkul dan pompa air telah dimobilisasi.',
                'descriptionDetail' => 'Penanganan lanjutan pembersihan sisa material tanah dan dahan pohon tumbang pada bahu jalan lingkungan di Kelurahan Malalayang Satu Barat.',
                'reporterName' => 'Yuliana Mandagi',
                'reporterPhone' => '0852-4011-7782',
                'incidentDate' => '24 Oktober 2024',
                'incidentTime' => '06:45 WITA',
                'reportDate' => '24 Oktober 2024',
                'reportTime' => '07:05 WITA (Tervalidasi)',
                'imageUrl' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=1000&q=80',
                'fieldLocationOverlay' => 'Malalayang Satu Barat, Lingk. 2',
                'fieldStatusOverlay' => 'Penanganan Material',
                'fieldPriorityOverlay' => 'Sedang',
                'fieldVictimsOverlay' => 'Nihil',
                'fieldFooterAddress' => 'Kel. Malalayang Satu Barat, Lingkungan 2',
                'fieldVerifiedBy' => 'Terverifikasi Pusdalops',
                'latitude' => 1.4541,
                'longitude' => 124.8095,
                'instructions' => [
                    'Koordinasi dengan aparat kelurahan untuk pengangkutan sisa batang pohon.',
                    'Laporkan dokumentasi akhir ke Pusdalops setelah akses jalan 100% normal.',
                ],
            ],
        ];
    }

    public function getAllAssignments(): array
    {
        if (!session()->has(self::SESSION_ASSIGNMENTS)) {
            session()->put(self::SESSION_ASSIGNMENTS, $this->getInitialAssignments());
        }

        return session()->get(self::SESSION_ASSIGNMENTS, []);
    }

    public function getAssignmentById(string $id): ?array
    {
        foreach ($this->getAllAssignments() as $item) {
            if (strtolower($item['id']) === strtolower($id) || strtolower($item['dispatchCode']) === strtolower('#' . ltrim($id, '#'))) {
                return $item;
            }
        }
        return null;
    }

    public function acceptAssignment(string $id): ?array
    {
        $assignments = $this->getAllAssignments();
        $found = null;

        foreach ($assignments as &$item) {
            if (strtolower($item['id']) === strtolower($id)) {
                $item['status'] = 'Sedang Ditangani';
                $item['statusBadgeDetail'] = 'Sedang Ditangani';
                $item['statusKey'] = 'sedang_ditangani';
                $found = $item;
                break;
            }
        }

        if ($found) {
            session()->put(self::SESSION_ASSIGNMENTS, $assignments);
        }

        return $found;
    }

    public function getInitialNotifications(): array
    {
        return [
            [
                'id' => 'notif-001',
                'badgeText' => 'URGENT DISPATCH',
                'badgeType' => 'urgent',
                'code' => '#DISP-2024-092',
                'assignmentId' => 'DISP-2024-092',
                'category' => 'penugasan_baru',
                'isUnread' => true,
                'title' => 'Penugasan Baru Diterbitkan: Banjir Luapan Sungai Mahasikok',
                'summary' => 'Admin BPBD telah menetapkan Anda ke Tim Reaksi Cepat untuk penanganan banjir di Kec. Tuminting. Perahu karet dan logistik evakuasi...',
                'timeText' => '10 Menit yang lalu • 24 Okt 2024, 09:30 WITA',
                'actionLabel' => 'Buka Detail',
                'detail' => [
                    'priorityBadge' => 'Prioritas Mendesak',
                    'code' => '#DISP-2024-092',
                    'headerTitle' => 'Detail Pemberitahuan Penugasan Baru',
                    'imageUrl' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=900&q=80',
                    'imageLocation' => 'DAS Sungai Mahasikok, Tuminting',
                    'imageWaterLevel' => 'Debit Air: +1.4m Waspada',
                    'disasterType' => 'Banjir Luapan Sungai Mahasikok',
                    'locationDistrict' => 'Kecamatan Tuminting',
                    'locationSub' => 'Lingkungan 4, Kota Manado',
                    'assignedTime' => '24 Okt 2024, 09:30 WITA',
                    'issuedBy' => 'Posko Induk Tikala',
                    'instruction' => 'Segera lakukan evakuasi warga terdampak di 6 rumah bantaran sungai dan koordinasikan penempatan perahu karet TRC. Dirikan pos pantau ketinggian muka air darurat.',
                    'unitTag' => 'Unit 1 TRC Tanggap',
                    'equipmentTag' => '2 Perahu Karet Siaga',
                ],
            ],
            [
                'id' => 'notif-002',
                'badgeText' => 'ADMINISTRASI KELENGKAPAN',
                'badgeType' => 'admin',
                'code' => null,
                'assignmentId' => null,
                'category' => 'izin',
                'isUnread' => true,
                'title' => 'Pengajuan Izin Disetujui',
                'summary' => 'Admin BPBD Posko Induk telah menyetujui formulir permohonan dinas luar/izin Anda untuk tanggal 12–13 Sep 2024 (Surat Keterangan No:...',
                'timeText' => 'Kemarin, 16:40 WITA',
                'actionLabel' => 'Lihat Berkas',
                'detail' => [
                    'priorityBadge' => 'Administrasi Personil',
                    'code' => '#IZIN-2024-019',
                    'headerTitle' => 'Detail Persetujuan Izin Petugas',
                    'imageUrl' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=900&q=80',
                    'imageLocation' => 'Posko Induk BPBD Manado',
                    'imageWaterLevel' => 'Status: Disetujui',
                    'disasterType' => 'Permohonan Izin Keluarga / Dinas',
                    'locationDistrict' => 'Administrasi SDM TRC',
                    'locationSub' => 'Posko Komando Tikala',
                    'assignedTime' => 'Kemarin, 16:40 WITA',
                    'issuedBy' => 'Admin BPBD Posko Induk',
                    'instruction' => 'Permohonan izin Anda telah disetujui. Selama masa izin berlangsung, tugas lapangan dialihkan sementara kepada personil cadangan Regu Alfa.',
                    'unitTag' => 'Regu Alfa TRC',
                    'equipmentTag' => 'SK Izin Terlampir',
                ],
            ],
            [
                'id' => 'notif-003',
                'badgeText' => 'OPERASI SELESAI',
                'badgeType' => 'done',
                'code' => '#DISP-2024-081',
                'assignmentId' => 'DISP-2024-088',
                'category' => 'penugasan_baru',
                'isUnread' => false,
                'title' => 'Status Laporan Telah Selesai: Longsor Ranomuut',
                'summary' => 'Operasi tanggap darurat telah ditutup oleh Admin BPBD. Laporan akhir kaji cepat dan pembersihan material jalan telah disetujui. Terima kasih...',
                'timeText' => '20 Okt 2024, 18:00 WITA',
                'actionLabel' => 'Arsip #DISP-2024-081',
                'detail' => [
                    'priorityBadge' => 'Operasi Selesai',
                    'code' => '#DISP-2024-081',
                    'headerTitle' => 'Arsip Penutupan Operasi Lapangan',
                    'imageUrl' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=900&q=80',
                    'imageLocation' => 'Kel. Ranomuut, Kec. Paal Dua',
                    'imageWaterLevel' => 'Akses Jalan: 100% Normal',
                    'disasterType' => 'Longsor Tebing Jalan Ranomuut',
                    'locationDistrict' => 'Kecamatan Paal Dua',
                    'locationSub' => 'Kelurahan Ranomuut, Kota Manado',
                    'assignedTime' => '20 Okt 2024, 18:00 WITA',
                    'issuedBy' => 'Pusdalops BPBD Manado',
                    'instruction' => 'Seluruh rangkaian evakuasi material longsor telah dinyatakan selesai dan terverifikasi. Peralatan operasional telah dikembalikan ke gudang logistik.',
                    'unitTag' => 'Unit Gabungan TRC',
                    'equipmentTag' => 'Operasi Ditutup',
                ],
            ],
            [
                'id' => 'notif-004',
                'badgeText' => 'EDUKASI & PROTOKOL',
                'badgeType' => 'info',
                'code' => null,
                'assignmentId' => null,
                'category' => 'info',
                'isUnread' => false,
                'title' => 'Pembaruan SOP Tanggap Darurat BMKG Musim Hujan 2024',
                'summary' => 'Panduan koordinasi posko terpadu lintas sektor untuk peringatan dini cuaca ekstrem dan prosedur evakuasi malam hari...',
                'timeText' => '18 Okt 2024',
                'actionLabel' => 'Dokumen SOP v2.4',
                'detail' => [
                    'priorityBadge' => 'Protokol Resmi',
                    'code' => 'SOP-TRC-v2.4',
                    'headerTitle' => 'Pembaruan SOP Tanggap Darurat 2024',
                    'imageUrl' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
                    'imageLocation' => 'Seluruh Sektor Kota Manado',
                    'imageWaterLevel' => 'Berlaku Efektif',
                    'disasterType' => 'Protokol Hidrometeorologi Basah',
                    'locationDistrict' => 'Seluruh Kecamatan',
                    'locationSub' => 'Kota Manado',
                    'assignedTime' => '18 Okt 2024, 08:00 WITA',
                    'issuedBy' => 'Kepala Pelaksana BPBD',
                    'instruction' => 'Setiap regu piket wajib melakukan pengecekan radio komunikasi setiap 2 jam dan memastikan kesiapan perahu karet sebelum pergantian shift.',
                    'unitTag' => 'Seluruh Regu TRC',
                    'equipmentTag' => 'Dokumen SOP v2.4',
                ],
            ],
        ];
    }

    public function getNotifications(): array
    {
        if (!session()->has(self::SESSION_NOTIFICATIONS)) {
            session()->put(self::SESSION_NOTIFICATIONS, $this->getInitialNotifications());
        }

        return session()->get(self::SESSION_NOTIFICATIONS, []);
    }

    public function markNotificationRead(string $id): void
    {
        $list = $this->getNotifications();
        foreach ($list as &$n) {
            if ($n['id'] === $id) {
                $n['isUnread'] = false;
                break;
            }
        }
        session()->put(self::SESSION_NOTIFICATIONS, $list);
    }

    public function markAllNotificationsRead(): void
    {
        $list = $this->getNotifications();
        foreach ($list as &$n) {
            $n['isUnread'] = false;
        }
        session()->put(self::SESSION_NOTIFICATIONS, $list);
    }

    public function getLeaveTypes(): array
    {
        return [
            'Izin Keluarga',
            'Izin Sakit / Medis',
            'Dinas Luar / Pelatihan SAR',
            'Cuti Tahunan Personil',
        ];
    }

    public function getLeaveRequests(): array
    {
        if (!session()->has(self::SESSION_LEAVES)) {
            session()->put(self::SESSION_LEAVES, [
                [
                    'id' => 'IZIN-2024-019',
                    'leaveType' => 'Izin Keluarga',
                    'startDate' => '2024-09-12',
                    'endDate' => '2024-09-13',
                    'reason' => 'Menghadiri kegiatan keluarga inti di Minahasa Utara.',
                    'status' => 'Disetujui',
                    'createdAt' => '10 Sep 2024',
                ],
            ]);
        }

        return session()->get(self::SESSION_LEAVES, []);
    }

    public function submitLeaveRequest(array $payload): array
    {
        $list = $this->getLeaveRequests();

        $newLeave = [
            'id' => 'IZIN-' . date('Y') . '-' . rand(100, 999),
            'leaveType' => $payload['leave_type'],
            'startDate' => $payload['start_date'],
            'endDate' => $payload['end_date'],
            'reason' => trim($payload['reason']),
            'status' => 'Menunggu Persetujuan',
            'createdAt' => date('d M Y, H:i') . ' WITA',
        ];

        array_unshift($list, $newLeave);
        session()->put(self::SESSION_LEAVES, $list);

        return $newLeave;
    }
}
