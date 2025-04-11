@extends('layouts.app')

@section('content')
    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-sm text-gray-500 mb-1">Siswa Terlambat</div>
            <div class="text-3xl font-bold text-gray-800">5</div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-sm text-gray-500 mb-1">Kehadiran Hari Ini</div>
            <div class="text-3xl font-bold text-gray-800">716</div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-sm text-gray-500 mb-1">Kehadiran Hari Ini</div>
            <div class="text-3xl font-bold text-gray-800">716</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap items-center gap-4 mb-4">
        <select class="border rounded px-10 py-2 text-sm">
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
        <select class="border rounded px-10 py-2 text-sm">
            <option>XI RPL</option>
            <option>XII AK 1</option>
        </select>
        <input type="text" placeholder="Ketik NIS" class="ml-auto border rounded px-3 py-2 text-sm w-48" />
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Kelas</th>
                    <th class="px-4 py-2 text-left">Kehadiran</th>
                    <th class="px-4 py-2 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="px-4 py-2">001</td>
                    <td class="px-4 py-2">Rizky Maulana</td>
                    <td class="px-4 py-2">XI RPL</td>
                    <td class="px-4 py-2">Hadir</td>
                    <td class="px-4 py-2">-</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">002</td>
                    <td class="px-4 py-2">Dewi Anggraini</td>
                    <td class="px-4 py-2">XI RPL</td>
                    <td class="px-4 py-2">Terlambat</td>
                    <td class="px-4 py-2">Datang 15 menit lewat</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">003</td>
                    <td class="px-4 py-2">Budi Santoso</td>
                    <td class="px-4 py-2">XII AK 1</td>
                    <td class="px-4 py-2">Hadir</td>
                    <td class="px-4 py-2">-</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">004</td>
                    <td class="px-4 py-2">Siti Nurhaliza</td>
                    <td class="px-4 py-2">XI RPL</td>
                    <td class="px-4 py-2">Izin</td>
                    <td class="px-4 py-2">Sakit</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">005</td>
                    <td class="px-4 py-2">Andi Prasetyo</td>
                    <td class="px-4 py-2">XI RPL</td>
                    <td class="px-4 py-2">Hadir</td>
                    <td class="px-4 py-2">-</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="p-4 text-sm text-center text-gray-500 border-t">
        2025. SMKN 46 JAKARTA
    </footer>
@endsection
