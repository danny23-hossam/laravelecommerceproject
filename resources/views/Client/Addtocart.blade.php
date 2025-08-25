<style>
/* Background and centering */
.d-flex.justify-content-center.align-items-center.min-vh-100 {
  background-color: #faf7fb; /* soft pastel lavender */
}

/* Card container */
.product-card {
  background-color: #fff; /* crisp white */
  border-radius: 12px;
  padding: 24px 20px;
  width: 320px;
  box-shadow: 0 4px 12px rgba(100, 75, 100, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}
.product-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 20px rgba(100, 75, 100, 0.15);
}

/* Product Image wrapper */
.product-image {
  width: 100%;
  max-height: 200px;
  border-radius: 10px;
  object-fit: contain; /* Changed from cover to contain */
  background-color: #f8f0f8; /* subtle background to fill empty space */
  box-shadow: 0 2px 8px rgba(150, 100, 150, 0.1);
  transition: transform 0.35s ease;
}
.product-card:hover .product-image {
  transform: scale(1.03);
}

/* Product Title */
.product-title {
  font-size: 1.4rem;
  font-weight: 600;
  color: #5c4060; /* dusty plum */
  margin-top: 16px;
  margin-bottom: 6px;
  user-select: none;
}

/* Price */
.product-price {
  font-size: 1.1rem;
  font-weight: 500;
  color: #a17f9b; /* soft mauve */
  margin-bottom: 18px;
}

/* Button */
.btn-pink {
  background-color: #b48ead; /* pastel purple */
  border: none;
  color: white !important;
  padding: 12px 36px;
  border-radius: 30px;
  font-weight: 600;
  font-size: 1rem;
  box-shadow: 0 6px 12px rgba(180, 142, 173, 0.35);
  transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
  user-select: none;
  cursor: pointer;
}
.btn-pink:hover,
.btn-pink:focus {
  background-color: #9a6f9c; /* darker purple */
  box-shadow: 0 8px 20px rgba(154, 111, 156, 0.5);
  transform: translateY(-3px);
  outline: none;
}
.btn-pink:focus-visible {
  outline: 2px solid #f6b8f9ff;
  outline-offset: 3px;
}
</style>

<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="product-card">
    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-image">

    <h5 class="product-title">{{ $product->name }}</h5>
    <h6 class="product-price">${{ $product->price }}</h6>

    <form action="{{ route('client.insert', $product) }}" method="POST">
    @csrf
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

  </div>
</div>
