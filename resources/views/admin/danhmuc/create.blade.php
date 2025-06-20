@extends('home')

@section('content')
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Tạo danh mục mới</h3>
  </div>
  
  <form method="POST" action="{{ route('danhmuc.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <!-- Thông tin cơ bản -->
      <div class="form-group">
        <label for="title">Tiêu đề <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Nhập tiêu đề danh mục" value="{{ old('title') }}">
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      <!-- Thông tin tác giả -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="author">Tác giả</label>
            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author" placeholder="Nhập tên tác giả" value="{{ old('author') }}">
            @error('author')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="transcribed">Người soạn</label>
            <input type="text" name="transcribed" class="form-control @error('transcribed') is-invalid @enderror" id="transcribed" placeholder="Nhập người soạn" value="{{ old('transcribed') }}">
            @error('transcribed')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
      
      <!-- Thông tin quốc gia và giá -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="country">Quốc gia <span class="text-danger">*</span></label>
            <select name="country" class="form-control @error('country') is-invalid @enderror" id="country">
                <option value="">-- Chọn quốc gia --</option>
                <option value="VN" {{ old('country') == 'VN' ? 'selected' : '' }}>Việt Nam</option>
                <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>Mỹ</option>
                <option value="KR" {{ old('country') == 'KR' ? 'selected' : '' }}>Hàn Quốc</option>
                <option value="JP" {{ old('country') == 'JP' ? 'selected' : '' }}>Nhật Bản</option>
                <option value="CN" {{ old('country') == 'CN' ? 'selected' : '' }}>Trung Quốc</option>
                <option value="OTHER" {{ old('country') == 'OTHER' ? 'selected' : '' }}>Khác</option>
            </select>
            @error('country')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="price">Giá tiền (VND)</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Nhập giá" value="{{ old('price') }}">
            @error('price')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
      
      <!-- Upload file -->
      <div class="form-group">
        <label for="image">File ảnh</label>
        <div class="custom-file">
          <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image">
          <label class="custom-file-label" for="image">Chọn file ảnh...</label>
          @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <small class="form-text text-muted">Chấp nhận: JPG, PNG, GIF (tối đa 2MB)</small>
      </div>
      

    
          <div class="form-group">
            <label for="link">link youtube </label>
            <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Nhập link" value="{{ old('transcribed') }}">
            @error('link')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
       
      
      <!-- Trạng thái -->
      <div class="form-group">
        <div class="custom-control custom-switch">
          <input type="checkbox" name="status" class="custom-control-input" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
          <label class="custom-control-label" for="status">Kích hoạt</label>
        </div>
      </div>
    </div>
    
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Lưu danh mục
      </button>
      <a href="{{ route('danhmuc.index') }}" class="btn btn-default float-right">
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