{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{ open: false }" x-cloak class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <b class="text-xl font-bold text-gray-800 dark:text-white">Aplikasi Kas STIE</b>
                    </a>
                </div>

                <!-- Main Navigation Links (Desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        <!-- Link Dashboard -->
                        <x-responsive-nav-link href="{{ Auth::user()->hasRole('Admin') ? route('admin.dashboard') : route('mahasiswa.dashboard') }}" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-responsive-nav-link>

                        <!-- Menu untuk Admin -->
                        @if(Auth::user()->hasRole('Admin'))
                            <x-responsive-nav-link href="{{ route('admin.mahasiswa.index') }}" :active="request()->routeIs('admin.mahasiswa.*')">
                                Mahasiswa
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('admin.tugas.index') }}" :active="request()->routeIs('admin.tugas.*')">
                                Tugas
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('admin.tagihan.index') }}" :active="request()->routeIs('admin.tagihan.*')">
                                Tagihan
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('admin.kas.index') }}" :active="request()->routeIs('admin.kas.*')">
                                Kas
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('admin.pembayaran.index') }}" :active="request()->routeIs('admin.pembayaran.*')">
                                Verifikasi
                            </x-responsive-nav-link>
                        @endif

                        <!-- Menu untuk Mahasiswa -->
                        @if(Auth::user()->hasRole('Mahasiswa'))
                            <x-responsive-nav-link href="{{ route('mahasiswa.tugas.index') }}" :active="request()->routeIs('mahasiswa.tugas.*')">
                                Tugas Saya
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('mahasiswa.pembayaran.index') }}" :active="request()->routeIs('mahasiswa.pembayaran.*')">
                                Pembayaran
                            </x-responsive-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side: Dark Mode Toggle & User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Dark Mode Toggle -->
                <button @click="$el.closest('html').classList.toggle('dark')" class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <!-- Authentication Dropdown -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}
                                <svg class="ms-2 -me-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <x-dropdown-header>Manage Account</x-dropdown-header>
                            <x-dropdown-link href="{{ route('profile.edit') }}">Profile</x-dropdown-link>
                            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="null" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Guest Links -->
                    <div class="ms-3 space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">Register</a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Hamburger icon (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <!-- Dashboard Link (Mobile) -->
                <x-responsive-nav-link href="{{ Auth::user()->hasRole('Admin') ? route('admin.dashboard') : route('mahasiswa.dashboard') }}" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options (Mobile) -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-base text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-sm text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.*')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="null" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Log in</x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-responsive-nav-link>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>