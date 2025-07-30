@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        @if($booking->payment_status == 'paid')
                            ✅ Thanh toán thành công
                        @else
                            <span class="text-danger">Vé không hợp lệ hoặc chưa thanh toán thành công.</span>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    @if($booking->payment_status == 'paid')
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Thông tin phim</h5>
                            <p><strong>Phim:</strong> {{ $booking->showtime->movie->title }}</p>
                            <p><strong>Phòng:</strong> {{ $booking->showtime->room->name }}</p>
                            <p><strong>Suất chiếu:</strong> {{ $booking->showtime->start_time }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin đặt vé</h5>
                            <p><strong>Mã đơn:</strong> {{ $booking->order_code }}</p>
                            <p><strong>Ghế:</strong> 
                                @foreach($booking->bookingSeats as $bookingSeat)
                                    {{ $bookingSeat->seat->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </p>
                            <p><strong>Tổng tiền:</strong> <span class="text-danger fw-bold">{{ number_format($booking->total_price) }}đ</span></p>
                            <span class="badge bg-success">Đã thanh toán</span>
                        </div>
                    </div>
                    <div class="alert alert-success mt-3">
                        <h6>🎉 Chúc mừng! Thanh toán thành công</h6>
                        <p class="mb-0">Vé của bạn đã được xác nhận. Vui lòng đến rạp trước giờ chiếu 15 phút.</p>
                    </div>
                    @else
                    <div class="alert alert-danger mt-3">
                        Vé không hợp lệ hoặc chưa thanh toán thành công.
                    </div>
                    @endif
                    <div class="mt-3">
                        <a href="{{ route('client.booking.history') }}" class="btn btn-secondary">Quay lại lịch sử</a>
                        <a href="{{ route('client.home') }}" class="btn btn-primary">Về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 