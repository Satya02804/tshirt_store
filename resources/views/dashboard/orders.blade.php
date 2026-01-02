@extends('layout_1.app_1')
@section('content')

<link rel="stylesheet" href="{{ asset('css/orders.css') }}">

        <nav class="m-2 ms-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </nav>

    <div class="container-fluid mt-4">
        <h3 class=" text-muted ms-4">Order Summary</h3>
        <div class="table-responsive mb-5">
            <table class="table table-striped align-middle">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th class="ps-lg-5">Items</th>
                        {{-- <th>Status</th> --}}
                        <th class="text-end pe-lg-5">Total Price(₹)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->created_at->format('d M, Y') }}</td>

                            <td class="fw-bold">{{ $order->order_number }}</td>
                            <td>
                                @if ($order->user)
                                    {{ strtoupper($order->user->name) }}
                                @else
                                    <span class="text-muted">Guest</span>
                                @endif
                            </td>
                            <td class="ps-lg-5">
                                <span class="badge bg-light text-dark border">
                                    {{ $order->items->sum('quantity') }} Items
                                </span>
                            </td>
                            {{-- <td>
                                <span
                                    class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td> --}}

                       <td class="fw-bold text-end pe-lg-5">{{ number_format($order->total_price, 2) }}</td>

                            <td>
                                {{-- @can('view-orders') --}}
                                @role('super-admin')
                                    <a href="javascript:void(0)" data-order="{{ json_encode($order) }}"
                                        onclick="showOrderDetails(this)">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-eye text-primary"
                                            style="background: #f3f4f6; align-items: center;
                                            margin-left:10px; border-radius: 4px; cursor: pointer;"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </a>
                                @endrole
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Order Details Modal --}}
    <div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted text-uppercase small fw-bold">Customer Info</h6>
                            <p class="mb-1 fw-bold" id="modalCustomerName">Loading...</p>
                            <p class="mb-1 text-muted small"><i class="bi bi-telephone"></i> <span
                                    id="modalPhone"></span></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="text-muted text-uppercase small fw-bold">Order Info</h6>
                            <p class="mb-1">Order ID: <span class="fw-bold text-dark" id="modalOrderId">#</span></p>
                            <p class="mb-1">Date: <span id="modalDate"></span></p>
                            <p class="mb-1">Address: <span class="small text-muted" id="modalAddress"></span></p>
                        </div>
                    </div>

                    <div class="table-responsive border rounded">
                        <table class="table table-borderless mb-0">
                            <thead class="bg-light text-muted small text-uppercase">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Price(₹)</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody id="modalItemsBody">
                            </tbody>
                            <tfoot class="border-top">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total Amount</td>
                                    <td class="text-end fw-bold fs-5 text-primary" id="modalGrandTotal">₹0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        const notyf = new Notyf({
            position: {
                x: 'center',
                y: 'top'
            },
            duration: 3000
        });

        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif
        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    </script>

    <script>
        // Global variable
let orderModal;

// Wait for HTML to load completely
document.addEventListener('DOMContentLoaded', function() {
    var modalElement = document.getElementById('orderModal');
    if (modalElement) {
        orderModal = new bootstrap.Modal(modalElement);
    } else {
        console.error("Error: Modal element not found!");
    }
});

// Helper function
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR',
        minimumFractionDigits: 2
    }).format(amount);
}

function showOrderDetails(element) {
    if (!orderModal) {
        console.error("Modal not initialized");
        return;
    }

    const orderData = element.getAttribute('data-order');
    const order = JSON.parse(orderData);

    // Populate Basic Info
    document.getElementById('modalOrderId').innerText = order.order_number;
    document.getElementById('modalCustomerName').innerText = order.user ? order.user.name : 'Guest User';
    document.getElementById('modalPhone').innerText = order.phone;
    document.getElementById('modalAddress').innerText = order.shipping_address;
    document.getElementById('modalGrandTotal').innerText = formatCurrency(order.total_price);

    let date = new Date(order.created_at);
    document.getElementById('modalDate').innerText = date.toLocaleDateString();

    let itemsHtml = '';

    if (order.items && order.items.length > 0) {

        // ---  Aggregate Items by Product ID ---
        const aggregatedItems = {};

        order.items.forEach(item => {
            const productId = item.product_id;

            if (aggregatedItems[productId]) {
                // If product already exists in list, just increase quantity
                aggregatedItems[productId].quantity += Number(item.quantity);
            } else {
                // If new, add it to our list
                aggregatedItems[productId] = {
                    ...item,
                    quantity: Number(item.quantity)
                };
            }
        });
        // --- Generate HTML from Aggregated Items ---
        Object.values(aggregatedItems).forEach(item => {
            let productName = item.product ? item.product.name : 'Product Deleted';
            let productImg = item.product ? item.product.url : 'https://via.placeholder.com/50';

            // Calculate total based on the NEW aggregated quantity
            let lineTotal = item.price * item.quantity;

            itemsHtml += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center overflow-auto">
                            <img src="${productImg}"
                                 style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover; margin-right: 10px; border: 1px solid #eee;">
                            <div>
                                <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">${productName}</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center align-middle"> ${item.quantity}</td>

                    <td class="text-end align-middle numeric-alignment">${formatCurrency(item.price)}</td>
                    <td class="text-end align-middle fw-bold numeric-alignment text-dark">${formatCurrency(lineTotal)}</td>
                </tr>
            `;
        });

    } else {
        itemsHtml = '<tr><td colspan="4" class="text-center text-muted">No items found.</td></tr>';
    }

    document.getElementById('modalItemsBody').innerHTML = itemsHtml;

    orderModal.show();
}

    </script>

@endsection
