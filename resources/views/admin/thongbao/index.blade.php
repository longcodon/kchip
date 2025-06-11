@extends('home')

@section('content')

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
@endif

{{-- Thông báo trang chủ --}}
<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">🔵 Thông báo Trang chủ</h3>
  </div>
  <div class="card-body">
    <p>{{ $thongbao->trangchu ?? 'Chưa có nội dung' }}</p>
    <a href="{{ route('thongbao.edit.country', 'trangchu') }}" class="btn btn-info">
      <i class="fas fa-edit"></i> Chỉnh sửa
    </a>
  </div>
</div>

{{-- Thông báo ưu đãi --}}
<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">🟢 Thông báo Ưu đãi</h3>
  </div>
  <div class="card-body">
    <p>{{ $thongbao->uudai ?? 'Chưa có nội dung' }}</p>
    <a href="{{ route('thongbao.edit.country', 'uudai') }}" class="btn btn-info">
      <i class="fas fa-edit"></i> Chỉnh sửa
    </a>
  </div>
</div>

@endsection
