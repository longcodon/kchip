@extends('home')

@section('content')
<div class="card card-primary">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Thêm khách hàng</h3>
    <a href="{{ route('khachhang.create') }}" class="btn btn-sm btn-success">
      <i class="fas fa-plus"></i> Thêm mới
    </a>
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
 
   
            <th >Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Tùy chỉnh</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($khachhang as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->email ?? 'N/A' }}</td>
              <td>{{ $item->fb ?? 'N/A' }}</td>
              <td>{{ $item->title  }}</td>
              <td>{{ $item->author ?? 'N/A' }}</td>
              <td class="text-center">
                @if($item->img)
                  <img class="img-thumbnail" style="max-height: 100px;" 
                       src="{{ asset( $item->img) }}" 
                       alt="{{ $item->title }}"
                       data-toggle="modal" data-target="#imageModal{{ $item->id }}">
                @else
                  <span class="text-muted">Không có ảnh</span>
                @endif
              </td>
              <td class="text-right">{{ number_format($item->price, 0, ',', '.') }} ₫</td>
              
             <td>{{ $item->note ?? 'N/A' }}</td>
              
              <td class="text-center">
                <span class="badge badge-{{ $item->status ? 'success' : 'secondary' }}">
                  {{ $item->status ? 'Đã thanh toán ' : 'Chưa thanh toán' }}
                </span>
              </td>
              <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
              <td class="text-center">
                <div class="btn-group btn-group-sm">
                  <a href="{{ route('danhmuc.edit', $item->id) }}" 
                     class="btn btn-info" title="Sửa">
                    <i class="fas fa-edit"></i>
                  </a>
                  
                  <form action="{{ route('danhmuc.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" title="Xóa"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                  
                 
                </div>
              </td>
            </tr>
            
            <!-- Modal xem ảnh lớn -->
            <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-body text-center">
                    <img src="{{ asset('uploads/danhmuc/' . $item->image) }}" 
                         class="img-fluid" alt="{{ $item->title }}">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  </div>
                </div>
              </div>
            </div>
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