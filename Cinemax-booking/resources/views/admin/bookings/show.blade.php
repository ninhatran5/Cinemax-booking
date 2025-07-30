@extends('admin.home')

@section('content')
    <h1>Chi tiết đặt vé #{{ $booking->id }}</h1>
    <ul>
        <li>Mã Đơn: {{ $booking->order_code}}</li>
        <li>Khách hàng: {{ $booking->user->name ?? 'N/A' }}</li>
        <li>Suất chiếu: {{ $booking->showtime->id ?? 'N/A' }}</li>
        <li>Thời gian đặt: {{ $booking->booking_time }}</li>
        <li>Tổng tiền: {{ number_format($booking->total_price) }} đ</li>
        <li>Trạng thái: <span class="badge bg-success">Đã thanh toán</span></li>
    </ul>

    <h3>Danh sách ghế đã đặt</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Ghế</th>
                <th>Loại ghế</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($booking->bookingSeats as $bs)
                <tr>
                    <td>{{ $bs->seat->name ?? 'N/A' }}</td>
                    <td>{{ $bs->seat->seatType->name ?? 'N/A' }}</td>
                    <td>{{ number_format($bs->price) }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Quay lại</a>
@endsection
