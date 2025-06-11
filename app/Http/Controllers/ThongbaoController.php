<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thongbao; // Import the Thongbao model
use Illuminate\Support\Facades\Auth; // Import Auth facade for authentication
use Illuminate\Support\Facades\Storage; // Import Storage facade for file storage
class ThongbaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $thongbao = Thongbao::first();
        return view('admin.thongbao.index',compact('thongbao'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.thongbao.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $data = $request->validate([
        'country' => 'required|in:trangchu,uudai',
        'description' => 'required|string',
    ]);

    $thongbao = new Thongbao();

    // Gán vào đúng cột được chọn
    if ($data['country'] === 'trangchu') {
        $thongbao->trangchu = $data['description'];
        $thongbao->uudai = ''; // Gán mặc định để tránh lỗi
    } elseif ($data['country'] === 'uudai') {
        $thongbao->uudai = $data['description'];
        $thongbao->trangchu = ''; // Gán mặc định để tránh lỗi
    }

    $thongbao->save();

    return redirect()->route('thongbao.index')->with('success', 'Thông báo đã được tạo thành công.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $thongbao = Thongbao::find($id);
        return view('admin.thongbao.edit',compact('thongbao'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $thongbao = Thongbao::findOrFail($id);

    if ($request->has('trangchu')) {
        $request->validate(['trangchu' => 'required|string']);
        $thongbao->trangchu = $request->trangchu;
    }

    if ($request->has('uudai')) {
        $request->validate(['uudai' => 'required|string']);
        $thongbao->uudai = $request->uudai;
    }

    $thongbao->save();

    return redirect()->route('thongbao.index')->with('success', 'Thông báo đã được cập nhật.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $thongbao = Thongbao::findOrFail($id);
        $thongbao->delete();

        return redirect()->route('thongbao.index')->with('success', 'Thông báo đã được xóa thành công.');
    }




    public function editByCountry($country)
{
    // Kiểm tra giá trị hợp lệ
    if (!in_array($country, ['trangchu', 'uudai'])) {
        abort(404, 'Loại thông báo không hợp lệ.');
    }

    $thongbao = Thongbao::first(); // giả định chỉ có 1 bản ghi

  return view('admin.thongbao.edit', compact('thongbao', 'country'));

}
}
