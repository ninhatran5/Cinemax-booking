<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        // Tìm kiếm theo tiêu đề
        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status') && in_array($request->status, ['active', 'inactive'])) {
            $query->where('status', $request->status);
        }

        $movies = $query->latest()->paginate(10)->withQueryString(); // giữ query khi phân trang

        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'duration', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/movies', 'public');
        }

        Movie::create($data);

        return redirect()->route('admin.movies.index')->with('success', 'Thêm phim thành công.');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'duration', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/movies', 'public');
        }

        $movie->update($data);

        return redirect()->route('admin.movies.index')->with('success', 'Cập nhật phim thành công.');
    }

    // Xoá mềm
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->back()->with('success', 'Đã xoá phim (mềm).');
    }

    // Khôi phục
    public function restore($id)
    {
        $movie = Movie::onlyTrashed()->findOrFail($id);
        $movie->restore();
        return redirect()->back()->with('success', 'Đã khôi phục phim.');
    }

    // Xoá vĩnh viễn
    public function forceDelete($id)
    {
        $movie = Movie::onlyTrashed()->findOrFail($id);
        $movie->forceDelete();
        return redirect()->back()->with('success', 'Đã xoá phim vĩnh viễn.');
    }
    // danh sách xóa mềm 
    public function trash()
    {
        $movies = Movie::onlyTrashed()->latest()->paginate(10);
        return view('admin.movies.trash', compact('movies'));
    }
}
