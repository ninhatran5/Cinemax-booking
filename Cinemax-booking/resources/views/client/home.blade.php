@extends('layout')

@section('content')
    @include('client.block.slide')
    <div class="container">
        <h2>Phim đang chiếu</h2>
        <div class="d-flex mb-3">
            @foreach ($dates as $date)
                <a href="{{ route('client.home', ['date' => $date]) }}">
                    <button class="btn btn me-2 {{ $selectedDate == $date ? 'btn-primary' : '' }}">
                        {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                    </button>
                </a>
            @endforeach
        </div>
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <div>
                                <img src="{{ asset('storage/' . $movie->image) }}" width="50" alt="{{ $movie->title }}">
                                <span class="ms-2">{{ $movie->duration }} phút</span>
                            </div>
                            <div class="mt-2">
                                @foreach ($movie->showtimes as $showtime)
                                    <button class="btn btn-success btn-sm mb-1"
                                        onclick="openSeatModal({{ $showtime->id }})">
                                        {{ $showtime->start_time }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
