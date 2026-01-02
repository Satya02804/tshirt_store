@extends('layout_1.app_1')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">

    <nav class="m-2 ms-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <br>
    <h3 class=" text-muted ms-4">User Management</h3>
    <div class="table-responsive mb-5">
        <table class="table table-striped align-middle">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->roles->isNotEmpty())
                                @foreach ($user->roles as $role)
                                    @if ($role->name === 'super-admin')
                                        <span class="badge bg-danger">{{ ucfirst($role->name) }}</span>
                                    @elseif($role->name === 'admin')
                                        <span class="badge bg-warning text-dark">{{ ucfirst($role->name) }}</span>
                                    @else
                                        <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                                    @endif
                                @endforeach
                            @else
                                <span class="badge bg-secondary">No Role</span>
                            @endif
                        </td>
                        <td>
                            @if (auth()->user()->id !== $user->id)
                                <div class="d-flex align-items-center gap-2">
                                    @if (!$user->hasRole('super-admin'))
                                        {{-- Role Assignment Dropdown --}}
                                        @role('super-admin')
                                            <form action="{{ route('users.assignRole') }}" method="POST" class="m-0">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <select name="role" class="form-select form-select-sm"
                                                    onchange="this.form.submit()" style="width: auto;">
                                                    <option value="" disabled>Change Role</option>
                                                    @foreach ($roles as $role)
                                                        @if ($role->name !== 'super-admin')
                                                            <option value="{{ $role->name }}"
                                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                                {{ ucfirst($role->name) }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </form>
                                        @endrole

                                        {{-- Delete Button --}}
                                        @can('delete-users')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-trash3 text-danger" style="cursor: pointer;"
                                                viewBox="0 0 16 16" onclick="deleteUser({{ $user->id }})" title="Delete">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                            </svg>
                                        @else
                                            <span class="badge bg-secondary">No Permission</span>
                                        @endcan
                                    @else
                                        <span class="badge bg-danger">Protected</span>
                                    @endif
                                </div>
                            @else
                                <span class="badge bg-info">You</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Hidden form for delete -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        const notyf = new Notyf({
            position: {
                x: 'center',
                y: 'top'
            },
            duration: 3000
        });

        function deleteUser(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteForm = document.getElementById('deleteForm');
                    if (!deleteForm) {
                        notyf.error('Error: Form not found');
                        return;
                    }
                    deleteForm.action = '/users/' + id;
                    deleteForm.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    notyf.error('Deletion cancelled');
                }
            });
        }

        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script>
        // Initialize Notyf for toast notifications
        const notyf = new Notyf({
            position: {
                x: 'center',
                y: 'top'
            },
            duration: 3000,
            ripple: true,
            dismissible: true
        });

        /**
         * Delete user with confirmation and toast notification
         * @param {number} id - User ID to delete
         */
        function deleteUser(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get the form element
                    const deleteForm = document.getElementById('deleteForm');

                    if (!deleteForm) {
                        notyf.error('Error: Form not found');
                        console.error('deleteForm element not found in the DOM');
                        return;
                    }

                    // Set the action URL
                    deleteForm.action = '/users/' + id;

                    // Show processing notification
                    notyf.success('Processing deletion...');

                    // Submit the form
                    deleteForm.submit();

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User cancelled - show notification
                    notyf.error('Deletion cancelled');
                }
            });
        }

        /**
         * Show notification based on type
         * @param {string} type - 'success' or 'error'
         * @param {string} message - Message to display
         */
        function showNotification(type, message) {
            if (type === 'success') {
                notyf.success(message);
            } else if (type === 'error') {
                notyf.error(message);
            }
        }

        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            // Check if delete form exists
            const deleteForm = document.getElementById('deleteForm');
            if (!deleteForm) {
                console.warn('Warning: deleteForm not found. Delete functionality may not work.');
            }
        });
    </script>
@endsection
