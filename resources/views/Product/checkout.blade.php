@extends('layout.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">



    <div class="container mt-5">
        {{-- <a href="{{ url()->previous() }}" class="btn btn-outline-dark" title="Go Back"> Go Back </a> --}}
        <div class="row">
            <!-- Cart Summary -->
            <div class="col-md-7">
                <div id="checkout-items"class="card p-3 mb-3" style="max-height: 400px; overflow-y: auto;">
                    <h3>Order Summary</h3>
                    <!-- Items will be loaded by JavaScript -->
                </div>
                <div class="card p-3 bg-light border-0">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span id="cartSubtotal" class="fw-bold">₹0</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Discount</span>
                        <span id="cartDiscount">- ₹0</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Total Amount</h5>
                        <h4 id="totalAmount" class="mb-0 fw-bold text-dark">₹0</h4>
                    </div>
                </div>

            </div>

            <!-- Checkout Form -->
            <div class="col-md-5">
                <div class="card p-4">
                    <h4>Billing Details</h4>
                    <form id="checkoutForm" action="{{ route('order.place') }}" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" placeholder="Enter phone number" id="phoneNo">
                            <span class="error" id="error-phn"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea class="form-control" rows="2" placeholder="Enter your address" id="address"></textarea>
                            <span class="error" id="error-address"></span>

                        </div>

                        <hr>
                        @can('place-orders')
                            <button type="submit" class="btn btn-success w-100">Proceed to Payment <i
                                    class="bi bi-arrow-right"></i></button>
                        @endcan
                        <a href="{{ asset('/tshirt') }}" class="btn btn-outline-secondary w-100 mt-2">Back to
                            Shopping</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        window.notyf = new Notyf({
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
    {{-- <script src="{{ asset('js/checkout.js') }}"></script> --}}
    <script>
        const notyf = new Notyf({
            position: {
                x: 'center',
                y: 'top'
            }
        });

        // Load cart items
        let cartItems = JSON.parse(localStorage.getItem("myCart")) || [];

        // Phone number validation pattern
        const phn = /^(\+91[\-\s]?)?[6-9]\d{9}$/;

        // Helper function to format money
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR',
                minimumFractionDigits: 2
            }).format(amount);
        }

        // Display cart items
        function displayCheckoutItems() {
            const container = document.getElementById('checkout-items');

            if (cartItems.length === 0) {
                container.innerHTML = '<p class="text-center text-muted">No items in cart</p>';
                window.location.href = '/tshirt';
                return;
            }

            let html = '';
            let subtotal = 0;
            let totalDiscount = 0;
            let finalTotal = 0;

            cartItems.forEach(item => {
                let qty = item.quantity || 1;
                let originalPrice = Number(item.originalPrice) || Number(item.price);
                let price = Number(item.price);

                subtotal += (originalPrice * qty);
                totalDiscount += ((originalPrice - price) * qty);
                finalTotal += (price * qty);

                let lineTotal = price * qty;

                html += `
            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                <img src="${item.url}" style="width:60px; height:60px; object-fit:cover; border-radius:8px; border: 1px solid #eee;">
                <div class="ms-3 flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="mb-1 fw-bold">${item.name}</h6>
                        <span class="badge bg-light text-dark border">x ${qty}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <div class="text-muted small">
                            ${originalPrice > price ? `<span class="text-decoration-line-through me-1">${formatCurrency(originalPrice)}</span>` : ''}
                            <span>${formatCurrency(price)} / unit</span>
                        </div>
                        <span class="fw-bold text-dark numeric-alignment" style="font-size: 1.1em;">
                            ${formatCurrency(lineTotal)}
                        </span>
                    </div>
                </div>
            </div>
        `;
            });

            container.innerHTML = html;
            document.getElementById('cartSubtotal').innerText = formatCurrency(subtotal);
            document.getElementById('cartDiscount').innerText = totalDiscount > 0 ? '- ' + formatCurrency(totalDiscount) :
                formatCurrency(0);
            document.getElementById('totalAmount').innerText = formatCurrency(finalTotal);
        }

        // --- Form submission handler ---
        const checkoutForm = document.getElementById('checkoutForm');
        const errorPhoneNo = document.getElementById('error-phn');
        const errorAddress = document.getElementById('error-address');
        const submitBtn = document.querySelector('button[type="submit"]');

        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Reset errors
                errorPhoneNo.classList.add('d-none');
                errorAddress.classList.add('d-none');

                let noInput = document.getElementById('phoneNo').value;
                let addressInput = document.getElementById('address').value;
                let isValid = true;

                // Phone Number Validation
                if (noInput === '+91' || noInput === '') {
                    errorPhoneNo.textContent = "Phone number is required";
                    errorPhoneNo.classList.remove('d-none');
                    isValid = false;
                } else if (!phn.test(noInput)) {
                    errorPhoneNo.textContent = "Enter a valid phone number";
                    errorPhoneNo.classList.remove('d-none');
                    isValid = false;
                }

                // Address Validation
                if (addressInput === '') {
                    errorAddress.textContent = "Address is required";
                    errorAddress.classList.remove('d-none');
                    isValid = false;
                }

                // -Save Data & Redirect instead of Submitting ---
                if (isValid) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm"></span> Moving to Payment...';

                    // 1. Save Info to LocalStorage
                    const shippingInfo = {
                        phone: noInput,
                        address: addressInput
                    };
                    localStorage.setItem("shippingInfo", JSON.stringify(shippingInfo));
                    //  Redirect to Payment Page
                    setTimeout(() => {
                        window.location.href = '/checkout/payment';
                    }, 500);
                }

                return isValid;
            });
        }

        // Initialize
        displayCheckoutItems();
    </script>
@endsection
