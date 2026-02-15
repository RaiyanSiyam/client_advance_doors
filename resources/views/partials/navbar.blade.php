<header class="w-full bg-white shadow-sm sticky top-0 z-50">
    <!-- Top Utility Bar -->
    <div class="bg-brand-dark text-gray-300 text-xs py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="hidden md:flex space-x-4">
                <span><i class="fas fa-phone-alt mr-1"></i> +880 1234 567 890</span>
                <span><i class="fas fa-envelope mr-1"></i> info@advancedoors.com</span>
            </div>
            <div class="flex space-x-4 ml-auto">
                <a href="#" class="hover:text-white transition">Store Locator</a>
                <a href="#" class="hover:text-white transition">Track Order</a>
                <a href="#" class="hover:text-white transition">My Account</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <div class="text-2xl font-bold text-brand-dark tracking-tighter">
                    ADVANCE<span class="text-brand-red">DOORS</span>
                </div>
            </a>

            <!-- Search Bar (Hidden on mobile, visible on lg) -->
            <div class="hidden lg:flex flex-1 max-w-xl mx-8 relative">
                <input type="text" placeholder="Search for doors, sofas, beds..." 
                       class="w-full bg-gray-100 border border-transparent text-gray-700 py-2.5 px-4 rounded-full focus:outline-none focus:bg-white focus:border-brand-red transition duration-300">
                <button class="absolute right-0 top-0 h-full px-5 text-gray-500 hover:text-brand-red">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Icons -->
            <div class="flex items-center space-x-6">
                <a href="#" class="relative group text-gray-600 hover:text-brand-red transition">
                    <i class="far fa-heart text-xl"></i>
                    <span class="hidden group-hover:block absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs py-1 px-2 rounded whitespace-nowrap">Wishlist</span>
                </a>
                <a href="#" class="relative group text-gray-600 hover:text-brand-red transition">
                    <i class="fas fa-shopping-bag text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-brand-red text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </a>
                
                <!-- Mobile Menu Button -->
                <button onclick="toggleMenu()" class="lg:hidden text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Links (Desktop) -->
    <nav class="hidden lg:block border-t border-gray-100">
        <div class="container mx-auto px-4">
            <ul class="flex space-x-8 py-3 text-sm font-medium text-gray-700 uppercase tracking-wide">
                <li><a href="#" class="text-brand-red border-b-2 border-brand-red pb-3">Home</a></li>
                <li class="group relative">
                    <a href="#" class="hover:text-brand-red transition flex items-center">
                        Doors <i class="fas fa-chevron-down ml-1 text-xs text-gray-400"></i>
                    </a>
                    <!-- Dropdown -->
                    <div class="absolute top-full left-0 w-48 bg-white shadow-lg py-2 hidden group-hover:block border-t-2 border-brand-red">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red text-transform-none">Solid Wood</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red text-transform-none">Engineered</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red text-transform-none">Glass Doors</a>
                    </div>
                </li>
                <li><a href="#" class="hover:text-brand-red transition">Living</a></li>
                <li><a href="#" class="hover:text-brand-red transition">Bedroom</a></li>
                <li><a href="#" class="hover:text-brand-red transition">Dining</a></li>
                <li><a href="#" class="hover:text-brand-red transition">Office</a></li>
            </ul>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
        <div class="px-4 py-2 space-y-1">
            <a href="#" class="block py-2 text-brand-red font-medium">Home</a>
            <a href="#" class="block py-2 text-gray-600 border-b">Doors</a>
            <a href="#" class="block py-2 text-gray-600 border-b">Living</a>
            <a href="#" class="block py-2 text-gray-600 border-b">Bedroom</a>
            <a href="#" class="block py-2 text-gray-600">Dining</a>
        </div>
    </div>
</header>