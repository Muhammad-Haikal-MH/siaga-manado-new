@extends('admin.layouts.admin')

@section('title', 'Berita — Admin Panel SiagaManado')

@section('content')
<div class="space-y-8">
    <!-- Header with Tabs to Draft Berita (Frame 42 & 44) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-[#1b253e]">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                Statistik & Ringkasan Berita
            </h1>
            <p class="text-xs text-slate-400 mt-1">Pantau statistik publikasi dan kelola draft artikel kebencanaan</p>
        </div>

        <div class="flex items-center gap-3">
            <a
                href="{{ route('admin.berita.draft') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-bold bg-[#3b82f6] hover:bg-blue-600 text-white shadow-lg transition"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                </svg>
                <span>Buka Draft Berita ({{ $metrics['berita_draft'] }})</span>
            </a>
        </div>
    </div>

    <!-- Top 3 Metric Cards (Matching Frame 42) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Total Berita -->
        <div class="bg-[#12192c] border border-[#1d2740] rounded-2xl p-6 shadow-md hover:border-slate-600/50 transition">
            <span class="text-xs font-medium text-slate-300 block mb-2">Total Berita</span>
            <div class="text-3xl font-extrabold text-white tracking-tight">
                {{ $metrics['total_berita'] }}
            </div>
        </div>

        <!-- Berita Draft -->
        <div class="bg-[#12192c] border border-[#1d2740] rounded-2xl p-6 shadow-md hover:border-slate-600/50 transition">
            <span class="text-xs font-medium text-slate-300 block mb-2">Berita Draft</span>
            <div class="text-3xl font-extrabold text-white tracking-tight">
                {{ $metrics['berita_draft'] }}
            </div>
        </div>

        <!-- Berita Published -->
        <div class="bg-[#12192c] border border-[#1d2740] rounded-2xl p-6 shadow-md hover:border-slate-600/50 transition">
            <span class="text-xs font-medium text-slate-300 block mb-2">Berita Published</span>
            <div class="text-3xl font-extrabold text-white tracking-tight">
                {{ $metrics['berita_published'] }}
            </div>
        </div>
    </div>

    <!-- 2 Charts Row (Matching Frame 42) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 pt-2">
        <!-- Chart 1: Statistik Total Berita (Bar Chart) -->
        <div class="bg-[#101728]/80 border border-[#1c263e] rounded-2xl p-7 shadow-lg">
            <h3 class="text-xl font-bold text-white mb-6 tracking-tight">
                Statistik Total Berita
            </h3>
            <div class="h-80 w-full relative">
                <canvas id="totalBeritaChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Statistik Berita di Publish (Line Chart) -->
        <div class="bg-[#101728]/80 border border-[#1c263e] rounded-2xl p-7 shadow-lg">
            <h3 class="text-xl font-bold text-white mb-6 tracking-tight">
                Statistik Berita di Publish
            </h3>
            <div class="h-80 w-full relative">
                <canvas id="beritaPublishChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bar Chart - Statistik Total Berita (Frame 42)
        const ctxBar = document.getElementById('totalBeritaChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Mei', 'Des'],
                datasets: [{
                    label: 'Total Berita',
                    data: [1, 5],
                    backgroundColor: '#3b82f6',
                    borderRadius: 6,
                    borderSkipped: false,
                    barThickness: 56,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: {
                            color: '#1e293b',
                            borderDash: [5, 5],
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: { family: 'Plus Jakarta Sans', size: 12 }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 8,
                        ticks: {
                            stepSize: 2,
                            color: '#94a3b8',
                            font: { family: 'Plus Jakarta Sans', size: 12 }
                        },
                        grid: {
                            color: '#1e293b',
                            borderDash: [5, 5],
                        }
                    }
                }
            }
        });

        // Line Chart - Statistik Berita di Publish (Frame 42)
        const ctxLine = document.getElementById('beritaPublishChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Des'],
                datasets: [{
                    label: 'Berita Published',
                    data: [4],
                    borderColor: '#a855f7',
                    backgroundColor: '#c084fc',
                    pointBackgroundColor: '#c084fc',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    tension: 0.3,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: {
                            color: '#1e293b',
                            borderDash: [5, 5],
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: { family: 'Plus Jakarta Sans', size: 12 }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 4,
                        ticks: {
                            stepSize: 1,
                            color: '#94a3b8',
                            font: { family: 'Plus Jakarta Sans', size: 12 }
                        },
                        grid: {
                            color: '#1e293b',
                            borderDash: [5, 5],
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
