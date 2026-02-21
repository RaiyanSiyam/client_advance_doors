<header class="w-full bg-white sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Logo (Hatil Style) -->
            <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                <div class="bg-brand-red text-white font-bold text-2xl tracking-tight px-3 py-1 mr-1">
                    ADVANCE
                </div>
                <div class="text-brand-dark font-bold text-2xl tracking-tighter">
                    DOORS
                </div>
            </a>

            <!-- Main Navigation -->
            <nav class="hidden xl:block flex-1 px-8">
                <ul class="flex justify-center space-x-6 text-[15px] font-medium text-gray-800">
                    <li class="hover:text-brand-red transition cursor-pointer"><a href="{{ route('home') }}">Home</a></li>
                    <li class="hover:text-brand-red transition cursor-pointer"><a href="{{ route('shop') }}">Living Room</a></li>
                    
                    <!-- Mega Menu Trigger -->
                    <li class="group static">
                        <a href="{{ route('shop') }}" class="block py-8 hover:text-brand-red transition">Bedroom</a>
                        
                        <!-- Mega Menu Dropdown -->
                        <div class="absolute left-0 top-full w-full bg-white shadow-xl border-t border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="container mx-auto px-8 py-10 flex gap-16">
                                <div class="w-1/4">
                                    <h4 class="font-bold text-brand-dark mb-4 hover:text-brand-red cursor-pointer">Bed Room Set</h4>
                                    <h4 class="font-bold text-brand-dark mb-3 mt-6 hover:text-brand-red cursor-pointer flex items-center gap-1">Bed <i class="fas fa-arrow-right text-xs"></i></h4>
                                    <ul class="space-y-2 text-sm text-gray-600">
                                        <li><a href="#" class="hover:text-brand-red transition">King Size Bed</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Queen Size Bed</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Semi Double Bed</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Bed with Storage</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Low Height Bed</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Sofa Cum Bed</a></li>
                                    </ul>
                                </div>
                                <div class="w-1/4">
                                    <h4 class="font-bold text-brand-dark mb-3 hover:text-brand-red cursor-pointer flex items-center gap-1">Wardrobe <i class="fas fa-arrow-right text-xs"></i></h4>
                                    <ul class="space-y-2 text-sm text-gray-600">
                                        <li><a href="#" class="hover:text-brand-red transition">Wardrobe With Mirror</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Wardrobe With Slide Door</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Modular Wardrobe</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Non-Lacquer Wardrobe</a></li>
                                    </ul>
                                </div>
                                <div class="w-1/4">
                                    <h4 class="font-bold text-brand-dark mb-3 hover:text-brand-red cursor-pointer flex items-center gap-1">Chest of Drawers <i class="fas fa-arrow-right text-xs"></i></h4>
                                    <ul class="space-y-2 text-sm text-gray-600 mb-6">
                                        <li><a href="#" class="hover:text-brand-red transition">Non-Lacquer Chest of Drawers</a></li>
                                    </ul>
                                    <h4 class="font-bold text-brand-dark mb-3 hover:text-brand-red cursor-pointer flex items-center gap-1">Dressing Table <i class="fas fa-arrow-right text-xs"></i></h4>
                                    <ul class="space-y-2 text-sm text-gray-600">
                                        <li><a href="#" class="hover:text-brand-red transition">Non-Lacquer Dressing Table</a></li>
                                        <li><a href="#" class="hover:text-brand-red transition">Dressing Table With Storage</a></li>
                                    </ul>
                                </div>
                                <div class="w-1/4">
                                    <img src="https://images.unsplash.com/photo-1505693416388-b0346ef12126?w=400&q=80" alt="Bedroom Promotion" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="hover:text-brand-red transition cursor-pointer py-8"><a href="#">Dining</a></li>
                    <li class="hover:text-brand-red transition cursor-pointer py-8"><a href="#">Kitchen</a></li>
                    <li class="hover:text-brand-red transition cursor-pointer py-8"><a href="#">Kids' Room</a></li>
                    <li class="hover:text-brand-red transition cursor-pointer py-8"><a href="#">SmartFit</a></li>
                    <li class="hover:text-brand-red transition cursor-pointer py-8"><a href="#">Door</a></li>
                    <li class="hover:text-brand-red transition cursor-pointer py-8"><a href="#">Interior</a></li>
                    <li class="hover:text-brand-red transition cursor-pointer py-8 flex items-center gap-1">More <i class="fas fa-caret-down text-xs"></i></li>
                </ul>
            </nav>

            <!-- Right Icons -->
            <div class="flex items-center space-x-6">
                <button class="text-gray-800 hover:text-brand-red transition">
                    <i class="fas fa-search text-lg"></i>
                </button>
                <button onclick="toggleCart()" class="text-gray-800 hover:text-brand-red transition relative">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-brand-red text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">0</span>
                </button>
                <button class="text-gray-800 hover:text-brand-red transition">
                    <i class="far fa-user text-lg"></i>
                </button>
                
                <button class="xl:hidden text-gray-800 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Slide-out Cart Drawer (Hidden by default) -->
    <div id="cartDrawerOverlay" onclick="toggleCart()" class="fixed inset-0 bg-black/40 z-[60] hidden opacity-0 transition-opacity duration-300"></div>
    <div id="cartDrawer" class="fixed inset-y-0 right-0 w-[400px] max-w-full bg-white shadow-2xl z-[70] transform translate-x-full transition-transform duration-300 flex flex-col">
        <!-- Cart Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <h2 class="text-xl font-medium text-brand-dark">Your Cart (0)</h2>
            <button onclick="toggleCart()" class="bg-brand-red text-white w-8 h-8 flex items-center justify-center hover:bg-red-700 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Cart Content (Empty State) -->
        <div class="flex-1 flex flex-col items-center justify-center p-8 text-center">
            <svg class="w-48 h-48 mb-6 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="text-gray-500">Your shopping cart is currently empty.</p>
            <a href="{{ route('shop') }}" class="mt-8 bg-brand-dark text-white px-8 py-3 hover:bg-brand-red transition uppercase tracking-wider text-sm">Return to Shop</a>
        </div>
    </div>
</header>

<script>
    function toggleCart() {
        const drawer = document.getElementById('cartDrawer');
        const overlay = document.getElementById('cartDrawerOverlay');
        
        if (drawer.classList.contains('translate-x-full')) {
            // Open
            drawer.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        } else {
            // Close
            drawer.classList.add('translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }
    }
</script>