@extends('layout')

@section('content')
    <style>
        .date-tab {
            display: inline-block;
            padding: 8px 12px;
            margin-right: 10px;
            color: #6c757d;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            font-weight: 500;
        }

        .date-tab:hover {
            color: #0056b3;
            text-decoration: none;
        }

        .date-tab.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
    </style>
    @include('client.block.slide')
    <div class="container">
        <br>
        <h2>Phim đang chiếu</h2>
        <div class="d-flex mb-3">
            @foreach ($dates as $date)
                <a href="{{ route('client.movie', ['date' => $date]) }}"
                    class="date-tab {{ $selectedDate == $date ? 'active' : '' }}">
                    {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                </a>
            @endforeach
        </div>
        @if ($errors->has('seats'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ $errors->first('seats') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif
        @php
            use Carbon\Carbon;
            $now = Carbon::now();
        @endphp
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-start border rounded shadow-sm p-3 h-100"
                        style="background-color: #fff;">
                        <!-- Poster -->
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="img-fluid me-3"
                            style="width: 120px; height: auto; border-radius: 10px; object-fit: cover;">

                        <!-- Thông tin -->
                        <div>
                            <h5 class="fw-bold text-uppercase">{{ $movie->title }}</h5>

                            <div class="text-muted mb-2 small">
                                <i class="bi bi-clock-fill text-primary"></i> |
                                {{ $movie->duration }} phút
                            </div>

                            <!-- Suất chiếu -->
                            @foreach ($movie->showtimes as $showtime)
                                @php
                                    // Parse ngày giờ chiếu từ DB
                                    $showDateTime = Carbon::parse($showtime->show_date . ' ' . $showtime->start_time);

                                    // Nếu hôm nay và giờ chiếu < hiện tại ⇒ disable
                                    $isToday = $showDateTime->isSameDay($now);
                                    $isExpired = $isToday && $showDateTime->lt($now);
                                @endphp

                                <button class="btn btn-sm mb-2 me-2"
                                    style="background-color: {{ $isExpired ? '#ffc107' : '#28a745' }};
               color: {{ $isExpired ? '#000' : '#fff' }};"
                                    {{ $isExpired ? 'disabled' : '' }}
                                    onclick="{{ $isExpired ? '' : "openSeatModal($showtime->id)" }}">
                                    {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="seatModal" tabindex="-1" aria-labelledby="seatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="seatModalContent">
                <!-- Nội dung ghế sẽ load bằng AJAX -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openSeatModal(showtimeId) {
            fetch(`/showtime/${showtimeId}/seats`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('seatModalContent').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById('seatModal'));
                    modal.show();
                });
        }
    </script>
@endsection
