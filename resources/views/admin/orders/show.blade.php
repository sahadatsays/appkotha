<x-admin-layout>
    <x-slot name="title">Order {{ $order->order_number }}</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-700">Orders</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">{{ $order->order_number }}</span>
                </li>
            </ol>
        </nav>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Order {{ $order->order_number }}</h1>
            <span class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y h:i A') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Order Items</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                    @if($item->product)
                                        <a href="{{ route('admin.products.edit', $item->product) }}" class="text-xs text-indigo-600 hover:underline">Edit product</a>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">৳{{ number_format($item->price, 0) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">৳{{ number_format($item->total, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">Subtotal</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">৳{{ number_format($order->subtotal, 0) }}</td>
                        </tr>
                        @if($order->discount > 0)
                            <tr>
                                <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">
                                    Discount @if($order->coupon_code)({{ $order->coupon_code }})@endif
                                </td>
                                <td class="px-6 py-3 text-sm font-medium text-red-600">-৳{{ number_format($order->discount, 0) }}</td>
                            </tr>
                        @endif
                        @if($order->tax > 0)
                            <tr>
                                <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">Tax</td>
                                <td class="px-6 py-3 text-sm font-medium text-gray-900">৳{{ number_format($order->tax, 0) }}</td>
                            </tr>
                        @endif
                        <tr class="border-t-2 border-gray-300">
                            <td colspan="3" class="px-6 py-3 text-right text-base font-bold text-gray-900">Total</td>
                            <td class="px-6 py-3 text-base font-bold text-gray-900">৳{{ number_format($order->total, 0) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Licenses -->
            @if($order->licenses->count() > 0)
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Licenses</h3>
                    </div>
                    <div class="p-5 space-y-3">
                        @foreach($order->licenses as $license)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <code class="text-sm font-mono text-gray-800">{{ $license->license_key }}</code>
                                    <div class="text-xs text-gray-500 mt-1">{{ $license->product->name ?? 'Product' }}</div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $license->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($license->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Customer Notes -->
            @if($order->notes)
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Customer Notes</h3>
                    <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                </div>
            @endif

            <!-- Admin Notes -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Admin Notes</h3>
                <form action="{{ route('admin.orders.add-note', $order) }}" method="POST">
                    @csrf
                    <textarea name="admin_notes" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Add internal notes...">{{ $order->admin_notes }}</textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200">
                        Save Notes
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Update -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Order Status</h3>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="refunded" {{ $order->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    <button type="submit" class="mt-2 w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Payment Status -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Status</h3>
                <form action="{{ route('admin.orders.update-payment-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="payment_status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    <button type="submit" class="mt-2 w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">
                        Update Payment
                    </button>
                </form>
                @if($order->payment_method)
                    <div class="mt-4 text-sm text-gray-500">
                        <span class="font-medium">Method:</span> {{ ucfirst($order->payment_method) }}
                    </div>
                @endif
                @if($order->payment_id)
                    <div class="mt-1 text-sm text-gray-500">
                        <span class="font-medium">Transaction ID:</span> {{ $order->payment_id }}
                    </div>
                @endif
            </div>

            <!-- Customer Info -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Customer</h3>
                <div class="space-y-3">
                    <div>
                        <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                        <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                        @if($order->customer_phone)
                            <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                        @endif
                    </div>
                    @if($order->company_name)
                        <div class="pt-2 border-t border-gray-200">
                            <div class="text-sm text-gray-500">Company</div>
                            <div class="text-sm font-medium text-gray-900">{{ $order->company_name }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Info -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Order Info</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Order Date</dt>
                        <dd class="text-gray-900">{{ $order->created_at->format('M d, Y') }}</dd>
                    </div>
                    @if($order->paid_at)
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Paid At</dt>
                            <dd class="text-gray-900">{{ $order->paid_at->format('M d, Y') }}</dd>
                        </div>
                    @endif
                    @if($order->completed_at)
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Completed At</dt>
                            <dd class="text-gray-900">{{ $order->completed_at->format('M d, Y') }}</dd>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Currency</dt>
                        <dd class="text-gray-900">{{ $order->currency ?? 'BDT' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-admin-layout>
