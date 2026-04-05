@extends('layouts.app')

@section('content')

<!-- FIX: Forcefully hide the global Auth Modal on the Profile page to prevent it from popping up during form validation errors -->
<style>
    #authModalOverlay { display: none !important; }
</style>

<div class="bg-gray-50 min-h-screen pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Account</h1>
            <p class="text-gray-500 mt-1">Manage your details, addresses, and security settings.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-8">
            
            <!-- LEFT SIDEBAR -->
            <div class="w-full md:w-1/4 shrink-0">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <!-- User Badge -->
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50 text-center">
                        <div class="w-20 h-20 bg-brand-red text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-3 shadow-md">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                    
                    <!-- Navigation Tabs -->
                    <nav class="flex flex-col">
                        <button onclick="showProfileTab('info')" id="btn-info" class="profile-tab-btn w-full text-left px-6 py-4 text-sm font-medium border-l-2 border-brand-red text-brand-red bg-red-50/50 transition-colors">
                            <i class="far fa-user mr-3 text-center w-4"></i> Personal Info
                        </button>
                        <button onclick="showProfileTab('addresses')" id="btn-addresses" class="profile-tab-btn w-full text-left px-6 py-4 text-sm font-medium border-l-2 border-transparent text-gray-600 hover:bg-gray-50 hover:text-brand-red transition-colors">
                            <i class="fas fa-map-marker-alt mr-3 text-center w-4"></i> Address Book
                        </button>
                        <button onclick="showProfileTab('security')" id="btn-security" class="profile-tab-btn w-full text-left px-6 py-4 text-sm font-medium border-l-2 border-transparent text-gray-600 hover:bg-gray-50 hover:text-brand-red transition-colors">
                            <i class="fas fa-shield-alt mr-3 text-center w-4"></i> Security
                        </button>
                        <form action="{{ route('customer.logout') }}" method="POST" class="border-t border-gray-100">
                            @csrf
                            <button type="submit" class="w-full text-left px-6 py-4 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-red-600 transition-colors">
                                <i class="fas fa-sign-out-alt mr-3 text-center w-4"></i> Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
            
            <!-- RIGHT CONTENT AREA -->
            <div class="w-full md:w-3/4">
                
                <!-- TAB: Personal Info -->
                <div id="tab-info" class="profile-tab block">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Personal Information</h2>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                            @csrf 
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all">
                                    @error('name')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">Phone Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all">
                                    @error('phone')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all">
                                @error('email')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <button type="submit" class="bg-brand-dark text-white font-bold py-3 px-8 rounded-xl hover:bg-black transition-colors shadow-md mt-2">Save Changes</button>
                        </form>
                    </div>
                </div>

                <!-- TAB: Address Book -->
                <div id="tab-addresses" class="profile-tab hidden">
                    
                    <!-- Saved Addresses -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Saved Addresses</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($user->addresses as $address)
                                <div class="border border-gray-200 rounded-xl p-5 relative group bg-gray-50 hover:border-brand-red transition-colors">
                                    <div class="flex items-center gap-2 mb-2 text-brand-dark">
                                        <i class="fas fa-city text-sm text-brand-red"></i>
                                        <span class="font-bold text-sm">{{ $address->city }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ $address->address }}</p>
                                    
                                    <!-- Delete Address Button -->
                                    <form action="{{ route('profile.address.destroy', $address->id) }}" method="POST" class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full bg-red-100 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors shadow-sm">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                            
                            @if($user->addresses->isEmpty())
                                <div class="col-span-full text-center py-6 text-gray-500 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                    <i class="far fa-map text-2xl mb-2 text-gray-400"></i>
                                    <p class="text-sm">You haven't saved any addresses yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Add New Address Form -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Add New Address</h2>
                        <form action="{{ route('profile.address.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">City</label>
                                <input type="text" name="city" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all">
                                @error('city')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">Full Delivery Address</label>
                                <textarea name="address" required rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all"></textarea>
                                @error('address')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="bg-brand-red text-white font-bold py-3 px-8 rounded-xl hover:bg-red-800 transition-colors shadow-md">Save Address</button>
                        </form>
                    </div>
                </div>

                <!-- TAB: Security -->
                <div id="tab-security" class="profile-tab hidden">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Change Password</h2>
                        
                        <form action="{{ route('profile.password') }}" method="POST" class="space-y-5 max-w-lg">
                            @csrf 
                            @method('PUT')
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">Current Password</label>
                                <input type="password" name="current_password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all">
                                @error('current_password')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">New Password</label>
                                <input type="password" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all">
                                @error('password')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-1">Confirm New Password</label>
                                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-red outline-none transition-all">
                            </div>

                            <button type="submit" class="bg-brand-dark text-white font-bold py-3 px-8 rounded-xl hover:bg-black transition-colors shadow-md mt-2">Update Password</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Simple Vanilla JS to handle profile tab switching
    function showProfileTab(tabName) {
        // 1. Hide all tabs
        document.querySelectorAll('.profile-tab').forEach(tab => {
            tab.classList.add('hidden');
            tab.classList.remove('block');
        });
        
        // 2. Remove active styles from all buttons
        document.querySelectorAll('.profile-tab-btn').forEach(btn => {
            btn.classList.remove('border-brand-red', 'text-brand-red', 'bg-red-50/50');
            btn.classList.add('border-transparent', 'text-gray-600');
        });

        // 3. Show selected tab and highlight button
        document.getElementById('tab-' + tabName).classList.remove('hidden');
        document.getElementById('tab-' + tabName).classList.add('block');
        
        const activeBtn = document.getElementById('btn-' + tabName);
        activeBtn.classList.remove('border-transparent', 'text-gray-600');
        activeBtn.classList.add('border-brand-red', 'text-brand-red', 'bg-red-50/50');
    }

    // Automatically open the correct tab if there are validation errors or specific success messages!
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('current_password') || $errors->has('password') || (session('success') && str_contains(strtolower(session('success')), 'password')))
            showProfileTab('security');
        @elseif($errors->has('city') || $errors->has('address') || (session('success') && str_contains(strtolower(session('success')), 'address')))
            showProfileTab('addresses');
        @else
            showProfileTab('info');
        @endif

        // FIX: Ensure the browser body doesn't get scroll-locked by the global auth modal script
        setTimeout(() => {
            document.body.style.overflow = 'auto';
        }, 50);
    });
</script>
@endsection