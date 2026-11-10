<?php

namespace App\Services;

class ReportMockService
{
    private const SESSION_KEY = 'siagamanado_user_reports';

    public function getDisasterTypes(): array
    {
        return [
            ['id' => 'Banjir', 'label' => 'Banjir & Genangan Air'],
            ['id' => 'Longsor', 'label' => 'Tanah Longsor'],
            ['id' => 'Gempa', 'label' => 'Gempa Bumi'],
            ['id' => 'Cuaca Ekstrem', 'label' => 'Cuaca Ekstrem & Angin Kencang'],
            ['id' => 'Gelombang Tinggi', 'label' => 'Gelombang Tinggi / Abrasi Pesisir'],
            ['id' => 'Kebakaran', 'label' => 'Kebakaran Pemukiman / Lahan'],
        ];
    }

    public function getInitialReports(): array
    {
        return [
            [
                'id' => 'RPT-20250527-001',
                'title' => 'Genangan Air Meluap di Tikala Baru',
                'reporterId' => 'usr-001',
                'reporterName' => 'Muhammad Haikal',
                'phone' => '081234567890',
                'disasterType' => 'Banjir',
                'disasterCategoryLabel' => 'Banjir & Genangan Air',
                'incidentDate' => '2025-05-27',
                'incidentTime' => '14:52',
                'createdAt' => '2025-05-27 14:52:00',
                'displayDate' => '27 Mei 2025',
                'location' => 'Jl. Jenderal Sudirman No. 12, Tikala Baru, Kec. Tikala, Kota Manado',
                'district' => 'Tikala',
                'latitude' => 1.4848,
                'longitude' => 124.8542,
                'coordinates' => '1.4848° N, 124.8542° E (Wilayah Sektor Tikala)',
                'description' => 'Air sungai Tondano mulai masuk pemukiman warga setinggi 40cm. Warga sekitar sudah mulai memindahkan barang elektronik ke tempat lebih tinggi.',
                'photoUrl' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=900&q=80',
                'photoName' => 'bukti_banjir_tikala_27052025.jpg',
                'photoSize' => '2.4 MB',
                'mediaList' => [
                    [
                        'type' => 'image',
                        'url' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=900&q=80',
                        'name' => 'bukti_banjir_tikala_27052025.jpg',
                        'size' => '2.4 MB',
                    ]
                ],
                'status' => 'menunggu',
            ],
            [
                'id' => 'RPT-20250520-002',
                'title' => 'Longsoran Tebing di Akses Jalan Ring Road',
                'reporterId' => 'usr-001',
                'reporterName' => 'Muhammad Haikal',
                'phone' => '081234567890',
                'disasterType' => 'Longsor',
                'disasterCategoryLabel' => 'Tanah Longsor',
                'incidentDate' => '2025-05-20',
                'incidentTime' => '08:15',
                'createdAt' => '2025-05-20 08:15:00',
                'displayDate' => '20 Mei 2025',
                'location' => 'Jalur Singkil – Ring Road, Kec. Singkil, Kota Manado',
                'district' => 'Singkil',
                'latitude' => 1.5034,
                'longitude' => 124.8612,
                'coordinates' => '1.5034° N, 124.8612° E (Wilayah Sektor Singkil)',
                'description' => 'Material tanah dan batu dari lereng bukit menutup sebagian bahu jalan pasca hujan deras semalam. Mohon penanganan agar tidak menghambat arus lalu lintas.',
                'photoUrl' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=900&q=80',
                'photoName' => 'bukti_longsor_ringroad_20052025.jpg',
                'photoSize' => '1.8 MB',
                'mediaList' => [
                    [
                        'type' => 'image',
                        'url' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=900&q=80',
                        'name' => 'bukti_longsor_ringroad_20052025.jpg',
                        'size' => '1.8 MB',
                    ]
                ],
                'status' => 'menunggu',
            ],
        ];
    }

    public function getAllReports(): array
    {
        if (!session()->has(self::SESSION_KEY)) {
            session()->put(self::SESSION_KEY, $this->getInitialReports());
        }

        return session()->get(self::SESSION_KEY, []);
    }

    public function getMyReports(string $userId = 'usr-001'): array
    {
        $all = $this->getAllReports();
        return array_values(array_filter($all, fn ($r) => $r['reporterId'] === $userId));
    }

    public function createReport(array $payload, array $currentUser): array
    {
        $all = $this->getAllReports();
        $types = $this->getDisasterTypes();

        $disasterType = $payload['disaster_type'] ?? 'Banjir';
        $disasterCategoryLabel = $disasterType;

        foreach ($types as $t) {
            if ($t['id'] === $disasterType || $t['label'] === $disasterType) {
                $disasterType = $t['id'];
                $disasterCategoryLabel = $t['label'];
                break;
            }
        }

        $datePart = $payload['incident_date'] ?? date('Y-m-d');
        $timePart = $payload['incident_time'] ?? date('H:i');

        $location = trim($payload['location']);
        $shortLocation = explode(',', $location)[0] ?: $location;

        $mediaList = $payload['media_list'] ?? [];
        $firstMedia = $mediaList[0] ?? [
            'type' => 'image',
            'url' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=900&q=80',
            'name' => 'dokumentasi_bencana.jpg',
            'size' => '1.5 MB',
        ];

        $lat = isset($payload['latitude']) ? (float) $payload['latitude'] : 1.4822;
        $lng = isset($payload['longitude']) ? (float) $payload['longitude'] : 124.8489;

        $newReport = [
            'id' => 'RPT-' . date('Ymd') . '-' . rand(100, 999),
            'title' => 'Laporan ' . $disasterType . ' di ' . $shortLocation,
            'reporterId' => $currentUser['id'],
            'reporterName' => $currentUser['name'],
            'phone' => trim($payload['phone'] ?? $currentUser['phone']),
            'disasterType' => $disasterType,
            'disasterCategoryLabel' => $disasterCategoryLabel,
            'incidentDate' => $datePart,
            'incidentTime' => $timePart,
            'createdAt' => $datePart . ' ' . $timePart . ':00',
            'displayDate' => $this->formatIndonesianDate($datePart),
            'location' => $location,
            'district' => 'Manado',
            'latitude' => $lat,
            'longitude' => $lng,
            'coordinates' => ($payload['coordinates'] ?? sprintf('%.4f° N, %.4f° E', $lat, $lng)) . ' (Wilayah Sektor Terkait)',
            'description' => trim($payload['description']),
            'photoUrl' => $firstMedia['url'],
            'photoName' => $firstMedia['name'],
            'photoSize' => $firstMedia['size'],
            'mediaList' => $mediaList,
            'status' => 'menunggu',
        ];

        array_unshift($all, $newReport);
        session()->put(self::SESSION_KEY, $all);

        return $newReport;
    }

    private function formatIndonesianDate(string $dateStr): string
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $parts = explode('-', $dateStr);
        if (count($parts) !== 3) {
            return $dateStr;
        }
        $year = $parts[0];
        $month = (int) $parts[1];
        $day = (int) $parts[2];

        return $day . ' ' . ($months[$month] ?? 'Mei') . ' ' . $year;
    }
}
