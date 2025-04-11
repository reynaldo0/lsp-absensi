@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Edit Data Siswa</h2>

        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                <input type="text" name="nisn" id="nisn"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nisn', $siswa->nisn) }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nama', $siswa->nama) }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas" id="kelas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required>
                    <option value="">-- Pilih Kelas --</option>
                    @php
                        $kelasOptions = [
                            'X RPL',
                            'XI RPL',
                            'XII RPL',
                            'X BR',
                            'XI BR',
                            'XII BR',
                            'X AKL',
                            'XI AKL',
                            'XII AKL',
                        ];
                    @endphp
                    @foreach ($kelasOptions as $kelas)
                        <option value="{{ $kelas }}" {{ old('kelas', $siswa->kelas) == $kelas ? 'selected' : '' }}>
                            {{ $kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
