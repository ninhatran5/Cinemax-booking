@extends('admin.home')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                Thêm nhiều ghế vào phòng chiếu
            </div>

            <div class="card-body">
                {{-- Thông báo --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
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

                {{-- Form tạo ghế --}}
                <form method="POST" action="{{ route('admin.seats.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Phòng chiếu</label>
                        <select name="room_id" class="form-select @error('room_id') is-invalid @enderror" required>
                            <option value="">-- Chọn phòng --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"> Số hàng (A, B, C... hoặc A,B,C)</label>
                        <input type="text" name="rows" id="rows"
                            class="form-control @error('rows') is-invalid @enderror" value="{{ old('rows') }}"
                            placeholder="VD: A,B,C" required>
                        @error('rows')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"> Số ghế mỗi hàng</label>
                        <input type="number" name="seats_per_row" id="seats_per_row"
                            class="form-control @error('seats_per_row') is-invalid @enderror"
                            value="{{ old('seats_per_row') }}" min="1" required>
                        @error('seats_per_row')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Loại ghế</label>
                        <select name="seat_type_id" class="form-select" required>
                            <option value="">-- Chọn loại ghế --</option>
                            @foreach ($seatTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('seat_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Preview --}}
                    <div class="mb-3">
                        <label class="form-label"> Xem trước tên ghế sẽ tạo</label>
                        <div id="seat-preview" class="border rounded bg-light p-2" style="min-height: 60px;"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary"> Quay lại</a>
                        <button type="submit" class="btn btn-primary"> Tạo ghế</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script xem trước tên ghế --}}
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
                        html += `<span class="badge bg-primary me-1 mb-1">${row}${i}</span>`;
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
