@extends('layouts.app')

@section('content')
<!-- Hero Slider Section -->
<div class="relative w-full h-[85vh] bg-brand-dark overflow-hidden">
    
    <!-- Slide 1 -->
    <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-100 z-10">
        <!-- Removed opacity-50 so the picture is fully visible -->
        <img src="https://images.unsplash.com/photo-1618219908412-a29a1bb7b86e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
             class="absolute inset-0 w-full h-full object-cover" 
             alt="Premium Interior">
        
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-white text-6xl md:text-[5.5rem] font-bold mb-4 tracking-tight drop-shadow-md">
                Sets you as a trend
            </h1>
            <div class="flex items-center gap-4">
                <div class="w-16 h-[1px] bg-white"></div>
                <p class="text-white text-3xl md:text-5xl font-light tracking-wide drop-shadow-md">
                    aesthetically stylish setter
                </p>
            </div>
        </div>
    </div>

    <!-- Slide 2 -->
    <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-0 z-0">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
             class="absolute inset-0 w-full h-full object-cover" 
             alt="Modern Doors">
        
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-white text-6xl md:text-[5.5rem] font-bold mb-4 tracking-tight drop-shadow-md">
                Sets you as a trend
            </h1>
            <div class="flex items-center gap-4">
                <div class="w-16 h-[1px] bg-white"></div>
                <p class="text-white text-3xl md:text-5xl font-light tracking-wide drop-shadow-md">
                    aesthetically stylish setter
                </p>
            </div>
        </div>
    </div>

    <!-- Slide 3 -->
    <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-0 z-0">
        <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
             class="absolute inset-0 w-full h-full object-cover" 
             alt="Luxury Furniture">
        
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-white text-6xl md:text-[5.5rem] font-bold mb-4 tracking-tight drop-shadow-md">
                Sets you as a trend
            </h1>
            <div class="flex items-center gap-4">
                <div class="w-16 h-[1px] bg-white"></div>
                <p class="text-white text-3xl md:text-5xl font-light tracking-wide drop-shadow-md">
                    aesthetically stylish setter
                </p>
            </div>
        </div>
    </div>

    <!-- Slider Pagination Dots -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
        <button class="slider-dot w-3 h-3 rounded-full bg-white transition"></button>
        <button class="slider-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white transition"></button>
        <button class="slider-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white transition"></button>
    </div>
</div>

    <!-- Floating Contact/Chat Buttons -->
    <div class="absolute bottom-10 left-10 text-white flex flex-col gap-1">
        <i class="fas fa-phone-alt mb-1 opacity-80"></i>
        <span class="text-sm font-light">09 678 7777 77</span>
    </div>
    <div class="absolute bottom-10 right-10">
        <button class="bg-brand-red w-14 h-14 rounded-full flex items-center justify-center text-white text-xl shadow-lg hover:bg-red-700 transition">
            <i class="fas fa-comment"></i>
        </button>
    </div>
</div>

<!-- Asymmetrical Grid Layout (Creations with purpose) -->
<div class="container mx-auto px-4 lg:px-8 py-20">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Text Column -->
        <div class="w-full lg:w-1/3 flex flex-col justify-center lg:pr-12 text-left mb-10 lg:mb-0">
            <h2 class="text-5xl font-bold text-brand-dark mb-6 leading-tight">Creations with<br>purpose</h2>
            <p class="text-2xl text-gray-500 font-light mb-8">Many choices based on your space</p>
            <a href="{{ route('shop') }}" class="inline-block text-xl text-brand-dark font-medium border-b border-brand-dark pb-1 w-max hover:text-brand-red hover:border-brand-red transition">Explore Now</a>
        </div>

        <!-- Image Grid Column (Changed from grid-cols-2 to grid-cols-3) -->
        <div class="w-full lg:w-2/3 grid grid-cols-3 gap-4">
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Sofa">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1505843490538-5133c6c7d0e1?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Desk">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://craftsmill.in/cdn/shop/files/dining-1-table-100-cm-diameter-x-76-cm-h-4-nantes-chairs-hessian-beige-100-cotton-fabric-distressed-white-on-chairs-and-table-frame-legs-in-mango-wood-walnut-finish-on-table-top-in-ma.jpg?v=1725045379" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Dining">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Kitchen">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Living Room">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1538688525198-9b88f6f53126?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Decor">
            </div>
        </div>
    </div>
