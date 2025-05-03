<header class="bg-white border-b px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
    <div class="flex items-center gap-3">
        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>

        <div class="relative">
            <button class="p-2 rounded-full hover:bg-gray-100 transition" id="profile-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>

            <div id="profile-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <ul>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 w-full text-left">Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    const profileButton = document.getElementById('profile-button');
    const profileDropdown = document.getElementById('profile-dropdown');

    profileButton.addEventListener('click', () => {
        profileDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
    });
</script>
