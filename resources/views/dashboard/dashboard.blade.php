@extends('layout_1.app_1')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">




    <div class="container-fluid">
        {{-- Add Product Modal - Only show if user has create-products permission --}}
        @can('create-products')
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('tshirt.store') }}" method="POST" onsubmit="return saveTshirt()">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add New T-Shirt</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="pTitle" name="name">
                                    <span id="error-title" class="text-danger small mt-1 d-none"></span>
                                </div>
                                <div class="mb-3">
                                    <label>Image URL</label>
                                    <input type="text" class="form-control" id="pURL" name="url">
                                    <span id="error-url" class="text-danger small mt-1 d-none"></span>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label>Price (₹)</label>
                                        <input type="number" class="form-control" id="pPrice" name="price">
                                        <span id="error-price" class="text-danger small mt-1 d-none"></span>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label>Discount (%)</label>
                                        <input type="number" class="form-control" id="pDiscount" name="discount">
                                        <span id="error-discount" class="text-danger small mt-1 d-none"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-dark">Add T-shirt</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </div>


    <nav class="d-flex mt-2 m-2 ms-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inventory</li>
        </ol>

        {{-- Show Add Button only if user has create-products permission --}}
        @can('create-products')
            <div class="d-flex align-items-center mt-2 ms-auto gap-2">
                <button type="button" class="btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add New T-shirt
                </button>
            </div>
        @endcan
    </nav>
    <h3 class="text-muted ms-4">T-shirt Management</h3>

    <div class="table-responsive mb-5">
        <table class="table table-striped align-middle">
            <thead class="thead">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $i => $product)
                    <tr>
                        <td><img src="{{ $product->url }}" alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->discount > 0)
                                <span class="text-decoration-line-through text-danger me-2">
                                    ₹{{ $product->price }}
                                </span>
                                @php
                                    $discountedPrice = $product->price - $product->price * ($product->discount / 100);
                                @endphp
                                <span class="fw-bold text-dark">₹{{ round($discountedPrice) }}</span>
                            @else
                                ₹{{ $product->price }}
                            @endif
                        </td>
                        <td>
                            @if ($product->discount > 0)
                                <span class="badge bg-danger">{{ $product->discount }}% OFF</span>
                            @else
                                <span class="badge bg-light text-dark border">None</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-3">
                                {{-- Edit Button - Only show if user has edit-products permission --}}
                                @can('edit-products')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square text-warning" style="cursor: pointer;" viewBox="0 0 16 16"
                                        onclick="editData({{ $i }})" title="Edit">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                @endcan

                                {{-- Delete Button - Only show if user has delete-products permission --}}
                                @can('delete-products')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-trash3 text-danger" style="cursor: pointer;" viewBox="0 0 16 16"
                                        onclick="deleteData({{ $product->id }})" title="Delete">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Edit Modal - Only show if user has edit-products permission --}}
    @can('edit-products')
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editForm" method="POST" onsubmit="return updateTshirt()">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit T-Shirt</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" class="form-control" id="editTitle" name="name">
                                <span id="error-editTitle" class="text-danger small d-none"></span>
                            </div>
                            <div class="mb-3">
                                <label>Image URL</label>
                                <input type="text" class="form-control" id="editURL" name="url">
                                <span id="error-editURL" class="text-danger small d-none"></span>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Price (₹)</label>
                                    <input type="number" class="form-control" id="editPrice" name="price">
                                    <span id="error-editPrice" class="text-danger small mt-1 d-none"></span>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Discount (%)</label>
                                    <input type="number" class="form-control" id="editDiscount" name="discount">
                                    <span id="error-editDiscount" class="text-danger small mt-1 d-none"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn">Update T-shirt</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script>
        let tshirtData = @json($products);
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    {{-- <script src="{{ asset('js/dashboard.js') }}"></script>  --}}
    <script>
        const notyf = new Notyf({
            position: {
                x: 'center',
                y: 'top'
            }
        });
        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif
    </script>
    <script>
        function saveTshirt() {


            // Get the values
            const title = document.getElementById('pTitle').value;
            const url = document.getElementById('pURL').value;
            const price = document.getElementById('pPrice').value;
            const discount = document.getElementById('pDiscount').value;


            const errorTitle = document.getElementById('error-title');
            const errorURL = document.getElementById('error-url');
            const errorPrice = document.getElementById('error-price');
            const errorDiscount = document.getElementById('error-discount');

            // Reset error messages

            errorTitle.classList.add('d-none');
            errorURL.classList.add('d-none');
            errorPrice.classList.add('d-none');
            errorDiscount.classList.add('d-none');

            let isValid = true;

            if (title.trim() === '') {
                errorTitle.textContent = "Title is required";
                errorTitle.classList.remove('d-none');
                isValid = false;
            }

            if (url.trim() === '') {
                errorURL.textContent = "Enter Image URL.";
                errorURL.classList.remove('d-none');
                isValid = false;
            } else if (!urlPattern.test(url)) {
                errorURL.textContent = "Enter Valid Image URL";
                errorURL.classList.remove('d-none');
                isValid = false;
            }

            if (price.trim() === '') {
                errorPrice.textContent = "Price is required";
                errorPrice.classList.remove('d-none');
                isValid = false;
            }
            if (discount.value <= 0) {
                errorDiscount.textContent = "Discount must be above zero";
                errorDiscount.classList.remove('d-none');
                isValid = false;

            }

            return isValid;


        }

        function deleteData(id) {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    let destroy = document.getElementById('deleteForm');

                    destroy.action = '/tshirt/' + id;

                    destroy.submit();

                }
            });
        }

        function updateTshirt() {

            const urlPattern = /^(http|https|ftp):\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(:[a-zA-Z0-9]*)?(\/.*)?$/;

            // Get values from the EDIT inputs
            const title = document.getElementById('editTitle').value;
            const url = document.getElementById('editURL').value;
            const price = document.getElementById('editPrice').value;
            const discount = document.getElementById('editDiscount').value;

            const errorTitle = document.getElementById('error-editTitle');
            const errorURL = document.getElementById('error-editURL');
            const errorPrice = document.getElementById('error-editPrice');
            const errorDiscount = document.getElementById('error-editDiscount');

            //  Reset Errors
            errorTitle.classList.add('d-none');
            errorURL.classList.add('d-none');
            errorPrice.classList.add('d-none');
            errorDiscount.classList.add('d-none');

            let isValid = true;
            //validation
            if (title.trim() === '') {
                errorTitle.textContent = "Title is required";
                errorTitle.classList.remove('d-none');
                isValid = false;
            }

            if (url.trim() === '') {
                errorURL.textContent = "Enter Image URL.";
                errorURL.classList.remove('d-none');
                isValid = false;
            } else if (!urlPattern.test(url)) {
                errorURL.textContent = "Enter Valid Image URL";
                errorURL.classList.remove('d-none');
                isValid = false;
            }

            if (price.trim() === '') {
                errorPrice.textContent = "Price is required";
                errorPrice.classList.remove('d-none');
                isValid = false;
            }
            if (discount < 0 || discount > 100) {
                errorDiscount.textContent = "Discount must be between 0 and 100";
                errorDiscount.classList.remove('d-none');
                isValid = false;

            }
            return isValid;
        }


        function editData(index) {
            let product = tshirtData[index];

            document.getElementById('editTitle').value = product.name;
            document.getElementById('editURL').value = product.url;
            document.getElementById('editPrice').value = product.price;
            document.getElementById('editDiscount').value = product.discount;

            document.getElementById('error-editTitle').classList.add('d-none');
            document.getElementById('error-editURL').classList.add('d-none');
            document.getElementById('error-editPrice').classList.add('d-none');
            document.getElementById('error-editDiscount').classList.add('d-none');

            let update = document.getElementById('editForm');
            update.action = '/tshirt/' + product.id;

            let myModal = new bootstrap.Modal(document.getElementById('editModal'));
            myModal.show();
        }
    </script>
@endsection
