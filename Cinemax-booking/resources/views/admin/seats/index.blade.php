@extends('admin.home')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 fw-bold text-primary">Danh sách ghế</h4>
            <a href="{{ route('admin.seats.create') }}" class="btn btn-success shadow-sm">Tạo nhiều ghế</a>
        </div>

        {{-- Thông báo --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        {{-- Bộ lọc --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.seats.index') }}" class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label for="seat_type" class="form-label fw-semibold">Lọc theo loại ghế:</label>
                        <select name="seat_type" id="seat_type" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <option value="normal" {{ request('seat_type') == 'normal' ? 'selected' : '' }}>Ghế Thường
                            </option>
                            <option value="vip" {{ request('seat_type') == 'vip' ? 'selected' : '' }}>Ghế VIP</option>
                            <option value="double" {{ request('seat_type') == 'double' ? 'selected' : '' }}>Ghế Đôi</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="room_id" class="form-label fw-semibold">Lọc theo phòng chiếu:</label>
                        <select name="room_id" id="room_id" class="form-select">
                            <option value="">-- Tất cả --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary me-2">Lọc</button>
                        <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Xóa lọc</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.seats.deleteRow') }}" class="row g-3 align-items-center">
                    @csrf

                    <div class="col-md-4">
                        <label for="room_id_delete" class="form-label fw-semibold">Chọn phòng:</label>
                        <select name="room_id" id="room_id_delete" class="form-select" required>
                            <option value="">-- Chọn phòng --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="row" class="form-label fw-semibold">Tên hàng (VD: A, B,...):</label>
                        <input type="text" name="row" class="form-control" placeholder="Nhập tên hàng..." required>
                    </div>

                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-danger">Xóa hàng ghế</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Bảng danh sách --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên hàng</th>
                        <th>Tên ghế</th>
                        <th>Loại ghế</th>
                        <th>Phòng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($seats as $seat)
                        <tr>
                            <td>{{ $seat->id }}</td>
                            <td>{{ $seat->row }}</td>
                            <td>{{ $seat->name }}</td>
                            <td>
                                @switch($seat->seat_type)
                                    @case('normal')
                                        <span class="badge bg-primary">Ghế Thường</span>
                                    @break

                                    @case('vip')
                                        <span class="badge bg-warning text-dark">Ghế VIP</span>
                                    @break

                                    @case('double')
                                        <span class="badge bg-danger">Ghế Đôi</span>
                                    @break

                                    @default
                                        <span class="text-muted">Không rõ</span>
                                @endswitch
                            </td>
                            <td>{{ $seat->room->name ?? 'Không xác định' }}</td>
                            <td>
                                <a href="{{ route('admin.seats.edit', $seat->id) }}"
                                    class="btn btn-sm btn-outline-warning me-1">Sửa</a>
                                <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST"
                                    style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Xóa ghế này?')" class="btn btn-sm btn-outline-danger">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">Không có ghế nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Phân trang --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $seats->links() }}
            </div>
        </div>
    @endsection
