@extends('home')
@section('content')
<div class="container">
  <h3>Cập nhật khách hàng</h3>
  <form action="{{ route('khachhang.update', $khachhang->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label>Tên</label>
      <input type="text" name="name" class="form-control" value="{{ $khachhang->name }}" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ $khachhang->email }}" required>
    </div>
    <div class="form-group">
      <label>Facebook</label>
      <input type="text" name="fb" class="form-control" value="{{ $khachhang->fb }}" required>
    </div>
    <div class="form-group">
      <label>Ghi chú</label>
      <textarea name="note" class="form-control" required>{{ $khachhang->note }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
  </form>
</div>
@endsection
