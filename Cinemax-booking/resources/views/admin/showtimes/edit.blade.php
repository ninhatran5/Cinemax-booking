@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark fw-semibold"> Sửa lịch chiếu</div>
            <div class="card-body">
                <form action="{{ route('admin.showtimes.update', $showtime->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Phim --}}
                    <div class="mb-3">
                        <label class="form-label"> Phim</label>
                        <select name="movie_id" class="form-select @error('movie_id') is-invalid @enderror" required>
                            @foreach ($movies as $movie)
                                <option value="{{ $movie->id }}"
                                    {{ $showtime->movie_id == $movie->id ? 'selected' : '' }}>
                                    {{ $movie->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('movie_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Phòng chiếu --}}
                    <div class="mb-3">
                        <label class="form-label"> Phòng chiếu</label>
                        <select name="room_id" class="form-select @error('room_id') is-invalid @enderror" required>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ $showtime->room_id == $room->id ? 'selected' : '' }}>
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
                        <label class="form-label"> Ngày chiếu</label>
                        <input type="date" name="show_date" class="form-control @error('show_date') is-invalid @enderror"
                            value="{{ $showtime->show_date }}" required>
                        @error('show_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Giờ bắt đầu --}}
                    <div class="mb-3">
                        <label class="form-label"> Giờ bắt đầu</label>
                        <input type="time" name="start_time"
                            class="form-control @error('start_time') is-invalid @enderror"
                            value="{{ $showtime->start_time }}" required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nút --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.showtimes.index') }}" class="btn btn-secondary"> Trở về</a>
                        <button type="submit" class="btn btn-success"> Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
