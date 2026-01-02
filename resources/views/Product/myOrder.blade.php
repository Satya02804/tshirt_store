@extends('layout.app')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/myorder.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


    <div class="order-container">
        <div class="order-wrapper">

            <div style="margin-bottom: 20px;">
                <a href="{{ url()->previous() }}" class="btn btn-sm back-btn"
                    style="display: inline-flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                    Go Back
                </a>
            </div>
            {{-- Page Header --}}

            <div class="page-header">
                <svg class="header-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>

                <h1 class="page-title">My Orders</h1>
            </div>

            @if ($orders->isEmpty())
                {{-- Empty State --}}
                <div class="empty-state">
                    <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No orders
                        yet</h2>
                    <p style="color: #6b7280;">Your order history will appear here</p>
                </div>
            @else
                {{-- Orders List --}}
                <div class="orders-list">
                    @foreach ($orders as $order)
                        <div class="order-card">

                            {{-- Order Header --}}
                            <div class="order-header">
                                <div class="order-top-row">
                                    <div>
                                        <h3 class="order-id">{{ $order->order_number }}</h3>
                                        <p class="order-date">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                                    </div>

                                    {{-- Dynamic Status Badge --}}
                                    {{-- @php
                                    $statusClass = 'status-default';
                                    if($order->status == 'pending') $statusClass = 'status-pending';
                                    elseif($order->status == 'processing') $statusClass = 'status-processing';
                                    elseif($order->status == 'shipped') $statusClass = 'status-shipped';
                                    elseif($order->status == 'delivered') $statusClass = 'status-delivered';
                                    elseif($order->status == 'cancelled') $statusClass = 'status-cancelled';
                                @endphp --}}
                                    {{-- <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($order->status) }}
                                </span> --}}
                                </div>

                                <div class="order-info-grid">
                                    <div>
                                        <p class="info-label">Total Amount</p>
                                        <p class="info-value">₹{{ number_format($order->total_price, 2) }}</p>
                                    </div>
                                    {{-- <div>
                                    <p class="info-label">Payment Method</p>
                                    <p class="info-value">{{ $order->payment_method }}</p>
                                </div> --}}
                                    <div>
                                        <p class="info-label">Phone</p>
                                        <p class="info-value">{{ $order->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Order Items Section --}}
                            <div class="order-items-section">
                                <button onclick="toggleOrder({{ $order->id }})" class="toggle-btn">
                                    <span>Order Items ({{ $order->items->count() }})</span>
                                    <svg id="icon-{{ $order->id }}" class="toggle-icon" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div id="order-{{ $order->id }}" class="order-items-container hidden">
                                    @foreach ($order->items as $item)
                                        <div class="item-row">
                                            @if ($item->product && $item->product->url)
                                                <img src="{{ $item->product->url }}" alt="{{ $item->product->name }}"
                                                    class="item-image">
                                            @else
                                                <div class="item-placeholder">
                                                    <svg style="width: 24px; height: 24px;" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif

                                            <div class="item-details">
                                                <h4 class="item-name">
                                                    {{ $item->product ? $item->product->name : 'Product Deleted' }}
                                                </h4>
                                                <span class="item-meta">Price:
                                                    ₹{{ number_format($item->price, 2) }}</span>&nbsp; &nbsp;
                                                <span class="item-meta">Qty: {{ $item->quantity }}</span>

                                            </div>

                                            <div class="item-price-block">
                                                <p class="item-total">
                                                    ₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="order-footer">
                                        <p class="info-label">Shipping Address:</p>
                                        <p class="info-value" style="font-weight: 400;">
                                            {{ $order->shipping_address }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleOrder(orderId) {
            const orderDiv = document.getElementById('order-' + orderId);
            const icon = document.getElementById('icon-' + orderId);

            if (orderDiv.classList.contains('hidden')) {
                orderDiv.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                orderDiv.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>

@endsection
