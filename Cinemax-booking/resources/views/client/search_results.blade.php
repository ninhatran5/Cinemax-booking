@extends('layout')

@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Kết quả tìm kiếm cho:
            <span class="text-danger" style="color: red !important;">"{{ request('query') }}"</span>
        </h3>
        @php
            use Carbon\Carbon;
            $now = Carbon::now();
        @endphp
        @if ($movies->isEmpty())
            <div class="alert alert-warning text-center">
                Không tìm thấy phim nào phù hợp.
            </div>
        @else
            <div class="row">
                @foreach ($movies as $movie)
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-start border rounded shadow-sm p-3 h-100 bg-white">
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
                                        $showDateTime = Carbon::parse(
                                            $showtime->show_date . ' ' . $showtime->start_time,
                                        );
                                        $isExpired = $showDateTime->lt($now); // đã qua giờ
                                    @endphp

                                    <button class="btn btn-sm mb-2 me-2"
                                        style="background-color: {{ $isExpired ? '#ffc107' : '#28a745' }};
                                           color: {{ $isExpired ? '#000' : '#fff' }};"
                                        {{ $isExpired ? 'disabled' : '' }}
                                        @if (!$isExpired) onclick="openSeatModal({{ $showtime->id }})" @endif>
                                        {{ $showDateTime->format('H:i') }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
