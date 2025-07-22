<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeatType;
use Illuminate\Http\Request;

class SeatTypeController extends Controller
{
    public function index()
    {
        $seatTypes = SeatType::withTrashed()->get();
        return view('admin.seat_types.index', compact('seatTypes'));
    }

    public function create()
    {
        return view('admin.seat_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);

        SeatType::create($request->only('name', 'price'));

        return redirect()->route('admin.seat-types.index')->with('success', 'Đã thêm loại ghế.');
    }

    public function edit($id)
    {
        $seatType = SeatType::withTrashed()->findOrFail($id);
        return view('admin.seat_types.edit', compact('seatType'));
    }

    public function update(Request $request, $id)
    {
        $seatType = SeatType::withTrashed()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);

        $seatType->update($request->only('name', 'price'));

        return redirect()->route('admin.seat-types.index')->with('success', 'Đã cập nhật loại ghế.');
    }

    public function destroy($id)
    {
        $seatType = SeatType::withCount('seats')->findOrFail($id);

        if ($seatType->seats_count > 0) {
            return redirect()->back()->with('error', 'Không thể xóa mềm vì loại ghế đã được sử dụng.');
        }

        $seatType->delete();

        return redirect()->route('admin.seat-types.index')->with('success', 'Đã xoá mềm loại ghế.');
    }

    public function restore($id)
    {
        $seatType = SeatType::withTrashed()->findOrFail($id);

        if (!$seatType->trashed()) {
            return redirect()->back()->with('error', 'Loại ghế này chưa bị xoá.');
        }

        $seatType->restore();

        return redirect()->route('admin.seat-types.index')->with('success', 'Đã khôi phục loại ghế.');
    }

    public function forceDelete($id)
    {
        $seatType = SeatType::withTrashed()->withCount('seats')->findOrFail($id);

        if ($seatType->seats_count > 0) {
            return redirect()->back()->with('error', 'Không thể xoá vĩnh viễn vì loại ghế đã được sử dụng.');
        }

        $seatType->forceDelete();

        return redirect()->route('admin.seat-types.index')->with('success', 'Đã xoá vĩnh viễn loại ghế.');
    }
}
