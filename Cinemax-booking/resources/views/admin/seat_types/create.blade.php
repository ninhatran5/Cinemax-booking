@extends('admin.home')
@section('content')
    <h2>Thêm loại ghế</h2>

    <form method="POST" action="{{ route('admin.seat-types.store') }}">
        @csrf
        <div class="mb-3">
            <label>Tên loại</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <button class="btn btn-primary">Lưu</button>
    </form>
@endsection
