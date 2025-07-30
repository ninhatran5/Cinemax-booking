<style>
    .modal-dialog {
        max-width: 1500px;
    }

    .btn-seat-available {
        background-color: #28a745;
        color: #fff;
    }

    .btn-seat-selected {
        background-color: #ffc107;
        color: #000;
    }

    .seat-row {
        display: flex;
        gap: 6px;
        margin-bottom: 6px;
        align-items: center;
        overflow-x: auto;
        white-space: nowrap;
    }

    .seat-label {
        width: 50px;
        font-weight: bold;
        font-size: 13px;
        flex-shrink: 0;
    }

    .btn-seat {
        width: 60px;
        height: 50px;
        font-size: 11px;
        padding: 2px;
        text-align: center;
        line-height: 1.1;
    }

    .btn-seat small {
        font-size: 8px;
    }

    .info-section p,
    .info-section label,
    .info-section span {
        font-size: 13px;
    }
</style>

<div class="modal-header">
    <h5 class="modal-title">Chọn ghế cho phim: {{ $showtime->movie->title }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form action="{{ route('client.booking.store', $showtime->id) }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-10">
                @php
                    $seatsByRow = $showtime->room->seats->groupBy('row');
                @endphp

                @foreach ($seatsByRow as $row => $seats)
                    <div class="seat-row">
                        <div class="seat-label">Hàng {{ $row }}:</div>
                        @foreach ($seats as $seat)
                            @php
                                $type = $seat->seatType;
                                $isBooked = in_array($seat->id, $bookedSeatIds);
                            @endphp
                            <input type="checkbox" class="btn-check seat-checkbox" name="seats[]"
                                id="seat{{ $seat->id }}" value="{{ $seat->id }}"
                                {{ $isBooked ? 'disabled' : '' }} data-name="{{ $seat->name }}"
                                data-price="{{ $type->price ?? 0 }}" data-type="{{ $type->name ?? '' }}">
                            <label class="btn btn-sm btn-seat {{ $isBooked ? 'btn-secondary' : 'btn-seat-available' }}"
                                for="seat{{ $seat->id }}">
                                {{ $seat->name }}<br> <small>{{ $type->name ?? '' }}</small>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="col-md-2 info-section">
                <p><strong>Phim:</strong> {{ $showtime->movie->title }}</p>
                <p><strong>Phòng:</strong> {{ $showtime->room->name }}</p>
                <p><strong>Suất chiếu:</strong> {{ $showtime->start_time }}</p>

                <div class="mb-2">
                    <label><strong>Họ tên:</strong>
                        <p>{{ Auth::user()->name ?? 'Khách' }}</p>
                    </label>
                </div>

                <div class="mb-2">
                    <label><strong>Email:</strong>
                        <p>{{ Auth::user()->email ?? 'Không có email' }}</p>
                    </label>
                </div>

                <div class="mb-2">
                    <strong>Ghế đã chọn:</strong> <span id="selected-seats">--</span>
                </div>

                <div class="mb-3">
                    <strong>Tổng tiền:</strong> <span id="total-price">0đ</span>
                </div>

                @auth
                    <button type="submit" class="btn btn-warning w-100">Thanh toán qua VNPAY</button>
                @else
                    <a href="{{ route('client.login') }}" class="btn btn-danger w-100">Đăng nhập để đặt vé</a>
                @endauth
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seatCheckboxes = document.querySelectorAll('.seat-checkbox');
        const selectedSeatsSpan = document.getElementById('selected-seats');
        const totalAmountSpan = document.getElementById('total-price');

        seatCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSummary);
        });

        function updateSummary() {
            let selectedSeats = [];
            let total = 0;

            seatCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const name = checkbox.dataset.name;
                    const price = parseFloat(checkbox.dataset.price || 0);
                    const type = checkbox.dataset.type || '';
                    selectedSeats.push(`${name} (${type})`);
                    total += price;
                }
            });

            selectedSeatsSpan.textContent = selectedSeats.length > 0 ? selectedSeats.join(', ') : '--';
            totalAmountSpan.textContent = total.toLocaleString('vi-VN') + 'đ';
        }

        setTimeout(updateSummary, 100);
    });
</script>
