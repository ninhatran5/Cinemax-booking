@extends('layout')

@section('content')
    <div class="container">
        <div class="container">
            <h2>Phim đang chiếu</h2>
            <div class="d-flex mb-3">
                @foreach ($dates as $date)
                    <a href="{{ route('client.movie', ['date' => $date]) }}">
                        <button class="btn btn me-2 {{ $selectedDate == $date ? 'btn-primary' : '' }}">
                            {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                        </button>
                    </a>
                @endforeach
            </div>

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
                            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}"
                                class="img-fluid me-3"
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
                                        $showtimeTime = Carbon::parse($showtime->start_time);
                                        $isPast = $showtimeTime <= $now;
                                    @endphp

                                    <button class="btn btn-sm mb-2 me-2"
                                        style="background-color: {{ $isPast ? '#ffc107' : '#28a745' }};
                                   color: {{ $isPast ? '#000' : '#fff' }};"
                                        {{ $isPast ? 'disabled' : '' }}
                                        onclick="{{ $isPast ? '' : "openSeatModal($showtime->id)" }}">
                                        {{ $showtimeTime->format('H:i') }}
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
    </div>
@endsection
