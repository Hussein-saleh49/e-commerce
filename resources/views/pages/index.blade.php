@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
  <h2 class="mb-4">Dashboard</h2>
  
  <!-- Stats Cards -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card text-bg-primary shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Products</h5>
          <p class="card-text fs-3">{{ $productscount }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-bg-success shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Customers</h5>
          <p class="card-text fs-3">{{ $customerscount }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-bg-warning shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Orders</h5>
          <p class="card-text fs-3">{{ $ordercount }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-bg-danger shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Revenue</h5>
          <p class="card-text fs-3">${{ number_format($revenue,2) }}</p>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Charts Row -->
  <div class="row g-4 mb-4">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Monthly Sales</h5>
          <canvas id="salesChart" height="150"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Top Products</h5>
          <canvas id="productsChart" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Latest Orders Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Latest Orders</h5>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Created</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->customer->name ?? 'Guest' }}</td>
              <td>${{ $order->total ?? 0 }}</td>
              <td>
                <span class="badge 
                  @if($order->status == 'completed') bg-success
                  @elseif($order->status == 'pending') bg-warning
                  @else bg-danger @endif">
                  {{ ucfirst($order->status) }}
                </span>
              </td>
              <td>{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">No orders yet</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $orders->links() }}
    </div>
  </div>
</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Monthly Sales Chart (Dynamic)
  const salesCtx = document.getElementById('salesChart');
  new Chart(salesCtx, {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [{
        label: 'Sales ($)',
        data: [
          @for ($i = 1; $i <= 12; $i++)
              {{ $monthlySales[$i] ?? 0 }},
          @endfor
        ],
        borderColor: 'rgba(25,135,84,1)',
        backgroundColor: 'rgba(25,135,84,0.3)',
        tension: 0.4,
        fill: true
      }]
    }
  });

  // Top Products Chart (Dynamic)
  const productsCtx = document.getElementById('productsChart');
  new Chart(productsCtx, {
    type: 'doughnut',
    data: {
      labels: {!! json_encode($topProducts->pluck('name')) !!},
      datasets: [{
        data: {!! json_encode($topProducts->pluck('total_sold')) !!},
        backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545','#6610f2']
      }]
    }
  });
</script>
@endsection
