@extends("index");
@section("Dashboard.content")



<div class="page-wrapper py-5  mx-5 " style="background-color: #f8f9fa;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-semibold mx-5 p-4 ">Products</h2>
      <a href="{{ route("product.create") }}" class="btn btn-success fw-semibold">
        + Add New Product
      </a>
    </div>

    <div class="card shadow-sm border-0 rounded mx-5 px-5">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product )
              
           
              
                <tr>
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->quantity }}</td>
                  <td>{{ $product->category_id }}</td>
                  <td>{{ $product->description }}</td>
                   <td>
    		          	<img src="{{ asset('storage/' . $product->image) }}" alt="Product" width="80" height="80">
		                     </td>
                  
                  <td>
                    <a href="  {{ route("product.edit",$product->id) }}" class="btn btn-sm btn-warning me-1">
                      Edit
                    </a>
                    <form action="{{ route("product.delete",$product->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                        Delete
                      </button>
                    </form>
                     
                  </td>
                </tr>
                  @endforeach
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection