@extends('layout')

@section('content')
    <div class="container my-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>Thông tin vé</h4>
            </div>
            <div class="card-body">
                <p><strong>Phim:</strong> {{ $booking->showtime->movie->title }}</p>
                <p><strong>Phòng:</strong> {{ $booking->showtime->room->name }}</p>
                <p><strong>Suất chiếu:</strong>
                    {{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('H:i d/m/Y') }}</p>
                <p><strong>Thời gian đặt:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i d/m/Y') }}
                </p>

                <p><strong>Ghế đã chọn:</strong></p>
                <ul>
                    @foreach ($booking->seats as $seat)
                        <li>
                            Ghế {{ $seat->name }} ({{ $seat->type->name ?? '' }}) -
                            {{ number_format($seat->pivot->price, 0, ',', '.') }}đ
                        </li>
                    @endforeach
                </ul>

                <hr>
                <p><strong>Tổng tiền:</strong>
                    <span class=" fw-bold"
                        style="color: red">{{ number_format($booking->total_price, 0, ',', '.') }}đ</span>
                </p>

                <a href="{{ route('client.home') }}" class="btn btn-primary mt-3">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
@endsection
