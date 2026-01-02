<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    {{-- LINK THE NEW CSS FILE HERE --}}
    <link rel="stylesheet" href="{{ asset('css/dashboardHome.css') }}">
</head>

<body>
    <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            {{-- LEFT SIDE: Sidebar Trigger & Brand Logo --}}
            <div class="d-flex align-items-center gap-3">

                {{-- Hamburger Icon --}}
                <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

                {{-- Sidebar Menu Structure (Hidden/Overlay) --}}
                <div id="mySidenav" class="sidenav">
                    <div class="top">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="{{ route('dash.home') }}">Home</a>

                        @can('view-dashboard')
                            <a href="{{ route('dashboard') }}">Inventory</a>
                        @endcan

                        @can('view-orders')
                            <a href="{{ route('dashboard.orders') }}">Orders</a>
                        @endcan
                        @can('view-users')
                            <a href="{{ route('users') }}">Users</a>
                        @endcan
                        @can('view-earnings')
                            <a href="{{ route('earnings') }}">Earnings</a>
                        @endcan



                    </div>
                    <div class="bottom">
                        @auth
                            <a href="{{ route('orders.my') }}">My Order</a>
                        @endauth
                    </div>
                </div>

                {{-- Brand Logo --}}
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ asset('/dashHome') }}">
                    <strong>T-Shirt Store</strong>
                    {{-- SVG Icon --}}
                    <svg height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-38.24 -38.24 458.86 458.86"
                        xml:space="preserve" fill="#000000" stroke="#000000" stroke-width="0.00382375"
                        transform="rotate(45)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                            stroke-width="0.76475"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path style="fill:#010002;"
                                    d="M296.052,44.286c-1.51-1.51-3.514-2.339-5.639-2.339h-45.981c-4.398,0-7.978,3.58-7.978,7.978 v7.834l-0.477,1.122c-4.863,11.421-16.009,20.526-29.805,24.363l-1.599,0.221l-28.361-0.221 c-13.783-3.843-24.924-12.948-29.799-24.363l-0.483-1.122v-7.834c0-4.398-3.58-7.978-7.978-7.978H91.973 c-2.094,0-4.147,0.853-5.639,2.339l-60.128,60.14c-1.504,1.504-2.339,3.509-2.339,5.639c0,2.13,0.829,4.135,2.339,5.645 l45.987,45.981c1.79,1.79,4.308,2.631,6.766,2.261l6.838-1.008V332.45c0,4.398,3.58,7.984,7.978,7.984h184.257 c2.13,0,4.135-0.829,5.645-2.339c1.504-1.51,2.333-3.509,2.333-5.633V148.814l12.894,12.871c3.019,3.019,8.264,3.019,11.289,0.006 l45.987-45.981c1.51-1.51,2.339-3.514,2.339-5.645c0-2.13-0.829-4.129-2.333-5.633L296.052,44.286z M304.555,150.455 l-30.473-30.407v208.447H97.731V149.118l-18.503,2.727l-41.786-41.78l56.184-56.184h40.378v6.325l1.438,3.365 c6.283,14.708,20.323,26.356,37.567,31.165l1.528,0.43l30.807,0.239l3.246-0.442l0.782-0.221 c17.262-4.797,31.308-16.457,37.585-31.189l1.432-3.359v-6.313h40.384l56.178,56.184L304.555,150.455z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>


            {{-- RIGHT SIDE: Buttons & Profile Dropdown --}}
            <div class="d-flex align-items-center gap-2">

                @role('super-admin')
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                        data-bs-target="#rolePermissionModal">
                        <i class="fas fa-user-shield"></i> Manage Roles
                    </button>
                @endrole

                <a href="{{ asset('/tshirt') }}" class="btn btn-outline-dark">
                    <i class="fas fa-store"></i> View Store
                </a>

                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Hello, {{ Auth::user()->name ?? 'User' }}</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

            </div>

        </div>
    </nav>

    {{-- Role & Permission Management Modal --}}
    <div class="modal fade" id="rolePermissionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="rolePermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="rolePermissionForm" method="POST" action="{{ route('roles.updatePermissions') }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">

                        <h5 class="modal-title" id="rolePermissionModalLabel">
                            <i class="fas fa-user-shield"></i> Manage Role Permissions
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Note:</strong> Only Super Admin can modify role permissions. Check the permissions
                            you want to assign to each role.
                        </div>

                        {{-- Super Admin Section --}}
                        <div class="permission-section">
                            <h6>
                                <i class="fas fa-crown text-danger"></i>&nbsp; Super Admin
                                <span class="role-badge badge-super-admin">All Access</span>
                            </h6>
                            <div class="alert alert-warning mb-2" style="padding: 8px; font-size: 0.875rem;">
                                <i class="fas fa-lock"></i> Super Admin has all permissions by default and cannot be
                                modified.
                            </div>
                            <div class="container">
                                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                                    {{-- Keeping original structure --}}
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" checked disabled> View Dashboard
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" checked disabled> View Analytics
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" checked disabled> View
                                            Users</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" checked disabled>
                                            Delete Users</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" checked disabled>
                                            View Orders</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" checked disabled>
                                            View Earnings</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" checked disabled> View Products
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" checked disabled>
                                            Create Products</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" checked disabled>
                                            Edit Products</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" checked disabled>
                                            Delete Products</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" checked disabled> Add To Cart
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" checked disabled>
                                            Check - Out</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" checked disabled>
                                            Place Orders</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" checked disabled>
                                            Payment</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Admin Section --}}
                        <div class="permission-section">
                            <h6>
                                <i class="fas fa-user-cog text-warning"></i>&nbsp; Admin
                                <span class="role-badge badge-admin">Limited Access</span>
                            </h6>
                            <div class="container">
                                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[admin][]"
                                                value="view-dashboard"
                                                {{ in_array('view-dashboard', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            View Dashboard</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="view-analytics"
                                                {{ in_array('view-analytics', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            View Analytics</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="view-users"
                                                {{ in_array('view-users', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            View Users</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="delete-users"
                                                {{ in_array('delete-users', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Delete Users</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="view-orders"
                                                {{ in_array('view-orders', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            View Order</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="view-earnings"
                                                {{ in_array('view-earnings', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            View Earnings</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[admin][]"
                                                value="view-products"
                                                {{ in_array('view-products', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            View Products</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="create-products"
                                                {{ in_array('create-products', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Create Products</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[admin][]"
                                                value="edit-products"
                                                {{ in_array('edit-products', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Edit Products</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="delete-products"
                                                {{ in_array('delete-products', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Delete Products</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[admin][]"
                                                value="add-to-cart"
                                                {{ in_array('add-to-cart', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Add To Cart</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[admin][]"
                                                value="checkout"
                                                {{ in_array('checkout', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Check - Out</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[admin][]"
                                                value="place-orders"
                                                {{ in_array('place-orders', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Place Orders</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[admin][]"
                                                value="payment"
                                                {{ in_array('payment', $adminPermissions ?? []) ? 'checked' : '' }}>
                                            Payment</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- User Section --}}
                        <div class="permission-section">
                            <h6>
                                <i class="fas fa-user text-primary"></i> &nbsp;User
                                <span class="role-badge badge-user">Customer Access</span>
                            </h6>
                            <div class="container">
                                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                                    <div class="col">
                                        <label class="p-3 "> <input type="checkbox" name="permissions[user][]"
                                                value="add-to-cart"
                                                {{ in_array('add-to-cart', $userPermissions ?? []) ? 'checked' : '' }}>
                                            Add To Cart</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[user][]"
                                                value="checkout"
                                                {{ in_array('checkout', $userPermissions ?? []) ? 'checked' : '' }}>
                                            Check - Out</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[user][]"
                                                value="place-orders"
                                                {{ in_array('place-orders', $userPermissions ?? []) ? 'checked' : '' }}>
                                            Place Orders</label>
                                    </div>
                                    <div class="col">
                                        <label class="p-3 "><input type="checkbox" name="permissions[user][]"
                                                value="payment"
                                                {{ in_array('payment', $userPermissions ?? []) ? 'checked' : '' }}>
                                            Payment</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        @can('view-users')
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Permissions
                            </button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Dashboard Cards --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3 m-2">
        <div class="col">
            <div class="card border-success h-100" id="inventory" style="cursor: pointer;">
                <div class="card-body">
                    <div class="card-title">
                        <span>Inventory</span>
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                    <h5>{{ $totalTshirt }}</h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-info h-100" id="price">
                <div class="card-body">
                    <div class="card-title">
                        <span>Inventory Value</span>
                        <i class="fa-solid fa-vault"></i>
                    </div>
                    <h5>₹{{ number_format($totalInventorySum, 2) }}</h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-warning h-100" id="user" style="cursor: pointer;">
                <div class="card-body">
                    <div class="card-title">
                        <span>Users</span>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h5>{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-danger h-100" id="order" style="cursor: pointer;">
                <div class="card-body">
                    <div class="card-title">
                        <span>Orders</span>
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <h5>{{ $totalOrders }}</h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success h-100" id="earning" style="cursor: pointer;">
                <div class="card-body">
                    <div class="card-title">
                        <span>Earnings</span>
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                    <h5>₹{{ number_format($totalEarnings, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>
    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        // Initialize Notyf
        const notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'center',
                y: 'top',
            },
        });

        // Card click handlers
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("inventory")?.addEventListener("click", function() {
                window.location.href = "{{ route('dashboard') }}";
            });

            document.getElementById("user")?.addEventListener("click", function() {
                window.location.href = "{{ asset('users') }}";
            });
            document.getElementById("order")?.addEventListener("click", function() {
                window.location.href = "{{ asset('orders') }}";
            });
            document.getElementById("earning")?.addEventListener("click", function() {
                window.location.href = "{{ asset('earnings') }}";
            });
        });

        // Show notifications
        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif

    function openNav() {
    if (window.innerWidth <= 768) {
        document.getElementById("mySidenav").style.width = "100%";
    } else {
        document.getElementById("mySidenav").style.width = "250px"; 
    }
}

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

</body>

</html>
