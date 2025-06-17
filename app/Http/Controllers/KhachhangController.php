<?php

namespace App\Http\Controllers;

use App\Models\Khachhang;
use Illuminate\Http\Request;

class KhachhangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $orders = \App\Models\Khachhang::all()
        ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d H:i:s'); // dùng timestamp để gom nhóm
        });

    return view('admin.khachhang.index', compact('orders'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'fb' => 'required',
            'note' => 'required',
            


        ],[
            
           
            

        ]);


        $khachhang=new Khachhang();
       
        $khachhang->name=$data['name'];
        $khachhang->email=$data['email'];
        $khachhang->fb=$data['fb'];
        $khachhang->note=$data['note'];

     

        $khachhang->save();
        // toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('pay');
       
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
        $khachhang = Khachhang::find($id);
        return view('admin.khachhang.edit',compact('khachhang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $data=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'fb' => 'required',
            'note' => 'required',
            


        ],[
            
           
            

        ]);


             $khachhang = Khachhang::find($id);
        $khachhang->name=$data['name'];
        $khachhang->email=$data['email'];
        $khachhang->fb=$data['fb'];
        $khachhang->note=$data['note'];

     

        $khachhang->save();
        // toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('khachhang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
               $khachhang = Khachhang::find($id);
        $khachhang->delete();
          return redirect()->route('khachhang.index');
    }



public function updateTrangthai(Request $request, $id)
{
    $kh = Khachhang::findOrFail($id);
    $kh->trangthai = $request->input('trangthai');
    $kh->save();

    return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
}


}
