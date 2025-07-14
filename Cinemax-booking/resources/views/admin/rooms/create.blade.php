@extends('admin.home')

@section('content')
<div class="container mt-4">
    <h4>Thêm phòng chiếu</h4>

    <form method="POST" action="{{ route('admin.rooms.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name">Tên phòng</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="capacity">Sức chứa</label>
            <input type="number" name="capacity" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
