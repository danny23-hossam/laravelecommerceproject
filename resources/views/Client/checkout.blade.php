@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>

    {{-- Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Cart Items --}}
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>
                        {{ $item->quantity }}
                        <input type="hidden" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}">
                    </td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totals --}}
    <h4>
        Subtotal: ${{ number_format($total, 2) }} <br>
        @if(session()->has('discount'))
            Discount: ${{ number_format(session('discount'), 2) }} <br>
        @endif
        <strong>Total: ${{ number_format($total - session('discount', 0), 2) }}</strong>
    </h4>

    {{-- Coupon Form --}}
    <form action="{{ route('checkout.coupon') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="coupon_code" class="form-control" placeholder="Enter coupon code" required>
            <button type="submit" class="btn btn-success">Apply Coupon</button>
        </div>
    </form>

    {{-- Checkout Form --}}
    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
