<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatType;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index(Request $request)
    {
        $query = Seat::with(['room', 'type']);

        if ($request->filled('seat_type_id')) {
            $query->where('seat_type_id', $request->seat_type_id);
        }

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        $seats = $query->orderBy('created_at', 'desc')
            ->paginate(20)
            ->appends($request->query());

        $rooms = Room::all();
        $seatTypes = SeatType::all();

        return view('admin.seats.index', compact('seats', 'rooms', 'seatTypes'));
    }

    public function create()
    {
        $rooms = Room::all();
        $seatTypes = SeatType::all();
        return view('admin.seats.create', compact('rooms', 'seatTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'rows' => 'required|string',
            'seats_per_row' => 'required|integer|min:1',
            'seat_type_id' => 'required|exists:seat_types,id',
        ]);

        $room = Room::findOrFail($request->room_id);
        $seatType = SeatType::findOrFail($request->seat_type_id);
        $seatsPerRow = intval($request->seats_per_row);
        $rowLetters = array_map('trim', explode(',', strtoupper($request->rows)));
        $totalToCreate = count($rowLetters) * $seatsPerRow;
        $currentCount = $room->seats()->count();

        if (($currentCount + $totalToCreate) > $room->capacity) {
            return redirect()->back()->withInput()->with(
                'error',
                'Phòng "' . $room->name . '" chỉ chứa tối đa ' . $room->capacity .
                    ' ghế. Hiện đã có ' . $currentCount . ' ghế. Bạn đang cố thêm ' . $totalToCreate . ' ghế!'
            );
        }

        foreach ($rowLetters as $rowLetter) {
            $positionY = ord($rowLetter) - 64;
            for ($i = 1; $i <= $seatsPerRow; $i++) {
                Seat::create([
                    'room_id' => $room->id,
                    'seat_type_id' => $seatType->id,
                    'row' => $rowLetter,
                    'position_x' => $i,
                    'position_y' => $positionY,
                    'name' => $rowLetter . $i,
                ]);
            }
        }

        return redirect()->route('admin.seats.index')->with('success', 'Đã tạo ghế hàng loạt thành công!');
    }

    public function edit(Seat $seat)
    {
        $rooms = Room::all();
        $seatTypes = SeatType::all();
        return view('admin.seats.edit', compact('seat', 'rooms', 'seatTypes'));
    }

    public function update(Request $request, Seat $seat)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:10',
            'seat_type_id' => 'required|exists:seat_types,id',
        ]);

        $seatType = SeatType::findOrFail($request->seat_type_id);

        $name = $request->input('name');
        $rowLetter = substr($name, 0, 1);
        $seatNumber = intval(substr($name, 1));
        $positionY = ord($rowLetter) - 64;

        $seat->update([
            'room_id' => $request->input('room_id'),
            'seat_type_id' => $seatType->id,
            'row' => $rowLetter,
            'position_x' => $seatNumber,
            'position_y' => $positionY,
            'name' => $name,
            
        ]);

        return redirect()->route('admin.seats.index')->with('success', 'Cập nhật ghế thành công!');
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('admin.seats.index')->with('success', 'Đã xóa ghế!');
    }

    public function deleteRow(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'row' => 'required|string|max:2'
        ]);

        $deleted = Seat::where('room_id', $request->room_id)
            ->where('row', strtoupper($request->row))
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.seats.index')->with('success', 'Đã xóa hàng ghế thành công!');
        }

        return redirect()->route('admin.seats.index')->with('error', 'Không tìm thấy ghế để xóa!');
    }
}
