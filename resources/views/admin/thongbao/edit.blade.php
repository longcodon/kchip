@extends('home')

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Chỉnh sửa thông báo {{ $country == 'trangchu' ? 'Trang chủ' : 'Ưu đãi' }}
    </h3>
  </div>
  <form method="POST" action="{{ route('thongbao.update', $thongbao->id) }}">
    @csrf
    @method('PUT')
    <div class="card-body">
      <div class="form-group">
        <label>Nội dung</label>
        <textarea name="{{ $country }}" rows="5" class="form-control">{{ old($country, $thongbao->$country) }}</textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật</button>
      <a href="{{ route('thongbao.index') }}" class="btn btn-secondary float-right">Hủy</a>
    </div>
  </form>
</div>
@endsection
