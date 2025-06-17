@extends('home')

@section('content')
<div class="container">
  <h3>📦 Danh sách Mã giảm giá</h3>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  @endif

  <a href="{{ route('ma.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Thêm mã
  </a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Mã giảm giá</th>
        <th>Giảm (%)</th>

        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      @foreach($ma as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ $item->ma }}</td>
          <td>{{ $item->maprice }}%</td>
          <td>
            <a href="{{ route('ma.edit', $item->id) }}" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i> Sửa
            </a>
            <form action="{{ route('ma.destroy', $item->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">
                <i class="fas fa-trash"></i> Xóa
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
