@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <h2>Thêm phim mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề phim</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Thời lượng (phút)</label>
                <input type="number" name="duration" class="form-control" required value="{{ old('duration') }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tạm ẩn</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh phim</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Lưu phim</button>
            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
