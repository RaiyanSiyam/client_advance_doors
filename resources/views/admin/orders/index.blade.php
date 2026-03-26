@extends('admin.layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
            <p class="text-gray-600 text-sm mt-1">Manage and track all customer orders.</p>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
        
        <!-- Toolbar (Search/Filter) -->
        <div class="p-4 border-b border-zinc-200 flex flex-col sm:flex-row gap-4 justify-between items-center bg-zinc-50/50">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="w-full sm:w-96 relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by order ID or customer..." class="w-full pl-10 pr-4 py-2 bg-white border border-zinc-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-colors">
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-50 border-b border-zinc-200">
                        <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Order ID</th>
                        <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Date</th>
                        <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Customer</th>
                        <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Total</th>
                        <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-zinc-50/50 transition-colors group">
                            <td class="py-4 px-6 text-sm font-bold text-zinc-900">
                                #{{ $order->id ?? $order->order_number }}
                            </td>
                            <td class="py-4 px-6 text-sm text-zinc-600">
                                {{ $order->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="py-4 px-6 text-sm text-zinc-800">
                                <div class="font-semibold">{{ $order->customer_name ?? 'Guest' }}</div>
                                <div class="text-xs text-zinc-500">{{ $order->customer_email }}</div>
                            </td>
                            <td class="py-4 px-6 text-sm font-semibold text-zinc-800">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="py-4 px-6 text-sm">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'shipped' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'delivered' => 'bg-green-100 text-green-800 border-green-200',
                                        'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                    ];
                                    $statusClass = $statusColors[strtolower($order->status)] ?? 'bg-zinc-100 text-zinc-800 border-zinc-200';
                                @endphp
                                <span class="px-3 py-1 text-xs font-bold rounded-full border uppercase tracking-wide {{ $statusClass }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm text-right">
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-zinc-400 hover:text-zinc-900 hover:bg-zinc-200 transition-colors" title="View & Edit">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center">
                                <div class="w-16 h-16 bg-zinc-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-box-open text-2xl text-zinc-400"></i>
                                </div>
                                <h3 class="text-sm font-bold text-zinc-900 mb-1">No orders found</h3>
                                <p class="text-xs text-zinc-500">There are no orders matching your criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="p-4 border-t border-zinc-200">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection