<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
</head>

<body>

    <div class="container h-100 d-flex align-items-center justify-content-center" style="padding-top: 60px;">
        <div class="login-card">

            <div class="text-center mb-4">
                <h3 class="fw-bold">Reset Password</h3>
                <p class="text-muted small">Create a new, strong password for your account.</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address:</label>
                    <input type="email" name="email" class="form-control" placeholder="Confirm your email" required>
                </div>


                <div class="mb-3">
                    <label for="Password" class="form-label fw-bold"> New Password:</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="Password1"
                            placeholder="Enter new password" required>
                        <button class="btn btn-outline-secondary" type="button" id="showPassword1"
                            style="border-left: none; border-color: #dee2e6;">
                            <i class="fa-solid fa-eye" id="eye1"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password:</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" placeholder="Repeat password" required>
                        <button class="btn btn-outline-secondary" type="button" id="showPassword2"
                            style="border-left: none; border-color: #dee2e6;">
                            <i class="fa-solid fa-eye" id="eye2"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-admin w-100 py-2 fw-bold">Reset Password</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-3 text-center p-2">
                    {{ $errors->first() }}
                </div>
            @endif

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
