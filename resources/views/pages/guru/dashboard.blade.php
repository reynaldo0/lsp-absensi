@extends('layouts.app')

@section('content')
    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-sm text-gray-500 mb-1">Siswa Terlambat</div>
            <div class="text-3xl font-bold text-gray-800">{{ $terlambat }}</div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-sm text-gray-500 mb-1">Kehadiran Hari Ini</div>
            <div class="text-3xl font-bold text-gray-800">{{ $hadir }}</div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-sm text-gray-500 mb-1">Kehadiran Hari Ini</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalHariIni }}</div>
        </div>
    </div>

    <form method="GET" action="{{ route('guru.dashboard') }}" class="mb-4">
        <div class="flex items-center gap-4">
            <select name="periode" onchange="this.form.submit()" class="...">
                <option value="1" {{ request('periode') == 1 ? 'selected' : '' }}>Hari Ini</option>
                <option value="3" {{ request('periode') == 3 ? 'selected' : '' }}>3 Hari</option>
                <option value="7" {{ request('periode') == 7 ? 'selected' : '' }}>Seminggu</option>
            </select>

            <select name="kelas_filter" onchange="this.form.submit()" class="border rounded px-6 py-2 text-sm">
                <option value="">Semua Kelas</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas }}" {{ $kelasFilter == $kelas ? 'selected' : '' }}>
                        {{ $kelas }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="search" placeholder="Ketik NISN atau Nama" value="{{ request('search') }}"
                class="border border-gray-300 rounded px-3 py-2 text-sm w-48 ml-auto" />
        </div>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left">Nisn</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Kelas</th>
                    <th class="px-4 py-2 text-left">Kehadiran</th>
                    <th class="px-4 py-2 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataAbsensi as $absen)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $absen->siswa->nisn }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->nama }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->kelas }}</td>
                        <td class="px-4 py-2">
                            {{ in_array($absen->keterangan, ['Alpha', 'izin']) ? 'Tidak Hadir' : 'Hadir' }}</td>
                        <td class="px-4 py-2">{{ $absen->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="p-4 text-sm text-center text-gray-500 border-t">
        2025. SMKN 46 JAKARTA
    </footer>
@endsection
