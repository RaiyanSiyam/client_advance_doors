@extends('layouts.app')

@section('content')
<!-- Hero Slider Section -->
<div class="relative w-full h-[85vh] bg-brand-dark overflow-hidden">
    <img src="https://images.unsplash.com/photo-1618219908412-a29a1bb7b86e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
         class="absolute inset-0 w-full h-full object-cover opacity-50" 
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

    <!-- Slider Pagination Dots -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
        <button class="w-3 h-3 rounded-full bg-white/40 hover:bg-white transition"></button>
        <button class="w-3 h-3 rounded-full bg-white transition"></button>
        <button class="w-3 h-3 rounded-full bg-white/40 hover:bg-white transition"></button>
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
        <div class="w-full lg:w-1/3 flex flex-col justify-center lg:pr-12 text-center lg:text-left mb-10 lg:mb-0">
            <h2 class="text-5xl font-bold text-brand-dark mb-6 leading-tight">Creations with<br>purpose</h2>
            <p class="text-2xl text-gray-500 font-light mb-8">Many choices based on your space</p>
            <a href="{{ route('shop') }}" class="inline-block text-xl text-brand-dark font-medium border-b border-brand-dark pb-1 w-max hover:text-brand-red hover:border-brand-red transition mx-auto lg:mx-0">Explore Now</a>
        </div>

        <!-- Image Grid Column -->
        <div class="w-full lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Sofa">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1505843490538-5133c6c7d0e1?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Desk">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1617806118233-18e1c0945594?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Dining">
            </div>
            <div class="bg-gray-100 aspect-square group overflow-hidden cursor-pointer relative">
                <img src="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=600&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Kitchen">
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
                    <img src="https://images.unsplash.com/photo-1583847268964-b28e51136b34?w=400&q=80" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Cushion">
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
@endsection