@extends('admin.home')

@section('content')
<div class="container mt-4">
    <h4>Cập nhật phòng chiếu</h4>

    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="name">Tên phòng</label>
            <input type="text" name="name" class="form-control" value="{{ $room->name }}" required>
        </div>

        <div class="mb-3">
            <label for="capacity">Sức chứa</label>
            <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
