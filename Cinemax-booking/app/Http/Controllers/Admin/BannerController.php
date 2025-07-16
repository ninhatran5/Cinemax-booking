<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }
    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:5500',
            'position' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            // Xoá ảnh cũ nếu có
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            // Lưu ảnh mới
            $data['image'] = $request->file('image')->store('uploads/banner', 'public');
        }


        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật banner thành công');
    }
}
