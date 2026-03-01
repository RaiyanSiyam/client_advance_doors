@extends('layouts.admin')

@section('header_title', 'Dashboard')
@section('header_subtitle', 'Welcome back, here is your store\'s summary.')

@section('content')
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Products Card -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100 flex flex-col justify-between group hover:border-red-200 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center justify-center text-zinc-600 group-hover:bg-red-50 group-hover:text-red-600 group-hover:border-red-100 transition-all">
                    <i class="fas fa-box text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-green-500 bg-green-50 px-2 py-1 rounded-md">+12%</span>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-zinc-900 mb-1">{{ $totalProducts ?? 0 }}</h3>
                <p class="text-sm font-medium text-zinc-500">Total Products</p>
            </div>
        </div>

        <!-- Active Products Card -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100 flex flex-col justify-between group hover:border-red-200 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center justify-center text-zinc-600 group-hover:bg-red-50 group-hover:text-red-600 group-hover:border-red-100 transition-all">
                    <i class="fas fa-eye text-xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-zinc-900 mb-1">{{ $activeProducts ?? 0 }}</h3>
                <p class="text-sm font-medium text-zinc-500">Active on Storefront</p>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100 flex flex-col justify-between group hover:border-red-200 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center justify-center text-zinc-600 group-hover:bg-red-50 group-hover:text-red-600 group-hover:border-red-100 transition-all">
                    <i class="fas fa-tags text-xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-zinc-900 mb-1">{{ $totalCategories ?? 0 }}</h3>
                <p class="text-sm font-medium text-zinc-500">Categories</p>
            </div>
        </div>

        <!-- Pending Orders Card -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100 flex flex-col justify-between group hover:border-red-200 transition-colors relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -z-10 opacity-50"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-red-600 text-white shadow-lg shadow-red-600/30 flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-xl"></i>
                </div>
                <span class="flex h-3 w-3 relative">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-zinc-900 mb-1">--</h3>
                <p class="text-sm font-medium text-zinc-500">Pending Orders</p>
            </div>
        </div>

    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Chart / Activity Area -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-zinc-900">Sales Overview</h3>
                <select class="text-sm border-zinc-200 rounded-lg text-zinc-500 bg-zinc-50 py-1.5 pl-3 pr-8 focus:ring-red-500 focus:border-red-500">
                    <option>This Week</option>
                    <option>This Month</option>
                    <option>This Year</option>
                </select>
            </div>
            <div class="h-72 flex items-center justify-center bg-zinc-50/50 rounded-xl border border-dashed border-zinc-200">
                <div class="text-center text-zinc-400">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm border border-zinc-100">
                        <i class="fas fa-chart-line text-2xl text-red-300"></i>
                    </div>
                    <p class="font-medium text-sm">Analytics engine initializing.</p>
                    <p class="text-xs mt-1">Data will appear once orders begin processing.</p>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100 p-6">
            <h3 class="text-lg font-bold text-zinc-900 mb-6">Quick Actions</h3>
            <div class="space-y-4">
                <a href="{{ route('admin.products.create') }}" class="flex items-start p-4 rounded-xl border border-zinc-100 bg-white hover:border-red-200 hover:shadow-md hover:shadow-red-100/50 transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center mr-4 group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm text-zinc-900 group-hover:text-red-600 transition-colors">Add New Product</p>
                        <p class="text-xs text-zinc-500 mt-0.5">Publish new item to catalog</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-start p-4 rounded-xl border border-zinc-100 bg-white hover:border-zinc-300 hover:shadow-md transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-zinc-100 text-zinc-600 flex items-center justify-center mr-4 group-hover:bg-zinc-800 group-hover:text-white transition-colors">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm text-zinc-900 transition-colors">Manage Inventory</p>
                        <p class="text-xs text-zinc-500 mt-0.5">Update pricing & availability</p>
                    </div>
                </a>

                <div class="mt-8 pt-6 border-t border-zinc-100">
                    <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-4">System Status</p>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <p class="text-sm font-medium text-zinc-700">All systems operational</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection