<footer class="bg-gray-100 pt-20 pb-10 border-t border-gray-200">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-6 mb-16">
            
            <!-- Brand Column (Takes 2 columns space) -->
            <div class="lg:col-span-2 pr-8">
                <a href="{{ route('home') }}" class="inline-block mb-6">
                    <div class="flex items-center">
                        <div class="bg-brand-red text-white font-bold text-2xl tracking-tight px-3 py-1 mr-1">
                            ADVANCE
                        </div>
                        <div class="text-brand-dark font-bold text-2xl tracking-tighter">
                            DOORS
                        </div>
                    </div>
                </a>
                <p class="text-gray-500 text-sm mb-8 leading-relaxed font-light pr-4">
                    Advance Doors provides world-class home furniture and interior solutions. We craft elegance that transcends trends and turns your home into a sanctuary of sophistication.
                </p>
                <div class="flex space-x-3">
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-300 text-gray-500 flex items-center justify-center hover:bg-brand-red hover:text-white hover:border-brand-red transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-300 text-gray-500 flex items-center justify-center hover:bg-brand-red hover:text-white hover:border-brand-red transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-300 text-gray-500 flex items-center justify-center hover:bg-brand-red hover:text-white hover:border-brand-red transition"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Links Column 1 -->
            <div>
                <h4 class="text-sm font-bold text-brand-dark mb-6 uppercase tracking-widest">Company</h4>
                <ul class="space-y-4 text-sm text-gray-500 font-light">
                    <li><a href="#" class="hover:text-brand-red transition">About Us</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Store Locator</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Career</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">News & Events</a></li>
                </ul>
            </div>

            <!-- Links Column 2 -->
            <div>
                <h4 class="text-sm font-bold text-brand-dark mb-6 uppercase tracking-widest">Support</h4>
                <ul class="space-y-4 text-sm text-gray-500 font-light">
                    <li><a href="{{ route('contact') }}" class="hover:text-brand-red transition">Contact Us</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Warranty Policy</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">EMI Facilities</a></li>
                    <li><a href="#" class="hover:text-brand-red transition">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div>
                <h4 class="text-sm font-bold text-brand-dark mb-6 uppercase tracking-widest">Reach Us</h4>
                <ul class="space-y-4 text-sm text-gray-500 font-light">
                    <li class="flex items-start">
                        <i class="fas fa-phone-alt mt-1 mr-3 text-gray-400 w-4"></i>
                        <span>09 678 7777 77</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope mt-1 mr-3 text-gray-400 w-4"></i>
                        <span>info@advancedoors.com</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-gray-400 w-4"></i>
                        <span>123 Furniture Ave, Dhaka</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400 font-light tracking-wide">
            <p>&copy; 2026 Advance Doors. All Rights Reserved.</p>
            <div class="mt-4 md:mt-0 flex gap-4">
                <a href="#" class="hover:text-brand-dark transition">Terms of Service</a>
                <a href="#" class="hover:text-brand-dark transition">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>