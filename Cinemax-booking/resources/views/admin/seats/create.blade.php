@extends('admin.home')

@section('content')
    <h4 class="mb-4">Thêm ghế mới</h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.seats.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Phòng chiếu</label>
            <select name="room_id" class="form-select" required>
                <option value="">-- Chọn phòng --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Hàng (A, B,...)</label>
            <input type="text" name="row" class="form-control" value="{{ old('row') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cột (số)</label>
            <input type="number" name="column" class="form-control" value="{{ old('column') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại ghế</label>
            <select name="seat_type_id" class="form-select" required>
                <option value="">-- Chọn loại ghế --</option>
                @foreach ($seatTypes as $type)
                    <option value="{{ $type->id }}" {{ old('seat_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_available" class="form-check-input" id="availableCheck" checked>
            <label class="form-check-label" for="availableCheck">Còn trống</label>
        </div>

        <button type="submit" class="btn btn-primary">Thêm ghế</button>
        <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Huỷ</a>
    </form>
@endsection
