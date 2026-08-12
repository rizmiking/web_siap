<header class="bg-white border-b border-slate-200 sticky top-0 z-30">
    <div class="px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
        <!-- Left: App Title / Brand -->
        <div class="flex items-center space-x-3">
            <span class="text-xl font-bold tracking-tight text-blue-600">SIAP</span>
            <span class="hidden sm:inline-block text-xs font-semibold px-2.5 py-0.5 rounded bg-blue-100 text-blue-800">
                Sistem Informasi Administrasi Pelatihan
            </span>
        </div>

        <!-- Right: Profile & Logout -->
        <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
            </div>

            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                    class="inline-flex items-center justify-center px-3 py-1.5 border border-red-200 text-xs font-medium rounded-lg text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</header>