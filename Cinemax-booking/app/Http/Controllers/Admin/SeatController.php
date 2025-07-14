<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index(Request $request)
    {
        $query = Seat::with('room');

        if ($request->filled('seat_type')) {
            $query->where('seat_type', $request->seat_type);
        }

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        // ⚠️ Sắp xếp theo thời gian tạo mới nhất lên đầu
        $seats = $query->orderBy('created_at', 'desc')
            ->paginate(20)
            ->appends($request->query());

        $rooms = Room::all();

        return view('admin.seats.index', compact('seats', 'rooms'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('admin.seats.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'rows' => 'required|string', // VD: A,B,C
            'seats_per_row' => 'required|integer|min:1',
            'seat_type' => 'required|in:normal,vip,double',
        ]);

        $room = Room::findOrFail($request->room_id);
        $seatType = $request->seat_type;
        $seatsPerRow = intval($request->seats_per_row);

        // Chuẩn hóa hàng ghế (VD: A,B,C => ['A','B','C'])
        $rowLetters = array_map('trim', explode(',', strtoupper($request->rows)));
        $totalToCreate = count($rowLetters) * $seatsPerRow;

        // Đếm số ghế hiện tại của phòng
        $currentCount = $room->seats()->count();

        if (($currentCount + $totalToCreate) > $room->capacity) {
            return redirect()->back()->withInput()->with(
                'error',
                'Phòng "' . $room->name . '" chỉ chứa tối đa ' . $room->capacity .
                    ' ghế. Hiện đã có ' . $currentCount . ' ghế. Bạn đang cố thêm ' . $totalToCreate . ' ghế!'
            );
        }

        foreach ($rowLetters as $rowLetter) {
            for ($i = 1; $i <= $seatsPerRow; $i++) {
                Seat::create([
                    'room_id' => $room->id,
                    'name' => $rowLetter . $i,
                    'seat_type' => $seatType,
                    'row' => $rowLetter,
                ]);
            }
        }

        return redirect()->route('admin.seats.index')->with('success', 'Đã tạo ghế hàng loạt thành công!');
    }

    public function edit(Seat $seat)
    {
        $rooms = Room::all();
        return view('admin.seats.edit', compact('seat', 'rooms'));
    }

    public function update(Request $request, Seat $seat)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:10',
            'seat_type' => 'required|in:normal,vip,double',
            'row' => 'nullable|string|max:2',
        ]);

        $seat->update([
            'room_id' => $request->input('room_id'),
            'name' => $request->input('name'),
            'seat_type' => $request->input('seat_type'),
            'row' => $request->input('row') ?? substr($request->input('name'), 0, 1),
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
