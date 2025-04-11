@extends('layouts.welcome')

@section('content')
    <!-- Hero Section -->
    <div class="bg-indigo-600 text-white py-16 px-6 text-center rounded-lg mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Sistem Kehadiran Siswa</h1>
        <p class="text-lg md:text-xl">SMKN 46 Jakarta - Terpercaya dan Transparan</p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('login') }}" class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-indigo-500 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                Register
            </a>
        </div>
    </div>

    <!-- Section Title -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Rekap Kehadiran Siswa</h2>
        <p class="text-sm text-gray-500 mt-1">
            Menampilkan data kehadiran dari
            {{ \Carbon\Carbon::now()->subDays(($periode ?? 1) - 1)->format('d M Y') }}
            sampai {{ \Carbon\Carbon::now()->format('d M Y') }}
        </p>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('absensi.index') }}" class="mb-6 text-center">
        <div class="flex flex-wrap justify-center gap-4 items-center">
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
                class="border rounded px-4 py-2 text-sm shadow-sm w-60" />
        </div>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto px-52 bg-white shadow-md rounded-lg mb-12">
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
                @forelse ($absensi as $absen)
                    <tr class="hover:bg-gray-50 border-t">
                        <td class="px-4 py-2">{{ $absen->siswa->nisn ?? '-' }}</td>
                        <td class="px-4 py-2 font-medium">{{ $absen->siswa->nama ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->jenis_kelamin ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->siswa->kelas ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                {{ $absen->keterangan === 'Alpha' ? 'bg-red-500' : 'bg-green-500' }}">
                                {{ $absen->keterangan === 'Alpha' ? 'Tidak Hadir' : 'Hadir' }}
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
