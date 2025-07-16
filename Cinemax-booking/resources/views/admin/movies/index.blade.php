@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <h2>Danh sách phim</h2>
        <a href="{{ route('admin.movies.create') }}" class="btn btn-primary mb-3">Thêm phim</a>
        <a href="{{ route('admin.movies.trash') }}" class="btn btn-danger mb-3"> Xem phim đã xoá</a>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <form method="GET" action="{{ route('admin.movies.index') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tiêu đề..."
                    value="{{ request('keyword') }}">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tạm ẩn</option>
                </select>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Lọc</button>
                <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Đặt lại</a>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Thời lượng</th>
                    <th>Trạng thái</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->duration }} phút</td>
                        {{-- <td>{{ $movie->status }}</td> --}}
                        <td>
                            @switch($movie->status)
                                @case('active')
                                    <span class="badge bg-primary">Hoạt động</span>
                                @break

                                @case('inactive')
                                    <span class="badge bg-warning text-dark">Tạm ẩn</span>
                                @break
                            @endswitch
                        </td>
                        <td>
                            @if ($movie->image)
                                <img src="{{ asset('storage/' . $movie->image) }}" width="50"
                                    alt="{{ $movie->title }}">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Bạn có chắc chắn?')"
                                    class="btn btn-sm btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
