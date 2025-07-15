<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShowtimeController extends Controller
{
    public function index(Request $request)
    {
        $query = Showtime::with(['movie', 'room']);

        if ($request->filled('movie_id')) {
            $query->where('movie_id', $request->movie_id);
        }

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        if ($request->filled('date')) {
            $query->where('show_date', $request->date);
        }

        $showtimes = $query->latest()->paginate(10)->withQueryString();

        $movies = Movie::where('status', 'active')->get();
        $rooms = Room::all();

        return view('admin.showtimes.index', compact('showtimes', 'movies', 'rooms'));
    }

    public function create()
    {
        $movies = Movie::where('status', 'active')->get();
        $rooms = Room::all();
        return view('admin.showtimes.create', compact('movies', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'show_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);

        $movie = Movie::find($request->movie_id);
        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = $startTime->copy()->addMinutes($movie->duration);
        // Kiểm tra trùng lịch chiếu trong cùng phòng
        $exists = Showtime::where('room_id', $request->room_id)
            ->where('show_date', $request->show_date)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                    ->orWhereBetween('end_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                    ->orWhere(function ($q2) use ($startTime, $endTime) {
                        $q2->where('start_time', '<=', $startTime->format('H:i'))
                            ->where('end_time', '>=', $endTime->format('H:i'));
                    });
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['start_time' => 'Khung giờ này đã có lịch chiếu trong phòng này.'])->withInput();
        }
        Showtime::create([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'show_date' => $request->show_date,
            'start_time' => $startTime->format('H:i'),
            'end_time' => $endTime->format('H:i'),
        ]);

        return redirect()->route('admin.showtimes.index')->with('success', 'Tạo lịch chiếu thành công.');
    }

    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);
        $movies = Movie::where('status', 'active')->get();
        $rooms = Room::all();
        return view('admin.showtimes.edit', compact('showtime', 'movies', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'show_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);

        $showtime = Showtime::findOrFail($id);
        $movie = Movie::find($request->movie_id);
        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = $startTime->copy()->addMinutes($movie->duration);
        // Kiểm tra trùng lịch chiếu trong cùng phòng
        $exists = Showtime::where('room_id', $request->room_id)
            ->where('show_date', $request->show_date)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                    ->orWhereBetween('end_time', [$startTime->format('H:i'), $endTime->format('H:i')])
                    ->orWhere(function ($q2) use ($startTime, $endTime) {
                        $q2->where('start_time', '<=', $startTime->format('H:i'))
                            ->where('end_time', '>=', $endTime->format('H:i'));
                    });
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['start_time' => 'Khung giờ này đã có lịch chiếu trong phòng này.'])->withInput();
        }
        $showtime->update([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'show_date' => $request->show_date,
            'start_time' => $startTime->format('H:i'),
            'end_time' => $endTime->format('H:i'),
        ]);

        return redirect()->route('admin.showtimes.index')->with('success', 'Cập nhật lịch chiếu thành công.');
    }

    public function destroy($id)
    {
        Showtime::destroy($id);
        return back()->with('success', 'Đã xoá lịch chiếu.');
    }
}
