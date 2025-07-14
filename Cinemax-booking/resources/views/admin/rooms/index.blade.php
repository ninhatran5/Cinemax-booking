@extends('admin.home')

@section('content')
<div class="container mt-4">
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary mb-3">Thêm phòng</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên phòng</th>
                <th>Sức chứa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>{{ $room->name }}</td>
                <td>{{ $room->capacity }}</td>
                <td>
                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
