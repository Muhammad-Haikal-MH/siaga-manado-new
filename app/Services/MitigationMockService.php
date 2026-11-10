<?php

namespace App\Services;

class MitigationMockService
{
    public function getAllMitigations(): array
    {
        return [
            [
                'id' => 'mit-banjir',
                'slug' => 'banjir',
                'title' => 'Banjir',
                'fullTitle' => 'Panduan Kesiapsiagaan & Mitigasi Bencana Banjir',
                'badgeText' => 'DAERAH ALIRAN SUNGAI',
                'badgeColor' => 'blue',
                'dotColor' => '#f59e0b',
                'stepsCount' => 15,
                'stepsLabel' => '15 Langkah Kesiapan',
                'summary' => 'Panduan lengkap menghadapi potensi luapan Daerah Aliran Sungai (DAS) Tondano, Tikala, dan Sario serta genangan pesisir di wilayah Kota Manado.',
                'riskAreas' => [
                    'Kec. Tikala & Paal Dua',
                    'Kec. Tuminting & Singkil',
                    'Bantaran DAS Tondano & Sario',
                    'Kawasan Dataran Rendah Komo Luar',
                ],
                'emergencyBagItems' => [
                    'Dokumen penting (KTP, KK, Ijazah, Surat Tanah) dalam map kedap air',
                    'Pakaian ganti, jas hujan, dan selimut darurat untuk 3 hari',
                    'Senter LED tahan air, baterai cadangan, dan peluit darurat',
                    'Powerbank terisi penuh dan kabel pengisi daya telepon seluler',
                    'Air minum kemasan minimal 3 liter per orang & makanan siap saji',
                    'Kotak P3K, obat-obatan pribadi rutin, dan cairan antiseptik',
                ],
                'phases' => [
                    'sebelum' => [
                        [
                            'step' => 1,
                            'title' => 'Kenali Risiko Wilayah & Rute Evakuasi',
                            'description' => 'Ketahui apakah tempat tinggal Anda berada di zona rawan luapan DAS Tondano, Tikala, atau Sario. Pelajari peta jalur evakuasi menuju posko dataran tinggi terdekat di kelurahan Anda.',
                        ],
                        [
                            'step' => 2,
                            'title' => 'Siapkan Tas Siaga Bencana (72 Jam)',
                            'description' => 'Kemas dokumen penting dalam plastik kedap air, pakaian ganti, senter, obat pribadi, makanan tahan lama, dan powerbank di satu tas ransel yang mudah dijangkau.',
                        ],
                        [
                            'step' => 3,
                            'title' => 'Bersihkan Saluran Drainase Lingkungan',
                            'description' => 'Pastikan selokan dan saluran air di sekitar rumah bebas dari sumbatan sampah atau sedimen lumpur, terutama menjelang puncak musim penghujan.',
                        ],
                        [
                            'step' => 4,
                            'title' => 'Amankan Instalasi Listrik & Barang Elektronik',
                            'description' => 'Tempatkan stopkontak dan perangkat elektronik di posisi yang lebih tinggi dari batas genangan air tertinggi yang pernah terjadi di lingkungan Anda.',
                        ],
                        [
                            'step' => 5,
                            'title' => 'Catat Nomor Darurat Pusdalops Manado',
                            'description' => 'Simpan nomor Call Center 112 (Bebas Pulsa) dan Pusdalops BPBD Kota Manado (0431) 851113 di telepon seluruh anggota keluarga.',
                        ],
                    ],
                    'saat' => [
                        [
                            'step' => 6,
                            'title' => 'Matikan Aliran Listrik (MCB) & Gas LPG',
                            'description' => 'Segera matikan saklar utama listrik di meteran PLN dan lepaskan regulator tabung gas LPG begitu air mulai memasuki area teras atau lantai rumah.',
                        ],
                        [
                            'step' => 7,
                            'title' => 'Pantau Peringatan Dini Resmi',
                            'description' => 'Ikuti perkembangan tinggi muka air sungai dan arahan evakuasi dari petugas kelurahan, sirine peringatan dini, atau portal SiagaManado.',
                        ],
                        [
                            'step' => 8,
                            'title' => 'Dahulukan Evakuasi Kelompok Rentan',
                            'description' => 'Pastikan lansia, anak-anak, ibu hamil, dan penyandang disabilitas dievakuasi lebih awal menuju titik kumpul sebelum ketinggian air meningkat.',
                        ],
                        [
                            'step' => 9,
                            'title' => 'Hindari Berjalan atau Berkendara di Arus Deras',
                            'description' => 'Jangan menerobos arus air yang mengalir deras. Arus setinggi 15-30 cm saja sudah dapat menjatuhkan orang dewasa atau menyeret kendaraan roda dua.',
                        ],
                        [
                            'step' => 10,
                            'title' => 'Laporkan Kejadian Melalui SiagaManado',
                            'description' => 'Jika membutuhkan bantuan evakuasi perahu karet atau melihat warga terjebak, segera kirim laporan dilengkapi titik lokasi dan foto melalui fitur Laporkan.',
                        ],
                    ],
                    'setelah' => [
                        [
                            'step' => 11,
                            'title' => 'Pastikan Kondisi Rumah Aman Sebelum Kembali',
                            'description' => 'Kembali ke rumah hanya setelah pihak berwenang menyatakan kondisi banjir telah surut sepenuhnya dan struktur bangunan aman.',
                        ],
                        [
                            'step' => 12,
                            'title' => 'Gunakan Alas Kaki & Sarung Tangan Saat Membersihkan Lumpur',
                            'description' => 'Lindungi diri dari pecahan kaca, paku, hewan berbisa, serta bakteri Leptospirosis yang terbawa sisa air banjir.',
                        ],
                        [
                            'step' => 13,
                            'title' => 'Periksa Jaringan Listrik Sebelum Dinyalakan',
                            'description' => 'Pastikan seluruh kabel, saklar, dan peralatan elektronik benar-benar kering sebelum menyalakan kembali aliran listrik utama.',
                        ],
                        [
                            'step' => 14,
                            'title' => 'Gunakan Air Bersih & Masak Air Hingga Mendidih',
                            'description' => 'Hindari mengonsumsi air sumur yang tercemar banjir. Gunakan air bersih dari tangki distribusi darurat atau rebus air hingga mendidih sempurna.',
                        ],
                        [
                            'step' => 15,
                            'title' => 'Waspadai Penyakit Pasca-Banjir',
                            'description' => 'Segera periksakan diri ke pos kesehatan terdekat apabila mengalami demam, diare, gatal-gatal kulit, atau luka terbuka pasca membersihkan genangan.',
                        ],
                    ],
                ],
            ],
            [
                'id' => 'mit-longsor',
                'slug' => 'longsor',
                'title' => 'Longsor',
                'fullTitle' => 'Panduan Kesiapsiagaan & Mitigasi Bencana Tanah Longsor',
                'badgeText' => 'LERENG & PERBUKITAN',
                'badgeColor' => 'amber',
                'dotColor' => '#ea580c',
                'stepsCount' => 12,
                'stepsLabel' => '12 Langkah Kesiapan',
                'summary' => 'Panduan mengenali gejala pergerakan tanah, tindakan penyelamatan darurat, dan mitigasi lereng di kawasan perbukitan Kota Manado.',
                'riskAreas' => [
                    'Kec. Wanea & Tingkulu',
                    'Kec. Singkil & Kombos',
                    'Kec. Malalayang (Perbukitan)',
                    'Jalur Jalan Lingkar (Ring Road) Manado',
                ],
                'emergencyBagItems' => [
                    'Peluit darurat berdaya suara nyaring untuk memberi sinyal posisi',
                    'Senter kepala (headlamp) agar kedua tangan tetap bebas saat evakuasi',
                    'Sepatu tertutup/boot beralas anti-selip dan jas hujan',
                    'Dokumen identitas keluarga dalam kemasan kedap air',
                    'Kotak P3K, perban elastis, dan obat-obatan darurat',
                    'Air minum dan makanan berenergi tinggi (biskuit/cokelat)',
                ],
                'phases' => [
                    'sebelum' => [
                        [
                            'step' => 1,
                            'title' => 'Amati Tanda-Tanda Awal Pergerakan Tanah',
                            'description' => 'Waspadai munculnya retakan baru di tanah, tembok rumah, atau jalan beraspal, serta pohon dan tiang listrik yang mulai tampak miring di area lereng.',
                        ],
                        [
                            'step' => 2,
                            'title' => 'Perhatikan Perubahan Aliran Air Tanah',
                            'description' => 'Jika mata air atau rembesan air di tebing mendadak keruh berlumpur atau tiba-tiba mengering saat musim hujan, segera tingkatkan kewaspadaan.',
                        ],
                        [
                            'step' => 3,
                            'title' => 'Hindari Memotong Tebing Secara Tegak Lurus',
                            'description' => 'Jangan menggali bagian bawah tebing secara curam tanpa dinding penahan tanah (talud) dan saluran drainase permukaan yang memadai.',
                        ],
                        [
                            'step' => 4,
                            'title' => 'Tanam Vegetasi Berakar Kuat di Area Lereng',
                            'description' => 'Tanam tanaman berakar tunggang dan dalam seperti bambu, vetiver (akar wangi), atau pepohonan keras untuk membantu mengikat struktur tanah.',
                        ],
                    ],
                    'saat' => [
                        [
                            'step' => 5,
                            'title' => 'Segera Evakuasi Saat Hujan Lebat Berkepanjangan',
                            'description' => 'Apabila hujan deras turun lebih dari 2-3 jam tanpa henti di wilayah tebing curam dan terdengar suara gemuruh, segera tinggalkan rumah menuju tempat lapang.',
                        ],
                        [
                            'step' => 6,
                            'title' => 'Menjauh dengan Arah Menyamping dari Jalur Longsoran',
                            'description' => 'Lari menjauh secara menyamping (tegak lurus) keluar dari lintasan material longsoran, bukan searah dengan turunan lereng.',
                        ],
                        [
                            'step' => 7,
                            'title' => 'Lindungi Kepala Bila Tidak Sempat Menghindar',
                            'description' => 'Jika terjebak di dalam ruangan dan tidak sempat keluar, meringkuklah membentuk bola (posisi fetal) dan lindungi bagian kepala dengan bantal atau kedua tangan.',
                        ],
                        [
                            'step' => 8,
                            'title' => 'Bunyikan Peluit atau Peringatkan Tetangga Sekitar',
                            'description' => 'Gunakan peluit darurat atau pengeras suara lingkungan untuk membangunkan warga sekitar terutama apabila kejadian berlangsung pada malam atau dini hari.',
                        ],
                    ],
                    'setelah' => [
                        [
                            'step' => 9,
                            'title' => 'Jangan Langsung Memasuki Area Longsoran',
                            'description' => 'Tanah di sekitar lokasi longsor utama masih labil dan sangat berpotensi memicu longsor susulan, terutama bila cuaca masih mendung atau gerimis.',
                        ],
                        [
                            'step' => 10,
                            'title' => 'Laporkan Titik Lokasi & Korban Terjebak ke Petugas',
                            'description' => 'Berikan informasi akurat kepada tim SAR dan BPBD mengenai perkiraan jumlah warga yang masih berada di lokasi tanpa melakukan penggalian berisiko sendiri.',
                        ],
                        [
                            'step' => 11,
                            'title' => 'Waspadai Banjir Bandang Akibat Bendungan Alami',
                            'description' => 'Periksa apakah material longsor menutup aliran sungai di lembah, karena tumpukan tersebut dapat jebol sewaktu-waktu dan memicu banjir bandang.',
                        ],
                        [
                            'step' => 12,
                            'title' => 'Ikuti Rekomendasi Geologi Sebelum Membangun Kembali',
                            'description' => 'Pastikan lahan telah diperiksa kestabilannya oleh instansi teknis sebelum memperbaiki bangunan atau kembali menghuni rumah di sekitar lereng.',
                        ],
                    ],
                ],
            ],
            [
                'id' => 'mit-gempa',
                'slug' => 'gempa',
                'title' => 'Gempa',
                'fullTitle' => 'Panduan Kesiapsiagaan & Mitigasi Bencana Gempa Bumi',
                'badgeText' => 'SESAR AKTIF & TEKTONIK',
                'badgeColor' => 'rose',
                'dotColor' => '#e11d48',
                'stepsCount' => 10,
                'stepsLabel' => '10 Langkah Kesiapan',
                'summary' => 'Panduan penyelamatan diri saat guncangan gempa bumi tektonik dan kesiapsiagaan dini di wilayah pesisir maupun perkotaan Manado.',
                'riskAreas' => [
                    'Seluruh Kecamatan di Kota Manado',
                    'Kawasan Pesisir Teluk Manado & Boulevard',
                    'Gedung Bertingkat & Pusat Perbelanjaan',
                    'Kepulauan Bunaken, Manado Tua & Siladen',
                ],
                'emergencyBagItems' => [
                    'Peluit darurat dan senter LED dengan baterai cadangan',
                    'Kotak P3K lengkap, masker penutup hidung (debu reruntuhan)',
                    'Air minum dan makanan siap saji untuk minimal 3 hari',
                    'Salinan dokumen penting & uang tunai secukupnya',
                    'Radio portabel baterai untuk memantau informasi resmi BMKG',
                    'Sepatu beralas tebal untuk melindungi kaki dari pecahan kaca',
                ],
                'phases' => [
                    'sebelum' => [
                        [
                            'step' => 1,
                            'title' => 'Amankan Perabotan Tinggi ke Dinding',
                            'description' => 'Pasang pengait atau siku penahan pada lemari tinggi, rak buku, dan pemanas air agar tidak mudah roboh menimpa penghuni saat terjadi guncangan.',
                        ],
                        [
                            'step' => 2,
                            'title' => 'Kenali Titik Aman di Setiap Ruangan',
                            'description' => 'Identifikasi meja yang kokoh untuk berlindung serta jauhi area dekat kaca jendela besar, cermin gantung, dan lampu gantung.',
                        ],
                        [
                            'step' => 3,
                            'title' => 'Ketahui Jalur Evakuasi Darurat & Titik Kumpul Tinggi',
                            'description' => 'Bagi warga di pesisir Teluk Manado, hafalkan rute tercepat menuju dataran tinggi apabila gempa dirasakan kuat dan berlangsung lebih dari 20 detik.',
                        ],
                    ],
                    'saat' => [
                        [
                            'step' => 4,
                            'title' => 'Terapkan Prinsip: Merunduk, Lindungi Kepala, Bertahan',
                            'description' => 'Jika berada di dalam ruangan, segera merunduk di bawah meja yang kokoh, lindungi kepala dan leher Anda, serta pegang kaki meja hingga guncangan berhenti.',
                        ],
                        [
                            'step' => 5,
                            'title' => 'Jangan Gunakan Lift Saat di Gedung Bertingkat',
                            'description' => 'Apabila berada di gedung bertingkat, tetap tenang, tunggu guncangan reda, lalu keluarlah menggunakan tangga darurat. Jangan pernah menggunakan lift.',
                        ],
                        [
                            'step' => 6,
                            'title' => 'Cari Area Terbuka Jika Berada di Luar Ruangan',
                            'description' => 'Menjauhlah dari bangunan tinggi, tiang listrik, papan reklame, pohon besar, dan dinding pembatas yang berisiko runtuh.',
                        ],
                        [
                            'step' => 7,
                            'title' => 'Menepi & Berhenti Jika Sedang Mengemudi',
                            'description' => 'Kurangi kecepatan secara bertahap, menepi di tempat yang jauh dari jembatan layang, underpass, atau tebing, dan tetap di dalam kendaraan hingga guncangan berhenti.',
                        ],
                    ],
                    'setelah' => [
                        [
                            'step' => 8,
                            'title' => 'Waspadai Gempa Susulan & Periksa Kerusakan Sekitar',
                            'description' => 'Keluarlah dari bangunan dengan tertib setelah guncangan utama berhenti. Bersiaplah menghadapi kemungkinan gempa susulan.',
                        ],
                        [
                            'step' => 9,
                            'title' => 'Segera Menuju Dataran Tinggi Bila Gempa Sangat Kuat di Pesisir',
                            'description' => 'Jika Anda berada di pantai dan merasakan gempa kuat hingga sulit berdiri atau melihat air laut surut mendadak, segera evakuasi ke tempat tinggi tanpa menunggu sirine.',
                        ],
                        [
                            'step' => 10,
                            'title' => 'Pantau Informasi Resmi BMKG & BPBD Kota Manado',
                            'description' => 'Jangan mudah percaya kabar bohong (hoaks) terkait prediksi gempa. Ikuti kanal informasi resmi BMKG dan aplikasi SiagaManado.',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function getMitigationBySlug(string $slug): ?array
    {
        foreach ($this->getAllMitigations() as $item) {
            if ($item['slug'] === $slug || $item['id'] === $slug) {
                return $item;
            }
        }
        return null;
    }
}

