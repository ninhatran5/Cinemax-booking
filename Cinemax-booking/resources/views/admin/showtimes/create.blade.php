@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold"> Thêm lịch chiếu mới</div>
            <div class="card-body">
                <form action="{{ route('admin.showtimes.store') }}" method="POST">
                    @csrf

                    {{-- Chọn phim --}}
                    <div class="mb-3">
                        <label class="form-label">Phim</label>
                        <select name="movie_id" class="form-select @error('movie_id') is-invalid @enderror" required>
                            <option value="">-- Chọn phim --</option>
                            @foreach ($movies as $movie)
                                <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                                    {{ $movie->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('movie_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Chọn phòng --}}
                    <div class="mb-3">
                        <label class="form-label">Phòng chiếu</label>
                        <select name="room_id" class="form-select @error('room_id') is-invalid @enderror" required>
                            <option value="">-- Chọn phòng --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ngày chiếu --}}
                    <div class="mb-3">
                        <label class="form-label">Ngày chiếu</label>
                        <input type="date" name="show_date" class="form-control @error('show_date') is-invalid @enderror"
                            value="{{ old('show_date') }}" required>
                        @error('show_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Giờ bắt đầu --}}
                    <div class="mb-3">
                        <label class="form-label">Giờ bắt đầu</label>
                        <input type="time" name="start_time"
                            class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}"
                            required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nút lưu --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.showtimes.index') }}" class="btn btn-secondary"> Quay lại</a>
                        <button type="submit" class="btn btn-success">Lưu lịch chiếu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
