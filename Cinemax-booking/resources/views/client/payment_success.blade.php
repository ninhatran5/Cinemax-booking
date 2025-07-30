@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h2>🎉 Thanh toán thành công!</h2>
        <p>Cảm ơn bạn đã đặt vé tại Cinemax.</p>
        <a href="{{ route('client.booking.show', $booking) }}" class="btn btn-primary mt-3">Xem chi tiết vé</a>
        <a href="{{ route('client.home') }}" class="btn btn-secondary mt-3">Về trang chủ</a>
    </div>
</div>
@endsection