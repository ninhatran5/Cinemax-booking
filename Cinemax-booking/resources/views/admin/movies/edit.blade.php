@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <h2>Chỉnh sửa phim: {{ $movie->title }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề phim</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $movie->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Thời lượng (phút)</label>
                <input type="number" name="duration" class="form-control" value="{{ old('duration', $movie->duration) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="active" {{ $movie->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ $movie->status == 'inactive' ? 'selected' : '' }}>Tạm ẩn</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh phim (nếu muốn thay đổi)</label>
                <input type="file" name="image" class="form-control">
                @if ($movie->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $movie->image) }}" width="120" alt="Ảnh hiện tại">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
