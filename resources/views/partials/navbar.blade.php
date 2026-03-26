<header id="main-header" class="w-full fixed top-0 z-50 transition-all duration-300 bg-transparent text-white">
    <!-- Top Utility Bar -->
    <div id="top-bar" class="bg-brand-dark text-gray-300 text-xs transition-all duration-300 overflow-hidden" style="max-height: 50px; padding: 0.5rem 0; opacity: 1;">
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
    <div id="nav-container" class="container mx-auto px-4 py-4 transition-all duration-300">
        <div class="flex items-center justify-between">
            
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <div class="text-2xl font-bold tracking-tighter">
                    <span id="logo-text" class="text-white transition-colors duration-300">ADVANCE</span><span class="text-brand-red">DOORS</span>
                </div>
            </a>

            <!-- Main Navigation Links (Desktop) -->
            <nav class="hidden lg:block">
                <ul class="flex space-x-8 items-center font-medium">
                    <li><a href="{{ route('home') }}" class="nav-link text-white hover:text-brand-red transition">Home</a></li>
                    <li class="relative group">
                        <a href="#" class="nav-link text-white flex items-center hover:text-brand-red transition">
                            Doors <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
                        </a>
                        <!-- Dropdown -->
                        <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg py-2 hidden group-hover:block border-t-2 border-brand-red text-gray-800">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red transition">Solid Wood</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red transition">Engineered</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50 hover:text-brand-red transition">Glass Doors</a>
                        </div>
                    </li>
                    <li><a href="#" class="nav-link text-white hover:text-brand-red transition">Living</a></li>
                    <li><a href="#" class="nav-link text-white hover:text-brand-red transition">Bedroom</a></li>
                    <li><a href="#" class="nav-link text-white hover:text-brand-red transition">Dining</a></li>
                    <li><a href="#" class="nav-link text-white hover:text-brand-red transition">Office</a></li>
                </ul>
            </nav>

            <!-- Right Side Icons & Actions -->
            <div class="flex items-center space-x-5">
                <!-- Search Form (Hidden on mobile) -->
                <div class="hidden md:block relative">
                    <input type="text" placeholder="Search..." class="w-48 pl-4 pr-10 py-1.5 rounded-full border border-transparent focus:ring-2 focus:ring-brand-red bg-white/20 text-white placeholder-gray-200 outline-none backdrop-blur-sm transition-all duration-300" id="search-input">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white hover:text-brand-red transition" id="search-icon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <!-- Mobile Search Icon -->
                <button class="md:hidden nav-icon text-white hover:text-brand-red transition">
                    <i class="fas fa-search text-xl"></i>
                </button>

                <!-- User Icon -->
                <button class="nav-icon text-white hover:text-brand-red transition"><i class="far fa-user text-xl"></i></button>
                
                <!-- Cart Icon -->
                <button class="nav-icon text-white hover:text-brand-red transition relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-brand-red text-white text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center">0</span>
                </button>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden nav-icon text-white hover:text-brand-red transition focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white shadow-lg border-t border-gray-200 absolute w-full left-0 top-full">
        <div class="px-4 py-2 space-y-1 text-gray-800">
            <a href="{{ route('home') }}" class="block py-2 text-brand-red font-medium">Home</a>
            <a href="#" class="block py-2 border-b hover:text-brand-red transition">Doors</a>
            <a href="#" class="block py-2 border-b hover:text-brand-red transition">Living</a>
            <a href="#" class="block py-2 border-b hover:text-brand-red transition">Bedroom</a>
            <a href="#" class="block py-2 border-b hover:text-brand-red transition">Dining</a>
            <a href="#" class="block py-2 hover:text-brand-red transition">Office</a>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const header = document.getElementById('main-header');
        const topBar = document.getElementById('top-bar');
        const navContainer = document.getElementById('nav-container');
        const logoText = document.getElementById('logo-text');
        const navLinks = document.querySelectorAll('.nav-link');
        const navIcons = document.querySelectorAll('.nav-icon');
        const searchInput = document.getElementById('search-input');
        const searchIcon = document.getElementById('search-icon');
        
        const mobileMenuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        // 1. Mobile Menu Toggle Logic
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // 2. Scroll Effect Logic
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                // --- SCROLLED STATE (White Navbar) ---
                
                header.classList.remove('bg-transparent', 'text-white');
                header.classList.add('bg-white', 'shadow-md');
                
                // Hide Top Bar smoothly
                if(topBar) {
                    topBar.style.maxHeight = '0';
                    topBar.style.padding = '0';
                    topBar.style.opacity = '0';
                }
                
                navContainer.classList.remove('py-4');
                navContainer.classList.add('py-3');
                
                // Change Logo Text
                if(logoText) {
                    logoText.classList.remove('text-white');
                    logoText.classList.add('text-brand-dark'); // Or text-gray-900
                }
                
                // Change Link Colors
                navLinks.forEach(link => {
                    link.classList.remove('text-white');
                    link.classList.add('text-gray-800');
                });
                
                // Change Icon Colors
                navIcons.forEach(icon => {
                    icon.classList.remove('text-white');
                    icon.classList.add('text-gray-800');
                });

                // Update Search Input Style
                if(searchInput) {
                    searchInput.classList.remove('bg-white/20', 'text-white', 'placeholder-gray-200');
                    searchInput.classList.add('bg-gray-100', 'text-gray-800', 'placeholder-gray-500');
                }
                if(searchIcon) {
                    searchIcon.classList.remove('text-white');
                    searchIcon.classList.add('text-gray-600');
                }

            } else {
                // --- TOP STATE (Transparent Navbar) ---
                
                header.classList.add('bg-transparent', 'text-white');
                header.classList.remove('bg-white', 'shadow-md');
                
                // Show Top Bar smoothly
                if(topBar) {
                    topBar.style.maxHeight = '50px'; 
                    topBar.style.padding = '0.5rem 0';
                    topBar.style.opacity = '1';
                }
                
                navContainer.classList.add('py-4');
                navContainer.classList.remove('py-3');
                
                // Revert Logo Text
                if(logoText) {
                    logoText.classList.add('text-white');
                    logoText.classList.remove('text-brand-dark');
                }
                
                // Revert Link Colors
                navLinks.forEach(link => {
                    link.classList.add('text-white');
                    link.classList.remove('text-gray-800');
                });
                
                // Revert Icon Colors
                navIcons.forEach(icon => {
                    icon.classList.add('text-white');
                    icon.classList.remove('text-gray-800');
                });

                // Revert Search Input Style
                if(searchInput) {
                    searchInput.classList.add('bg-white/20', 'text-white', 'placeholder-gray-200');
                    searchInput.classList.remove('bg-gray-100', 'text-gray-800', 'placeholder-gray-500');
                }
                if(searchIcon) {
                    searchIcon.classList.add('text-white');
                    searchIcon.classList.remove('text-gray-600');
                }
            }
        });
    });
</script>