<style>
    .modal-dialog {
        max-width: 1500px;
    }

    .seat-row {
        display: flex;
        gap: 8px;
        margin-bottom: 10px;
    }

    .seat-wrapper {
        width: 50px;
    }

    .seat-wrapper input[type="checkbox"] {
        display: none;
    }

    .seat-wrapper label {
        display: block;
        width: 100%;
        text-align: center;
        padding: 4px 0;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-seat-available {
        background-color: #a4a4a4 !important;
        /* Xám */
        color: #fff !important;
    }

    .btn-seat-selected {
        background-color: #28a745 !important;
        /* Xanh lá */
        color: #fff !important;
    }

    .btn-seat-booked {
        background-color: #ff0019 !important;
        /* Đỏ */
        color: #fff !important;
        pointer-events: none;
        opacity: 0.8;
    }
</style>

<div class="modal-header">
    <h5 class="modal-title">Chọn ghế - {{ $showtime->room->name }} ({{ $showtime->start_time }})</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="{{ route('client.booking.store', $showtime->id) }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            {{-- Ghi chú trạng thái --}}
            <div class="col-md-12 mb-3">
                <div class="alert alert-light border">
                    <strong>Chú thích:</strong>
                    <div class="d-flex flex-wrap gap-4 mt-2">
                        <div><span class="btn btn-sm btn-seat-available">&nbsp;&nbsp;&nbsp;</span> Ghế trống</div>
                        <div><span class="btn btn-sm btn-seat-selected">&nbsp;&nbsp;&nbsp;</span> Đang chọn</div>
                        <div><span class="btn btn-sm btn-seat-booked">&nbsp;&nbsp;&nbsp;</span> Đã đặt</div>
                    </div>
                </div>
            </div>

            {{-- Phần CHỌN GHẾ --}}
            <div class="col-md-9">
                @php
                    $seatsByRow = $showtime->room->seats->groupBy('row');
                @endphp

                @foreach ($seatsByRow as $rowName => $seats)
                    <div class="mb-2">
                        <strong>Hàng {{ $rowName }}:</strong>
                        <div class="seat-row">
                            @foreach ($seats as $seat)
                                @php $isBooked = in_array($seat->id, $bookedSeatIds); @endphp
                                <div class="seat-wrapper">
                                    <input type="checkbox" id="seat{{ $seat->id }}" name="seats[]"
                                        value="{{ $seat->id }}" {{ $isBooked ? 'disabled' : '' }}>
                                    <label for="seat{{ $seat->id }}"
                                        class="btn btn-sm {{ $isBooked ? 'btn-seat-booked' : 'btn-seat-available' }}">
                                        {{ $seat->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Thông tin đặt vé --}}
            <div class="col-md-3">
                <h5>Thông tin đặt vé</h5>
                <p>Người dùng: {{ auth()->user()->name }}</p>
                <p>Email:{{ auth()->user()->email }}</p>
                <p>Ghế đã chọn: <span id="selected-seats">---</span></p>
                <p>Tổng tiền: <span id="total-price">0đ</span></p>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-success">Đặt vé</button>
    </div>
</form>

<script>
    const seatCheckboxes = document.querySelectorAll('input[type="checkbox"][name="seats[]"]');
    const selectedSeatsText = document.getElementById('selected-seats');
    const totalPriceText = document.getElementById('total-price');
    const seatPrice = 50000; // giá 1 ghế

    function updateSelectedSeats() {
        let selectedSeats = [];
        let total = 0;
        seatCheckboxes.forEach(checkbox => {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (checkbox.checked) {
                selectedSeats.push(label.textContent.trim());
                label.classList.remove('btn-seat-available');
                label.classList.add('btn-seat-selected');
                total += seatPrice;
            } else {
                label.classList.remove('btn-seat-selected');
                label.classList.add('btn-seat-available');
            }
        });
        selectedSeatsText.textContent = selectedSeats.length ? selectedSeats.join(', ') : '---';
        totalPriceText.textContent = total.toLocaleString('vi-VN') + 'đ';
    }

    seatCheckboxes.forEach(cb => cb.addEventListener('change', updateSelectedSeats));
</script>
