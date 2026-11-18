@extends('layouts.petugas')

@section('title', 'Pengajuan Izin Petugas — SiagaManado')

@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Page Header matching Frame 53.png -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            Pengajuan Izin Petugas
        </h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1.5 max-w-xl leading-relaxed">
            Formulir izin ketidakhadiran atau dinas luar untuk personil operasional Tim Reaksi Cepat (TRC) BPBD Kota Manado.
        </p>
    </div>

    <!-- Main Form Card matching Frame 53.png -->
    <div class="rounded-[26px] bg-[#131b2c] border border-slate-800/90 p-6 sm:p-10 shadow-xl">
        <h2 class="text-base sm:text-lg font-extrabold text-white mb-6">
            Formulir Izin
        </h2>

        <form action="{{ route('petugas.leave.store') }}" method="POST" class="space-y-5" novalidate>
            @csrf

            <!-- Jenis Izin -->
            <div>
                <label for="leave_type" class="block text-xs font-bold text-slate-300 mb-2">
                    Jenis Izin
                </label>
                <select
                    id="leave_type"
                    name="leave_type"
                    class="w-full rounded-xl bg-[#090e1a] border border-slate-800 px-4 py-3.5 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#4e8cff]"
                >
                    @foreach($leaveTypes as $type)
                        <option value="{{ $type }}" {{ old('leave_type') === $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
                @error('leave_type')
                    <p class="mt-1.5 text-xs font-semibold text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Mulai & Tanggal Selesai -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="start_date" class="block text-xs font-bold text-slate-300 mb-2">
                        Tanggal Mulai
                    </label>
                    <input
                        id="start_date"
                        name="start_date"
                        type="date"
                        value="{{ old('start_date', '2024-10-26') }}"
                        class="w-full rounded-xl bg-[#090e1a] border border-slate-800 px-4 py-3.5 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#4e8cff]"
                    />
                    @error('start_date')
                        <p class="mt-1.5 text-xs font-semibold text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-xs font-bold text-slate-300 mb-2">
                        Tanggal Selesai
                    </label>
                    <input
                        id="end_date"
                        name="end_date"
                        type="date"
                        value="{{ old('end_date', '2024-10-28') }}"
                        class="w-full rounded-xl bg-[#090e1a] border border-slate-800 px-4 py-3.5 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#4e8cff]"
                    />
                    @error('end_date')
                        <p class="mt-1.5 text-xs font-semibold text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Alasan Pengajuan -->
            <div>
                <label for="reason" class="block text-xs font-bold text-slate-300 mb-2">
                    Alasan Pengajuan
                </label>
                <textarea
                    id="reason"
                    name="reason"
                    rows="4"
                    placeholder="Contoh: Pendampingan keluarga rawat inap di RSUP Prof. Kandou"
                    class="w-full rounded-xl bg-[#090e1a] border border-slate-800 px-4 py-3.5 text-sm text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4e8cff]"
                >{{ old('reason', 'Pendampingan keluarga rawat inap di RSUP Prof. Kandou') }}</textarea>
                @error('reason')
                    <p class="mt-1.5 text-xs font-semibold text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons: Batal & Kirim Pengajuan matching Frame 53.png -->
            <div class="pt-4 flex items-center justify-end gap-6">
                <a
                    href="{{ route('petugas.dashboard') }}"
                    class="text-xs sm:text-sm font-bold text-slate-300 hover:text-white transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-8 py-3 rounded-full bg-[#4e8cff] hover:bg-[#3b7bef] text-[#091224] text-xs sm:text-sm font-extrabold shadow-lg transition cursor-pointer"
                >
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>

    <!-- Riwayat Pengajuan Izin Terbaru -->
    @if(!empty($leaveHistory))
        <div class="rounded-[22px] bg-[#131b2c] border border-slate-800/90 p-6">
            <h3 class="text-sm font-extrabold text-slate-200 mb-4">
                Riwayat Pengajuan Izin Anda
            </h3>
            <div class="space-y-3">
                @foreach($leaveHistory as $lv)
                    <div class="rounded-xl bg-[#0e1525] border border-slate-800 px-4 py-3 flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-extrabold text-white">{{ $lv['leaveType'] }}</span>
                                <span class="text-[11px] font-mono text-slate-400">({{ $lv['startDate'] }} s/d {{ $lv['endDate'] }})</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-1">{{ $lv['reason'] }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold {{ $lv['status'] === 'Disetujui' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                            {{ $lv['status'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
