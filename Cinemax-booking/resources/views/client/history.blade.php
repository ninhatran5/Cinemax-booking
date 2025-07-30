@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Lịch sử đặt vé</h2>
    
    @php
        $paidBookings = $bookings->where('payment_status', 'paid');
    @endphp
    @if($paidBookings->count() > 0)
        <div class="row">
            @foreach($paidBookings as $booking)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->showtime->movie->title }}</h5>
                            <p class="card-text">
                                <strong>Phòng:</strong> {{ $booking->showtime->room->name }}<br>
                                <strong>Suất chiếu:</strong> {{ $booking->showtime->start_time }}<br>
                                <strong>Ghế:</strong> 
                                @foreach($booking->bookingSeats as $bookingSeat)
                                    {{ $bookingSeat->seat->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                                <br>
                                <strong>Tổng tiền:</strong> {{ number_format($booking->total_price) }}đ<br>
                                <strong>Mã đơn:</strong> {{ $booking->order_code }}<br>
                                <span class="badge bg-success">Đã thanh toán</span>
                            </p>
                            <a href="{{ route('client.booking.show', $booking->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Bạn chưa có vé nào.
        </div>
    @endif
</div>
@endsection
