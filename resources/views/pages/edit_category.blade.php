@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <h2 class="mb-4">Edit Category</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{route("categories.update",$category->id)}}" method="post">
                @csrf
                @method('put')

                <!-- Category Name -->
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" id="categoryName" name="name" class="form-control" value="{{old("name",$category->name)}}">
                     @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="categoryDescription" class="form-label">Description</label>
                    <textarea id="categoryDescription" name="description" class="form-control" rows="3">{{old("description",$category->description)}}</textarea>
                     @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Category</button>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
