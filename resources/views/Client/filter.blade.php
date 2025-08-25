<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">🛒 Our Products</h2>

    <!-- Filters -->
    <form action="#" method="GET" class="row g-3 mb-4">

        <!-- Price Range -->
        <div class="col-md-3">
            <label for="min_price" class="form-label">Min Price</label>
            <input type="number" name="min_price" id="min_price" class="form-control"
                   value="{{ request('min_price') }}" placeholder="0">
        </div>
        <div class="col-md-3">
            <label for="max_price" class="form-label">Max Price</label>
            <input type="number" name="max_price" id="max_price" class="form-control"
                   value="{{ request('max_price') }}" placeholder="1000">
        </div>

        <!-- Category -->
        <div class="col-md-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Availability -->
        <div class="col-md-3">
            <label for="availability" class="form-label">Availability</label>
            <select name="availability" id="availability" class="form-select">
                <option value="">All</option>
                <option value="1" {{ request('availability') === '1' ? 'selected' : '' }}>In Stock</option>
                <option value="0" {{ request('availability') === '0' ? 'selected' : '' }}>Out of Stock</option>
            </select>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
    </form>

    <!-- Product Results -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                        <p class="fw-bold">Price: ${{ $product->price }}</p>
                        <p class="badge bg-secondary">{{ $product->category->name }}</p>
                        <p class="badge {{ $product->quantity ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->quantity ? 'In Stock' : 'Out of Stock' }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No products found with these filters.</p>
        @endforelse
    </div>
</div>

</body>
</html>
