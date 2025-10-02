@extends("layouts.app")
@section("content")

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
  <h2 class="mb-4">Products</h2>

  <!-- Add Product Button -->
  <div class="mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Add New Product
    </a>
  </div>

  <form  action="{{route("products.search")}}" method="get" class="mb-3">
    
    <div class="input-group">
        <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="ابحث عن منتج..." 
            value="">
        <button class="btn btn-primary" type="submit">
            بحث
        </button>
    </div>
</form>


  <!-- Products Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Product List</h5>
      <table class="table table-striped table-hover mt-3">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td>{{ $product->stock }}</td>
            
            <td>
              @if($product->status == "available")
                <span class="badge bg-success">{{ $product->status }}</span>
              @else
                <span class="badge bg-danger">{{ $product->status }}</span>
              @endif
            </td>

            <td>
              @if($product->image)
            <img src="{{ asset('uploads/products/' . $product->image) }}" width="80" class="img-thumbnail">
              @else
            <span class="text-muted">No Image</span>
            @endif

            </td>

            <td>
              <a href="{{route("products.edit",$product->id)}}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
              <form action="{{route("products.destroy",$product->id)}}" method="post" style="display:inline-block">
                @csrf 
                @method("delete")
              <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</main>
@endsection
