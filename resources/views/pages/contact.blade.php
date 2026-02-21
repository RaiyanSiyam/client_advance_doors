@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="w-full bg-white py-16 border-b-4 border-brand-red">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-brand-red mb-4 tracking-tight uppercase">Contact Us</h1>
        <p class="text-lg text-gray-500 font-light max-w-2xl mx-auto">We are here to assist you with any inquiries about our premium furniture and door collections.</p>
    </div>
</div>

<div class="container mx-auto px-4 lg:px-8 py-20 bg-white">
    <div class="flex flex-col lg:flex-row gap-16 lg:gap-24">
        
        <!-- Contact Information Side -->
        <div class="w-full lg:w-1/3">
            <h2 class="text-3xl font-bold text-brand-red mb-8 uppercase tracking-widest">Get in Touch</h2>
            <div class="w-24 h-[2px] bg-brand-red mb-10"></div>
            
            <div class="space-y-10">
                <div>
                    <h4 class="text-sm font-bold text-brand-red uppercase tracking-widest mb-2">Head Office</h4>
                    <p class="text-xl text-gray-800 font-light leading-relaxed">
                        123 Furniture Avenue,<br>
                        Industrial Area, Block B<br>
                        Dhaka, Bangladesh
                    </p>
                </div>
                
                <div>
                    <h4 class="text-sm font-bold text-brand-red uppercase tracking-widest mb-2">Contact</h4>
                    <p class="text-xl text-gray-800 font-light mb-1">+880 1234 567 890</p>
                    <p class="text-xl text-gray-800 font-light">info@advancedoors.com</p>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-brand-red uppercase tracking-widest mb-2">Business Hours</h4>
                    <p class="text-lg text-gray-800 font-light mb-1">Saturday - Thursday</p>
                    <p class="text-lg text-gray-800 font-light">10:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full lg:w-2/3">
            <h2 class="text-3xl font-bold text-brand-red mb-8 uppercase tracking-widest">Send a Message</h2>
            <div class="w-24 h-[2px] bg-brand-red mb-10"></div>

            <form action="#" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-bold text-brand-red uppercase tracking-widest mb-2">Your Name</label>
                        <input type="text" name="name" class="w-full border-b border-gray-300 py-3 bg-transparent focus:outline-none focus:border-brand-red transition-colors text-lg text-gray-800" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-brand-red uppercase tracking-widest mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full border-b border-gray-300 py-3 bg-transparent focus:outline-none focus:border-brand-red transition-colors text-lg text-gray-800" placeholder="john@example.com">
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-brand-red uppercase tracking-widest mb-2">Phone Number (Optional)</label>
                    <input type="text" name="phone" class="w-full border-b border-gray-300 py-3 bg-transparent focus:outline-none focus:border-brand-red transition-colors text-lg text-gray-800" placeholder="+880 1XXXXXXXXX">
                </div>

                <div>
                    <label class="block text-xs font-bold text-brand-red uppercase tracking-widest mb-2">Message</label>
                    <textarea name="message" rows="4" class="w-full border-b border-gray-300 py-3 bg-transparent focus:outline-none focus:border-brand-red transition-colors text-lg resize-none text-gray-800" placeholder="How can we help you today?"></textarea>
                </div>
                
                <button type="button" class="bg-brand-red text-white font-bold py-4 px-10 hover:bg-red-800 transition uppercase tracking-widest text-sm mt-4 border-2 border-brand-red hover:border-red-800">
                    Submit Inquiry
                </button>
            </form>
        </div>

    </div>
</div>
@endsection