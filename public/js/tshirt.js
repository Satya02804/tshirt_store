const notyf = new Notyf({
    position: {
        x: 'center',
        y: 'top'
    },
});

// Helper functions
function can(permission) {
    return window.userPermissions && window.userPermissions[permission];
}

function isAuth() {
    return window.userPermissions && window.userPermissions.authenticated;
}

let cartItems = JSON.parse(localStorage.getItem("myCart")) || [];

// --- Load Products via AJAX ---
function loadProducts() {
    const container = document.getElementById('tshirt_product');

    axios.get('/fetch-products')
        .then(function (response) {
            const products = response.data.products;
            tshirtData = products;

            let html = '';

            if (products.length === 0) {
                container.innerHTML = '<p class="text-center w-100">No products found.</p>';
                return;
            }

            products.forEach(product => {
                // Calculate prices for display
                let priceSection = '';
                if (product.discount > 0) {
                    let newPrice = Math.round(product.price - (product.price * (product.discount / 100)));
                    priceSection = `
                        <span class="text-decoration-line-through text-danger me-2" style="font-size: 0.9rem;">₹${product.price}</span>
                        <span class="fw-bold text-success fs-5">₹${newPrice}</span>
                    `;
                } else {
                    priceSection = `<span class="fw-bold fs-5 text-dark">₹${product.price}</span>`;
                }

                // Badge Logic
                let badge = product.discount > 0
                    ? `<div class="position-absolute top-0 end-0 m-2">
                         <span class="badge bg-danger rounded-pill shadow-sm" style="font-size: 0.8rem; padding: 8px 12px;">
                            ${product.discount}% OFF
                         </span>
                       </div>`
                    : '';

                // --- BUTTON LOGIC CHANGED HERE ---
                let addToCartButton = '';

                // Case 1: Guest User OR (Logged In User WITH Permission) -> SHOW BUTTON
                if (!isAuth() || can('add_to_cart')) {
                    addToCartButton = `
                        <button class="btn btn-outline-dark w-100 mt-auto" onclick="addItemToCart(${product.id})">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    `;
                }
                // Case 2: Logged In User WITHOUT Permission -> SHOW DISABLED
                else {
                    addToCartButton = `
                        <button class="btn btn-outline-secondary w-100 mt-auto" disabled title="Permission Revoked">
                            <i class="bi bi-lock"></i> No Permission
                        </button>
                    `;
                }

                html += `
                <div class="card h-100 position-relative">
                    ${badge}
                    <img src="${product.url}" alt="${product.name}">

                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title text-center text-dark">${product.name}</h4>
                        <div class="price text-center mb-3">
                            ${priceSection}
                        </div>

                        ${addToCartButton}
                    </div>
                </div>`;
            });

            container.innerHTML = html;
        })
        .catch(function (error) {
            console.error('Error:', error);
            container.innerHTML = '<p class="text-center text-danger w-100">Failed to load products.</p>';
        });
}

// --- Add to Cart Logic ---
function addItemToCart(id) {

    // 1. Check permissions
    if (isAuth() && !can('add_to_cart')) {
        notyf.error('You do not have permission to add items to cart');
        return;
    }

    let product = tshirtData.find(item => item.id === id);

    if (product) {
        // Check if product already exists in cart
        let existingItem = cartItems.find(item => item.id === product.id);

        if (existingItem) {
            // If exists, just increase quantity
            existingItem.quantity = (existingItem.quantity || 1) + 1;
            notyf.success(product.name + " quantity updated (+1)");
        } else {
            // If new, calculate price and push with quantity = 1
            let finalPrice = Number(product.price);
            let rawDiscount = Number(product.discount);

            if (rawDiscount > 0) {
                finalPrice = Math.round(finalPrice - (finalPrice * (rawDiscount / 100)));
            }

            let item = {
                id: product.id,
                name: product.name,
                price: finalPrice,
                url: product.url,
                originalPrice: Number(product.price),
                quantity: 1
            };
            cartItems.push(item);
            notyf.success(product.name + " added to cart");
        }

        localStorage.setItem("myCart", JSON.stringify(cartItems));
        cart();
    }
}
// --- Update Quantity (+/-) ---
function updateQuantity(index, change) {
    if (cartItems[index]) {
        // Initialize quantity if it doesn't exist (for old cart data)
        if (!cartItems[index].quantity) {
            cartItems[index].quantity = 1;
        }

        let newQuantity = cartItems[index].quantity + change;

        if (newQuantity < 1) {
            deleteData(index);
        } else {
            cartItems[index].quantity = newQuantity;
            localStorage.setItem("myCart", JSON.stringify(cartItems));
            cart();
        }
    }
}

