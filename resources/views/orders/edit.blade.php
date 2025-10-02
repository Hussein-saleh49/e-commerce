@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <h2 class="mb-4">Edit Order #{{ $order->id }}</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Customer -->
                <div class="mb-3">
                    <label class="form-label">Customer</label>
                    <select name="customer_id" class="form-select" required>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" 
                                {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Total -->
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="number" step="0.01" name="total" class="form-control" 
                           value="{{ old('total', $order->total) }}" required>
                    @error('total') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ old('status', $order->status)=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ old('status', $order->status)=='processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ old('status', $order->status)=='completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $order->status)=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Update Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
