@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Coupons</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('coupons.create') }}" class="btn btn-primary mb-3">+ Add Coupon</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Discount</th>
                <th>Expires At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount }}%</td>
                    <td>{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : 'No expiry' }}</td>
                    <td>
                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this coupon?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No coupons found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
