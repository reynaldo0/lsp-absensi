@extends('layouts.app')

@section('content')
    <div class="w-4/5 p-8">
        <h2 class="text-lg font-semibold mb-4">ADMIN ABSENSI</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="py-2 px-4 border">NIP</th>
                        <th class="py-2 px-4 border">Nama</th>
                        <th class="py-2 px-4 border">Role</th>
                        <th class="py-2 px-4 border text-center">Kontrol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="py-2 px-4 border">{{ $admin->nip }}</td>
                            <td class="py-2 px-4 border">{{ $admin->name }}</td>
                            <td class="py-2 px-4 border">{{ $admin->role }}</td>
                            <td class="py-2 px-4 border text-center space-x-2">
                                <a href="{{ route('user.edit', $admin->id) }}" class="text-blue-600 hover:underline">
                                    <button type="submit"
                                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 focus:outline-none">
                                        Edit
                                    </button>
                                </a>

                                <form action="{{ route('user.destroy', $admin->id) }}" method="POST" class="inline-block"
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
                    @endforeach

                    @if ($admins->isEmpty())
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-center text-gray-500">Belum ada data admin.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <footer class="mt-10 text-sm text-gray-500 text-center">
            2025. SMKN 46 JAKARTA
        </footer>
    </div>
@endsection
