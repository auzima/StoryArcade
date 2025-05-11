@auth
    <x-dropdown align="right" width="48">
        {{-- Bouton déclencheur --}}
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none">
                <div>{{ Auth::user()->name }}</div>
                <svg class="ml-1 w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0L5.293 8.707a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
                </svg>
            </button>
        </x-slot>

        {{-- Contenu du menu déroulant --}}
        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                ⚙️ Profil
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                    🔓 Déconnexion
                </button>
            </form>
        </x-slot>
    </x-dropdown>
@endauth