@extends('admin.home')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary">Danh sách phòng chiếu</h4>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-success shadow-sm">Thêm phòng</a>
        </div>

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

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên phòng</th>
                            <th>Sức chứa</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td>{{ $room->id }}</td>
                                <td class="fw-semibold">{{ $room->name }}</td>
                                <td><span class="badge bg-primary">{{ $room->capacity }}</span></td>
                                <td>
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                        class="btn btn-sm btn-outline-warning me-1">Sửa</a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($rooms->isEmpty())
                            <tr>
                                <td colspan="4" class="text-muted">Chưa có phòng nào.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
