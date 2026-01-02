@extends('layout_1.app_1')

@section('content')
<link rel="stylesheet" href="{{asset('css/earnings.css')}}">
<style></style>
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center m-3">
             <nav class="m-2 ms-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Earnings</li>
            </ol>
        </nav>


        {{-- Total Revenue Badge (Kept this as it's useful for Earnings) --}}
        <div class="bg-success bg-gradient text-white px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-cash-stack fs-5"></i>
            <div>
                <span class="d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px; opacity: 0.9;">Total
                    Revenue</span>
                <span class="fs-5 fw-bold">₹{{ number_format($orders->sum('total_price'), 2) }}</span>
            </div>
        </div>
    </div>

    <div class="container-fluid">
            {{-- Card Header --}}
            <h3 class=" text-muted ms-4" > Earning Summary</h3>

            <div class="card-body p-0 mb-5  ">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary   font-weight-bolder opacity-7 ps-4"
                                    style="font-size: 1rem;">No</th>

                                <th class="text-uppercase text-secondary   font-weight-bolder opacity-7"
                                    style="font-size: 1rem;">Date</th>

                                <th class="text-uppercase text-secondary   font-weight-bolder opacity-7"
                                    style="font-size: 1rem;">Order ID</th>
                                <th class="text-uppercase text-secondary   font-weight-bolder opacity-7"
                                    style="font-size: 1rem;">Customer</th>
                                <th class="text-uppercase text-secondary   font-weight-bolder opacity-7"
                                    style="font-size: 1rem;">Payment Type</th>
                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7 text-end"
                                    style="font-size: 1rem;">Amount(₹)</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    {{-- NO --}}
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0 text-muted">{{ $loop->iteration }}</p>
                                    </td>
                                    {{-- DATE --}}

                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $order->created_at->format('d M, Y') }}
                                        </span>
                                    </td>

                                    {{-- ORDER ID --}}
                                    <td>
                                        <span class="text-dark fw-bold text-sm">{{ $order->order_number }}</span>
                                    </td>

                                    {{-- CUSTOMER --}}
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            @if ($order->user)
                                                {{-- Optional: Avatar Circle (Uncomment if you want the circle) --}}
                                                {{-- <div class="me-2 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                                </div> --}}
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ strtoupper($order->user->name) }}</h6>

                                                </div>
                                            @else
                                                <span class="badge bg-secondary">Guest</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- PAYMENT TYPE (Styled like Roles) --}}
                                    <td>
                                        @php
                                            $badgeClass = match ($order->payment_method) {
                                                'cod' => 'bg-info',
                                                'card' => 'bg-primary',
                                                'upi' => 'bg-warning text-dark',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} rounded-pill text-uppercase"
                                            style="font-size: 0.7rem; padding: 0.5em 1em;     margin-left: 40px;">
                                            {{ str_replace('_', ' ', $order->payment_method) }}
                                        </span>
                                    </td>

                                    {{-- AMOUNT --}}
                                    <td class="text-end" >
                                        <span class="text-success fw-bold " style="margin-right:2rem" >
                                            {{ number_format($order->total_price, 2) }}
                                        </span>
                                    </td>


                                </tr>
                            @endforeach

                            {{-- EMPTY STATE --}}
                            @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div
                                            class="d-flex flex-column align-items-center justify-content-center text-muted">
                                            <i class="bi bi-wallet2 fs-1 mb-2 opacity-50"></i>
                                            <p class="mb-0">No earnings data found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
@endsection
