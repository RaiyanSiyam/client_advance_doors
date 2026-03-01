@extends('layouts.admin')

@section('header_title', 'Orders')
@section('header_subtitle', 'Track and fulfill customer purchases.')

@section('content')
<div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
    <!-- Filters -->
    <div class="flex flex-wrap items-center gap-2">
        <a href="#" class="px-4 py-2 rounded-xl text-sm font-semibold bg-zinc-900 text-white shadow-sm">All Orders</a>
        <a href="#" class="px-4 py-2 rounded-xl text-sm font-semibold bg-white border border-zinc-200 text-zinc-600 hover:bg-zinc-50 transition-colors">Pending</a>
        <a href="#" class="px-4 py-2 rounded-xl text-sm font-semibold bg-white border border-zinc-200 text-zinc-600 hover:bg-zinc-50 transition-colors">Processing</a>
        <a href="#" class="px-4 py-2 rounded-xl text-sm font-semibold bg-white border border-zinc-200 text-zinc-600 hover:bg-zinc-50 transition-colors">Completed</a>
    </div>

    <div class="relative w-full lg:w-80 group">
        <input type="text" placeholder="Search order ID, customer..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-zinc-200 rounded-xl focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-sm">
        <i class="fas fa-search absolute left-4 top-3 text-zinc-400 group-focus-within:text-red-500 transition-colors"></i>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-zinc-50/80 border-b border-zinc-100 text-[11px] uppercase tracking-wider text-zinc-500 font-bold">
                <tr>
                    <th class="px-6 py-4">Order ID</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 text-sm">
                {{-- Mock Loop: Replace with @foreach($orders as $order) --}}
                @foreach(['Pending', 'Processing', 'Completed', 'Cancelled', 'Pending'] as $index => $status)
                <tr class="hover:bg-zinc-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <span class="font-bold text-zinc-900">#ORD-{{ rand(1000, 9999) }}</span>
                    </td>
                    <td class="px-6 py-4 text-zinc-500">
                        {{ now()->subDays($index)->format('M d, Y') }}<br>
                        <span class="text-xs">{{ now()->subHours($index * 3)->format('h:i A') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-zinc-900">John Doe {{ $index }}</div>
                        <div class="text-xs text-zinc-500">john{{ $index }}@example.com</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($status == 'Pending')
                            <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-[11px] font-bold inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                            </span>
                        @elseif($status == 'Processing')
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded-full text-[11px] font-bold inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Processing
                            </span>
                        @elseif($status == 'Completed')
                            <span class="px-2.5 py-1 bg-green-50 text-green-700 border border-green-200 rounded-full text-[11px] font-bold inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Completed
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-zinc-100 text-zinc-600 border border-zinc-200 rounded-full text-[11px] font-bold inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span> Cancelled
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-zinc-900">৳{{ number_format(rand(5000, 25000)) }}</div>
                        <div class="text-xs text-zinc-500">{{ rand(1, 4) }} items</div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-zinc-100 text-zinc-700 hover:bg-red-50 hover:text-red-600 font-semibold text-xs transition-all border border-transparent hover:border-red-100">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-zinc-100 bg-zinc-50/50 flex justify-between items-center text-sm text-zinc-500">
        Showing 1 to 5 of 45 orders
    </div>
</div>
@endsection