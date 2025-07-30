@extends('layout')

@section('content')
    <style>
        .table thead th {
            background-color: #f8f9fa;
            color: #000;
        }

        .badge {
            font-size: 85%;
            padding: 6px 8px;
            border-radius: 6px;
        }

        /* Bỏ hiệu ứng hover */
        .table tbody tr {
            background-color: #ffffff;
        }

        .table-bordered> :not(caption)>*>* {
            border-color: #dee2e6;
        }

        .btn-outline-primary {
            border-radius: 4px;
        }
    </style>

    <div class="container my-4">
        <h3 class="mb-4 text-primary">🕘 Lịch sử đặt vé</h3>

        @if ($bookings->isEmpty())
            <div class="alert alert-secondary text-center">
                Bạn chưa có đặt vé nào.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-striped align-middle table-bordered border-light bg-white">
                    <thead class="table-light text-center">
                        <tr>
                            <th>STT</th>
                            <th>Mã Đặt vé</th>
                            <th>Phim</th>
                            <th>Phòng</th>
                            <th>Suất chiếu</th>
                            <th>Ghế đã đặt</th>
                            <th>Tổng tiền</th>
                            <th>Đặt lúc</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $index => $booking)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->order_code }}</td>
                                <td class="text-start">{{ $booking->showtime->movie->title }}</td>
                                <td>{{ $booking->showtime->room->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('H:i d/m/Y') }}</td>
                                <td class="text-start">
                                    @foreach ($booking->seats as $seat)
                                        <span class="badge bg-light border" style="color: black">
                                            {{ $seat->name }} ({{ $seat->seatType->name ?? 'N/A' }})
                                        </span>
                                        {{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                </td>
                                <td>
                                    <strong class=" fw-bold" style="color: red">
                                        {{ number_format($booking->total_price, 0, ',', '.') }}đ
                                    </strong>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('client.booking.show', $booking->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
