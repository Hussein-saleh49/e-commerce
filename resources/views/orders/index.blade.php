@extends('layouts.app')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <h2 class="mb-4">Orders</h2>

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>${{ $order->total }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('orders.show',$order->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('orders.destroy',$order->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</main>
@endsection
