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
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    <!-- Main Header -->
    <header id="mainHeader" class="w-full fixed top-0 z-50 transition-all duration-300 bg-transparent border-transparent">
       

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
                        <li><a href="{{ route('category.show', 'doors') }}" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Doors</a></li>
                        <li><a href="{{ route('category.show', 'living-room') }}" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Living Room</a></li>
                        <li><a href="{{ route('category.show', 'bedroom') }}" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Bedroom</a></li>
                        <li><a href="{{ route('category.show', 'dining') }}" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Dining</a></li>
                        <li><a href="{{ route('category.show', 'interior') }}" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Interior</a></li>    
                    </ul>
                </nav>

                <!-- Right Side Icons & Actions -->
                <div class="flex items-center space-x-5">
                    <!-- Search Form (Hidden on mobile) -->
                    <div class="hidden md:block relative">
                        <input type="text" placeholder="Search..." class="w-48 pl-4 pr-10 py-1.5 rounded-full border border-transparent focus:ring-2 focus:ring-brand-red bg-white/20 text-white placeholder-gray-200 outline-none backdrop-blur-sm transition-all duration-300" id="searchInput">
                        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white hover:text-brand-red transition-colors duration-300" id="searchIcon">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <!-- Mobile Search Icon -->
                    <button class="md:hidden nav-icon text-white hover:text-brand-red transition-colors duration-300">
                        <i class="fas fa-search text-xl"></i>
                    </button>

                    <!-- User Icon -->
                    <button class="nav-icon text-white hover:text-brand-red transition-colors duration-300"><i class="far fa-user text-xl"></i></button>
                    
                    <!-- Cart Icon -->
                    <button onclick="toggleCartDrawer()" class="nav-icon text-white hover:text-brand-red transition-colors duration-300 relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-brand-red text-white text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center">0</span>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMobileMenu()" class="lg:hidden nav-icon text-white hover:text-brand-red transition-colors duration-300 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown (Hidden by default) -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white shadow-2xl border-t-2 border-brand-red absolute w-full left-0 top-full transition-all duration-300">
            <div class="px-4 py-4 space-y-2 text-gray-800 font-medium">
                <a href="{{ route('category.show', 'doors') }}" class="block px-4 py-3 rounded-lg text-brand-red bg-gray-50 transition-colors duration-300">Doors</a>
                <a href="{{ route('category.show', 'living-room') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-50 hover:text-brand-red transition-colors duration-300">Living Room</a>
                <a href="{{ route('category.show', 'bedroom') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-50 hover:text-brand-red transition-colors duration-300">Bedroom</a>
                <a href="{{ route('category.show', 'dining') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-50 hover:text-brand-red transition-colors duration-300">Dining</a>
                <a href="{{ route('category.show', 'interior') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-50 hover:text-brand-red transition-colors duration-300">Interior</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

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
        let isMobileMenuOpen = false;

        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            if(mobileMenu) {
                mobileMenu.classList.toggle('hidden');
                // Track state to force white header if open
                isMobileMenuOpen = !mobileMenu.classList.contains('hidden');
                
                // Re-trigger scroll logic to apply color changes immediately
                window.dispatchEvent(new Event('scroll'));
            }
        }

        // Toggle Sub-Dropdown inside Mobile Menu
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

        const mainHeader = document.getElementById('mainHeader');
        const navContainer = document.getElementById('navContainer');
        const logoText = document.getElementById('logoText');
        const navLinks = document.querySelectorAll('.nav-link');
        const navIcons = document.querySelectorAll('.nav-icon');
        const searchInput = document.getElementById('searchInput');
        const searchIcon = document.getElementById('searchIcon');

        // Check if the current page is the homepage
        const isHomePage = {{ request()->is('/') ? 'true' : 'false' }};

        function updateHeaderStyles() {
         // If we scrolled down OR if we are NOT on the homepage, make it solid white
            if (window.scrollY > 50 || !isHomePage) {
            
                mainHeader.classList.add('bg-white', 'border-gray-200', 'shadow-md');
                mainHeader.classList.remove('bg-transparent', 'border-transparent');
                
                navContainer.classList.add('py-2');
                navContainer.classList.remove('py-4');
                
                if(logoText) {
                    logoText.classList.add('text-brand-dark');
                    logoText.classList.remove('text-white');
                }
                navLinks.forEach(link => {
                    link.classList.add('text-gray-800');
                    link.classList.remove('text-white');
                });
                navIcons.forEach(icon => {
                    icon.classList.add('text-gray-800');
                    icon.classList.remove('text-white');
                });
                
                if(searchInput) {
                    searchInput.classList.add('bg-gray-100', 'text-gray-800', 'placeholder-gray-500', 'border-gray-300');
                    searchInput.classList.remove('bg-white/20', 'text-white', 'placeholder-gray-200', 'border-transparent');
                }
                if(searchIcon) {
                    searchIcon.classList.add('text-gray-600');
                    searchIcon.classList.remove('text-white');
                }
            } else {
                // Only make it transparent if we are ON the homepage and at the VERY TOP
                mainHeader.classList.add('bg-transparent', 'border-transparent');
                mainHeader.classList.remove('bg-white', 'border-gray-200', 'shadow-md');
                
                navContainer.classList.add('py-4');
                navContainer.classList.remove('py-2');
                
                if(logoText) {
                    logoText.classList.add('text-white');
                    logoText.classList.remove('text-brand-dark');
                }
                navLinks.forEach(link => {
                    link.classList.add('text-white');
                    link.classList.remove('text-gray-800');
                });
                navIcons.forEach(icon => {
                    icon.classList.add('text-white');
                    icon.classList.remove('text-gray-800');
                });
                
                if(searchInput) {
                    searchInput.classList.add('bg-white/20', 'text-white', 'placeholder-gray-200', 'border-transparent');
                    searchInput.classList.remove('bg-gray-100', 'text-gray-800', 'placeholder-gray-500', 'border-gray-300');
                }
                if(searchIcon) {
                    searchIcon.classList.add('text-white');
                    searchIcon.classList.remove('text-gray-600');
                }
            }
        }

        window.addEventListener('scroll', updateHeaderStyles);
        document.addEventListener('DOMContentLoaded', updateHeaderStyles);
    </script>
</body>
</html>