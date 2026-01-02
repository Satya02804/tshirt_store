<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #4f46e5;
        --primary-light: #eef2ff;
        --secondary: #64748b;
        --success: #10b981;
        --info: #3b82f6;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1e293b;
        --light: #f8fafc;
        --border: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: #f1f5f9;
        font-family: 'Inter', sans-serif;
        color: #334155;
        font-size: 0.95rem;
    }

    /* --- Navigation --- */
    .navbar {
        background: #ffffff !important;
        border-bottom: 1px solid var(--border);
        padding: 0.8rem 1rem;
        box-shadow: var(--shadow-sm) !important;
    }

    .navbar-brand strong {
        font-weight: 700;
        color: var(--dark);
        letter-spacing: -0.5px;
    }

    /* --- Sidebar --- */
    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1050;
        top: 0;
        left: 0;
        background-color: #0f172a;
        overflow-x: hidden;
        padding-top: 60px;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .sidenav a {
        padding: 14px 24px;
        text-decoration: none;
        font-size: 16px;
        color: #94a3b8;
        display: block;
        transition: 0.2s;
        font-weight: 500;
        border-left: 3px solid transparent;
    }

    .sidenav a:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.05);
        border-left-color: var(--primary);
    }

    .sidenav .closebtn {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 30px;
        margin-left: 0;
        color: #fff;
    }

    .sidenav .bottom {
        margin-top: auto;
        border-top: 1px solid #1e293b;
        padding: 10px 0;
    }
</style>


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

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
