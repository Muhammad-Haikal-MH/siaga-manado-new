<?php

namespace App\Services;

class NewsMockService
{
    public function getWeatherHighlight(): array
    {
        return [
            'monthYear' => 'Mei 2025',
            'title' => 'Prakiraan Cuaca Manado Pagi ini hingga Malam hari',
            'subtitle' => 'Potensi hujan petir disertai angin kencang di pesisir Sario & Malalayang',
            'windSpeed' => '25 km/h',
            'windDirection' => 'Barat Daya',
            'humidity' => '97%',
            'humidityLabel' => 'Jenuh',
            'temperature' => '19°',
            'condition' => 'Hujan Lebat',
            'source' => 'Sumber: BMKG Sulut & weather.com',
        ];
    }

    public function getAllNews(): array
    {
        return [
            [
                'id' => 'nws-001',
                'slug' => 'hujan-intensitas-tinggi-manado-picu-genangan-longsor',
                'title' => 'Hujan Intensitas Tinggi di Manado Picu Genangan dan Longsor di 3 Titik Kecamatan: Warga Diimbau Waspada',
                'shortTitle' => 'TRC BPBD Manado Siagakan 5 Perahu Karet di Titik Rawan DAS Tondano',
                'category' => 'Banjir',
                'publishedAt' => '28 Mei 2025',
                'publishedTime' => '28 Mei 2025, 08:30 WITA',
                'author' => 'Admin Siaga Manado',
                'status' => 'Published',
                'imageUrl' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1000&q=80',
                'imageCaption' => 'Tim Reaksi Cepat (TRC) BPBD Kota Manado bersama Basarnas mengevakuasi warga lansia menggunakan perahu karet di kawasan Pasar Paal Dua, Rabu (28/5/2025).',
                'summary' => 'Mengantisipasi air kiriman dari arah hulu Minahasa, perahu karet dan tenda darurat telah disiagakan di sejumlah titik rawan sepanjang DAS Tondano.',
                'content' => [
                    'MANADO — Hujan berintensitas sedang hingga lebat yang mengguyur wilayah Kota Manado sejak dini hari pukul 02.15 WITA mengakibatkan peningkatan debit air secara signifikan pada dua Daerah Aliran Sungai (DAS) utama, yaitu DAS Tikala dan DAS Sawangan. Pusdalops BPBD Kota Manado mengonfirmasi luapan air telah menggenangi pemukiman warga dengan ketinggian air antara 30 hingga 75 sentimeter di sejumlah titik dataran rendah.',
                    'Kepala Pelaksana BPBD Kota Manado menyampaikan bahwa Tim Reaksi Cepat (TRC) telah menerjunkan 5 unit perahu karet beserta personel gabungan di titik-titik krusial seperti Kelurahan Paal Dua, Tikala Baru, dan Komo Luar. Prioritas evakuasi difokuskan pada kelompok rentan seperti warga lanjut usia, ibu hamil, serta anak-anak.',
                    'Selain genangan banjir, curah hujan tinggi juga memicu pergerakan tanah berskala kecil di 3 kecamatan berbukit, yakni Kecamatan Singkil, Wanea, dan Malalayang. Warga yang bermukim di sekitar bantaran sungai maupun lereng tebing diimbau untuk tetap waspada dan segera melaporkan tanda-tanda kedaruratan melalui aplikasi SiagaManado atau layanan bebas pulsa 112.',
                ],
                'keyPoints' => [
                    '5 unit perahu karet dan posko tenda darurat disiagakan di sekitar DAS Tondano & DAS Tikala.',
                    'Ketinggian genangan air berkisar antara 30 cm hingga 75 cm di kawasan Paal Dua dan Tikala.',
                    'Masyarakat diimbau memantau prakiraan cuaca BMKG dan segera melapor jika debit air terus naik.',
                ],
            ],
            [
                'id' => 'nws-002',
                'slug' => 'peringatan-gelombang-tinggi-pesisir-teluk-manado-bunaken',
                'title' => 'Peringatan Gelombang Tinggi 2.5 Meter di Pesisir Teluk Manado & Bunaken',
                'shortTitle' => 'Peringatan Gelombang Tinggi 2.5 Meter di Pesisir Teluk Manado & Bunaken',
                'category' => 'Banjir',
                'publishedAt' => '28 Mei 2025',
                'publishedTime' => '28 Mei 2025, 07:15 WITA',
                'author' => 'Admin Siaga Manado',
                'status' => 'Published',
                'imageUrl' => 'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?auto=format&fit=crop&w=1000&q=80',
                'imageCaption' => 'Gelombang pasang menghantam tanggul pemecah ombak di kawasan pesisir Teluk Manado.',
                'summary' => 'Nelayan tradisional dan operator kapal wisata menuju Pulau Bunaken diimbau menunda pelayaran seiring potensi angin kencang dan gelombang pasang.',
                'content' => [
                    'MANADO — Stasiun Meteorologi Maritim Bitung bersama BPBD Kota Manado mengeluarkan peringatan dini gelombang tinggi yang berpotensi mencapai 2,0 hingga 2,5 meter di perairan Teluk Manado, Kepulauan Bunaken, serta pesisir utara Sulawesi Utara.',
                    'Kondisi ini dipicu oleh adanya pola tekanan rendah dan kecepatan angin Barat Daya yang mencapai 25 km/jam. Selain risiko pelayaran, warga yang tinggal di sepanjang pesisir Pantai Malalayang, Sario, hingga Tuminting diminta mewaspadai potensi banjir rob pada jam pasang maksimum malam hari.',
                    'Seluruh nelayan perahu kecil dan penyedia transportasi wisata bahari menuju Taman Nasional Bunaken diimbau untuk menunda keberangkatan hingga cuaca kembali kondusif.',
                ],
                'keyPoints' => [
                    'Tinggi gelombang di perairan Teluk Manado dan Pulau Bunaken diperkirakan mencapai 2.5 meter.',
                    'Potensi banjir pesisir (rob) di kawasan Malalayang, Sario, dan Boulevard.',
                    'Kapal wisata dan perahu nelayan kecil diminta menunda pelayaran sementara waktu.',
                ],
            ],
            [
                'id' => 'nws-003',
                'slug' => 'pembersihan-material-longsor-jalur-singkil-ring-road',
                'title' => 'Pembersihan Material Longsor di Jalur Singkil – Ring Road Berhasil Dituntaskan',
                'shortTitle' => 'Pembersihan Material Longsor di Jalur Singkil – Ring Road Berhasil Dituntaskan',
                'category' => 'Longsor',
                'publishedAt' => '27 Mei 2025',
                'publishedTime' => '27 Mei 2025, 16:40 WITA',
                'author' => 'Admin Siaga Manado',
                'status' => 'Published',
                'imageUrl' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=1000&q=80',
                'imageCaption' => 'Alat berat ekskavator dikerahkan untuk membersihkan material tanah longsor yang menutupi jalur Ring Road Manado.',
                'summary' => 'Akses jalan lingkar Manado kini dapat dilalui kendaraan roda dua dan empat secara bergantian setelah tim gabungan mengerahkan dua unit alat berat.',
                'content' => [
                    'MANADO — Tim gabungan BPBD Kota Manado bersama Dinas Pekerjaan Umum dan Penataan Ruang (PUPR) berhasil menuntaskan pembersihan material tanah longsor yang sempat menutup sebagian badan jalan di ruas Singkil – Ring Road pada Selasa (27/5/2025) sore.',
                    'Sebanyak dua unit ekskavator dan empat truk pengangkut tanah diterjunkan ke lokasi sejak pagi hari untuk menyingkirkan tumpukan tanah tebing serta pepohonan tumbang akibat hujan lebat sehari sebelumnya.',
                    'Saat ini arus lalu lintas dari arah Paal Dua menuju Tuminting maupun sebaliknya sudah kembali dibuka normal. Pengendara tetap diminta berhati-hati karena permukaan aspal masih licin.',
                ],
                'keyPoints' => [
                    'Pembersihan material longsor memakan waktu 6 jam dengan 2 unit ekskavator.',
                    'Jalur Singkil – Ring Road sudah dapat dilalui kendaraan roda dua dan empat.',
                    'Pengendara diimbau menjaga jarak aman karena jalanan masih basah dan licin.',
                ],
            ],
            [
                'id' => 'nws-004',
                'slug' => 'simulasi-evakuasi-gempa-bumi-sekolah-pesisir-manado',
                'title' => 'BPBD Manado Gelar Simulasi Evakuasi Mandiri Gempa Bumi di 12 Sekolah Pesisir',
                'shortTitle' => 'BPBD Manado Gelar Simulasi Evakuasi Mandiri Gempa Bumi di 12 Sekolah Pesisir',
                'category' => 'Gempa',
                'publishedAt' => '25 Mei 2025',
                'publishedTime' => '25 Mei 2025, 10:00 WITA',
                'author' => 'Admin Siaga Manado',
                'status' => 'Published',
                'imageUrl' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1000&q=80',
                'imageCaption' => 'Para siswa dan guru mempraktikkan prosedur berlindung di bawah meja dan evakuasi menuju titik kumpul aman.',
                'summary' => 'Meningkatkan kesiapsiagaan sejak dini terhadap potensi aktivitas sesar aktif di Laut Sulawesi, ribuan pelajar dilatih prosedur evakuasi cepat.',
                'content' => [
                    'MANADO — Mengingat posisi geografis Sulawesi Utara yang berdekatan dengan jalur subduksi lempeng Sangihe dan Laut Sulawesi, BPBD Kota Manado menyelenggarakan program Satuan Pendidikan Aman Bencana (SPAB) di 12 sekolah yang berada di kawasan pesisir.',
                    'Dalam kegiatan ini, para siswa diajarkan langkah praktis "Merunduk, Lindungi Kepala, dan Bertahan" (Drop, Cover, Hold On) saat merasakan guncangan gempa bumi, diikuti dengan evakuasi tertib menuju titik kumpul dataran tinggi.',
                    'Program edukasi ini diharapkan dapat memperkuat budaya sadar bencana di lingkungan sekolah maupun keluarga di Kota Manado.',
                ],
                'keyPoints' => [
                    '12 sekolah di kawasan pesisir Manado mengikuti simulasi evakuasi gempa bumi.',
                    'Sosialisasi jalur evakuasi vertikal dan titik kumpul dataran tinggi.',
                    'Penerapan kurikulum Satuan Pendidikan Aman Bencana (SPAB).',
                ],
            ],
            [
                'id' => 'nws-005',
                'slug' => 'pemasangan-rambu-jalur-evakuasi-baru-kecamatan-wanea',
                'title' => 'Pemasangan 20 Rambu Jalur Evakuasi dan Sirine Peringatan Dini di Kecamatan Wanea dan Tikala',
                'shortTitle' => 'Pemasangan 20 Rambu Jalur Evakuasi dan Sirine Peringatan Dini di Kecamatan Wanea',
                'category' => 'Longsor',
                'publishedAt' => '23 Mei 2025',
                'publishedTime' => '23 Mei 2025, 14:20 WITA',
                'author' => 'Admin Siaga Manado',
                'status' => 'Published',
                'imageUrl' => 'https://images.unsplash.com/photo-1541888946425-d09bb18086f6?auto=format&fit=crop&w=1000&q=80',
                'imageCaption' => 'Petugas teknis melakukan pengecekan panel rambu evakuasi dan sensor pemantau curah hujan.',
                'summary' => 'Optimalisasi sistem peringatan dini berbasis masyarakat dilakukan melalui penambahan papan petunjuk arah titik kumpul darurat.',
                'content' => [
                    'MANADO — Pemerintah Kota Manado melalui BPBD terus memperkuat infrastruktur mitigasi bencana dengan memasang 20 rambu jalur evakuasi reflektif serta memperbarui perangkat sirine peringatan dini di kawasan perbukitan Wanea dan bantaran sungai Tikala.',
                    'Rambu reflektif yang menyala dalam gelap tersebut dirancang untuk memudahkan warga mengenali rute tercepat menuju lokasi pengungsian apabila terjadi pemadaman listrik saat bencana malam hari.',
                    'Warga diharapkan turut menjaga fasilitas publik kebencanaan ini agar tetap berfungsi optimal ketika dibutuhkan.',
                ],
                'keyPoints' => [
                    '20 titik rambu jalur evakuasi reflektif baru dipasang di Kecamatan Wanea & Tikala.',
                    'Kalibrasi ulang sensor tinggi muka air dan sirine peringatan dini.',
                    'Partisipasi aktif masyarakat diperlukan untuk menjaga keutuhan rambu darurat.',
                ],
            ],
            [
                'id' => 'nws-006',
                'slug' => 'pemantauan-debit-air-bendungan-kuwil-kawangkoan-normal',
                'title' => 'Pantauan Debit Air Hulu Tondano & Bendungan Kuwil Kawangkoan dalam Status Terkendali',
                'shortTitle' => 'Pantauan Debit Air Hulu Tondano & Bendungan Kuwil Kawangkoan dalam Status Terkendali',
                'category' => 'Banjir',
                'publishedAt' => '21 Mei 2025',
                'publishedTime' => '21 Mei 2025, 11:05 WITA',
                'author' => 'Admin Siaga Manado',
                'status' => 'Published',
                'imageUrl' => 'https://images.unsplash.com/photo-1468476396571-4d6f2a427ee7?auto=format&fit=crop&w=1000&q=80',
                'imageCaption' => 'Kondisi aliran air terpantau stabil pada pos pemantauan hidrologi.',
                'summary' => 'Koordinasi Balai Wilayah Sungai Sulawesi I memastikan pintu air berfungsi optimal mereduksi potensi debit puncak kiriman ke wilayah Manado.',
                'content' => [
                    'MANADO — Berdasarkan hasil pemantauan berkala Pusdalops BPBD Kota Manado bersama Balai Wilayah Sungai (BWS) Sulawesi I, elevasi muka air di hulu Sungai Tondano serta Bendungan Kuwil Kawangkoan berada pada batas aman dan terkendali.',
                    'Infrastruktur pengendali banjir tersebut bekerja efektif menahan laju air kiriman dari wilayah dataran tinggi Minahasa sehingga mengurangi beban limpasan yang masuk ke hilir Kota Manado.',
                    'Kendati demikian, masyarakat diimbau untuk tidak membuang sampah ke saluran drainase perkotaan agar tidak memicu genangan lokal saat hujan turun.',
                ],
                'keyPoints' => [
                    'Elevasi muka air di pos pantau hulu Tondano berada pada level normal.',
                    'Koordinasi intensif antara Pusdalops BPBD Manado dan BWS Sulawesi I.',
                    'Imbauan menjaga kebersihan drainase lingkungan dari sampah rumah tangga.',
                ],
            ],
        ];
    }

    public function getPublishedNews(?string $search = '', ?string $category = 'Semua Berita'): array
    {
        $list = array_filter($this->getAllNews(), fn ($item) => $item['status'] === 'Published');

        if ($category && $category !== 'Semua Berita') {
            $list = array_filter($list, fn ($item) => strtolower($item['category']) === strtolower($category));
        }

        if ($search && trim($search) !== '') {
            $q = strtolower(trim($search));
            $list = array_filter($list, function ($item) use ($q) {
                return str_contains(strtolower($item['title']), $q)
                    || str_contains(strtolower($item['shortTitle']), $q)
                    || str_contains(strtolower($item['summary']), $q)
                    || str_contains(strtolower($item['category']), $q);
            });
        }

        return array_values($list);
    }

    public function getNewsBySlug(string $slug): ?array
    {
        foreach ($this->getAllNews() as $item) {
            if ($item['status'] === 'Published' && ($item['slug'] === $slug || $item['id'] === $slug)) {
                return $item;
            }
        }
        return null;
    }
}

