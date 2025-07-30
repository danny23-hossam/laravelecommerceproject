
@extends("index")
@section("Dashboard.content")


<div class="page-wrapper py-5 m-5" style="background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0 rounded">
          <div class="card-header bg-primary text-white text-center fs-4 fw-semibold">
            Create Category
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route("Category.insert") }}">
              @csrf
              <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Category Name</label>
                <input
                  type="text"
                  class="form-control form-control-lg"
                  id="name"
                  name="name"
                  placeholder="Enter category name"
                  required
                >
              </div>
              <button type="submit" class="btn btn-primary w-100 fw-semibold">
                Create Category
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection