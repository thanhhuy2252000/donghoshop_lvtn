<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sanpham;
use App\Models\Thuonghieu;
use App\Models\Danhmuc;
use App\Models\Hinhsanpham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Redirect;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\RedirectResponse;

class ImgController extends Controller
{
    public function index(Request $request){
        $query = Hinhsanpham::query();

        if ($request->filled('filter_id')) {
            $query->where('id', $request->filter_id);
        }
        if ($request->has('filter_loaihinh') && $request->filter_loaihinh != '') {
            $query->where('loaihinh', $request->filter_loaihinh);
        }
        if ($request->filled('filter_sanpham_id')) {
            $query->where('sanpham_id', $request->filter_sanpham_id);
        }
        
        $imgs =  $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->except('page'));

        $userlog =Auth::user();
        return view("backend.imgs",compact("userlog","imgs"));
    }
    public function uploadIndex(){
        $imgs = Hinhsanpham::all();
        $userlog =Auth::user();
        return view("backend.upload-img",compact("userlog","imgs"));
    }
    public function uploadImg(Request $request){
        $messages = [
            'imgs.image' => 'Tệp phải là hình ảnh.',
            'imgs.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'imgs.max' => 'Ảnh không được lớn hơn 2MB.',
            'sanpham_id.exists' => 'ID sản phẩm không hợp lệ hoặc không tồn tại.',
        ];
    
        $request->validate([
            'sanpham_id' => 'required|exists:sanphams,id',
            'loaihinh' => 'required|integer', 
            'imgs' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], $messages);

        $img= new Hinhsanpham();
        
        $img->loaihinh= $request->input('loaihinh');
        $img->imgs = $request->input('imgs');
        $img->sanpham_id = $request->input('sanpham_id');
        
        if($request->file('imgs')) {
            $file = $request->file('imgs');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('backend/img/product/', $filename);
            $img->imgs = $filename;
        }
        $img->save();
        
        return redirect()->route('imgs.index')->with("success","Thêm hình ảnh thành công !");
    }
    public function editIndex($id){
        $imgs = Hinhsanpham::find($id);
        $userlog =Auth::user();
        return view("backend.edit-img",compact("userlog","imgs"));
    }
    public function editImg(Request $request, $id){

        $messages = [
            'imgs.image' => 'Tệp phải là hình ảnh.',
            'imgs.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'imgs.max' => 'Ảnh không được lớn hơn 2MB.',
        ];
    
        $request->validate([
            'imgs' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], $messages);

        $img= Hinhsanpham::findOrFail($id);
        
        $img->loaihinh= $request->input('loaihinh');
        $img->sanpham_id = $request->input('sanpham_id');
        
        if($request->file('imgs')) {
            $file = $request->file('imgs');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('backend/img/product/', $filename);
            $img->imgs = $filename;
        }
        $img->save();
        
        return redirect()->route('imgs.index')->with("success","Sửa hình ảnh thành công !");
    }
    public function deleteImg(Request $request, $id){
        $img= Hinhsanpham::find($id);
        if(!$img) {
            return redirect()->back()->with('error', 'Hình ảnh không tồn tại.');
        }
        
        $img->delete();
        return redirect()->route('imgs.index')->with('success','Xóa hình ảnh thành công !');
    }
}
