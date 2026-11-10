<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Ayo tanggap bencana');
        $response->assertSee('Laporkan');
        $response->assertSee('Kirim Feedback');
    }

    public function test_news_list_and_detail_pages_render(): void
    {
        $response = $this->get('/berita');
        $response->assertStatus(200);
        $response->assertSee('Sorotan Utama Hari Ini');
        $response->assertSee('Berita terkini');

        $detail = $this->get('/berita/hujan-intensitas-tinggi-manado-picu-genangan-longsor');
        $detail->assertStatus(200);
        $detail->assertSee('Hujan Intensitas Tinggi di Manado');
        $detail->assertSee('Bagikan Berita');
    }

    public function test_mitigation_list_and_detail_pages_render(): void
    {
        $response = $this->get('/mitigasi');
        $response->assertStatus(200);
        $response->assertSee('Mitigasi Bencana');
        $response->assertSee('Banjir');
        $response->assertSee('Longsor');
        $response->assertSee('Gempa');

        $detail = $this->get('/mitigasi/banjir');
        $detail->assertStatus(200);
        $detail->assertSee('Panduan Kesiapsiagaan & Mitigasi Bencana Banjir');
        $detail->assertSee('Ceklis Tas Siaga Bencana');
    }

    public function test_profile_and_report_history_pages_render(): void
    {
        $profile = $this->get('/profil');
        $profile->assertStatus(200);
        $profile->assertSee('Informasi Profil');
        $profile->assertSee('Muhammad Haikal');

        $history = $this->get('/riwayat-laporan');
        $history->assertStatus(200);
        $history->assertSee('Riwayat Laporan Saya');
    }

    public function test_report_submission_and_validation_work(): void
    {
        // Equivalence Partitioning: Input laporan tidak lengkap -> Error validasi
        $invalid = $this->postJson('/lapor-bencana', [
            'phone' => 'abc',
            'location' => 'a',
            'description' => 'pendek',
        ]);
        $invalid->assertStatus(422);

        // Input laporan valid -> tersimpan dengan status awal "menunggu"
        $valid = $this->postJson('/lapor-bencana', [
            'phone' => '081234567890',
            'disaster_type' => 'Banjir',
            'incident_date' => date('Y-m-d'),
            'incident_time' => '10:30',
            'location' => 'Kawasan Tikala Baru, Kec. Tikala, Kota Manado',
            'coordinates' => '1.4822° N, 124.8489° E',
            'description' => 'Genangan air setinggi 35cm masuk ke halaman warga di Tikala Baru.',
            'photo_data_url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==',
            'photo_name' => 'bukti_banjir.png',
            'photo_size' => '1.1 MB',
        ]);

        $valid->assertStatus(200)
            ->assertJson([
                'message' => 'Laporan berhasil dikirim!',
                'report' => [
                    'reporterName' => 'Muhammad Haikal',
                    'status' => 'menunggu',
                ],
            ]);
    }

    public function test_feedback_submission_validation_works(): void
    {
        // Feedback kosong -> gagal validasi
        $empty = $this->postJson('/feedback', ['message' => '']);
        $empty->assertStatus(422);

        // Feedback valid -> berhasil
        $ok = $this->postJson('/feedback', [
            'message' => 'Sangat membantu masyarakat Kota Manado untuk memantau banjir.',
        ]);
        $ok->assertStatus(200);
    }
}
