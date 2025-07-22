@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark fw-semibold">
                Cập nhật ghế: {{ $seat->name }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.seats.update', $seat->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Phòng chiếu --}}
                    <div class="mb-3">
                        <label for="room_id" class="form-label"> Phòng chiếu</label>
                        <select name="room_id" id="room_id" class="form-select @error('room_id') is-invalid @enderror"
                            required>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}"
                                    {{ old('room_id', $seat->room_id) == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tên ghế --}}
                    <div class="mb-3">
                        <label for="name" class="form-label"> Tên ghế</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $seat->name) }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Loại ghế --}}
                    <div class="mb-3">
                        <label class="form-label">Loại ghế</label>
                        <select name="seat_type_id" class="form-select" required>
                            <option value="">-- Chọn loại ghế --</option>
                            @foreach ($seatTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ $seat->seat_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nút --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary"> Quay lại</a>
                        <button type="submit" class="btn btn-primary"> Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
