@extends('admin.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manage Order #{{ $order->id ?? $order->order_number }}</h1>
            <p class="text-gray-600 text-sm mt-1">Placed on {{ $order->created_at->format('F j, Y, g:i a') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.orders.index') }}" class="text-zinc-600 hover:text-zinc-900 bg-white border border-zinc-200 hover:bg-zinc-50 font-semibold px-4 py-2 rounded-xl transition-all shadow-sm text-sm flex items-center gap-2">
                <i class="fas fa-arrow-left text-xs"></i> Back to Orders
            </a>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-xl flex gap-3 shadow-sm">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="relative">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column: Order Items & Shipping Address -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Order Items Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="p-6 border-b border-zinc-200 bg-zinc-50/50">
                        <h2 class="text-lg font-bold text-zinc-800">Order Items</h2>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-zinc-50 border-b border-zinc-100">
                                    <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase">Product</th>
                                    <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase text-center">Qty</th>
                                    <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase text-right">Price</th>
                                    <th class="py-3 px-6 text-xs font-semibold text-zinc-500 uppercase text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100">
                                @foreach($order->items as $item)
                                    <tr class="hover:bg-zinc-50/30 transition-colors">
                                        <td class="py-4 px-6 flex items-center gap-4">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 rounded-lg object-cover border border-zinc-200">
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-zinc-100 border border-zinc-200 flex items-center justify-center">
                                                    <i class="fas fa-image text-zinc-300"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-sm font-bold text-zinc-900">{{ $item->product->name ?? 'Unknown Product' }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-zinc-600 text-center font-medium">
                                            x{{ $item->quantity }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-zinc-600 text-right">
                                            ${{ number_format($item->price, 2) }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-bold text-zinc-900 text-right">
                                            ${{ number_format($item->quantity * $item->price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Order Totals -->
                    <div class="p-6 bg-zinc-50 border-t border-zinc-200">
                        <div class="flex justify-end">
                            <div class="w-full sm:w-1/2 lg:w-2/3 space-y-3">
                                <div class="flex justify-between text-sm text-zinc-600">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($order->subtotal ?? $order->total_amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-zinc-600">
                                    <span>Shipping</span>
                                    <span>${{ number_format($order->shipping_cost ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold text-zinc-900 border-t border-zinc-200 pt-3 mt-3">
                                    <span>Total</span>
                                    <span>${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="p-6 border-b border-zinc-200 bg-zinc-50/50">
                        <h2 class="text-lg font-bold text-zinc-800">Shipping Details</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-zinc-800 text-sm whitespace-pre-line leading-relaxed">{{ $order->shipping_address ?? 'No shipping address provided.' }}</p>
                    </div>
                </div>

            </div>

            <!-- Right Column: Status & Customer Info -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Status Update Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="p-6 border-b border-zinc-200 bg-zinc-50/50">
                        <h2 class="text-lg font-bold text-zinc-800">Order Status</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-zinc-800 mb-2">Update Status</label>
                            <div class="relative">
                                <select name="status" class="w-full appearance-none border border-zinc-300 rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 text-zinc-800 bg-zinc-50 font-medium cursor-pointer">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-zinc-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            <p class="text-xs text-zinc-500 mt-2"><i class="fas fa-info-circle mr-1"></i> Changing the status may trigger email notifications to the customer.</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Details Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="p-6 border-b border-zinc-200 bg-zinc-50/50">
                        <h2 class="text-lg font-bold text-zinc-800">Customer Info</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-500 shrink-0">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-zinc-900">{{ $order->customer_name ?? 'Guest User' }}</p>
                                <p class="text-xs text-zinc-500 mt-0.5">Customer</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-zinc-100 pt-4 space-y-3">
                            <div class="flex items-center gap-3 text-sm">
                                <i class="fas fa-envelope text-zinc-400 w-4 text-center"></i>
                                <a href="mailto:{{ $order->customer_email }}" class="text-blue-600 hover:underline">{{ $order->customer_email }}</a>
                            </div>
                            <div class="flex items-center gap-3 text-sm">
                                <i class="fas fa-phone text-zinc-400 w-4 text-center"></i>
                                <a href="tel:{{ $order->customer_phone }}" class="text-zinc-700 hover:text-zinc-900">{{ $order->customer_phone ?? 'N/A' }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Sticky Footer -->
        <div class="flex justify-end gap-3 sticky bottom-4 bg-white/80 backdrop-blur-md p-4 mt-6 rounded-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border border-zinc-100 z-20">
            <a href="{{ route('admin.orders.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-zinc-600 hover:bg-zinc-100 transition-colors text-sm flex items-center">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-zinc-900 text-white rounded-xl font-bold hover:bg-black shadow-lg shadow-zinc-900/20 transition-all active:scale-95 flex items-center gap-2 text-sm">
                <i class="fas fa-save"></i> Update Order
            </button>
        </div>
    </form>
</div>
@endsection