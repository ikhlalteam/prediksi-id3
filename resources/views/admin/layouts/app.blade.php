<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md p-6 space-y-6">
            <!-- Foto profil admin -->
            <div class="flex flex-col items-center">
                <img src="{{ auth()->user()->profile_photo_path
                    ? asset('storage/' . auth()->user()->profile_photo_path)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0D8ABC&color=fff' }}"
                    class="w-24 h-24 rounded-full object-cover border-4 border-green-500"
                    alt="Foto Profil">
                <p class="mt-2 text-center text-green-700 font-bold">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
            </div>

            <!-- Navigasi -->
            <nav class="flex flex-col space-y-4 mt-6 text-green-700 font-semibold">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2 hover:underline {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-bold' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>

                <a href="{{ route('admin.rules.history') }}"
                   class="flex items-center gap-2 hover:underline {{ request()->routeIs('admin.rules.history') ? 'text-blue-600 font-bold' : '' }}">
                    <i data-lucide="history" class="w-5 h-5"></i> Riwayat Perhitungan
                </a>

                <a href="{{ route('admin.rules.upload') }}"
                   class="flex items-center gap-2 hover:underline {{ request()->routeIs('admin.rules.upload') ? 'text-blue-600 font-bold' : '' }}">
                    <i data-lucide="file-up" class="w-5 h-5"></i> Perhitungan ID3 Rules Baru
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 hover:underline {{ request()->is('admin/users*') ? 'text-blue-600 font-bold' : '' }}">
                <i data-lucide="users" class="w-5 h-5"></i> Manajemen Pengguna
                </a>

                <a href="{{ route('admin.profile') }}"
                   class="flex items-center gap-2 hover:underline {{ request()->routeIs('admin.profile') ? 'text-blue-600 font-bold' : '' }}">
                    <i data-lucide="user" class="w-5 h-5"></i> Profil Admin
                </a>
            </nav>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">
                    <i data-lucide="log-out" class="w-5 h-5"></i> Logout
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-auto">
            @yield('content')
        </div>
    </div>

    <!-- Aktifkan ikon Lucide -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
