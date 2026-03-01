<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Advance Doors</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        /* Custom scrollbar for a slicker look */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #d1d5db; }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-800 antialiased selection:bg-red-100 selection:text-red-900" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-zinc-200 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
            <!-- Logo Area -->
            <div class="flex items-center justify-center h-20 border-b border-zinc-100">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-extrabold tracking-tight text-zinc-900 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center shadow-lg shadow-red-600/30">
                        <i class="fas fa-door-open text-sm"></i>
                    </div>
                    ADVANCE<span class="text-red-600 font-light">Admin</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-8 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600 font-semibold shadow-sm ring-1 ring-red-100' : 'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <i class="fas fa-chart-pie w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-red-600' : 'text-zinc-400' }}"></i>
                    <span>Dashboard</span>
                </a>

                <div class="pt-6 pb-2">
                    <p class="px-4 text-[11px] font-bold tracking-widest text-zinc-400 uppercase">Catalog</p>
                </div>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-red-50 text-red-600 font-semibold shadow-sm ring-1 ring-red-100' : 'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <i class="fas fa-box w-5 text-center {{ request()->routeIs('admin.products.*') ? 'text-red-600' : 'text-zinc-400' }}"></i>
                    <span>Products</span>
                </a>
                
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900">
                    <i class="fas fa-tags w-5 text-center text-zinc-400"></i>
                    <span>Categories</span>
                </a>

                <div class="pt-6 pb-2">
                    <p class="px-4 text-[11px] font-bold tracking-widest text-zinc-400 uppercase">Sales</p>
                </div>

                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900">
                    <i class="fas fa-shopping-cart w-5 text-center text-zinc-400"></i>
                    <span>Orders</span>
                    <span class="ml-auto bg-red-100 text-red-700 py-0.5 px-2.5 rounded-full text-[10px] font-bold">New</span>
                </a>
            </nav>

            <!-- User Area & Logout -->
            <div class="p-4 border-t border-zinc-100 bg-zinc-50/50">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-zinc-600 rounded-xl hover:bg-red-50 hover:text-red-700 transition-colors group">
                        <i class="fas fa-sign-out-alt text-zinc-400 group-hover:text-red-500 transition-colors"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Mobile Header -->
            <header class="bg-white shadow-sm border-b border-zinc-200 lg:hidden flex items-center justify-between p-4 z-40">
                <div class="text-xl font-extrabold text-zinc-900 flex items-center gap-2">
                    <div class="w-6 h-6 rounded border border-red-600 text-red-600 flex items-center justify-center"><i class="fas fa-door-open text-[10px]"></i></div>
                    ADVANCE
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-zinc-500 hover:text-red-600 focus:outline-none transition-colors">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </header>

            <!-- Desktop Topbar -->
            <header class="hidden lg:flex bg-white/80 backdrop-blur-md h-20 border-b border-zinc-200 items-center justify-between px-8 z-30 sticky top-0">
                <div>
                    <h1 class="text-2xl font-bold text-zinc-900 tracking-tight">@yield('header_title', 'Overview')</h1>
                    <p class="text-sm text-zinc-500 mt-0.5">@yield('header_subtitle', 'Manage your application')</p>
                </div>
                <div class="flex items-center gap-6">
                    <button class="text-zinc-400 hover:text-red-600 transition-colors relative">
                        <i class="far fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    <div class="h-8 w-px bg-zinc-200"></div>
                    <div class="flex items-center gap-3 cursor-pointer group">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-bold text-zinc-900 group-hover:text-red-600 transition-colors">{{ auth()->user()->name ?? 'Administrator' }}</p>
                            <p class="text-xs text-zinc-500">System Admin</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-red-50 border border-red-100 flex items-center justify-center text-red-600 font-bold shadow-sm">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-zinc-50/50 p-4 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-white border border-green-200 p-4 rounded-xl shadow-sm flex items-center justify-between" x-data="{ show: true }" x-show="show" x-transition>
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-500 mr-3">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text-zinc-800 font-medium text-sm">{{ session('success') }}</p>
                            </div>
                            <button @click="show = false" class="text-zinc-400 hover:text-zinc-600"><i class="fas fa-times"></i></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
            
            <!-- Mobile Sidebar Overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-zinc-900/60 backdrop-blur-sm z-40 lg:hidden" style="display: none;" x-transition.opacity></div>
        </div>
    </div>

</body>
</html>