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
        <div id="navContainer" class="container mx-auto px-4 py-5 transition-all duration-300">
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
                        <li><a href="#" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Doors</a></li>
                        <li><a href="#" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Living</a></li>
                        <li><a href="#" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Bedroom</a></li>
                        <li><a href="#" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Dining</a></li>
                        <li><a href="#" class="nav-link text-white hover:text-brand-red transition-colors duration-300">Office</a></li>
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

                    <!-- Mobile Menu Button (Compact version fix) -->
                    <button onclick="toggleMobileMenu()" class="lg:hidden nav-icon text-white hover:text-brand-red transition-colors duration-300 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown (Hidden by default) -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white shadow-lg border-t border-gray-200 absolute w-full left-0 top-full">
            <div class="px-4 py-2 space-y-1 text-gray-800">
                <a href="{{ route('home') ?? '/' }}" class="block py-2 text-brand-red font-medium">Home</a>
                <a href="#" class="block py-2 border-b hover:text-brand-red transition">Doors</a>
                <a href="#" class="block py-2 border-b hover:text-brand-red transition">Living</a>
                <a href="#" class="block py-2 border-b hover:text-brand-red transition">Bedroom</a>
                <a href="#" class="block py-2 border-b hover:text-brand-red transition">Dining</a>
                <a href="#" class="block py-2 hover:text-brand-red transition">Office</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

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

    <!-- Scripts -->
    <script>
        // Fix for Mobile Menu
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            if(mobileMenu) {
                mobileMenu.classList.toggle('hidden');
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

        // Shrink header on scroll (Premium effect + Blending with Picture)
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            const topBar = document.getElementById('topBar');
            const navContainer = document.getElementById('navContainer');
            const logoText = document.getElementById('logoText');
            const searchInput = document.getElementById('searchInput');
            const searchIcon = document.getElementById('searchIcon');
            const navLinks = document.querySelectorAll('.nav-link');
            const navIcons = document.querySelectorAll('.nav-icon');

            if (window.scrollY > 50) {
                // Scrolled Down State: White Header
                header.classList.remove('bg-transparent', 'border-transparent');
                header.classList.add('bg-white', 'shadow-md', 'border-b', 'border-gray-200');

                // Collapse top bar
                if(topBar) {
                    topBar.style.maxHeight = '0px';
                    topBar.style.opacity = '0';
                    topBar.style.padding = '0';
                }
                
                // Make navbar slightly thinner
                if(navContainer) {
                    navContainer.classList.remove('py-4');
                    navContainer.classList.add('py-2');
                }

                // Change text from White to Dark
                if(logoText) {
                    logoText.classList.remove('text-white');
                    logoText.classList.add('text-brand-dark');
                }
                navLinks.forEach(link => {
                    link.classList.remove('text-white');
                    link.classList.add('text-gray-800');
                });
                navIcons.forEach(icon => {
                    icon.classList.remove('text-white');
                    icon.classList.add('text-gray-800');
                });

                // Update Search Input Colors
                if(searchInput) {
                    searchInput.classList.remove('bg-white/20', 'text-white', 'placeholder-gray-200', 'border-transparent');
                    searchInput.classList.add('bg-gray-100', 'text-gray-800', 'placeholder-gray-500', 'border-gray-300');
                }
                if(searchIcon) {
                    searchIcon.classList.remove('text-white');
                    searchIcon.classList.add('text-gray-600');
                }

            } else {
                // Top State: Transparent Header
                header.classList.add('bg-transparent', 'border-transparent');
                header.classList.remove('bg-white', 'shadow-md', 'border-b', 'border-gray-200');

                // Expand top bar
                if(topBar) {
                    topBar.style.maxHeight = '50px';
                    topBar.style.opacity = '1';
                    topBar.style.padding = '0.5rem 0';
                }

                // Restore navbar thickness
                if(navContainer) {
                    navContainer.classList.add('py-4');
                    navContainer.classList.remove('py-2');
                }

                // Change text back to White
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

                // Revert Search Input Colors
                if(searchInput) {
                    searchInput.classList.add('bg-white/20', 'text-white', 'placeholder-gray-200', 'border-transparent');
                    searchInput.classList.remove('bg-gray-100', 'text-gray-800', 'placeholder-gray-500', 'border-gray-300');
                }
                if(searchIcon) {
                    searchIcon.classList.add('text-white');
                    searchIcon.classList.remove('text-gray-600');
                }
            }
        });

        // Trigger scroll immediately on load to apply proper styles if the page is reloaded halfway down
        document.addEventListener('DOMContentLoaded', () => {
            window.dispatchEvent(new Event('scroll'));
        });
    </script>
</body>
</html>