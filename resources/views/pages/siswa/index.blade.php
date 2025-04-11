@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">DATA SISWA SMKN 12 JAKARTA</h2>

        <!-- Dropdown jumlah per halaman -->
        <form method="GET" class="mb-4">
            <select name="perPage" onchange="this.form.submit()" class="border rounded px-3 py-1 text-sm">
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
                        <th class="px-4 py-2 border">Kontrol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td class="px-4 py-2 border">{{ $siswa->nisn }}</td>
                            <td class="px-4 py-2 border">{{ $siswa->nama }}</td>
                            <td class="px-4 py-2 border">{{ $siswa->kelas }}</td>
                            <td class="px-4 py-2 border flex items-center gap-2">
                                <a href="#" class="text-blue-500 hover:text-blue-700">⚙️</a>
                                <form action="#" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">❌</button>
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
            {{ $siswas->appends(['perPage' => $perPage])->links() }}
        </div>

        <!-- Tombol tambah -->
        <div class="mt-4">
            <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">Tambah</a>
        </div>

        <!-- Footer -->
        <footer class="text-sm text-gray-500 text-center mt-6">
            2025. SMKN 46 JAKARTA
        </footer>
    </div>
@endsection
