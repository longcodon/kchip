
@extends('home')

@section('content')
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Tạo mã giảm giá</h3>
  </div>

  <form method="POST" action="{{ route('ma.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <!-- Thông tin cơ bản -->
 
      
      <div class="form-group">
        <label for="description">Nội dung </label>
        <textarea name="ma" class="form-control @error('ma') is-invalid @enderror" id="description" rows="3" placeholder="Nhập mã giảm giá mới">{{ old('ma') }}</textarea>
        @error('ma')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      

      <div class="form-group">
  <label for="maprice">Phần trăm giảm (%)</label>
  <input type="number" name="maprice" class="form-control @error('maprice') is-invalid @enderror" placeholder="Nhập % giảm" value="{{ old('maprice') }}">
  @error('maprice')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

     
  
      


       
      

    
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Lưu 
      </button>
      <a href="{{ route('ma.index') }}" class="btn btn-default float-right">
        <i class="fas fa-times"></i> Hủy bỏ
      </a>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
// Hiển thị tên file khi chọn
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
  var fileName = document.getElementById("image").files[0].name;
  var nextSibling = e.target.nextElementSibling;
  nextSibling.innerText = fileName;
});
</script>
@endpush