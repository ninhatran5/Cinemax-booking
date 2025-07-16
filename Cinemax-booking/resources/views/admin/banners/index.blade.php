@extends('admin.home')

@section('content')
    <div class="container mt-5">
        <h2>Danh sách banner</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Vị trí</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td><img src="{{ $banner->image ? asset('storage/' . $banner->image) : 'https://via.placeholder.com/150' }}"
                                width="150"></td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->position }}</td>
                        <td>{{ $banner->status }}</td>
                        <td>
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-primary">Chỉnh
                                sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
