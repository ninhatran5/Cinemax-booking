@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <h4>Thêm nhiều ghế vào phòng</h4>

        {{-- ✅ THÔNG BÁO --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Đã có lỗi xảy ra:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.seats.store') }}">
            @csrf

            <div class="mb-3">
                <label for="room_id" class="form-label">Phòng chiếu</label>
                <select name="room_id" class="form-control" required>
                    <option value="">-- Chọn phòng --</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="rows" class="form-label">Số hàng (A, B, C,...)</label>
                <input type="text" name="rows" id="rows" class="form-control" value="{{ old('rows') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="seats_per_row" class="form-label">Số ghế mỗi hàng</label>
                <input type="number" name="seats_per_row" id="seats_per_row" class="form-control" required min="1"
                    value="{{ old('seats_per_row') }}">
            </div>

            <div class="mb-3">
                <label for="seat_type" class="form-label">Loại ghế</label>
                <select name="seat_type" class="form-control" required>
                    <option value="">-- Chọn loại --</option>
                    <option value="normal" {{ old('seat_type') == 'normal' ? 'selected' : '' }}>Ghế thường</option>
                    <option value="vip" {{ old('seat_type') == 'vip' ? 'selected' : '' }}>Ghế VIP</option>
                    <option value="double" {{ old('seat_type') == 'double' ? 'selected' : '' }}>Ghế đôi</option>
                </select>
            </div>

            {{-- ✅ Xem trước tên ghế --}}
            <div class="mb-3">
                <label class="form-label">Xem trước tên ghế sẽ tạo</label>
                <div id="seat-preview" class="border rounded bg-light p-2" style="min-height: 60px;"></div>
            </div>

            <button type="submit" class="btn btn-primary">Tạo ghế</button>
            <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>

    {{-- ✅ Script preview tên ghế --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowsInput = document.getElementById('rows');
            const seatsInput = document.getElementById('seats_per_row');
            const preview = document.getElementById('seat-preview');

            function updatePreview() {
                const rowLetters = rowsInput.value.toUpperCase().split(',').map(r => r.trim()).filter(r => r !==
                '');
                const seatCount = parseInt(seatsInput.value);
                preview.innerHTML = '';

                if (rowLetters.length === 0 || isNaN(seatCount) || seatCount < 1) return;

                let html = '';
                rowLetters.forEach(row => {
                    for (let i = 1; i <= seatCount; i++) {
                        html +=
                            `<span style="display:inline-block; margin:2px; padding:4px 8px; background:#007bff; color:#fff; border-radius:4px;">${row}${i}</span>`;
                    }
                    html += '<br>';
                });

                preview.innerHTML = html;
            }

            rowsInput.addEventListener('input', updatePreview);
            seatsInput.addEventListener('input', updatePreview);
        });
    </script>
@endsection
