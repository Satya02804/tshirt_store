<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [ProductController::class, 'index'])->name('tshirt.index');
Route::get('/tshirt', [ProductController::class, 'index'])->name('tshirt.index');

// API: Get Products for JS
Route::get('/fetch-products', [ProductController::class, 'fetchProducts']);

// Checkout Permission Check
Route::get('/checkout/check', [ProductController::class, 'prepareCheckout'])->name('checkout.check');

/*
|--------------------------------------------------------------------------
| Forgot Password Routes
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', function () {
    return view('Profile.forgotPassword');
})->name('forgotPassword');

Route::post('/forgot-password', [UserController::class, 'forgotEmail'])->name('forgot.check');
Route::get('/reset-password/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [UserController::class, 'submitResetPassword'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'LoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    Route::get('/register', [UserController::class, 'RegisterForm'])->name('registration');
    Route::post('/register', [UserController::class, 'register'])->name('register.submit');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Logged In Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');

    // 1. Shipping Page
    Route::get('/checkout', [ProductController::class, 'showCheckout'])->name('checkout.page');

    // 2. Payment Page
    Route::view('/checkout/payment', 'Product.payment')->name('checkout.payment');

    // 3. Place Order API
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');

    // User Profile Routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    // Logout
    Route::post('/logout', [UserController::class, 'destroy'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Dashboard Routes (Admin/Staff)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashHome', [dashboardController::class, 'Tshirts'])
        ->middleware('can:view-dashboard')
        ->name('dash.home');

    Route::get('/dashboard', [dashboardController::class, 'dashboard'])
        ->middleware('can:view-dashboard')
        ->name('dashboard');

    Route::get('/dashboard/orders', [dashboardController::class, 'allOrders'])
        ->middleware('can:view-dashboard')
        ->name('dashboard.orders');

    Route::put('/roles/update-permissions', [dashboardController::class, 'updatePermissions'])
        ->middleware('role:super-admin')
        ->name('roles.updatePermissions');

    Route::get('/users', [dashboardController::class, 'users'])
        ->middleware('can:view-users')
        ->name('users');

    Route::get('/orders', [dashboardController::class, 'orders'])
        ->middleware('can:view-orders')
        ->name('orders');

    Route::get('/earnings', [dashboardController::class, 'earnings'])
    ->middleware('can:view-earnings')
    ->name('earnings');

    Route::post('/users/assign-role', [dashboardController::class, 'assignRole'])
        ->name('users.assignRole');

    Route::delete('/users/{id}', [dashboardController::class, 'deleteUser'])
        ->middleware('can:delete-users')
        ->name('delete.user');

    // Product Management Routes
    Route::post('/tshirt/store', [ProductController::class, 'store'])
        ->middleware('can:create-products')
        ->name('tshirt.store');

    Route::delete('/tshirt/{id}', [ProductController::class, 'delete'])
        ->middleware('can:delete-products')
        ->name('tshirt.delete');

    Route::put('/tshirt/{id}', [ProductController::class, 'update'])
        ->middleware('can:edit-products')
        ->name('tshirt.update');
});
