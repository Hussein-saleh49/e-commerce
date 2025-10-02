@extends("layouts.app")
@section("content")
      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <h2 class="mb-4">Add New Product</h2>

        <!-- Add Product Form -->
        <div class="card shadow-sm">
          <div class="card-body">
           <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <!-- Product Name -->
  <div class="mb-3">
    <label for="productName" class="form-label">Product Name</label>
    <input type="text" id="productName" name="product_name" class="form-control" placeholder="Enter product name">
  </div>

  <!-- Price -->
  <div class="mb-3">
    <label for="productPrice" class="form-label">Price ($)</label>
    <input type="number" id="productPrice" name="price" class="form-control" placeholder="Enter price">
  </div>

  <!-- Stock -->
  <div class="mb-3">
    <label for="productStock" class="form-label">Stock</label>
    <input type="number" name="stock" id="productStock" class="form-control" placeholder="Enter stock quantity">
  </div>

  <!-- Product Image -->
  <div class="mb-3">
    <label for="productImage" class="form-label">Product Image</label>
    <input type="file" id="productImage" name="image" class="form-control">
  </div>

  <!-- Status -->
  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
      <option value="">Choose...</option>
      <option value="available">Available</option>
      <option value="out_of_stock">Out of Stock</option>
    </select>
  </div>
  <!-- Category -->
<div class="mb-3">
    <label for="productCategory" class="form-label">Category</label>
    <select id="productCategory" name="category_id" class="form-select">
        <option value="">-- Choose Category --</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" {{old($category->id) == $category->id ? "selected":" "}} > {{$category->name}}</option>
        @endforeach 
    </select>
</div>
@error("category_id")
<div class="text-danger mt-1">{{ $message }}</div>
@enderror


  <!-- Buttons -->
  <div class="d-flex justify-content-between">
    <a href="{{ route('products.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Back
    </a>
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-save"></i> Save Product
    </button>
  </div>
</form>

          </div>
        </div>
      </main>
    </div>
  </div>

  @endsection
</body>
</html>

