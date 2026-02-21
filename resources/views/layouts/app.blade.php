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
    <header class="w-full bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm transition-all duration-300" id="mainHeader">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-[72px]">
                
                <!-- Logo -->
                <a href="{{ route('home') ?? '#' }}" class="flex-shrink-0 flex items-center group">
                    <div class="bg-brand-red text-white font-bold text-xl md:text-2xl tracking-tight px-3 py-1 mr-1 transition-transform group-hover:scale-105">
                        ADVANCE
                    </div>
                    <div class="text-brand-dark font-bold text-xl md:text-2xl tracking-tighter">
                        DOORS
                    </div>
                </a>

                <!-- Desktop Menu (Updated Navigation) -->
                <nav class="hidden lg:flex flex-1 justify-center px-8 h-full">
                    <ul class="flex space-x-10 text-[15px] font-medium text-gray-800 h-full">
                        
                        <li class="h-full flex items-center group">
                            <a href="#" class="relative group/link hover:text-brand-red transition-colors py-2 h-full flex items-center">
                                Living Room
                                <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-brand-red transition-all duration-300 group-hover/link:w-full"></span>
                            </a>
                        </li>

                        <li class="h-full flex items-center group">
                            <a href="#" class="relative group/link hover:text-brand-red transition-colors py-2 h-full flex items-center">
                                Bedroom
                                <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-brand-red transition-all duration-300 group-hover/link:w-full"></span>
                            </a>
                        </li>

                        <li class="h-full flex items-center group">
                            <a href="#" class="relative group/link hover:text-brand-red transition-colors py-2 h-full flex items-center">
                                Dining
                                <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-brand-red transition-all duration-300 group-hover/link:w-full"></span>
                            </a>
                        </li>

                        <li class="h-full flex items-center group">
                            <a href="#" class="relative group/link hover:text-brand-red transition-colors py-2 h-full flex items-center">
                                Door
                                <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-brand-red transition-all duration-300 group-hover/link:w-full"></span>
                            </a>
                        </li>
                        
                    </ul>
                </nav>

                <!-- Right Icons -->
                <div class="flex items-center space-x-5 lg:space-x-6 text-gray-800">
                    <button class="hover:text-brand-red transition">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <button class="hidden lg:block hover:text-brand-red transition">
                        <i class="far fa-heart text-lg"></i>
                    </button>
                    <!-- Cart Toggle Button -->
                    <button onclick="toggleCart()" class="hover:text-brand-red transition relative group">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <span class="absolute -top-1.5 -right-2 bg-brand-red text-white text-[9px] font-bold rounded-full h-4 w-4 flex items-center justify-center border-2 border-white shadow-sm group-hover:scale-110 transition-transform">0</span>
                    </button>
                    <button class="hidden lg:block hover:text-brand-red transition">
                        <i class="far fa-user text-lg"></i>
                    </button>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="lg:hidden text-gray-800 hover:text-brand-red focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Slide-out Cart Drawer (Lag-Free Version) -->
    <!-- We use pointer-events-none instead of display:none (hidden) to prevent rendering lag -->
    <div id="cartDrawerOverlay" onclick="toggleCart()" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] opacity-0 pointer-events-none transition-opacity duration-300 ease-out"></div>
    
    <div id="cartDrawer" class="fixed inset-y-0 right-0 w-[400px] max-w-full bg-white shadow-2xl z-[70] transform translate-x-full transition-transform duration-300 ease-out flex flex-col will-change-transform">
        <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-gray-50">
            <h2 class="text-lg font-bold text-brand-dark uppercase tracking-wide">Shopping Cart <span class="text-brand-red font-normal">(0)</span></h2>
            <button onclick="toggleCart()" class="text-gray-400 hover:text-brand-red transition transform hover:rotate-90 duration-300">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="flex-1 flex flex-col items-center justify-center p-8 text-center bg-white">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-shopping-bag text-4xl text-gray-300"></i>
            </div>
            <h3 class="text-xl font-medium text-brand-dark mb-2">Your cart is empty</h3>
            <p class="text-gray-500 font-light mb-8">Looks like you haven't added any furniture yet.</p>
            <a href="#" class="w-full bg-brand-red text-white px-8 py-3.5 hover:bg-red-800 transition uppercase tracking-widest text-sm font-medium text-center">Start Shopping</a>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

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
                    <p class="text-sm"><i class="fas fa-map-marker-alt mr-2"></i> 123 Furniture Avenue, City, State</p>
                    <p class="text-sm"><i class="fas fa-phone-alt mr-2"></i> +1 234-567890</p>
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
        // High-Performance Lag-Free Cart Toggle
        function toggleCart() {
            const drawer = document.getElementById('cartDrawer');
            const overlay = document.getElementById('cartDrawerOverlay');
            
            const isClosed = drawer.classList.contains('translate-x-full');
            
            if (isClosed) {
                // Open Drawer
                drawer.classList.remove('translate-x-full');
                
                // Show Overlay (using pointer-events to prevent reflow lag)
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100', 'pointer-events-auto');
                
                // Prevent background scrolling
                document.body.style.overflow = 'hidden';
            } else {
                // Close Drawer
                drawer.classList.add('translate-x-full');
                
                // Hide Overlay
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                
                // Restore background scrolling
                document.body.style.overflow = '';
            }
        }

        // Shrink header on scroll (Premium effect)
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) {
                header.classList.add('shadow-md');
            } else {
                header.classList.remove('shadow-md');
            }
        });
    </script>
</body>
</html>