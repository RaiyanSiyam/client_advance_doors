<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance Doors</title>
    
    <!-- Tailwind CSS CDN with Custom Brand Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-red': '#B91C1C', 
                        'brand-dark': '#1F2937',
                        'brand-gray': '#F3F4F6',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    <!-- Main Header -->
    <header id="mainHeader" class="w-full fixed top-0 z-40 transition-all duration-300 bg-transparent border-transparent">
    
        <!-- Main Navigation Bar -->
        <div id="navContainer" class="container mx-auto px-4 py-4 transition-all duration-300">
            <div class="flex items-center justify-between">
                
                <!-- Logo -->
                <a href="{{ route('home') ?? '/' }}" class="flex-shrink-0">
                    <div class="text-2xl font-bold tracking-tighter">
                        <span id="logoText" class="text-white transition-colors duration-300">ADVANCE</span><span class="text-brand-red">DOORS</span>
                    </div>
                </a>

                <!-- Main Navigation Links (Desktop) -->
                <nav class="hidden lg:block">
                    <ul class="flex space-x-8 items-center font-medium">
                        <li><a href="{{ route('home') ?? '/' }}" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Home</a></li>
                        <li class="relative group">
                            <a href="#" class="nav-link text-white flex items-center hover:text-brand-red transition-colors duration-300">
                                Doors <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
                            </a>
                            <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg py-2 hidden group-hover:block border-t-2 border-brand-red text-gray-800">
                                <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red transition">Solid Wood</a>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red transition">Engineered</a>
                            </div>
                        </li>
                        <li><a href="#" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Living</a></li>
                        <li><a href="#" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Bedroom</a></li>
                    </ul>
                </nav>

                <!-- Right Side Icons & Actions -->
                <div class="flex items-center space-x-5">
                    
                    <!-- Search Form (Desktop) -->
                    <form action="{{ url('product') }}" method="GET" class="hidden md:block relative m-0">
                        <input type="text" name="search" id="desktopSearchInput" placeholder="Search products..." autocomplete="off" class="w-48 pl-4 pr-10 py-1.5 rounded-full border border-transparent focus:ring-2 focus:ring-brand-red bg-white/20 text-white placeholder-gray-200 outline-none backdrop-blur-sm transition-all duration-300 text-sm">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white hover:text-brand-red transition-colors duration-300" id="searchIcon">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <!-- Live Search Dropdown Box (Desktop) -->
                        <div id="desktopSearchResults" class="absolute top-full left-0 w-full mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 hidden flex-col overflow-hidden z-50 text-gray-800">
                            <!-- JS Will Inject Results Here -->
                        </div>
                    </form>
                    
                    <!-- Mobile Search Icon Toggle -->
                    <button onclick="toggleMobileSearch()" class="md:hidden nav-icon text-white hover:text-brand-red transition-colors duration-300 focus:outline-none">
                        <i class="fas fa-search text-xl"></i>
                    </button>

                    <!-- AUTH ICON MAGIC -->
                    @auth
                        <div class="relative group">
                            <button class="nav-icon text-white hover:text-brand-red transition-colors duration-300 focus:outline-none flex items-center">
                                <i class="far fa-user text-xl"></i>
                            </button>
                            
                            <!-- Sleek Dropdown Menu -->
                            <div class="absolute right-0 mt-4 w-48 bg-white shadow-xl border-t-2 border-brand-red text-gray-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 rounded-b-lg overflow-hidden">
                                <a href="{{ route('profile') }}" class="block px-4 py-3 hover:bg-gray-50 hover:text-brand-red transition-colors text-sm font-medium border-b border-gray-100">
                                    <i class="far fa-user w-5 text-center mr-1"></i> My Profile
                                </a>
                                <form action="{{ route('customer.logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 hover:bg-gray-50 hover:text-red-600 transition-colors text-sm font-medium text-gray-600">
                                        <i class="fas fa-sign-out-alt w-5 text-center mr-1"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <button onclick="toggleAuthModal()" class="nav-icon text-white hover:text-brand-red transition-colors duration-300 relative group">
                            <i class="far fa-user text-xl"></i>
                            <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap pointer-events-none">Login / Sign Up</span>
                        </button>
                    @endauth
                    
                    <button onclick="toggleCartDrawer()" class="nav-icon text-white hover:text-brand-red transition-colors duration-300 relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-brand-red text-white text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center">0</span>
                    </button>

                    <button onclick="toggleMobileMenu()" class="lg:hidden nav-icon text-white hover:text-brand-red transition-colors duration-300 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Search Dropdown Bar -->
        <div id="mobileSearchBar" class="hidden md:hidden absolute top-full left-0 w-full bg-white shadow-md border-t border-gray-100 p-4 transition-all duration-300 z-40">
            <form action="{{ url('product') }}" method="GET" class="relative w-full m-0">
                <input type="text" name="search" id="mobileSearchInput" placeholder="Search for products..." autocomplete="off" class="w-full bg-gray-100 text-gray-800 rounded-xl pl-4 pr-12 py-3 focus:outline-none focus:ring-2 focus:ring-brand-red text-sm">
                <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-brand-red p-2"><i class="fas fa-search text-lg"></i></button>
                
                <!-- Live Search Dropdown Box (Mobile) -->
                <div id="mobileSearchResults" class="absolute top-full left-0 w-full mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 hidden flex-col overflow-hidden z-50 text-gray-800 max-h-60 overflow-y-auto">
                    <!-- JS Will Inject Results Here -->
                </div>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FLOATING AUTH MODAL (Ultra Compact for Mobile) -->
    <div id="authModalOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden opacity-0 transition-opacity duration-300 flex items-center justify-center p-4">
        <div id="authModal" class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform scale-95 opacity-0 transition-all duration-300 overflow-hidden relative">
            
            <button onclick="toggleAuthModal()" class="absolute right-4 top-4 text-gray-400 hover:text-red-500 z-10 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors">
                <i class="fas fa-times"></i>
            </button>

            <!-- Tabs -->
            <div class="flex border-b border-gray-100 relative pt-2">
                <button onclick="switchAuthTab('login')" id="tabLogin" class="w-1/2 py-3 text-center font-bold text-brand-red transition-colors duration-300 focus:outline-none text-sm sm:text-base">Login</button>
                <button onclick="switchAuthTab('register')" id="tabRegister" class="w-1/2 py-3 text-center font-bold text-gray-400 hover:text-gray-600 transition-colors duration-300 focus:outline-none text-sm sm:text-base">Sign Up</button>
                <div id="tabIndicator" class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-brand-red transition-transform duration-300"></div>
            </div>

            <!-- Form Content -->
            <div class="p-4 sm:p-6 max-h-[75vh] overflow-y-auto hide-scrollbar">
                
                <!-- Login Form -->
                <form id="loginForm" action="{{ route('customer.login') }}" method="POST" class="space-y-3">
                    @csrf
                    @if($errors->has('login_error'))
                        <div class="bg-red-50 border border-red-100 text-red-600 p-2.5 rounded-lg text-xs mb-3 flex gap-2">
                            <i class="fas fa-exclamation-circle mt-0.5"></i> {{ $errors->first('login_error') }}
                        </div>
                    @endif
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-3 py-2 sm:py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1">Password</label>
                        <input type="password" name="password" required class="w-full px-3 py-2 sm:py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none text-sm">
                    </div>
                    <button type="submit" class="w-full bg-brand-dark text-white font-bold py-2.5 rounded-lg hover:bg-black transition-colors shadow-md mt-4 text-sm">Sign In</button>
                </form>

                <!-- Register Form -->
                <form id="registerForm" action="{{ route('customer.register') }}" method="POST" class="space-y-3 hidden">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 sm:py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-3 py-2 sm:py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-3 py-2 sm:py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1">Password</label>
                            <input type="password" name="password" required class="w-full px-3 py-2 sm:py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1">Confirm</label>
                            <input type="password" name="password_confirmation" required class="w-full px-3 py-2 sm:py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none text-sm">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-brand-red text-white font-bold py-2.5 rounded-lg hover:bg-red-800 transition-colors shadow-md mt-4 text-sm">Create Account</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Side Drawer & Overlays (Opening from the right) -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black/50 z-[60] hidden opacity-0 pointer-events-none transition-opacity duration-300" onclick="toggleMobileMenu()"></div>
    <div id="mobileMenuDrawer" class="fixed right-0 top-0 h-full w-80 max-w-[85vw] bg-white shadow-xl z-[70] transform translate-x-full transition-transform duration-300 flex flex-col">
        <div class="p-4 flex justify-between items-center border-b border-gray-100 shrink-0">
            <span class="text-xl font-bold tracking-tighter text-brand-dark">ADVANCE<span class="text-brand-red">DOORS</span></span>
            <button onclick="toggleMobileMenu()" class="text-gray-400 hover:text-red-500 text-xl focus:outline-none w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-4 overflow-y-auto flex-1 space-y-1 text-gray-800 font-medium hide-scrollbar">
            <a href="{{ route('home') ?? '/' }}" class="block px-4 py-3.5 rounded-xl hover:bg-gray-50 hover:text-brand-red transition-colors duration-300">Home</a>
            
            <!-- Mobile Doors Dropdown Item -->
            <div class="block rounded-xl overflow-hidden">
                <button onclick="toggleMobileDropdown('doorsMobileDropdown')" class="w-full flex justify-between items-center text-left px-4 py-3.5 hover:bg-gray-50 hover:text-brand-red transition-colors duration-300 focus:outline-none">
                    <span>Doors</span>
                    <i class="fas fa-chevron-down text-[10px] transition-transform duration-300" id="doorsMobileDropdownIcon"></i>
                </button>
                <!-- Sub-menu -->
                <div id="doorsMobileDropdown" class="hidden flex-col bg-gray-50/50 px-4 py-2 space-y-1 text-sm text-gray-600 border-l-2 border-brand-red ml-2 mb-2 mt-1 rounded-r-md">
                    <a href="#" class="block px-4 py-2.5 rounded-lg hover:text-brand-red hover:bg-white shadow-sm transition-all duration-300">Solid Wood</a>
                    <a href="#" class="block px-4 py-2.5 rounded-lg hover:text-brand-red hover:bg-white shadow-sm transition-all duration-300">Engineered</a>
                </div>
            </div>

            <a href="#" class="block px-4 py-3.5 rounded-xl hover:bg-gray-50 hover:text-brand-red transition-colors duration-300">Living</a>
            <a href="#" class="block px-4 py-3.5 rounded-xl hover:bg-gray-50 hover:text-brand-red transition-colors duration-300">Bedroom</a>

            <div class="my-4 border-t border-gray-100"></div>

            @auth
                <a href="{{ route('profile') }}" class="flex items-center px-4 py-3.5 rounded-xl text-brand-red bg-red-50 hover:bg-red-100 transition-colors duration-300"><i class="far fa-user w-5 text-center mr-3"></i> My Profile</a>
                <form action="{{ route('customer.logout') }}" method="POST" class="m-0 mt-2">
                    @csrf
                    <button type="submit" class="w-full flex items-center text-left px-4 py-3.5 rounded-xl hover:bg-gray-50 text-gray-500 hover:text-red-600 transition-colors duration-300"><i class="fas fa-sign-out-alt w-5 text-center mr-3"></i> Logout</button>
                </form>
            @else
                <button onclick="toggleMobileMenu(); toggleAuthModal();" class="w-full flex items-center text-left px-4 py-3.5 rounded-xl text-brand-red bg-red-50 hover:bg-red-100 transition-colors duration-300"><i class="far fa-user w-5 text-center mr-3"></i> Login / Sign Up</button>
            @endauth
        </div>
    </div>

     <!-- Floating Chat Widget -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="#" class="bg-brand-dark text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:bg-brand-red hover:-translate-y-1 hover:scale-105 transition-all duration-300 group focus:outline-none">
            <i class="fas fa-comment-dots text-2xl group-hover:animate-pulse"></i>
        </a>
    </div>

    <!-- Cart Drawer Overlays -->
    <div id="cartDrawerOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-[60] hidden opacity-0 pointer-events-none transition-opacity duration-300" onclick="toggleCartDrawer()"></div>
    <div id="cartDrawer" class="fixed right-0 top-0 h-full w-80 bg-white shadow-xl z-[70] transform translate-x-full transition-transform duration-300">
        <div class="p-4 flex justify-between items-center border-b">
            <h2 class="text-lg font-bold">Your Cart</h2>
            <button onclick="toggleCartDrawer()" class="text-gray-500 hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-8 text-center text-gray-500">
            <p>Your cart is empty.</p>
        </div>
    </div>

    



   <!-- Footer -->
    <footer class="bg-brand-dark text-white pt-16 pb-8">
        <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-6">
                    <div class="bg-brand-red text-white font-bold text-lg px-2 py-1 mr-1">ADVANCE</div>
                    <div class="text-white font-bold text-lg">DOORS</div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">Crafting premium doors and furniture with uncompromising quality and timeless elegance.</p>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-brand-red transition">About Us</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Living Room</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Bedroom</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Doors</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-6">Customer Service</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-brand-red transition">Contact Us</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Shipping Policy</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Returns & Exchanges</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Track Order</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-6">Contact Info</h4>
                <div class="space-y-3 text-gray-400">
                    <p class="text-sm"><i class="fas fa-map-marker-alt mr-2"></i>Monipur, Mirpur, Dhaka-1216</p>
                    <p class="text-sm"><i class="fas fa-phone-alt mr-2"></i>+880 1924-458445</p>
                    <p class="text-sm"><i class="fas fa-envelope mr-2"></i> info@advancedoors.com</p>
                </div>
            </div>
        </div>
        
        <div class="text-center text-sm text-gray-500 mt-12 border-t border-slate-800 pt-6">
            &copy; {{ date('Y') }} Advance Doors. All rights reserved.
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // --- 1. Toggle Mobile Side Drawer (Now sliding from Right) ---
        let isMobileMenuOpen = false;

        function toggleMobileMenu() {
            const drawer = document.getElementById('mobileMenuDrawer');
            const overlay = document.getElementById('mobileMenuOverlay');
            const isClosed = drawer.classList.contains('translate-x-full');
            
            if (isClosed) {
                drawer.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0', 'pointer-events-none');
                    overlay.classList.add('opacity-100', 'pointer-events-auto');
                }, 10);
                document.body.style.overflow = 'hidden';
                isMobileMenuOpen = true;
                updateHeaderState(); // Force solid header
            } else {
                drawer.classList.add('translate-x-full');
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                setTimeout(() => overlay.classList.add('hidden'), 300);
                document.body.style.overflow = '';
                isMobileMenuOpen = false;
                updateHeaderState();
            }
        }

        function toggleMobileDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const icon = document.getElementById(dropdownId + 'Icon');
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('flex');
                if(icon) icon.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('flex');
                if(icon) icon.style.transform = 'rotate(0deg)';
            }
        }

        // --- 2. Live Search Dropdown UI Logic ---
        function toggleMobileSearch() {
            const searchBar = document.getElementById('mobileSearchBar');
            if (searchBar.classList.contains('hidden')) {
                searchBar.classList.remove('hidden');
                setTimeout(() => document.getElementById('mobileSearchInput').focus(), 100);
            } else {
                searchBar.classList.add('hidden');
            }
        }

        function setupLiveSearch(inputId, resultsId) {
            const input = document.getElementById(inputId);
            const results = document.getElementById(resultsId);
            let timeout = null;

            if(input && results) {
                input.addEventListener('input', function(e) {
                    clearTimeout(timeout);
                    const query = e.target.value.trim();

                    // Start matching from the 2nd letter
                    if(query.length >= 2) {
                        results.classList.remove('hidden');
                        results.innerHTML = `<div class="p-3 text-center text-gray-500 text-xs"><i class="fas fa-spinner fa-spin mr-2"></i> Searching...</div>`;
                        
                        // Hit the backend JSON endpoint to fetch matching products
                        timeout = setTimeout(() => {
                            fetch(`/search-suggestions?q=${encodeURIComponent(query)}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => {
                                if(!response.ok) throw new Error('Route missing');
                                return response.json();
                            })
                            .then(data => {
                                if(!data || data.length === 0) {
                                    // Exact message requested when no products match
                                    results.innerHTML = `<div class="p-4 text-center text-gray-500 text-sm font-medium">Nothing matches description</div>`;
                                } else {
                                    let html = `<div class="px-3 py-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-gray-50 border-b border-gray-100">Matching Products</div>`;
                                    
                                    data.forEach(product => {
                                        const imgSrc = product.image ? '/storage/' + product.image : 'https://placehold.co/100x100?text=No+Img';
                                        const price = product.sale_price ? product.sale_price : product.price;

                                        html += `
                                        <a href="/product/${product.slug}" class="flex items-center gap-3 p-3 hover:bg-gray-50 transition border-b border-gray-50 cursor-pointer">
                                            <div class="w-10 h-10 rounded overflow-hidden bg-gray-100 shrink-0">
                                                <img src="${imgSrc}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-bold text-gray-900 truncate">${product.name}</p>
                                                <p class="text-xs text-brand-red font-bold">৳${parseFloat(price).toLocaleString('en-US')}</p>
                                            </div>
                                        </a>`;
                                    });
                                    
                                    html += `<button type="submit" class="w-full text-center p-3 text-brand-red text-sm font-bold hover:bg-red-50 transition border-none bg-transparent cursor-pointer">View all results <i class="fas fa-arrow-right ml-1"></i></button>`;
                                    results.innerHTML = html;
                                }
                            })
                            .catch(error => {
                                // Fallback just in case the endpoint isn't set up yet
                                results.innerHTML = `
                                    <div class="p-4 text-center text-gray-500 text-sm">
                                        <p class="mb-2 text-red-500"><i class="fas fa-exclamation-triangle mr-1"></i> Missing backend route.</p>
                                        <button type="submit" class="inline-block bg-brand-dark hover:bg-brand-red text-white px-4 py-2 rounded text-xs font-bold transition">Press Enter to Search</button>
                                    </div>`;
                            });

                        }, 300); // 300ms debounce to prevent spamming the database
                    } else {
                        results.classList.add('hidden');
                    }
                });

                // Hide dropdown when clicking completely outside
                document.addEventListener('click', (e) => {
                    if(!input.contains(e.target) && !results.contains(e.target)) {
                        results.classList.add('hidden');
                    }
                });
            }
        }

        setupLiveSearch('desktopSearchInput', 'desktopSearchResults');
        setupLiveSearch('mobileSearchInput', 'mobileSearchResults');


        // --- 3. Hover & Scroll Logic for Navbar ---
        const header = document.getElementById('mainHeader');
        let isHeaderHovered = false;

        // Hover listeners
        header.addEventListener('mouseenter', () => { isHeaderHovered = true; updateHeaderState(); });
        header.addEventListener('mouseleave', () => { isHeaderHovered = false; updateHeaderState(); });
        
        // Scroll listener
        window.addEventListener('scroll', updateHeaderState);

        function updateHeaderState() {
            const topBar = document.getElementById('topBar');
            const navContainer = document.getElementById('navContainer');
            const logoText = document.getElementById('logoText');
            const searchInput = document.getElementById('desktopSearchInput'); // specific ID
            const searchIcon = document.getElementById('searchIcon');
            const navLinks = document.querySelectorAll('.nav-link');
            const navIcons = document.querySelectorAll('.nav-icon');

            // Become solid white if scrolled, hovered, or menu is open!
            if (window.scrollY > 50 || isHeaderHovered || isMobileMenuOpen) {
                header.classList.remove('bg-transparent', 'border-transparent');
                header.classList.add('bg-white', 'shadow-md', 'border-b', 'border-gray-200');
                
                if(topBar) { topBar.style.maxHeight = '0px'; topBar.style.opacity = '0'; topBar.style.padding = '0'; }
                if(navContainer) { navContainer.classList.remove('py-4'); navContainer.classList.add('py-2'); }
                if(logoText) { logoText.classList.remove('text-white'); logoText.classList.add('text-brand-dark'); }
                
                navLinks.forEach(link => { link.classList.remove('text-white'); link.classList.add('text-gray-800'); });
                navIcons.forEach(icon => { icon.classList.remove('text-white'); icon.classList.add('text-gray-800'); });
                
                if(searchInput) {
                    searchInput.classList.remove('bg-white/20', 'text-white', 'placeholder-gray-200', 'border-transparent');
                    searchInput.classList.add('bg-gray-100', 'text-gray-800', 'placeholder-gray-500', 'border-gray-300');
                }
                if(searchIcon) { searchIcon.classList.remove('text-white'); searchIcon.classList.add('text-gray-600'); }

            } else {
                // Transparent State
                header.classList.add('bg-transparent', 'border-transparent');
                header.classList.remove('bg-white', 'shadow-md', 'border-b', 'border-gray-200');
                
                if(topBar) { topBar.style.maxHeight = '50px'; topBar.style.opacity = '1'; topBar.style.padding = '0.5rem 0'; }
                if(navContainer) { navContainer.classList.add('py-4'); navContainer.classList.remove('py-2'); }
                if(logoText) { logoText.classList.add('text-white'); logoText.classList.remove('text-brand-dark'); }
                
                navLinks.forEach(link => { link.classList.add('text-white'); link.classList.remove('text-gray-800'); });
                navIcons.forEach(icon => { icon.classList.add('text-white'); icon.classList.remove('text-gray-800'); });
                
                if(searchInput) {
                    searchInput.classList.add('bg-white/20', 'text-white', 'placeholder-gray-200', 'border-transparent');
                    searchInput.classList.remove('bg-gray-100', 'text-gray-800', 'placeholder-gray-500', 'border-gray-300');
                }
                if(searchIcon) { searchIcon.classList.add('text-white'); searchIcon.classList.remove('text-gray-600'); }
            }
        }
         function toggleCartDrawer() {
            const drawer = document.getElementById('cartDrawer');
            const overlay = document.getElementById('cartDrawerOverlay');
            
            const isClosed = drawer.classList.contains('translate-x-full');
            
            if (isClosed) {
                // Open Drawer
                drawer.classList.remove('translate-x-full');
                
                // Show Overlay
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0', 'pointer-events-none');
                    overlay.classList.add('opacity-100', 'pointer-events-auto');
                }, 10);
                
                // Prevent background scrolling
                document.body.style.overflow = 'hidden';
            } else {
                // Close Drawer
                drawer.classList.add('translate-x-full');
                
                // Hide Overlay
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
                
                // Restore background scrolling
                document.body.style.overflow = '';
            }
        }

        // --- AUTH MODAL LOGIC ---
        function toggleAuthModal() {
            const overlay = document.getElementById('authModalOverlay');
            const modal = document.getElementById('authModal');
            
            if (overlay.classList.contains('hidden')) {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    modal.classList.remove('scale-95', 'opacity-0');
                    modal.classList.add('scale-100', 'opacity-100');
                }, 10);
                document.body.style.overflow = 'hidden';
            } else {
                overlay.classList.add('opacity-0');
                modal.classList.remove('scale-100', 'opacity-100');
                modal.classList.add('scale-95', 'opacity-0');
                setTimeout(() => { overlay.classList.add('hidden'); }, 300);
                document.body.style.overflow = '';
            }
        }

        function switchAuthTab(tab) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const tabLogin = document.getElementById('tabLogin');
            const tabRegister = document.getElementById('tabRegister');
            const indicator = document.getElementById('tabIndicator');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                tabLogin.classList.replace('text-gray-400', 'text-brand-red');
                tabRegister.classList.replace('text-brand-red', 'text-gray-400');
                indicator.style.transform = 'translateX(0%)';
            } else {
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                tabRegister.classList.replace('text-gray-400', 'text-brand-red');
                tabLogin.classList.replace('text-brand-red', 'text-gray-400');
                indicator.style.transform = 'translateX(100%)';
            }
        }

        @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                toggleAuthModal();
                @if($errors->has('login_error') || (old('email') && !$errors->has('name')))
                    switchAuthTab('login');
                @else
                    switchAuthTab('register');
                @endif
            });
        @endif

        // Trigger scroll immediately on load
        document.addEventListener('DOMContentLoaded', () => { window.dispatchEvent(new Event('scroll')); });
    </script>
</body>
</html>