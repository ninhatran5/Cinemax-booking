@extends('admin.home')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 fw-bold text-primary">Danh sách ghế</h4>
        <a href="{{ route('admin.seats.create') }}" class="btn btn-success shadow-sm">Tạo nhiều ghế</a>
    </div>

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

    {{-- Bộ lọc --}}
    <div class="accordion shadow-sm mb-4" id="accordionFilter">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFilter">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFilter">
                    Bộ lọc & Xoá hàng ghế
                </button>
            </h2>
            <div id="collapseFilter" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-6 border-end pe-3">
                            <form method="GET" action="{{ route('admin.seats.index') }}">
                                <div class="mb-3">
                                    <label class="form-label">Loại ghế</label>
                                    <select name="seat_type_id" class="form-select">
                                        <option value="">-- Tất cả --</option>
                                        @foreach ($seatTypes as $type)
                                            <option value="{{ $type->id }}"
                                                {{ request('seat_type_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phòng chiếu</label>
                                    <select name="room_id" class="form-select">
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
                                    <button class="btn btn-primary">Lọc</button>
                                    <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Xoá lọc</a>
                                </div>
                            </form>
                        </div>

                        {{-- Xoá hàng --}}
                        <div class="col-md-6 ps-3">
                            <form method="POST" action="{{ route('admin.seats.deleteRow') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Phòng chiếu</label>
                                    <select name="room_id" class="form-select" required>
                                        <option value="">-- Chọn phòng --</option>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tên hàng (A, B,...)</label>
                                    <input type="text" name="row" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-danger">Xoá hàng ghế</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Danh sách --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Phòng</th>
                    <th>Hàng</th>
                    <th>Cột</th>
                    <th>Loại ghế</th>
                    <th>Trạng thái</th>
                    <th width="140">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seats as $seat)
                    <tr>
                        <td>{{ $seat->id }}</td>
                        <td>{{ $seat->room->name }}</td>
                        <td>{{ $seat->row }}</td>
                        <td>{{ $seat->column }}</td>
                        <td>{{ $seat->seatType->name ?? '-' }}</td>
                        <td>
                            @if ($seat->is_available)
                                <span class="badge bg-success">Còn trống</span>
                            @else
                                <span class="badge bg-danger">Đã đặt</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.seats.edit', $seat->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn chắc chắn muốn xoá ghế này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $seats->links() }}
    </div>
@endsection
