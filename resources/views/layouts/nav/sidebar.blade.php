<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <div class="p-6 text-2xl font-bold text-gray-800 border-b">Absensi</div>

    <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700 font-medium">

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}">
                Home
            </a>

            <a href="{{ route('absensi.index') }}"
                class="block px-4 py-2 rounded-lg {{ request()->routeIs('absensi.index') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}">
                Data Absensi
            </a>
            <a href="{{ route('selfie.create') }}"
                class="block px-4 py-2 rounded-lg {{ request()->routeIs('selfie.create') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}">
                Absen Selfie
            </a>
            <a href="{{ route('selfie.index') }}"
                class="block px-4 py-2 rounded-lg {{ request()->routeIs('selfie.index') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}">
                Data Selfie
            </a>

            <a href="{{ route('siswa.index') }}"
                class="block px-4 py-2 rounded-lg {{ request()->routeIs('siswa.index') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}">
                Data Siswa
            </a>
            <a href="{{ route('user.index') }}"
                class="block px-4 py-2 rounded-lg {{ request()->routeIs('user.index') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}">
                Pengguna
            </a>

        @elseif(auth()->user()->role === 'siswa')
            <a href="{{ route('siswa.dashboard') }}"
                class="block px-4 py-2 rounded-lg {{ request()->routeIs('siswa.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}">
                Home
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">Keluar</button>
        </form>
    </nav>
</aside>
