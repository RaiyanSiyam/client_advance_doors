@extends('layouts.app')

@section('content')

<!-- Hero Section (Slider) -->
<section class="relative bg-brand-gray h-[500px] flex items-center overflow-hidden">
    <!-- Background Image Placeholder (Replace with actual dynamic slider later) -->
    <div class="absolute inset-0 bg-gray-200">
        <!-- Mockup Image Overlay -->
        <img src="https://images.unsplash.com/photo-1618220179428-22790b461013?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
             alt="Modern Living" 
             class="w-full h-full object-cover opacity-90">
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-lg bg-white/90 backdrop-blur-sm p-8 rounded-sm shadow-xl border-l-4 border-brand-red">
            <h2 class="text-sm font-bold text-brand-red tracking-widest uppercase mb-2">New Collection 2026</h2>
            <h1 class="text-4xl md:text-5xl font-bold text-brand-dark mb-4 leading-tight">
                Premium Doors & <br> Modern Furniture
            </h1>
            <p class="text-gray-600 mb-6">Experience the perfect blend of aesthetics and durability. Transform your home with Advance Doors.</p>
            <a href="#" class="inline-block bg-brand-red text-white px-8 py-3 font-medium text-sm uppercase tracking-wide hover:bg-red-800 transition duration-300 shadow-lg">
                Shop Now
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-brand-dark">Explore By Category</h2>
            <div class="w-16 h-1 bg-brand-red mx-auto mt-3"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            <!-- Category Item -->
            @foreach(['Doors', 'Sofas', 'Beds', 'Dining', 'Office', 'Misc'] as $category)
            <a href="#" class="group block text-center">
                <div class="w-32 h-32 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-brand-red transition duration-300 overflow-hidden relative">
                   <!-- Icon placeholder -->
                   <i class="fas fa-couch text-3xl text-gray-400 group-hover:text-white transition duration-300"></i>
                </div>
                <h3 class="font-medium text-gray-800 group-hover:text-brand-red transition">{{ $category }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products (Hatil Style Grid) -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-brand-dark">Best Sellers</h2>
                <div class="w-16 h-1 bg-brand-red mt-3"></div>
            </div>
            <a href="#" class="text-brand-red font-medium hover:text-brand-dark transition text-sm">View All <i class="fas fa-arrow-right ml-1"></i></a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Product Card 1 -->
            <div class="bg-white group hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="relative h-64 overflow-hidden bg-gray-200">
                    <span class="absolute top-4 left-4 bg-brand-red text-white text-xs font-bold px-2 py-1 z-10">NEW</span>
                    <img src="https://images.unsplash.com/photo-1517705600643-98fe9ccf3624?auto=format&fit=crop&w=500&q=80" 
                         alt="Door" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <!-- Hover Action -->
                    <div class="absolute bottom-0 left-0 right-0 bg-white/95 py-3 translate-y-full group-hover:translate-y-0 transition duration-300 flex justify-center space-x-4 shadow-top">
                        <button class="text-gray-800 hover:text-brand-red" title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        <button class="text-gray-800 hover:text-brand-red" title="Quick View"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">Entrance Doors</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-brand-red transition">Mahogany Solid Door</h3>
                    <div class="flex justify-center items-center space-x-2">
                        <span class="text-brand-red font-bold">$450.00</span>
                        <span class="text-gray-400 text-sm line-through">$550.00</span>
                    </div>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="bg-white group hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="relative h-64 overflow-hidden bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=500&q=80" 
                         alt="Sofa" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute bottom-0 left-0 right-0 bg-white/95 py-3 translate-y-full group-hover:translate-y-0 transition duration-300 flex justify-center space-x-4 shadow-top">
                        <button class="text-gray-800 hover:text-brand-red"><i class="fas fa-shopping-cart"></i></button>
                        <button class="text-gray-800 hover:text-brand-red"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">Living Room</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-brand-red transition">Velvet Green Sofa</h3>
                    <div class="flex justify-center items-center space-x-2">
                        <span class="text-brand-red font-bold">$1,200.00</span>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 & 4 would go here with similar structure -->
             <div class="bg-white group hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="relative h-64 overflow-hidden bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1505693416388-b0346ef12126?auto=format&fit=crop&w=500&q=80" 
                         alt="Sofa" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute bottom-0 left-0 right-0 bg-white/95 py-3 translate-y-full group-hover:translate-y-0 transition duration-300 flex justify-center space-x-4 shadow-top">
                        <button class="text-gray-800 hover:text-brand-red"><i class="fas fa-shopping-cart"></i></button>
                        <button class="text-gray-800 hover:text-brand-red"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">Bedroom</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-brand-red transition">King Size Bed</h3>
                    <div class="flex justify-center items-center space-x-2">
                        <span class="text-brand-red font-bold">$800.00</span>
                    </div>
                </div>
            </div>
             <div class="bg-white group hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="relative h-64 overflow-hidden bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1533090481720-856c6e3c1fdc?auto=format&fit=crop&w=500&q=80" 
                         alt="Sofa" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute bottom-0 left-0 right-0 bg-white/95 py-3 translate-y-full group-hover:translate-y-0 transition duration-300 flex justify-center space-x-4 shadow-top">
                        <button class="text-gray-800 hover:text-brand-red"><i class="fas fa-shopping-cart"></i></button>
                        <button class="text-gray-800 hover:text-brand-red"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">Dining</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-brand-red transition">Modern Dining Table</h3>
                    <div class="flex justify-center items-center space-x-2">
                        <span class="text-brand-red font-bold">$650.00</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
@include('partials.footer')

@endsection