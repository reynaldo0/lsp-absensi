@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-4">INPUT KEHADIRAN</h2>

        <!-- Filters -->
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <div class="flex flex-wrap items-center gap-4 mb-4">
                <select name="periode" class="border rounded px-6 py-2 text-sm">
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
                <select name="kelas_filter" class="border rounded px-6 py-2 text-sm">
                    <option value="X AK 1">X AK 1</option>
                    <option value="X AK 2">X AK 2</option>
                    <option value="X BR 1">X BR 1</option>
                </select>
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
                            <tr class="border-t">
                                <td class="px-3 py-2">
                                    <input type="checkbox" name="siswa_id[]" value="{{ $data->id }}"
                                        class="checkbox-siswa" />
                                </td>
                                <td class="px-3 py-2">{{ $data->id }}</td>
                                <td class="px-3 py-2">{{ $data->nama }}</td>
                                <td class="px-3 py-2">{{ $data->kelas }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Terlambat"
                                            class="mr-1">Terlambat</label>
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Sakit"
                                            class="mr-1">Sakit</label>
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Izin"
                                            class="mr-1">Izin</label>
                                    <label><input type="radio" name="keterangan[{{ $data->id }}]" value="Alpha"
                                            class="mr-1">Alpha</label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <footer class="p-4 text-sm text-center text-gray-500 border-t mt-6">
        2025. SMKN 46 JAKARTA
    </footer>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.checkbox-siswa');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endsection
