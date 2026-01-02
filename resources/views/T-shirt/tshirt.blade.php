<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Tshirt Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('css/tshirt.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light px-3">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">

                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

                    {{-- Sidebar menu --}}
                    <div id="mySidenav" class="sidenav">
                        <div class="top">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <a href="{{ asset('/tshirt') }}">Home</a>

                            @can('view-dashboard')
                                <a href="{{ route('dash.home') }}">Dashboard</a>
                            @endcan
                            @auth
                                <a href="{{ route('orders.my') }}">My Order</a>

                            @endauth

                            @guest
                                <a href="{{ route('login') }}">Login</a>
                            @endguest
                        </div>

                        {{-- Profile Icon & Name --}}
                        <div class="bottom">
                            @auth
                                <a href="{{ route('profile') }}" style="display: flex; align-items: center; gap: 10px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path fill-rule="evenodd"
                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                    </svg>
                                    {{ Auth::user()->name }}
                                </a>

                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                    </div>
                    <a id="navbar" class="navbar-brand mb-0 h1" href="{{ asset('/tshirt') }}"><strong> T-Shirt
                            Store</strong></a>
                </div>

                <button style="margin-left: auto;" class="btn btn-outline-dark ms-auto" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Cart
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cart" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h4 id="offcanvasRightLabel">Cart</h4>
                        <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                    </div>
                    <div class="offcanvas-footer p-3 pt-0 border-top"></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="tshirt" id="tshirt_product">
        <div id="loading-spinner" class="d-flex justify-content-center align-items-center w-100"
            style="min-height: 60vh;">
            <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="fixed-bottom bg-dark text-white text-center">
        <div class="container">Copyright &copy; 2025 T-Shirt Store</div>
    </div>


    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        // Init global variable
        let tshirtData = [];

        // ✅ IMPORTANT: Define user permissions for JS
        window.userPermissions = {
            authenticated: {{ auth()->check() ? 'true' : 'false' }},
            add_to_cart: @if (auth()->check() && auth()->user()->can('add-to-cart'))
                true
            @else
                false
            @endif ,
            checkout: @if (auth()->check() && auth()->user()->can('checkout'))
                true
            @else
                false
            @endif
        };
    </script>

    <script src="{{ asset('js/tshirt.js') }}"></script>

    <script>
        @if (session('success'))
            const notyfAlert = new Notyf({
                position: {
                    x: 'center',
                    y: 'top'
                }
            });
            notyfAlert.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            const notyfError = new Notyf({
                position: {
                    x: 'center',
                    y: 'top'
                }
            });
            notyfError.error("{{ session('error') }}");
        @endif
    </script>
</body>

</html>
