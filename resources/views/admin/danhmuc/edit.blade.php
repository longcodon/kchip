@extends('home')

@section('content')
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Chỉnh sửa danh mục</h3>
  </div>
  
  <form method="POST" action="{{ route('danhmuc.update', $danhmuc->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card-body">
      <!-- Thông tin cơ bản -->
      <div class="form-group">
        <label for="title">Tiêu đề <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" 
               placeholder="Nhập tiêu đề danh mục" value="{{ old('title', $danhmuc->title) }}">
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" 
                  rows="3" placeholder="Nhập mô tả">{{ old('description', $danhmuc->description) }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      <!-- Thông tin tác giả -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="author">Tác giả</label>
            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author" 
                   placeholder="Nhập tên tác giả" value="{{ old('author', $danhmuc->author) }}">
            @error('author')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="transcribed">Người soạn</label>
            <input type="text" name="transcribed" class="form-control @error('transcribed') is-invalid @enderror" 
                   id="transcribed" placeholder="Nhập người soạn" value="{{ old('transcribed', $danhmuc->transcribed) }}">
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
                <option value="VN" {{ old('country', $danhmuc->country) == 'VN' ? 'selected' : '' }}>Việt Nam</option>
                <option value="US" {{ old('country', $danhmuc->country) == 'US' ? 'selected' : '' }}>Mỹ</option>
                <option value="KR" {{ old('country', $danhmuc->country) == 'KR' ? 'selected' : '' }}>Hàn Quốc</option>
                <option value="JP" {{ old('country', $danhmuc->country) == 'JP' ? 'selected' : '' }}>Nhật Bản</option>
                <option value="CN" {{ old('country', $danhmuc->country) == 'CN' ? 'selected' : '' }}>Trung Quốc</option>
                <option value="OTHER" {{ old('country', $danhmuc->country) == 'OTHER' ? 'selected' : '' }}>Khác</option>
            </select>
            @error('country')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="price">Giá tiền (VND)</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" 
                   placeholder="Nhập giá" value="{{ old('price', $danhmuc->price) }}">
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
          <label class="custom-file-label" for="image" id="image-label">
            @if($danhmuc->image)
              {{ basename($danhmuc->image) }}
            @else
              Chọn file ảnh...
            @endif
          </label>
          @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <small class="form-text text-muted">Chấp nhận: JPG, PNG, GIF (tối đa 2MB)</small>
        
        <!-- Hiển thị ảnh hiện tại -->
        @if($danhmuc->image)
          <div class="mt-2">
            <img src="{{ asset('uploads/danhmuc/' . $danhmuc->image) }}" 
                 class="img-thumbnail" style="max-height: 150px;">
            <input type="hidden" name="current_image" value="{{ $danhmuc->image }}">
          </div>
        @endif
        
        <!-- Preview ảnh mới (nếu có) -->
        <div class="mt-2">
          <img id="image-preview" class="img-thumbnail d-none" style="max-height: 150px;">
        </div>
      </div>
      
     
            <div class="form-group">
    <label for="link">Link YouTube</label>
    <input type="url" name="link" class="form-control" 
           id="link" placeholder="Nhập link YouTube"
           value="{{ old('link', $danhmuc->link ?? '') }}">
    <small class="form-text text-muted">Ví dụ: https://www.youtube.com</small>
    </div>
        


      <!-- Trạng thái -->
      <div class="form-group">
        <div class="custom-control custom-switch">
          <input type="checkbox" name="status" class="custom-control-input" id="status" value="1" 
                 {{ old('status', $danhmuc->status) ? 'checked' : '' }}>
          <label class="custom-control-label" for="status">Kích hoạt</label>
        </div>
      </div>
    </div>
    
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Cập nhật
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
// Hiển thị tên file và preview ảnh khi chọn
document.getElementById('image').addEventListener('change', function(e) {
  const file = this.files[0];
  if (file) {
    // Hiển thị tên file
    document.getElementById('image-label').innerText = file.name;
    
    // Tạo URL tạm để preview ảnh
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById('image-preview');
      preview.src = e.target.result;
      preview.classList.remove('d-none');
    }
    reader.readAsDataURL(file);
  }
});
</script>
@endpush