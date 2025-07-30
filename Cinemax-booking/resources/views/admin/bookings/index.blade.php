@extends('admin.home')

@section('content')
<h1>Danh sách đặt vé</h1>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Mã Đơn</th>
            <th>Khách hàng</th>
            <th>Suất chiếu</th>
            <th>Thời gian đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->order_code }}</td>
            <td>{{ $booking->user->name ?? 'N/A' }}</td>
            <td>{{ $booking->showtime->id ?? 'N/A' }}</td>
            <td>{{ $booking->booking_time }}</td>
            <td>{{ number_format($booking->total_price) }} đ</td>
            <td>{{ $booking->payment_status }}</td>
            <td>
                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $bookings->links() }}
@endsection 