@extends('admin.home')
@section('content')
    <h2>Quản lý loại ghế</h2>

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

    <a href="{{ route('admin.seat-types.create') }}" class="btn btn-primary mb-3">+ Thêm loại ghế</a>

    <table class="table">
        <thead>
            <tr>
                <th>Tên loại</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seatTypes as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ number_format($type->price) }} đ</td>
                    <td>{{ $type->deleted_at ? 'Đã xoá' : 'Đang hoạt động' }}</td>
                    <td>
                        @if (!$type->deleted_at)
                            <a href="{{ route('admin.seat-types.edit', $type->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form method="POST" action="{{ route('admin.seat-types.destroy', $type->id) }}"
                                style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xoá mềm?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xoá mềm</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.seat-types.restore', $type->id) }}"
                                style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-success">Phục hồi</button>
                            </form>
                            <form method="POST" action="{{ route('admin.seat-types.force-delete', $type->id) }}"
                                style="display:inline;" onsubmit="return confirm('Xoá vĩnh viễn? Không thể khôi phục!')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-dark">Xoá vĩnh viễn</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
