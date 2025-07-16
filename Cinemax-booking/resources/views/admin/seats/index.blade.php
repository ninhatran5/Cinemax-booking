@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold text-primary"> Danh sách ghế</h4>
            <a href="{{ route('admin.seats.create') }}" class="btn btn-success shadow-sm"> Tạo nhiều ghế</a>
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
        <div class="accordion shadow-sm mb-4" id="accordionFilter">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFilter">
                    <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                        Bộ lọc & Xoá hàng ghế
                    </button>
                </h2>
                <div id="collapseFilter" class="accordion-collapse collapse show" aria-labelledby="headingFilter"
                    data-bs-parent="#accordionFilter">
                    <div class="accordion-body">

                        <div class="row">
                            {{-- Bộ lọc --}}
                            <div class="col-md-6 border-end pe-3">
                                <form method="GET" action="{{ route('admin.seats.index') }}">
                                    <div class="mb-3">
                                        <label for="seat_type" class="form-label">Loại ghế</label>
                                        <select name="seat_type" id="seat_type" class="form-select">
                                            <option value="">-- Tất cả --</option>
                                            <option value="normal" {{ request('seat_type') == 'normal' ? 'selected' : '' }}>
                                                Ghế Thường</option>
                                            <option value="vip" {{ request('seat_type') == 'vip' ? 'selected' : '' }}>Ghế
                                                VIP</option>
                                            <option value="double" {{ request('seat_type') == 'double' ? 'selected' : '' }}>
                                                Ghế Đôi</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="room_id" class="form-label">Phòng chiếu</label>
                                        <select name="room_id" id="room_id" class="form-select">
                                            <option value="">-- Tất cả --</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}"
                                                    {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                                    {{ $room->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Lọc</button>
                                        <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Xoá lọc</a>
                                    </div>
                                </form>
                            </div>

                            {{-- Xoá hàng ghế --}}
                            <div class="col-md-6 ps-3">
                                <form method="POST" action="{{ route('admin.seats.deleteRow') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="room_id_delete" class="form-label">Phòng chiếu</label>
                                        <select name="room_id" id="room_id_delete" class="form-select" required>
                                            <option value="">-- Chọn phòng --</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="row" class="form-label">Tên hàng (A, B,...)</label>
                                        <input type="text" name="row" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-danger"> Xoá hàng ghế</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- Bảng danh sách --}}
        <div class="card shadow-sm">
            <div class="card-header bg-light fw-semibold"> Danh sách ghế</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Hàng</th>
                                <th>Tên ghế</th>
                                <th>Loại</th>
                                <th>Phòng</th>
                                <th>X</th>
                                <th>Y</th>
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
                                                <span class="badge bg-primary">Thường</span>
                                            @break

                                            @case('vip')
                                                <span class="badge bg-warning text-dark">VIP</span>
                                            @break

                                            @case('double')
                                                <span class="badge bg-danger">Đôi</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">Không rõ</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $seat->room->name ?? 'Không xác định' }}</td>
                                    <td>{{ $seat->position_x }}</td>
                                    <td>{{ $seat->position_y }}</td>
                                    <td>
                                        <a href="{{ route('admin.seats.edit', $seat->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1">
                                            Sửa
                                        </a>
                                        <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Xóa ghế này?')"
                                                class="btn btn-sm btn-outline-danger">
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
                </div>

                {{-- Phân trang --}}
                <div class="card-footer text-center">
                    {{ $seats->links() }}
                </div>
            </div>
        </div>
    @endsection
