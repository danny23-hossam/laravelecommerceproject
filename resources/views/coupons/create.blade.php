@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Coupon</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coupons.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="code" class="form-label">Coupon Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="discount" class="form-label">Discount (%)</label>
            <input type="number" name="discount" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="expires_at" class="form-label">Expires At</label>
            <input type="date" name="expires_at" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Coupon</button>
        <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
