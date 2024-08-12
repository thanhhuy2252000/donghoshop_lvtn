<?php

namespace App\Http\Controllers\Backend;

use App\Models\Thuonghieu;
use App\Models\Sanpham;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Redirect;

class BrandController extends Controller
{
    public function index(Request $request){
        $query = Thuonghieu::query();

        if ($request->filled('filter_id')) {
            $query->where('id', $request->filter_id);
        }
        if ($request->filled('filter_name')) {
            $query->where('tenTH', 'like', '%' . $request->filter_name . '%');
        }

        $brands = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->except('page'));
        $userlog =Auth::user();
        return view("backend.brand",compact("brands","userlog"));
    }
   
    public function createBrandIndex(Request $request){
        $userlog =Auth::user();
        return view("backend.createbrand",compact("userlog"));
    }
    public function createBrand(Request $request){
        $brands= new Thuonghieu();
        $existingTH = Thuonghieu::where('tenTH', $request->input('tenTH'))->first();
        if ($existingTH) {
            return redirect()->back()->with("error", 'Thương hiệu đã tồn tại. Vui lòng nhập thương hiệu khác.');
        }
        $brands->tenTH=$request->input('tenTH');
        
        $brands->save();
        return redirect()->route('brand.index')->with("success","Thêm thương hiệu thành công !");
    }
    public function editBrandIndex($id){
        $brands=Thuonghieu::find($id);
        $userlog =Auth::user();
        return view("backend.editBrand",compact('brands',"userlog"));
    }
    public function editBrand(Request $request, $id){
        $brands= Thuonghieu::findOrFail($id);
        $existingTH = Thuonghieu::where('tenTH', $request->input('tenTH'))
        ->where('id', '!=', $id)
        ->first();
        if ($existingTH) {
        return redirect()->back()->with("error",  'Thương hiệu đã tồn tại. Vui lòng nhập thương hiệu khác.');
        }
        $brands->tenTH=$request->input('tenTH');
        
        $brands->save();
        return redirect()->route('brand.index')->with("success","Sửa thông tin thương hiệu thành công !");
    }
    public function deleteBrand(Request $request, $id){
        $brands = Thuonghieu::find($id);
        if(!$brands) {
            return redirect()->back()->with('error', 'thương hiệu không tồn tại.');
        }
        $isUsed = Sanpham::where('thuonghieu_id', $id)->exists();
        if ($isUsed) {
            return redirect()->back()->with('error', 'Thương hiệu này đang được sử dụng hoặc có ràng buộc không thể xóa.');
        }
        $brands->delete();
        return redirect()->route('brand.index')->with('success','Xóa thương hiệu thành công');
    }
}
