@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-4">INPUT KEHADIRAN</h2>
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Form (GET) -->
        <form method="GET" action="{{ route('absensi.index') }}" class="mb-4">
            <div class="flex items-center gap-4 absolute">
                <select name="periode" class="border rounded px-6 py-2 text-sm">
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
                <select name="kelas_filter" onchange="this.form.submit()" class="border rounded px-6 py-2 text-sm">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas }}" {{ $kelasFilter == $kelas ? 'selected' : '' }}>
                            {{ $kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Form Absensi (POST) -->
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <div class="flex items-center gap-4 mb-4">
                <button type="submit" class="ml-auto bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">
                    Konfirmasi Kehadiran
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-3 py-2"><input type="checkbox" id="select-all" /></th>
                            <th class="px-3 py-2 text-left">ID</th>
                            <th class="px-3 py-2 text-left">Nama</th>
                            <th class="px-3 py-2 text-left">Kelas</th>
                            <th class="px-3 py-2 text-left">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $data)
                            @php
                                $keteranganLama = $absenHariIni[$data->id]->keterangan ?? null;
                            @endphp
                            <tr class="border-t">
                                <td class="px-3 py-2">
                                    <input type="checkbox" name="siswa_id[]" value="{{ $data->id }}"
                                        class="checkbox-siswa" {{ isset($absenHariIni[$data->id]) ? 'checked' : '' }} />
                                </td>
                                <td class="px-3 py-2">{{ $data->nisn }}</td>
                                <td class="px-3 py-2">{{ $data->nama }}</td>
                                <td class="px-3 py-2">{{ $data->kelas }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Terlambat"
                                            class="mr-1"
                                            {{ $keteranganLama == 'Terlambat' ? 'checked' : '' }}>Terlambat</label>
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Sakit"
                                            class="mr-1" {{ $keteranganLama == 'Sakit' ? 'checked' : '' }}>Sakit</label>
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Izin"
                                            class="mr-1" {{ $keteranganLama == 'Izin' ? 'checked' : '' }}>Izin</label>
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Alpha"
                                            class="mr-1" {{ $keteranganLama == 'Alpha' ? 'checked' : '' }}>Alpha</label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.checkbox-siswa');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endsection
