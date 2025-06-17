@extends('home')

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Chỉnh sửa mã giảm giá</h3>
  </div>
  <form method="POST" action="{{ route('ma.update', $ma->id) }}">
    @csrf
    @method('PUT')
    <div class="card-body">
      <div class="form-group">
        <label>Mã giảm giá</label>
        <input type="text" name="ma" class="form-control @error('ma') is-invalid @enderror"
               value="{{ old('ma', $ma->ma) }}">
        @error('ma')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror  
      </div>


      <div class="form-group">
  <label>Phần trăm giảm (%)</label>
  <input type="number" name="maprice" class="form-control @error('maprice') is-invalid @enderror"
         value="{{ old('maprice', $ma->maprice) }}">
  @error('maprice')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

    
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật</button>
      <a href="{{ route('ma.index') }}" class="btn btn-secondary float-right">Hủy</a>
    </div>
  </form>
</div>
@endsection
