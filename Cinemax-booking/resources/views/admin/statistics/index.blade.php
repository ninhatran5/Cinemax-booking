@extends('admin.home')

@section('content')
    <div class="container">
        <h1>Thống kê hệ thống</h1>

        <div class="row">
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Tổng doanh thu</h5>
                    <p>{{ number_format($totalRevenue) }} đ</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Số lượng phim</h5>
                    <p>{{ $movieCount }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Số lượng người dùng</h5>
                    <p>{{ $userCount }}</p>
                </div>
            </div>
        </div>

        @if($totalRevenue == 0)
            <div class="alert alert-warning mt-3">Chưa có doanh thu nào được ghi nhận!</div>
        @endif

        <canvas id="revenueChart" height="100"></canvas>

        <h3 class="mt-4">Top 5 phim doanh thu cao nhất</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Phim</th>
                    <th>Doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topMovies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>{{ number_format($movie->revenue) }} đ</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Chưa có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart');
        const labels = {!! json_encode(array_keys($monthlyRevenue->toArray())) !!};
        const data = {!! json_encode(array_values($monthlyRevenue->toArray())) !!};
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels.length ? labels : ['Không có dữ liệu'],
                datasets: [{
                    label: 'Doanh thu theo tháng',
                    data: data.length ? data : [0],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                }]
            }
        });
    </script>
@endsection
