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
            <div class="alert alert-danger">
                {{ $errors->first('seats') }}
            </div>
        @endif
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-start border rounded shadow-sm p-3 h-100" style="background-color: #fff;">
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
                            {{-- Suất chiếu --}}
                            @php
                                $now = \Carbon\Carbon::now();
                            @endphp

                            @foreach ($movie->showtimes as $showtime)
                                @php
                                    $showtimeTime = \Carbon\Carbon::parse(
                                        "{$showtime->show_date} {$showtime->start_time}",
                                    );
                                    $isPast = $showtimeTime->lt($now);
                                @endphp

                                <button class="btn btn-sm mb-2 me-2"
                                    style="background-color: {{ $isPast ? '#ffc107' : '#28a745' }};
               color: {{ $isPast ? '#000' : '#fff' }};"
                                    @if ($isPast) disabled
            title="Suất chiếu đã kết thúc lúc {{ $showtimeTime->format('H:i d/m') }}"
        @else
            onclick="openSeatModal({{ $showtime->id }})" @endif>
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
@endsection
