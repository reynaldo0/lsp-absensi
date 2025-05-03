@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Tambah Data Siswa</h2>

        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                <input type="text" name="nisn" id="nisn"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas" id="kelas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required>
                    <option value="">-- Pilih Kelas --</option>
                    <option value="X RPL">X RPL</option>
                    <option value="XI RPL">XI RPL</option>
                    <option value="XII RPL">XII RPL</option>
                    <option value="X BR">X BR</option>
                    <option value="XI BR">XI BR</option>
                    <option value="XII BR">XII BR</option>
                    <option value="X AKL">X AKL</option>
                    <option value="XI AKL">XI AKL</option>
                    <option value="XII AKL">XII AKL</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
