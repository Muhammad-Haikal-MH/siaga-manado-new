<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminSiagamanadoTest extends TestCase
{
    public function test_admin_dashboard_renders_successfully(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Admin Panel');
        $response->assertSee('Total Users');
        $response->assertSee('Total Laporan');
        $response->assertSee('Laporan Baru');
        $response->assertSee('Laporan Selesai');
        $response->assertSee('Statistik Total Laporan');
        $response->assertSee('Statistik Laporan Selesai');
    }

    public function test_admin_laporan_page_and_verification(): void
    {
        $response = $this->get('/admin/laporan');
        $response->assertStatus(200);
        $response->assertSee('Data Pelaporan');
        $response->assertSee('raka');
        $response->assertSee('banjir');
        $response->assertSee('jakarta');
        $response->assertSee('Verifikasi');
        $response->assertSee('Tolak');

        // Test verification action
        $post = $this->post('/admin/laporan/LAP-2026-0520/verifikasi', [
            'reporter_name' => 'raka',
            'priority' => 'Siaga 2 (Tinggi)',
            'action_notes' => 'Laporan valid, tim relawan BPBD telah diterjunkan ke lokasi.',
        ]);
        $post->assertRedirect('/admin/laporan');
    }

    public function test_admin_berita_pages_render(): void
    {
        // Berita Overview
        $resIndex = $this->get('/admin/berita');
        $resIndex->assertStatus(200);
        $resIndex->assertSee('Statistik & Ringkasan Berita', false);
        $resIndex->assertSee('Total Berita');
        $resIndex->assertSee('Berita Draft');
        $resIndex->assertSee('Berita Published');

        // Draft Berita List
        $resDraft = $this->get('/admin/berita/draft');
        $resDraft->assertStatus(200);
        $resDraft->assertSee('Draft Berita');
        $resDraft->assertSee('Hujan Deras di Manado');
        $resDraft->assertSee('Longsor di Jalur Trans Sulawesi');

        // Edit Berita Form
        $resEdit = $this->get('/admin/berita/1/edit');
        $resEdit->assertStatus(200);
        $resEdit->assertSee('Edit Berita');
        $resEdit->assertSee('Judul Berita');
        $resEdit->assertSee('Gambar Berita');
    }

    public function test_admin_feedback_page_renders(): void
    {
        $response = $this->get('/admin/feedback');
        $response->assertStatus(200);
        $response->assertSee('Feedback');
        $response->assertSee('Nama Pengguna');
        $response->assertSee('emailpengguna@gmail.com');
    }

    public function test_admin_mitigasi_page_renders(): void
    {
        $response = $this->get('/admin/mitigasi');
        $response->assertStatus(200);
        $response->assertSee('Draft Mitigasi Bencana Alam');
        $response->assertSee('Rencana Kontinjensi Gempa Bumi Wilayah Manado');
        $response->assertSee('Pedoman Evakuasi Mandiri Erupsi Gunung Soputan');
    }
}
