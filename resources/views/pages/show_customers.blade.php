@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
  <h2 class="mb-4">Customer Details</h2>

  <div class="card shadow-sm">
    <div class="card-body">
      <p><strong>ID:</strong> {{ $customer->id }}</p>
      <p><strong>Name:</strong> {{ $customer->name }}</p>
      <p><strong>Email:</strong> {{ $customer->email }}</p>
      <p><strong>Phone:</strong> {{ $customer->phone }}</p>
      <p><strong>Address:</strong> {{ $customer->address }}</p>
    </div>
  </div>

  <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Back to list</a>
</main>

@endsection
