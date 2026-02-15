<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Advance Doors | Premium Furniture & Doors</title>

    <!-- Fonts: Using Poppins for a modern, Hatil-like premium feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (In production, use @vite('resources/css/app.css')) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Config for Brand Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-red': '#B91C1C', // Deep red similar to Hatil's accent
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

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }
        /* Custom scrollbar for webkit */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #B91C1C; }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-white flex flex-col min-h-screen">

    <!-- Header Component -->
    @include('partials.header')

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Component -->
    @include('partials.footer')

    <!-- Scripts -->
    <script>
        // Basic Mobile Menu Logic
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>