</div>

<!-- Split Feature Blocks -->
<div class="w-full flex flex-col md:flex-row h-auto md:h-[70vh]">
    <!-- Left Block -->
    <div class="relative w-full md:w-1/2 h-[50vh] md:h-full overflow-hidden group">
        <img src="https://images.unsplash.com/photo-1505693314120-0d443867891c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Personification" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex flex-col justify-center p-12 md:p-20 text-white">
            <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Designed to enhance<br>your personification</h2>
            <a href="{{ route('shop') }}" class="inline-block text-lg font-medium border-b border-white pb-1 w-max hover:text-gray-200 transition">Explore Now</a>
        </div>
    </div>
    
    <!-- Right Block -->
    <div class="relative w-full md:w-1/2 h-[50vh] md:h-full overflow-hidden group">
        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Convenience" class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105">
        <div class="absolute inset-0 bg-gray-500/30 mix-blend-multiply"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-end text-right p-12 md:p-20 text-white">
            <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Innovative enough to<br>stylize according to<br>convenience</h2>
            <a href="{{ route('shop') }}" class="inline-block text-lg font-medium border-b border-white pb-1 w-max hover:text-gray-200 transition">Explore Now</a>
        </div>
    </div>
</div>

<!-- Wide Banner Section -->
<div class="relative w-full h-[60vh] bg-gray-100 mt-2">
    <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" class="absolute inset-0 w-full h-full object-cover" alt="Bundle of satisfaction">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center px-4">
        <h2 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight">Made for creating tasty memories</h2>
        <div class="flex items-center gap-6 justify-center">
            <div class="w-16 h-[1px] bg-white hidden md:block"></div>
            <p class="text-4xl md:text-6xl font-light">Bundle of satisfaction</p>
            <div class="w-16 h-[1px] bg-white hidden md:block"></div>
        </div>
    </div>
</div>



<!-- Living Room Category Section -->
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-light text-brand-dark">Living Room</h2>
            <div class="w-full h-[1px] bg-gray-300 mt-2 mb-10 max-w-[200px] mx-auto"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Category Cards -->
            <a href="#" class="group text-center">
                <div class="bg-gray-200 aspect-square overflow-hidden mb-4">
                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&q=80" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Sofa Set">
                </div>
                <h3 class="text-lg text-gray-700 group-hover:text-brand-red transition">Sofa Set</h3>
            </a>
            <a href="#" class="group text-center">
                <div class="bg-gray-200 aspect-square overflow-hidden mb-4">
                    <img src="https://cdn.ecommercedns.uk/files/5/204455/1/49730361/cushion05.jpg" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Cushion">
                </div>
                <h3 class="text-lg text-gray-700 group-hover:text-brand-red transition">Cushion</h3>
            </a>
            <a href="#" class="group text-center">
                <div class="bg-gray-200 aspect-square overflow-hidden mb-4">
                    <img src="https://images.unsplash.com/photo-1532372320572-cda25653a26d?w=400&q=80" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Center Table">
                </div>
                <h3 class="text-lg text-gray-700 group-hover:text-brand-red transition">Center Table</h3>
            </a>
            <a href="#" class="group text-center">
                <div class="bg-gray-200 aspect-square overflow-hidden mb-4">
                    <img src="https://images.unsplash.com/photo-1505693314120-0d443867891c?w=400&q=80" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Divan">
                </div>
                <h3 class="text-lg text-gray-700 group-hover:text-brand-red transition">Divan</h3>
            </a>
        </div>
    </div>
</div>

