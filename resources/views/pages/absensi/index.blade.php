@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-semibold">DATA KEHADIRAN HARI INI</h4>
        <a href="{{ route('absensi.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-sm rounded flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
            </svg>
            Input Kehadiran
        </a>
    </div>

    <!-- Filter -->
    <div class="flex flex-wrap items-center gap-4 mb-4">
        <select class="border border-gray-300 rounded px-10 py-2 text-sm">
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
        <select class="border border-gray-300 rounded px-10 py-2 text-sm">
            <option>Semua Kelas</option>
            <option>XI RPL</option>
            <option>XII AK 1</option>
        </select>
        <input type="text" placeholder="Cari" class="border border-gray-300 rounded px-3 py-2 text-sm w-48 ml-auto" />
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-gray-800 border border-gray-200">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Nama</th>
                    <th class="px-4 py-2 border-b">Jenis Kelamin</th>
                    <th class="px-4 py-2 border-b">Kelas</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($absensiHariIni as $absen)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $absen->siswa->nisn ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->nama ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->jenis_kelamin ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->kelas ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->keterangan === 'Alpha' ? 'Tidak Hadir' : 'Hadir' }}</td>
                        <td class="px-4 py-2">{{ $absen->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak ada data hari ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="text-sm text-gray-500 text-center mt-6">
        2025. SMKN 46 JAKARTA
    </footer>
@endsection
