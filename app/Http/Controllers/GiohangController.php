<?php

namespace App\Http\Controllers;
use App\Models\Giohang;
use Illuminate\Http\Request;

class GiohangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
         
            'description'=>'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'country'=>'required',
            'author' => 'required',
            'transcribed' => 'required',
            'price' => 'required',
            'link' => 'required',


        ],[
            'title.required'=>'Tiêu đề không được bỏ trống',
            'description.required'=>'Mô tả không được bỏ trống',
            'image.required'=>'vui lòng tải ảnh lên',
            'title.unique' => 'Tiêu đề đã có vui lòng nhập không trùng',
             'status.required'=>'check status',
            //   'country.required'=>'required',
            

        ]);


        $giohang=new Giohang();
        $giohang->title=$data['title'];
        $giohang->description=$data['description'];
        $giohang->status=$data['status'];
        $giohang->slug = Str::slug($data['title']);
        $giohang->country=$data['country'];
        $giohang->author=$data['author'];
        $giohang->transcribed=$data['transcribed'];
        $giohang->price=$data['price'];
        $giohang->link=$data['link'];


        $get_image = $request->image;
        $path = 'uploads/danhmuc/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image));
        $new_image =  $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $danhmuc->image = $new_image;

        $danhmuc->save();
        // toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('danhmuc.index');
       
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
