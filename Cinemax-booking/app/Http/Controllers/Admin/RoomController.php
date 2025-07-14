<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Tạo phòng chiếu thành công');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(Room $room)
    {
        $room->delete(); // xóa mềm
        return redirect()->route('admin.rooms.index')->with('success', 'Đã xóa phòng chiếu');
    }
}
