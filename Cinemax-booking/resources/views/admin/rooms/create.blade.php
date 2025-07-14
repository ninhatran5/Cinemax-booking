@extends('admin.home')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white fw-semibold">Thêm phòng chiếu</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.rooms.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên phòng</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">Sức chứa</label>
                        <input type="number" name="capacity" class="form-control" required min="1">
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
