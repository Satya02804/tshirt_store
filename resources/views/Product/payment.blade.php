@extends('layout.app')

@section('content')

<link rel="stylesheet" href="{{asset('css/payment.css')}}">

<div class="container mb-5">
    <div class="row mt-5">
        {{-- LEFT COLUMN: Payment Selection --}}
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-muted">Select Payment Method</h5>
                </div>
                <div class="card-body">
                    <form id="payment-form">
                        {{-- 1. CASH ON DELIVERY --}}
                        <div class="payment-option mb-3 selected" onclick="selectPayment('cod')">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="cash" name="payment_method" value="cod" checked>
                                <label class="form-check-label w-100" for="cash">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Cash on Delivery (COD)</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cash text-success" viewBox="0 0 16 16">
                                            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                            <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- 2. CARD --}}
                        <div class="payment-option mb-3" onclick="selectPayment('card')">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="card" name="payment_method" value="card">
                                <label class="form-check-label w-100" for="card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Card</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                        </svg>
                                    </div>
                                </label>

                                <div class="collapse" id="cardCollapse">
                                    <div class="px-3 py-2">
                                        <label for="fullName" class="form-label">Cardholder Name:</label>
                                        <input type="text" id="fullName" class="form-control mb-2" placeholder="Name on Card">
                                        <span class="error" id="errorFullName"></span>

                                        <label for="cardNumber" class="form-label">Card Number:</label>
                                        <input type="text" id="cardNumber" class="form-control mb-2" placeholder="1234 5678 9012 3456">
                                        <span class="error" id="errorCardNumber"></span>

                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="w-50">
                                                <label for="expiryDate" class="form-label">Expiry Date:</label>
                                                <input type="text" id="expiryDate" class="form-control" placeholder="MM/YY">
                                                <span class="error" id="errorExpiryDate"></span>
                                            </div>
                                            <div class="w-50">
                                                <label for="cvv" class="form-label">CVV:</label>
                                                <input type="text" id="cvv" class="form-control" placeholder="123">
                                                <span class="error" id="errorCvv"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. UPI --}}
                        <div class="payment-option mb-3" onclick="selectPayment('upi')">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="upi" name="payment_method" value="upi">
                                <label class="form-check-label w-100" for="upi">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">UPI</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                                            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542s.987-.254 1.194-.542C9.42 6.644 9.5 6.253 9.5 6a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2z" />
                                            <path d="M16 6.5h-5.551a2.7 2.7 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5s-1.613-.412-2.006-.958A2.7 2.7 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5z" />
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ url()->previous() }}" class="back-btn">
                    <i class="bi bi-arrow-left"></i> Back to Shipping
                </a>
                @can('payment')
                    <button type="button" class="btn btn-primary px-5 py-2 fw-bold" id="payBtn" onclick="processPayment()">
                        Confirm Order <i class="bi bi-arrow-right"></i>
                    </button>
                @endcan
            </div>
        </div>

        {{-- RIGHT COLUMN: Order Summary --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Order Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3" id="orderSummaryList">
                        <li class="list-group-item text-center text-muted">Loading cart...</li>
                    </ul>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold" id="summarySubtotal">₹0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Discount</span>
                        <span class="fw-bold" id="summaryDiscount">₹0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success">Free</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-3">
                        <h5 class="fw-bold">Total</h5>
                        <h5 class="fw-bold text-primary" id="summaryTotal">₹0</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<script>
    const notyf = new Notyf({ position: { x: 'center', y: 'top' } });
    let cartItems = JSON.parse(localStorage.getItem("myCart")) || [];

    // 1. Load Order Summary
    document.addEventListener('DOMContentLoaded', () => {
        const list = document.getElementById('orderSummaryList');
        let subtotalMRP = 0;
        let totalDiscount = 0;
        let finalPayable = 0;

        if (cartItems.length > 0) {
            list.innerHTML = '';
            cartItems.forEach(item => {
                let qty = item.quantity || 1;
                let price = Number(item.price);
                let originalPrice = Number(item.originalPrice) || price;

                // ✅ FIX: Calculate Discount correctly
                subtotalMRP += originalPrice * qty;
                totalDiscount += (originalPrice - price) * qty;
                finalPayable += price * qty;

                list.innerHTML += `
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-light text-dark me-2">x${qty}</span>
                        <div class="d-flex flex-column">
                            <span class="small text-truncate" style="max-width: 150px;">${item.name}</span>
                            ${originalPrice > price
                                ? `<small class="text-muted text-decoration-line-through" style="font-size: 0.75rem;">₹${originalPrice}</small>`
                                : ''}
                        </div>
                    </div>
                    <span class="small fw-bold">₹${price * qty}</span>
                </li>`;
            });

            document.getElementById('summarySubtotal').innerText = '₹' + subtotalMRP;
            const discountElem = document.getElementById('summaryDiscount');
            if (totalDiscount > 0) {
                discountElem.innerText = '- ₹' + totalDiscount;
                discountElem.classList.add('text-success');
            } else {
                discountElem.innerText = '₹0';
            }
            document.getElementById('summaryTotal').innerText = '₹' + finalPayable;
        } else {
            list.innerHTML = '<li class="list-group-item text-center text-danger">Cart is empty!</li>';
        }
    });

    // 2. Handle Selection & Collapse
    function selectPayment(type) {
        document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('selected'));
        const radio = document.querySelector(`input[value="${type}"]`);
        radio.closest('.payment-option').classList.add('selected');
        radio.checked = true;

        const cardCollapse = document.getElementById('cardCollapse');
        if (type === 'card') {
            if (!cardCollapse.classList.contains('show')) new bootstrap.Collapse(cardCollapse, { show: true });
        } else {
            if (cardCollapse.classList.contains('show')) new bootstrap.Collapse(cardCollapse, { hide: true });
        }
    }

    // 3. Card Validation
    function validateCardDetails() {
        let isValid = true;
        document.getElementById('errorFullName').innerText = '';
        document.getElementById('errorCardNumber').innerText = '';
        document.getElementById('errorExpiryDate').innerText = '';
        document.getElementById('errorCvv').innerText = '';

        const fullName = document.getElementById('fullName').value.trim();
        const cardNumber = document.getElementById('cardNumber').value.trim();
        const expiryDate = document.getElementById('expiryDate').value.trim();
        const cvv = document.getElementById('cvv').value.trim();

        if (fullName === '') {
            document.getElementById('errorFullName').innerText = 'Name required';
            isValid = false;
        }
        if (!/^\d{16}$/.test(cardNumber.replace(/\s+/g, ''))) {
            document.getElementById('errorCardNumber').innerText = 'Invalid card number';
            isValid = false;
        }
        if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiryDate)) {
            document.getElementById('errorExpiryDate').innerText = 'Invalid Date';
            isValid = false;
        }
        if (!/^\d{3,4}$/.test(cvv)) {
            document.getElementById('errorCvv').innerText = 'Invalid CVV';
            isValid = false;
        }
        return isValid;
    }

    // 4. Process Payment
    function processPayment() {
        const btn = document.getElementById('payBtn');
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
        const shippingInfo = JSON.parse(localStorage.getItem("shippingInfo"));

        if (!shippingInfo) {
            notyf.error("Shipping info missing. Please go back.");
            return;
        }

        // ✅ FIX: Call Validation if Card is selected
        if (selectedPayment === 'card') {
            if (!validateCardDetails()) {
                notyf.error("Please fix card errors.");
                return;
            }
        }

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...';

        axios.post('/place-order', {
            phone: shippingInfo.phone,
            address: shippingInfo.address,
            payment_method: selectedPayment, // ✅ FIX: Send actual selected payment
            cart: cartItems
        })
        .then(response => {
            if (response.data.status === 200) {
                notyf.success("Order Placed Successfully!");
                localStorage.removeItem("myCart");
                localStorage.removeItem("shippingInfo");
                setTimeout(() => window.location.href = response.data.redirect_url, 1500);
            }
        })
        .catch(error => {
            console.error(error);
            if (error.response && error.response.data && error.response.data.message) {
                notyf.error(error.response.data.message);
            } else {
                notyf.error("Failed to place order.");
            }
            btn.disabled = false;
            btn.innerHTML = 'Confirm Order <i class="bi bi-arrow-right"></i>';
        });
    }
</script>
@endsection
