@extends('admin.home')
@section('content')
    <h2>Sửa loại ghế</h2>

    <form method="POST" action="{{ route('admin.seat-types.update', $seatType->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tên loại</label>
            <input type="text" name="name" class="form-control" value="{{ $seatType->name }}" required>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" value="{{ $seatType->price }}" required>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