<!-- Featured Products Slider Section -->
<div class="bg-zinc-50 py-16">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header & Navigation -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Featured Products</h2>
                <div class="w-24 h-1 bg-zinc-900"></div>
            </div>
            <div class="flex gap-3">
                <button id="slideLeftBtn" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-zinc-900 hover:text-white hover:border-zinc-900 transition focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button id="slideRightBtn" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-zinc-900 hover:text-white hover:border-zinc-900 transition focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <!-- Dynamic Slider Container -->
        <div id="featuredSliderContainer" class="flex gap-6 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-8 pt-2">
            
            @forelse($featuredProducts ?? [] as $product)
                <!-- Dynamic Product Card -->
                <div class="min-w-[280px] md:min-w-[320px] snap-start group relative bg-white shadow-sm rounded-lg p-3 transition-shadow hover:shadow-xl">
                    <div class="bg-gray-100 aspect-[4/5] overflow-hidden relative mb-4 rounded-md">
                        
                        <!-- Optional Badge (e.g. if the product has a discount) -->
                        @if(isset($product->discount_price))
                            <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 z-10 rounded">SALE</span>
                        @endif

                        <!-- Product Image (with a fallback if no image is uploaded) -->
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=500&q=80' }}" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-105" 
                             alt="{{ $product->name }}">
                        
                        <!-- Quick Actions Hover -->
                        <div class="absolute inset-x-0 bottom-4 flex justify-center gap-2 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-10">
                            <button class="bg-white text-zinc-900 w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-zinc-900 hover:text-white transition" title="Add to Wishlist">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                            <form action="{{ route('cart.add', $product->id ?? 1) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="bg-zinc-900 text-white px-6 py-2 rounded-full font-medium shadow-md hover:bg-brand-red transition">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="px-2 pb-2">
                        <!-- Category Name -->
                        <p class="text-sm text-gray-500 mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        
                        <!-- Product Name & Link -->
                        <h3 class="text-lg font-medium text-gray-900 truncate">
                            <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="hover:text-brand-red transition">
                                {{ $product->name }}
                            </a>
                        </h3>
                        
                        <!-- Price -->
                        <div class="flex items-center gap-2 mt-2">
                            <p class="text-zinc-900 font-bold">${{ number_format($product->price ?? 0, 2) }}</p>
                            @if(isset($product->old_price) && $product->old_price > $product->price)
                                <p class="text-gray-400 line-through text-sm">${{ number_format($product->old_price, 2) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-8 text-gray-500">
                    No featured products available at the moment.
                </div>
            @endforelse

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        
        let currentSlide = 0;
        const slideCount = slides.length;
        let sliderInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                    
                    dots[i].classList.remove('bg-white/40');
                    dots[i].classList.add('bg-white');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                    
                    dots[i].classList.remove('bg-white');
                    dots[i].classList.add('bg-white/40');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slideCount;
            showSlide(currentSlide);
        }

        function startSlider() {
            // Set 5 seconds interval
            sliderInterval = setInterval(nextSlide, 5000); 
        }

        function resetSlider() {
            clearInterval(sliderInterval);
            startSlider();
        }

        // Make dots clickable
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
                resetSlider();
            });
        });

        // Initialize
        showSlide(0);
        startSlider();

    
        // --- Featured Products Horizontal Slider Logic ---
        const productSlider = document.getElementById('featuredSliderContainer');
        const slideLeftBtn = document.getElementById('slideLeftBtn');
        const slideRightBtn = document.getElementById('slideRightBtn');

        // Scroll amount corresponds to card width + gap (approx 344px)
        const scrollAmount = 344; 

        if (slideLeftBtn && productSlider) {
            slideLeftBtn.addEventListener('click', () => {
                productSlider.scrollBy({
                    top: 0,
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });
        }

        if (slideRightBtn && productSlider) {
            slideRightBtn.addEventListener('click', () => {
                productSlider.scrollBy({
                    top: 0,
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        }

    });
</script>
@endsection