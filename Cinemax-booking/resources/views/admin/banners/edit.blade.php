@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Cập nhật banner: {{ $banner->title }}</h3>

        {{-- Hiển thị lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form cập nhật --}}
        <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $banner->title) }}">
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Ảnh hiện tại</label>
                @if ($banner->image)
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image" width="200"
                        class="img-thumbnail mb-2">
                @else
                    <p class="text-muted fst-italic">Chưa có ảnh</p>
                @endif

                <label for="image" class="form-label">Chọn ảnh mới (nếu muốn thay)</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Vị trí hiển thị (top / middle / bottom)</label>
                <input type="text" name="position" id="position" class="form-control"
                    value="{{ old('position', $banner->position) }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" id="status" class="form-select">
                    <option value="active" @selected(old('status', $banner->status) == 'active')>Hiển thị</option>
                    <option value="inactive" @selected(old('status', $banner->status) == 'inactive')>Ẩn</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
