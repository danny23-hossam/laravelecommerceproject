@extends('index')
@section('Dashboard.content')

<div class="page-wrapper py-5 m-5" style="background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-7">
        <div class="card shadow-sm border-0 rounded">
          <div class="card-header bg-warning text-dark text-center fs-4 fw-semibold p-2">
            Edit Product
          </div>
          <div class="card-body">
            <form action="{{ route("category.update",$category->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Category Name</label>
                <input type="text" name="name" class="form-control form-control-lg"
                  value="{{ $category->id }}" required>
              </div>

             

              

             


             

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-warning fw-semibold">Update Product</button>
                <a href="#" class="btn btn-secondary fw-semibold">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
