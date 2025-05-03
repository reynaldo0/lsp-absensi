@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">DATA SISWA SMKN 46 JAKARTA</h2>

        <!-- Dropdown jumlah per halaman -->
        <form method="GET" class="mb-4">
            <select name="perPage" onchange="this.form.submit()" class="border rounded px-10 py-1 text-sm">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
            </select>
        </form>

        <!-- Tabel -->
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Kelamin</th>
                        <th class="px-4 py-2 border">Kontrol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $siswa)
                        <tr>
                            <td class="px-4 py-2 border">{{ $siswa->nisn }}</td>
                            <td class="px-4 py-2 border">{{ $siswa->nama }}</td>
                            <td class="px-4 py-2 border">{{ $siswa->kelas }}</td>
                            <td class="px-4 py-2 border">{{ $siswa->jenis_kelamin }}</td>

                            <td class="px-4 py-2 border">
                                <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-blue-600 hover:underline">
                                    <button type="submit"
                                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 focus:outline-none">
                                        Edit
                                    </button>
                                </a>

                                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
        </div>

        <!-- Tombol tambah -->
        <div class="mt-4">
            <a href="{{ route('siswa.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">Tambah</a>
        </div>

        <!-- Footer -->
        <footer class="text-sm text-gray-500 text-center mt-6">
            2025. SMKN 46 JAKARTA
        </footer>
    </div>
@endsection
