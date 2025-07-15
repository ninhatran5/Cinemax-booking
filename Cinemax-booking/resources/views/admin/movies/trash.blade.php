@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <h3> Danh sách phim đã xoá mềm</h3>

        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary mb-3">← Quay lại danh sách phim</a>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Thời lượng</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->duration }} phút</td>
                        <td>
                            @if ($movie->image)
                                <img src="{{ asset('storage/' . $movie->image) }}" width="100">
                            @endif
                        </td>
                        <td>{{ $movie->status }}</td>
                        <td>
                            <form action="{{ route('admin.movies.restore', $movie->id) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('PUT')
                                <button class="btn btn-sm btn-success">Khôi phục</button>
                            </form>

                            <form action="{{ route('admin.movies.forceDelete', $movie->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Bạn chắc chắn muốn xoá vĩnh viễn phim này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xoá vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có phim nào đã xoá mềm.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $movies->links() }}
    </div>
@endsection
