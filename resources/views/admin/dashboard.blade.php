@extends('admin.layouts.admin')

@section('title', 'Dashboard — Admin Panel SiagaManado')

@section('content')
<div class="space-y-8">
    <!-- Top 4 Metric Cards (Matching Frame 40) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Users -->
        <div class="bg-[#12192c] border border-[#1d2740] rounded-2xl p-6 shadow-md hover:border-slate-600/50 transition">
            <span class="text-xs font-medium text-slate-300 block mb-2">Total Users</span>
            <div class="text-3xl font-extrabold text-white tracking-tight">
                {{ $metrics['total_users'] }}
            </div>
        </div>

        <!-- Card 2: Total Laporan -->
        <div class="bg-[#12192c] border border-[#1d2740] rounded-2xl p-6 shadow-md hover:border-slate-600/50 transition">
            <span class="text-xs font-medium text-slate-300 block mb-2">Total Laporan</span>
            <div class="text-3xl font-extrabold text-white tracking-tight">
                {{ $metrics['total_laporan'] }}
            </div>
        </div>

        <!-- Card 3: Laporan Baru -->
        <div class="bg-[#12192c] border border-[#1d2740] rounded-2xl p-6 shadow-md hover:border-slate-600/50 transition">
            <span class="text-xs font-medium text-slate-300 block mb-2">Laporan Baru</span>
            <div class="text-3xl font-extrabold text-white tracking-tight">
                {{ $metrics['laporan_baru'] }}
            </div>
        </div>

        <!-- Card 4: Laporan Selesai -->
        <div class="bg-[#12192c] border border-[#1d2740] rounded-2xl p-6 shadow-md hover:border-slate-600/50 transition">
            <span class="text-xs font-medium text-slate-300 block mb-2">Laporan Selesai</span>
            <div class="text-3xl font-extrabold text-white tracking-tight">
                {{ $metrics['laporan_selesai'] }}
            </div>
        </div>
    </div>

    <!-- Charts Row (Matching Frame 40) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 pt-2">
        <!-- Chart 1: Statistik Total Laporan (Bar Chart) -->
        <div class="bg-[#101728]/80 border border-[#1c263e] rounded-2xl p-7 shadow-lg">
            <h3 class="text-xl font-bold text-white mb-6 tracking-tight">
                Statistik Total Laporan
            </h3>
            <div class="h-80 w-full relative">
                <canvas id="totalLaporanChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Statistik Laporan Selesai (Line Chart) -->
        <div class="bg-[#101728]/80 border border-[#1c263e] rounded-2xl p-7 shadow-lg">
            <h3 class="text-xl font-bold text-white mb-6 tracking-tight">
                Statistik Laporan Selesai
            </h3>
            <div class="h-80 w-full relative">
                <canvas id="laporanSelesaiChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bar Chart - Statistik Total Laporan (Frame 40)
        const ctxBar = document.getElementById('totalLaporanChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Mei', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total Laporan',
                    data: [3, 2, 1, 1, 22],
                    backgroundColor: '#3b82f6',
                    borderRadius: 6,
                    borderSkipped: false,
                    barThickness: 48,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#cbd5e1',
                        padding: 10,
                        borderColor: '#334155',
                        borderWidth: 1,
                    }
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
                        max: 24,
                        ticks: {
                            stepSize: 6,
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

        // Line Chart - Statistik Laporan Selesai (Frame 40)
        const ctxLine = document.getElementById('laporanSelesaiChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Des'],
                datasets: [{
                    label: 'Laporan Selesai',
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
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#cbd5e1',
                        padding: 10,
                        borderColor: '#334155',
                        borderWidth: 1,
                    }
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
