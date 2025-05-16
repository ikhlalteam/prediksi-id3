<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<nav x-data="{ open: false }" class="bg-white dark:bg-white-800 border-b border-white-200 dark:border-white-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left side -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-8 w-auto fill-current text-gray-800 dark:text-white" />
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('riwayat.index')" :active="request()->routeIs('riwayat.index')">
                        {{ __('Riwayat Prediksi') }}
                    </x-nav-link>
                </div>
            </div>


            <!-- Right: Profile photo -->
            <div class="flex items-center space-x-2">
                <!-- Hamburger menu toggle -->
                <div class="sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-white-800 hover:text-white-900 dark:hover:text-white transition">
                            <img
                                src="{{ auth()->user()->profile_photo_path
                                    ? asset('storage/' . auth()->user()->profile_photo_path)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->username) . '&background=0D8ABC&color=fff' }}"
                                class="h-6 w-6 rounded-full object-cover"
                                alt="User photo"
                            />
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden px-4 pb-3">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('riwayat.index')" :active="request()->routeIs('riwayat.index')">
            {{ __('Riwayat Prediksi') }}
        </x-responsive-nav-link>
    </div>
</nav>

