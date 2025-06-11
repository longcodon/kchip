
@extends('home')

@section('content')
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Tạo thông báo</h3>
  </div>

  <form method="POST" action="{{ route('thongbao.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <!-- Thông tin cơ bản -->
 
      
      <div class="form-group">
        <label for="description">Nội dung </label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      

      
      <!-- Thông tin quốc gia và giá -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="country">thông báo cho <span class="text-danger">*</span></label>
            <select name="country" class="form-control @error('country') is-invalid @enderror" id="country">
              <option value="">-- Chọn  --</option>
              <option value="trangchu" {{ old('country') == 'trangchu' ? 'selected' : '' }}>trang chủ</option>
              <option value="uudai" {{ old('country') == 'uudai' ? 'selected' : '' }}>ưu đãi</option>
              <!-- Thêm các quốc gia khác -->
            </select>
            @error('country')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

      </div>
      
  
      


       
      
      {{-- <!-- Trạng thái -->
      <div class="form-group">
        <div class="custom-control custom-switch">
          <input type="checkbox" name="status" class="custom-control-input" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
          <label class="custom-control-label" for="status">Kích hoạt</label>
        </div>
      </div>
    </div> --}}
    
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Lưu 
      </button>
      <a href="{{ route('thongbao.index') }}" class="btn btn-default float-right">
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