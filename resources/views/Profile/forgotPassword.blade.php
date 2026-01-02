<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
</head>

<body>

    <div class="container h-100 d-flex align-items-center justify-content-center" style="padding-top: 60px;">
        <div class="login-card">

            <a href="{{ url()->previous() }}" class="close-btn" title="Go Back">&times;</a>

            <div class="text-center mb-4">
                <h3>Forgot Password?</h3>
                <p class="text-muted">Enter your email address and we'll send you a link to reset your password.</p>


                <form action="{{ route('forgot.check') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="forgotEmail" class="form-label fw-bold">Email Address:</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="forgotEmail" placeholder="name@example.com" required>
                    </div>

                    <button type="submit" class="btn btn-admin w-100 py-2 fw-bold">Send Reset Link</button>
                </form>
                @if (session('success'))
                    <div class="alert alert-success text-center p-2 mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-3 text-center p-2">
                        {{ $errors->first() }}
                    </div>
                @endif

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
