@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
  <h2 class="mb-4">Edit Customer</h2>

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="name" class="form-label">Customer Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $customer->name) }}">
          @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email) }}">
          @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
          @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea name="address" id="address" rows="3" class="form-control">{{ old('address', $customer->address) }}</textarea>
          @error('address') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</main>

@endsection
