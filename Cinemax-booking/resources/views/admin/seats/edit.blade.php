@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <h4>Cập nhật ghế: {{ $seat->name }}</h4>

        <form method="POST" action="{{ route('admin.seats.update', $seat->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="room_id">Phòng chiếu</label>
                <select name="room_id" class="form-control" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $seat->room_id == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name">Tên ghế</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $seat->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="seat_type">Loại ghế</label>
                <select name="seat_type" class="form-control" required>
                    <option value="normal" {{ $seat->seat_type == 'normal' ? 'selected' : '' }}>Ghế thường</option>
                    <option value="vip" {{ $seat->seat_type == 'vip' ? 'selected' : '' }}>Ghế VIP</option>
                    <option value="double" {{ $seat->seat_type == 'double' ? 'selected' : '' }}>Ghế đôi</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
