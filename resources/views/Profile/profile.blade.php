<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - T-Shirt Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<body>

    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="profile-card text-center">

          <a href="{{ url()->previous() }}" class="close-btn" title="Go Back">&times;</a>

            <div class="profile-logo mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#2c3e50"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
            </div>

            <div class="info text-start mb-4">

                {{--  Name  --}}
                <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                    <span class="fw-bold text-secondary">User Name:</span>
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                        <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#nameModal"
                            title="Edit Name">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{--  Email  --}}
                <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                    <span class="fw-bold text-secondary">E-mail:</span>
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-semibold text-dark">{{ Auth::user()->email }}</span>
                        <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#emailModal"
                            title="Edit Email">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{--  Password  --}}
                <div class="d-flex justify-content-between align-items-center py-3">
                    <span class="fw-bold text-secondary">Password:</span>
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold text-dark" style="letter-spacing: 2px;">••••••••</span>
                        <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#passwordModal"
                            title="Edit Password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ url('/tshirt') }}" class="btn btn-outline-secondary fw-bold">Back to Shopping</a>
            </div>
        </div>
    </div>

    {{-- update name --}}
    <div class="modal fade" id="nameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- update email --}}
    <div class="modal fade" id="emailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('profile.update') }}" method="POST" onsubmit="return updateEmail()">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Email</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <label class="form-label">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ Auth::user()->email }}">
                        <span class="error" id="error-email"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- update password --}}
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label">Current Password:</label>
                            <input type="password" class="form-control" name="current_password"
                                placeholder="Enter current password">
                            <div class="text-end mt-1">
                                <span><a href="{{ route('forgotPassword') }}"
                                        class="text-decoration-none text-muted small">Forgot password?</a></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password:</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Enter new password">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirm new password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        var notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'center',
                y: 'top',
            },
        });
        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>

</html>
