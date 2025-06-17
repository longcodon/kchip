@extends('home')

@section('content')
<div class="card card-primary">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Danh sách khách hàng</h3>
    {{-- <a href="{{ route('khachhang.create') }}" class="btn btn-sm btn-success">
      <i class="fas fa-plus"></i> Thêm mới
    </a> --}}
  </div>
  
  @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="danhmucTable">
        <thead class="thead-light">
          <tr>
            <th width="3%">STT</th> 
            <th>Name</th>
            <th>Email</th>
            <th>Facebook</th>
            
            <th>Đơn hàng </th>
            <th>Tác giả </th>
            <th>img</th>
            <th>Giá tiền</th>
            <th>Ghi chú</th>
            <th>Thanh toán</th>
 
   
            <th >Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Tùy chỉnh</th>

          </tr>
        </thead>
        <tbody>
@foreach ($orders as $groupTime => $group)
  <tr>
    <td colspan="12" style="background: #f0f0f0; font-weight: bold;">
      🧾 Đơn hàng lúc {{ \Carbon\Carbon::parse($groupTime)->format('d/m/Y H:i:s') }} — {{ $group->count() }} sản phẩm
    </td>
  </tr>

  @foreach ($group as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->email }}</td>
      <td>{{ $item->fb }}</td>
      <td>{{ $item->title }}</td>
      <td>{{ $item->author }}</td>
      <td>
        @if($item->img)
          <img class="img-thumbnail" style="max-height: 100px;" src="{{ asset($item->img) }}">
        @else
          Không có ảnh
        @endif
      </td>
      <td class="text-right">{{ number_format($item->price, 0, ',', '.') }} ₫</td>
      <td>{{ $item->note }}</td>


        <td>
        <span class="badge badge-success">Đã thanh toán</span>
      </td>
      
<td>
  <form method="POST" action="{{ route('khachhang.updateTrangthai', $item->id) }}">
    @csrf
    @method('PUT')
    <select name="trangthai" class="form-control form-control-sm" onchange="this.form.submit()">
      <option value="chờ xác nhận" {{ $item->trangthai == 'chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
      <option value="đã xác nhận" {{ $item->trangthai == 'đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
      <option value="đã gửi hàng" {{ $item->trangthai == 'đã gửi hàng' ? 'selected' : '' }}>Đã gửi hàng</option>
    
    </select>
  </form>
</td>


      <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
      <td>
        <div class="btn-group btn-group-sm">
          <a href="{{ route('khachhang.edit', $item->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
          <form method="POST" action="{{ route('khachhang.destroy', $item->id) }}">
            @csrf @method('DELETE')
            <button onclick="return confirm('Bạn chắc chắn?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </td>
    </tr>
  @endforeach
@endforeach


        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  .img-thumbnail {
    cursor: pointer;
    transition: transform 0.2s;
  }
  .img-thumbnail:hover {
    transform: scale(1.05);
  }
  .btn-group {
    white-space: nowrap;
  }
  .btn-group .btn {
    margin-right: 5px;
  }
  .btn-group .btn:last-child {
    margin-right: 0;
  }
  .table td, .table th {
    vertical-align: middle;
  }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
  $('#danhmucTable').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json"
    },
    "responsive": true,
    "autoWidth": false,
    "columnDefs": [
      { "orderable": false, "targets": [6, 10] } // Các cột hình ảnh và thao tác không sắp xếp
    ]
  });
});
</script>
@endpush