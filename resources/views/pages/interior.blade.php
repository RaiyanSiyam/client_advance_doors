@extends('layouts.app')

@section('content')

<!-- Header Section (Ultra Compact) -->
<div class="pt-20 pb-4 lg:pt-28 lg:pb-8 bg-transparent border-b border-gray-100">
    <div class="container mx-auto px-4 max-w-7xl text-center">
        <!-- Breadcrumbs -->
        <nav class="text-[10px] sm:text-xs mb-3 flex justify-center" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center space-x-2 text-gray-500">
                <li><a href="{{ route('home') ?? '/' }}" class="hover:text-brand-red transition">Home</a></li>
                <li><i class="fas fa-chevron-right text-[8px] text-gray-400 mx-1"></i></li>
                <li class="text-gray-900 font-medium">Interior Design Works</li>
            </ol>
        </nav>

        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-brand-dark mb-2 sm:mb-3">
            Transforming Spaces into <span class="text-brand-red">Masterpieces</span>
        </h1>
        <p class="max-w-3xl mx-auto text-[13px] sm:text-sm text-gray-600 leading-relaxed">
            At Advance Doors, we go beyond just providing premium materials. Our dedicated interior design and installation teams bring decades of craftsmanship to your home. From bespoke wooden paneling to complete room transformations, we ensure every detail is executed to absolute perfection.
        </p>
    </div>
</div>

<!-- Call to Action / Quotation Section (Ultra Compact) -->
<div class="py-6 sm:py-10 bg-transparent">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <i class="fas fa-drafting-compass text-2xl sm:text-3xl text-brand-red mb-2 sm:mb-3"></i>
        <h2 class="text-xl sm:text-3xl font-bold text-brand-dark mb-1.5 sm:mb-2">Ready to elevate your space?</h2>
        <p class="text-[13px] sm:text-base text-gray-600 mb-4 sm:mb-6">Our expert designers and craftsmen are ready to bring your vision to life. Get in touch with us today to discuss your project requirements.</p>
        
        <!-- Blended Contact Box -->
        <div class="bg-white border border-gray-100 shadow-md p-4 sm:p-6 rounded-xl max-w-md mx-auto relative overflow-hidden">
            <!-- Decorative touches for beauty -->
            <div class="absolute top-0 right-0 w-16 sm:w-24 h-16 sm:h-24 bg-brand-red/5 rounded-bl-full -z-10"></div>
            <div class="absolute bottom-0 left-0 w-12 sm:w-16 h-12 sm:h-16 bg-gray-50 rounded-tr-full -z-10"></div>

            <h3 class="text-base sm:text-lg text-brand-dark font-medium mb-1 relative z-10">Contact us to get a quotation</h3>
            <div class="flex items-center justify-center gap-2 sm:gap-3 text-lg sm:text-2xl font-bold text-brand-red my-1.5 sm:my-2 relative z-10">
                <i class="fas fa-phone-alt text-base sm:text-xl"></i>
                <a href="tel:+8801924458445" class="hover:text-red-800 transition">+880 1924-458445</a>
            </div>
            <p class="text-[11px] sm:text-xs text-gray-500 relative z-10">Available Monday to Saturday, 10:00 AM - 10:00 PM</p>
        </div>
        
        <!-- WhatsApp Message Button -->
        <div class="mt-4 sm:mt-5">
            <a href="https://wa.me/8801924458445" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-5 py-2 sm:px-6 sm:py-2.5 bg-[#25D366] text-white text-[13px] sm:text-sm font-medium rounded-md hover:bg-[#1da851] transition shadow-md hover:shadow-[#25D366]/30">
                <i class="fab fa-whatsapp text-base sm:text-lg"></i> Send us a message
            </a>
        </div>
    </div>
</div>

<!-- Gallery Section (Ultra Compact & 2-per-row on Mobile) -->
<div class="container mx-auto px-4 pb-12 sm:pb-16 max-w-7xl">
    <div class="text-center mb-5 sm:mb-8">
        <h2 class="text-lg sm:text-2xl font-bold text-brand-dark mb-1.5 sm:mb-2">Our Recent Projects</h2>
        <div class="w-10 sm:w-12 h-1 bg-brand-red mx-auto rounded"></div>
    </div>

    <!-- Masonry-style Grid (Explicitly grid-cols-2 on mobile, tighter gaps) -->
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-4 lg:gap-6">
        
        <!-- Gallery Item 1 -->
        <div class="group relative overflow-hidden rounded-lg shadow-sm aspect-square sm:aspect-[4/5]">
            <img src="https://www.interioracebd.com/images/jobs/56699-luxury-modern-living-room-design.jpg" alt="Interior Work 1" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-2 sm:p-4">
                <p class="text-white font-medium text-[10px] sm:text-sm leading-tight">Modern Living Room Setup</p>
            </div>
        </div>

        <!-- Gallery Item 2 -->
        <div class="group relative overflow-hidden rounded-lg shadow-sm aspect-square sm:aspect-[4/5]">
            <img src="https://www.bengalinteriors.com/wp-content/uploads/2024/12/Drawing-Room-Interior-Design-in-BD.jpg" alt="Interior Work 2" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-2 sm:p-4">
                <p class="text-white font-medium text-[10px] sm:text-sm leading-tight">Custom Door Installation</p>
            </div>
        </div>

        <!-- Gallery Item 3 -->
        <div class="group relative overflow-hidden rounded-lg shadow-sm aspect-square sm:aspect-[4/5]">
            <img src="https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Interior Work 3" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-2 sm:p-4">
                <p class="text-white font-medium text-[10px] sm:text-sm leading-tight">Luxury Bedroom Finish</p>
            </div>
        </div>

        <!-- Gallery Item 4 -->
        <div class="group relative overflow-hidden rounded-lg shadow-sm aspect-square sm:aspect-[4/5]">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Interior Work 4" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-2 sm:p-4">
                <p class="text-white font-medium text-[10px] sm:text-sm leading-tight">Bespoke Wall Paneling</p>
            </div>
        </div>

        <!-- Gallery Item 5 (Spans 2 columns, adjusted aspect ratio for mobile) -->
        <div class="group relative overflow-hidden rounded-lg shadow-sm aspect-[2/1] sm:aspect-[4/5] col-span-2 lg:col-span-2">
            <img src="https://www.bengalinteriors.com/wp-content/uploads/2022/02/best-interior-design-company-in-bangladesh.jpg" alt="Interior Work 5" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-2 sm:p-4">
                <p class="text-white font-medium text-[11px] sm:text-base leading-tight">Complete Home Renovation Project</p>
            </div>
        </div>

    </div>
</div>

@endsection