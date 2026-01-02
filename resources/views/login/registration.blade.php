<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> T-Shirt Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="container h-100 d-flex align-items-center justify-content-center" style="padding-top: 60px;">
        <div class="login-card">
            <div class="text-center mb-4">
                <h3><svg height="40px" width="40px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-38.24 -38.24 458.86 458.86"
                        xml:space="preserve" fill="#000000" stroke="#000000" stroke-width="0.00382375"
                        transform="rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                            stroke-width="0.76475"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <g>
                                    <path style="fill:#010002;"
                                        d="M296.052,44.286c-1.51-1.51-3.514-2.339-5.639-2.339h-45.981c-4.398,0-7.978,3.58-7.978,7.978 v7.834l-0.477,1.122c-4.863,11.421-16.009,20.526-29.805,24.363l-1.599,0.221l-28.361-0.221 c-13.783-3.843-24.924-12.948-29.799-24.363l-0.483-1.122v-7.834c0-4.398-3.58-7.978-7.978-7.978H91.973 c-2.094,0-4.147,0.853-5.639,2.339l-60.128,60.14c-1.504,1.504-2.339,3.509-2.339,5.639c0,2.13,0.829,4.135,2.339,5.645 l45.987,45.981c1.79,1.79,4.308,2.631,6.766,2.261l6.838-1.008V332.45c0,4.398,3.58,7.984,7.978,7.984h184.257 c2.13,0,4.135-0.829,5.645-2.339c1.504-1.51,2.333-3.509,2.333-5.633V148.814l12.894,12.871c3.019,3.019,8.264,3.019,11.289,0.006 l45.987-45.981c1.51-1.51,2.339-3.514,2.339-5.645c0-2.13-0.829-4.129-2.333-5.633L296.052,44.286z M304.555,150.455 l-30.473-30.407v208.447H97.731V149.118l-18.503,2.727l-41.786-41.78l56.184-56.184h40.378v6.325l1.438,3.365 c6.283,14.708,20.323,26.356,37.567,31.165l1.528,0.43l30.807,0.239l3.246-0.442l0.782-0.221 c17.262-4.797,31.308-16.457,37.585-31.189l1.432-3.359v-6.313h40.384l56.178,56.184L304.555,150.455z">
                                    </path>
                                    <path style="fill:#010002;"
                                        d="M373.055,87.552l-60.122-60.134c-6.015-6.021-14.016-9.338-22.519-9.338h-45.981 c-17.555,0-31.845,14.285-31.845,31.845v2.112c-2.291,3.198-6.11,5.895-10.746,7.56h-21.278c-4.63-1.665-8.461-4.368-10.758-7.566 v-2.112c0-17.561-14.285-31.845-31.845-31.845H91.979c-8.377,0-16.582,3.401-22.513,9.332L9.338,87.54 C3.318,93.555,0,101.55,0,110.065c0,8.509,3.312,16.504,9.326,22.519l45.987,45.981c1.993,1.993,4.219,3.705,6.611,5.09V332.45 c0,17.561,14.285,31.851,31.845,31.851h184.257c8.503,0,16.498-3.312,22.525-9.332c6.021-6.027,9.326-14.028,9.32-22.507V187.378 c6.504-1.122,12.572-4.195,17.191-8.813l45.987-45.981c6.015-6.009,9.326-14.01,9.326-22.519 C382.387,101.556,379.069,93.561,373.055,87.552z M364.617,124.147l-45.987,45.981c-5.382,5.382-13.742,7.154-20.687,4.72v157.609 c0.006,5.316-2.07,10.317-5.83,14.076c-3.765,3.759-8.765,5.836-14.082,5.836H93.775c-10.979,0-19.911-8.932-19.911-19.917 V175.575c-3.801-0.764-7.297-2.631-10.108-5.448l-45.987-45.981c-3.759-3.759-5.836-8.765-5.836-14.082 c0-5.322,2.071-10.317,5.836-14.076l60.134-60.14c3.711-3.711,8.837-5.836,14.076-5.836h45.981 c10.979,0,19.911,8.932,19.911,19.911v5.322c3.61,7.429,11.265,13.431,20.789,16.284h25.073 c9.529-2.846,17.179-8.849,20.783-16.284v-5.328c0-10.979,8.932-19.911,19.911-19.911h45.981c5.322,0,10.317,2.076,14.076,5.842 l60.128,60.14c3.759,3.753,5.836,8.753,5.836,14.076C370.453,115.381,368.383,120.388,364.617,124.147z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg></h3>
                <h3 class="fw-bold">Sign-up for T-shirt Store </h3>
            </div>

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf <div class="mb-3">
                    <label for="Name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control" id="Name"
                        value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" id="Email"
                        value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="Password" class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="Password1">
                        <button class="btn btn-outline-secondary" type="button" id="showPassword1"
                            style="border-left: none; border-color: #dee2e6;">
                            <i class="fa-solid fa-eye" id="eye1"></i>
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation">
                        <button class="btn btn-outline-secondary" type="button" id="showPassword2"
                            style="border-left: none; border-color: #dee2e6;">
                            <i class="fa-solid fa-eye" id="eye2"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-admin w-100 py-2 fw-bold">Register</button>
            </form>

            <div class="text-center mt-3 border-top pt-3">
                <small>Already have an account?<a href="{{ url('/login') }}"
                        class="text-muted text-decoration-underline"> &nbsp; Sign in →</a></small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const showPassword_1 = document.querySelector('#showPassword1');
        const password_1 = document.querySelector('#Password1');
        const eye_1 = document.querySelector('#eye1');

        showPassword_1.addEventListener('click', function() {
            const type = password_1.getAttribute('type') === 'password' ? 'text' : 'password';
            password_1.setAttribute('type', type);

            if (type === 'text') {
                eye_1.classList.remove('fa-eye');
                eye_1.classList.add('fa-eye-slash');
            } else {
                eye_1.classList.remove('fa-eye-slash');
                eye_1.classList.add('fa-eye');
            }
        });
        const showPassword_2 = document.querySelector('#showPassword2');
        const password = document.querySelector('#password_confirmation');
        const eye_2 = document.querySelector('#eye2');

        showPassword_2.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            if (type === 'text') {
                eye_2.classList.remove('fa-eye');
                eye_2.classList.add('fa-eye-slash');
            } else {
                eye_2.classList.remove('fa-eye-slash');
                eye_2.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
