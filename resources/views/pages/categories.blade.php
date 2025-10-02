@extends("layouts.app")
@section("content")
    {{-- @dd($categories) --}}
    <!-- Main Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>إدارة التصنيفات</h2>
        <a href="{{ route ("categories.create")}}" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i> إضافة تصنيف
        </a>
      </div>

      <!-- جدول التصنيفات -->
      <div class="card shadow">
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>category name</th>
                <th>description</th>
                <th>Status</th>
                <th>Actions </th>
              </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
              <tr>
                <td>{{ $category->id}}</td>
                <td>{{ $category->name}}</td>
                <td>{{ $category->description}}</td>
                <td>{{ $category->status}}</td>
                <td>
                  <a href="{{route("categories.edit",$category->id)}}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                  <form action="{{route("categories.destroy",$category->id)}}" method="post" style="display:inline-block">
                    @csrf
                    @method("delete")
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
              
             
              <!-- لو مفيش بيانات -->
              <!-- <tr><td colspan="4" class="text-center">لا توجد تصنيفات بعد</td></tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>


@endsection