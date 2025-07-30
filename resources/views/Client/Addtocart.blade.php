<div class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #fef6ff;">
    <div class="col-sm-8 col-md-6 col-lg-4">
        <div class="p-4 rounded-3 shadow-sm text-center" style="background-color: #fff0f5;">

            <div class="mb-3">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                     class="img-fluid rounded" style="height: 200px; object-fit: cover;">
            </div>

            <h5 class="fw-bold text-dark">{{ $product->name }}</h5>
            <h6 class="text-muted">${{ $product->price }}</h6>

            <form action="{{ route('client.insert', $product) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-pink rounded-pill px-4 py-2" style=" color: black;">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
