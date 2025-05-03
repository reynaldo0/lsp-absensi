@extends('layouts.welcome')

@section('content')
    <!-- Hero Section -->

    <div class="mt-8 flex justify-end pr-16 gap-4">
        <a href="{{ route('login') }}"
            class="bg-blue-500 px-6 py-2 text-white rounded-lg font-semibold hover:bg-blue-600 transition">
            Masuk
        </a>
    </div>

    <!-- Filter Form -->
    <form class="mb-6 pt-32 px-52 text-center">
        <div class="flex items-center gap-4">
            <select name="periode" onchange="this.form.submit()" class="border rounded px-4 py-2 text-sm shadow-sm">
                <option value="1" {{ request('periode') == 1 ? 'selected' : '' }}>Hari Ini</option>
                <option value="5" {{ request('periode') == 5 ? 'selected' : '' }}>5 Hari</option>
                <option value="6" {{ request('periode') == 6 ? 'selected' : '' }}>6 Hari</option>
            </select>

            <select name="kelas_filter" onchange="this.form.submit()" class="border rounded px-4 py-2 text-sm shadow-sm">
                <option value="">Semua Kelas</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas }}" {{ $kelasFilter == $kelas ? 'selected' : '' }}>
                        {{ $kelas }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="search" placeholder="Cari NISN / Nama" value="{{ request('search') }}"
                class="border rounded px-4 py-2 text-sm shadow-sm w-60 ml-auto" />
        </div>
    </form>

    <div class="overflow-x-auto px-52 bg-white h-screen shadow-md rounded-lg mb-12">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-indigo-50 text-left text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 border-b">NISN</th>
                    <th class="px-4 py-3 border-b">Nama</th>
                    <th class="px-4 py-3 border-b">Jenis Kelamin</th>
                    <th class="px-4 py-3 border-b">Kelas</th>
                    <th class="px-4 py-3 border-b">Status</th>
                    <th class="px-4 py-3 border-b">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataAbsensi as $absen)
                    <tr class="hover:bg-gray-50 border-t">
                        <td class="px-4 py-2">{{ $absen->siswa->nisn ?? '-' }}</td>
                        <td class="px-4 py-2 font-medium">{{ $absen->siswa->nama ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->jenis_kelamin ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->kelas ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span
                                class="px-2 py-1 rounded text-white text-xs font-semibold
        @if ($absen->keterangan === 'Alpha') bg-red-500
        @elseif ($absen->keterangan === 'Izin')
            bg-yellow-500
        @else
            bg-green-500 @endif">
                                @if ($absen->keterangan === 'Alpha')
                                    Tidak Hadir
                                @elseif ($absen->keterangan === 'Izin')
                                    Izin
                                @else
                                    Hadir
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $absen->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Tidak ada data kehadiran dalam periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
