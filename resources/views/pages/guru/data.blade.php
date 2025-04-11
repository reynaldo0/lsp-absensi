@extends('layouts.app')

@section('content')
    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded shadow">
            <h4 class="text-sm text-gray-500">SISWA TERLAMBAT</h4>
            <p class="text-2xl font-bold">5</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h4 class="text-sm text-gray-500">KEHADIRAN HARI INI</h4>
            <p class="text-2xl font-bold">716</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h4 class="text-sm text-gray-500">KEHADIRAN HARI INI</h4>
            <p class="text-2xl font-bold">716</p>
        </div>
    </div>

    <!-- Filters -->
    <h4 class="text-lg font-semibold mb-2">DATA KEHADIRAN HARI INI</h4>
    <div class="flex flex-wrap gap-4 items-center mb-4">
        <select class="border rounded px-4 py-2 text-sm">
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
        <select class="border rounded px-4 py-2 text-sm">
            <option>XI RPL</option>
            <option>XII AK 1</option>
        </select>
        <input type="text" placeholder="Ketik NIS" class="ml-auto border rounded px-3 py-2 text-sm w-48" />
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Kehadiran</th>
                    <th class="px-4 py-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop data kehadiran di sini -->
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="text-sm text-gray-500 text-center mt-6">
        2025. SMKN 46 JAKARTA
    </footer>
@endsection
