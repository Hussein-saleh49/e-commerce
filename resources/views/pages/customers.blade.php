@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
  <h2 class="mb-4">Customers List</h2>

  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">+ Add Customer</a>

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($customers as $customer)
            <tr>
              <td>{{ $customer->id }}</td>
              <td>{{ $customer->name }}</td>
              <td>{{ $customer->email }}</td>
              <td>{{ $customer->phone }}</td>
              <td>{{ $customer->address }}</td>
              <td>
                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No customers found</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</main>

@endsection
