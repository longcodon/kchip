<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ma;
class MaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $ma=Ma::all();
        return view('admin.ma.index',compact('ma'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('admin.ma.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
$data = $request->validate([
    'ma' => 'required',
    'maprice' => 'required|integer|min:0|max:100',
]);

$ma = new Ma();
$ma->ma = $data['ma'];
$ma->maprice = $data['maprice'];
$ma->save();


    return redirect()->route('ma.index')->with('success', 'Mã giảm giá đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ma = Ma::find($id);
        return view('admin.ma.edit',compact('ma'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $data = $request->validate([
        'ma' => 'required|string',
        'maprice' => 'required|integer|min:0|max:100',
    ]);

    $ma = Ma::findOrFail($id);
    $ma->ma = $data['ma'];
    $ma->maprice = $data['maprice'];
    $ma->save();

    return redirect()->route('ma.index')->with('success', 'Mã giảm giá đã được cập nhật.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $ma = Ma::findOrFail($id);
        $ma->delete();

        return redirect()->route('ma.index')->with('success', 'Mã giảm giá đã được xóa thành công.');
    }
}
