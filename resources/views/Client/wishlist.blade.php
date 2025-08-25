@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">My Wishlist</h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Wishlist items --}}
    @if($wishlist && count($wishlist) > 0)
        <div class="row">
            @foreach($wishlist as $item)
                <div class="col-md-4">
                    <div class="card mb-3 h-100">
                        <img src="{{ $item['image'] ?? 'https://via.placeholder.com/300' }}" 
                             class="card-img-top" 
                             alt="{{ $item['name'] ?? 'Product' }}">
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['name'] ?? 'Unnamed Product' }}</h5>
                            <p class="card-text">
                                ${{ $item['price'] ?? '0.00' }}
                            </p>

                            {{-- Remove from wishlist --}}
                            <form action="{{ route('wishlist.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Your wishlist is empty.
        </div>
    @endif
</div>
@endsection
