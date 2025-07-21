<div class="modal-header">
    <h5 class="modal-title">Chọn ghế - {{ $showtime->room->name }} ({{ $showtime->start_time }})</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form action="{{ route('client.booking.store', $showtime->id) }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="d-flex flex-wrap" style="max-width: 500px;">
            @foreach ($showtime->room->seats as $seat)
                @php $isBooked = in_array($seat->id, $bookedSeatIds); @endphp
                <div style="width: 50px; margin: 4px;">
                    <input type="checkbox" id="seat{{ $seat->id }}" name="seats[]" value="{{ $seat->id }}"
                        {{ $isBooked ? 'disabled' : '' }}>
                    <label for="seat{{ $seat->id }}"
                        class="btn btn-sm {{ $isBooked ? 'btn-danger' : 'btn-outline-primary' }}" style="width: 100%;">
                        {{ $seat->name }}
                    </label>
                </div>
            @endforeach
        </div>
        
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-success">Đặt vé</button>
    </div>
</form>
