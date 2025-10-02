<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>E-Commerce Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
</head>
<body class="bg-light">
  @if(session('success'))
  <div class="alert alert-success">
    {{ session("success") }}
  </div>
  @endif
  @if(session("error"))
  <div class="alert alert-danger">
    {{ session("error") }}
  </div>
  @endif

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar collapse">
        <div class="position-sticky p-3">
          <h4 class="text-white">E-Commerce</h4>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('products.index') }}">
                <i class="bi bi-box-seam"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('categories.index') }}">
                <i class="bi bi-tags"></i> Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('orders.index') }}">
                <i class="bi bi-cart-check"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('customers.index') }}">
                <i class="bi bi-people"></i> Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">
                <i class="bi bi-graph-up"></i> Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">
                <i class="bi bi-gear"></i> Settings
              </a>
            </li>
            <!-- Logout button -->
            <li class="nav-item mt-3">
              <form action="{{ route('logout') }}" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link nav-link text-white p-0" style="border:none; background:none;">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        @yield('content')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