// Render Cart Function
function cart() {
    let offcanvas = document.querySelector(".offcanvas-body");
    let offcanvasFooter = document.querySelector(".offcanvas-footer");

    if (!offcanvas || !offcanvasFooter) {
        return;
    }

    offcanvas.innerHTML = "";
    offcanvasFooter.innerHTML = "";

    let subtotal = 0;
    let finalTotal = 0;

    for (let i = 0; i < cartItems.length; i++) {
        let item = cartItems[i];
        // Ensure quantity exists
        let qty = item.quantity || 1;

        let originalPrice = Number(item.originalPrice) || Number(item.price);
        let price = Number(item.price);

        // Calculate totals based on Quantity
        subtotal += (originalPrice * qty);
        finalTotal += (price * qty);

        offcanvas.innerHTML += `
         <div class="d-flex align-items-center mb-3 border-bottom pb-2">
            <img src="${item.url}" style="width:60px; height:60px; border-radius:4px; margin-right:10px; object-fit:cover;">

            <div class="d-flex flex-column flex-grow-1">
                <p class="m-0 fw-bold" style="font-size: 14px;">${item.name}</p>
                <div class=" d-flex mb-0">
                    ${originalPrice > price
                ? `<small class="text-decoration-line-through text-danger me-1" style="font-size:0.9rem">₹${originalPrice}</small>`
                : ''}
                    <span class="fw-bold text-success" style="font-size:1rem">₹${price}</span>


                <div class="d-flex ms-auto" style="margin-right:10px;">
                    <button class="btn btn-sm btn-outline-secondary px-2 py-0" onclick="updateQuantity(${i}, -1)">-</button>
                    <span class="mx-2 fw-bold" style="font-size:0.9rem">${qty}</span>
                    <button class="btn btn-sm btn-outline-secondary px-2 py-0" onclick="updateQuantity(${i}, 1)">+</button>
                </div>
            </div>
              </div>

            <div class=" flex-column align-items-end" style="margin-top:15px;">
                <button onclick="deleteData(${i})" class="btn btn-sm text-danger border-0 p-0 mb-2">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <span class="fw-bold text-mutedark" style="font-size:0.9rem">₹${price * qty}</span>
            </div>
        </div>`;
    }

    let totalDiscount = subtotal - finalTotal;

    if (cartItems.length > 0) {
        offcanvasFooter.innerHTML = `
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Subtotal:</span>
                    <span>₹${subtotal}</span>
                </div>

                ${totalDiscount > 0 ? `
                <div class="d-flex justify-content-between mb-1 text-success">
                    <span>Discount:</span>
                    <span>- ₹${totalDiscount}</span>
                </div>` : ''}

                <div class="d-flex justify-content-between border-top pt-2 mt-2">
                    <h5 class="fw-bold">Total:</h5>
                    <h5 class="fw-bold">₹${finalTotal}</h5>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="button" onclick="checkout()" class="btn btn-success">Checkout</button>
                <button type="button" onclick="clearCart()" class="btn btn-outline-danger">Clear Cart</button>
            </div>
        `;
    } else {
        offcanvas.innerHTML = `
            <div class="text-center mt-5">
                <h5 class="text-muted">Your cart is empty</h5>
                <p class="small text-muted">Add some cool t-shirts!</p>
            </div>`;
    }
}
// Delete Function
function deleteData(i) {
    cartItems.splice(i, 1);
    localStorage.setItem("myCart", JSON.stringify(cartItems));
    cart();
    notyf.success("Item removed!");
}

// Checkout Function (Kept logic for checkout permission)
function checkout() {
    if (cartItems.length === 0) {
        notyf.error("Your cart is empty!");
        return;
    }

    localStorage.setItem("myCart", JSON.stringify(cartItems));

    // Check permission via server
    axios.get('/checkout/check')
        .then(response => {
            const data = response.data;

            if (data.status === 'guest') {
                // Guest must login for checkout
                localStorage.setItem("pendingCheckout", "true");
                notyf.error(data.message || 'Please login to checkout');
                setTimeout(() => window.location.href = data.url, 1500);
            } else if (data.status === 'unauthorized') {
                // Admin removed checkout permission
                notyf.error(data.message || 'You do not have permission to checkout');
            } else if (data.status === 'authorized') {
                // Success
                localStorage.removeItem("pendingCheckout");
                window.location.href = data.redirect_url;
            }
        })
        .catch(error => {
            console.error('Checkout Error:', error);
            notyf.error('Error processing checkout. Please try again.');
        });
}

function clearCart() {
    cartItems = [];
    localStorage.setItem("myCart", JSON.stringify(cartItems));
    cart();
    notyf.success("Cart cleared!");
}

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// Initialize
cart();
loadProducts();

// Check pending checkout logic (Restored exactly as before)
document.addEventListener('DOMContentLoaded', function () {
    const wasPendingCheckout = localStorage.getItem("pendingCheckout");

    if (wasPendingCheckout === "true") {
        const cartItemsCount = JSON.parse(localStorage.getItem("myCart") || "[]").length;

        if (cartItemsCount > 0) {
            localStorage.removeItem("pendingCheckout");

            axios.get('/checkout/check')
                .then(response => {
                    const data = response.data;
                    if (data.status === 'authorized') {
                        notyf.success("Welcome back! Redirecting to checkout...");
                        setTimeout(() => window.location.href = data.redirect_url, 1500);
                    } else if (data.status === 'unauthorized') {
                        notyf.error(data.message || 'You do not have permission to checkout');
                    }
                })
                .catch(error => {
                    notyf.error('Error checking permissions.');
                });
        } else {
            localStorage.removeItem("pendingCheckout");
        }
    }
});
