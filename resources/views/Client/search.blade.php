<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">🔎 Search for Products</h2>

    <!-- Search Form -->
    <form class="d-flex mb-4" id="searchForm">
        <input type="text" name="query" class="form-control me-2" placeholder="Enter product name...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Search Results -->
    <h4 class="mb-3">Search Results:</h4>
    <div id="products" class="row"></div>
</div>




<script>
const form = document.getElementById('searchForm');
const productsContainer = document.getElementById('products');

form.addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent page reload

    const input = form.querySelector('input[name="query"]');
    const query = input.value.trim();

    if (!query) {
        productsContainer.innerHTML = '<p class="text-muted">Please enter a search term.</p>';
        return;
    }

    productsContainer.innerHTML = '<p class="text-muted">Loading...</p>';

    fetch(`/products/searchbyname?query=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(response => {
            const products = response.data; // <-- important fix
            productsContainer.innerHTML = '';

            if (!products || products.length === 0) {
                productsContainer.innerHTML = '<p class="text-muted">No products found matching your search.</p>';
                return;
            }

            products.forEach(product => {
                productsContainer.innerHTML += `
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">${product.description ? product.description.substring(0, 80) : ''}</p>
                                <p class="fw-bold">Price: $${product.price}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error('Error fetching products:', err);
            productsContainer.innerHTML = '<p class="text-danger">Error loading products. Please try again.</p>';
        });
});
</script>

</body>
</html>
