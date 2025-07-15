@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0"> Danh sách lịch chiếu</h4>
            <a href="{{ route('admin.showtimes.create') }}" class="btn btn-primary">+ Thêm lịch chiếu</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        {{-- Form lọc --}}
        <form method="GET" class="card p-3 shadow-sm mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <select name="movie_id" class="form-select">
                        <option value="">-- Chọn phim --</option>
                        @foreach ($movies as $movie)
                            <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>
                                {{ $movie->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="room_id" class="form-select">
                        <option value="">-- Chọn phòng --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-primary w-100">Lọc</button>
                    <a href="{{ route('admin.showtimes.index') }}" class="btn btn-secondary w-100">Đặt lại</a>
                </div>
            </div>
        </form>

        {{-- Bảng danh sách --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th> Phim</th>
                        <th> Phòng</th>
                        <th> Ngày</th>
                        <th> Bắt đầu</th>
                        <th> Kết thúc</th>
                        <th> Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($showtimes as $showtime)
                        <tr>
                            <td>{{ $showtime->movie->title }}</td>
                            <td>{{ $showtime->room->name }}</td>
                            <td>{{ $showtime->show_date }}</td>
                            <td>{{ $showtime->start_time }}</td>
                            <td>{{ $showtime->end_time }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.showtimes.edit', $showtime->id) }}"
                                    class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.showtimes.destroy', $showtime->id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xoá lịch chiếu này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Không có lịch chiếu nào phù hợp.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="d-flex justify-content-end mt-3">
            {{ $showtimes->links() }}
        </div>
    </div>
@endsection
