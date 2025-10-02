@extends('layouts.app')

@section('title')

@section('content')
<
        <!-- ✅ Main Content -->
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Orders</h2>
                <a href="#" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create Order</a>
            </div>

            <!-- ✅ Search Form -->
            <form action="#" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="ابحث عن طلب...">
                    <button class="btn btn-primary" type="submit">بحث</button>
                </div>
            </form>

            <!-- ✅ Orders Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- مثال افتراضي -->
                            <tr>
                                <td>1</td>
                                <td>Hussein</td>
                                <td>$250.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>2025-10-01</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="#" method="post" class="d-inline">
                                       
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <!-- لو مفيش بيانات -->
                            <tr>
                                <td colspan="6" class="text-center">لا يوجد طلبات حاليا</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
