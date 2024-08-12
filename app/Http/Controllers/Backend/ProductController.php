<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sanpham;
use App\Models\Thuonghieu;
use App\Models\Danhmuc;
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

class ProductController extends Controller
{
    public function index(Request $request){
        $query = Sanpham::query();
        
        $filters = [
            'name' => 'name',
            'size' => 'size',
            'soluong' => 'soluong',
            'loai_day' => 'loai_day',
            'loai_mat' => 'loai_mat',
            'loai_kinh' => 'loai_kinh',
            'mau_day' => 'mau_day',
            'mau_mat' => 'mau_mat',
            'nangluong' => 'nangluong',
        ];

        // Áp dụng các điều kiện lọc
        foreach ($filters as $field => $filter) {
            if ($value = $request->input("filter_$filter")) {
                $query->where($field, 'like', "%$value%");
            }
        }
        if ($request->filled('filter_id')) {
            $query->where('id', $request->filter_id);
        }
        if ($request->filled('filter_trangthai')) {
            $query->where('trangthai', $request->filter_trangthai);
        }
        if ($request->has('filter_km_tungay') && $request->filter_km_tungay != '') {
            $query->whereDate('km_tungay', '>=', $request->filter_km_tungay);
        }
        if ($request->has('filter_km_denngay') && $request->filter_km_denngay != '') {
            $query->whereDate('km_denngay', '<=', $request->filter_km_denngay);
        }
        if ($request->filled('filter_price_range')) {
            switch ($request->filter_price_range) {
                case 'under_1m':
                    $query->where(function($q) {
                        $q->where('gia', '<', 1000000)
                          ->orWhere('giaKM', '<', 1000000);
                    });
                    break;
                case '1m_5m':
                    $query->where(function($q) {
                        $q->whereBetween('gia', [1000000, 5000000])
                          ->orWhereBetween('giaKM', [1000000, 5000000]);
                    });
                    break;
                case '5m_10m':
                    $query->where(function($q) {
                        $q->whereBetween('gia', [5000000, 10000000])
                          ->orWhereBetween('giaKM', [5000000, 10000000]);
                    });
                    break;
                case 'above_10m':
                    $query->where(function($q) {
                        $q->where('gia', '>', 10000000)
                          ->orWhere('giaKM', '>', 10000000);
                    });
                    break;
            }
        }
        $products = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->except('page'));
        $userlog =Auth::user();
        return view("backend.product",compact("products","userlog"));
    }
   
    
    public function createProductIndex(){
        $brands=Thuonghieu::all();
        $caterogys=Danhmuc::all();
        $userlog = Auth::user();
        return view("backend.createProduct",compact("brands","caterogys","userlog"));
    }
    public function createProduct(Request $request){
        $messages = [
            'img.image' => 'Tệp phải là hình ảnh.',
            'img.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'img.max' => 'Ảnh không được lớn hơn 2MB.',
            'gia.min' => 'Giá không được nhỏ hơn 0.',
            'giaKM.min' => 'Giá khuyến mãi không được nhỏ hơn 0.',
            'size.min' => 'Kích thước phải là số dương lớn hơn 0.',
            'soluong.min' => 'Số lượng nhập phải lớn hơn 0.'
        ];
    
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gia' => 'required|numeric|min:0',
            'giaKM' => 'nullable|numeric|min:0',
            'size' => 'required|numeric|min:0',
            'soluong' => 'required|integer|min:0',
        ], $messages);

        $products= new Sanpham();
        $products->danhmuc_id=$request->input('danhmuc_id');
        $products->thuonghieu_id=$request->input('thuonghieu_id');
        $products->name=$request->input('name');
        $products->soluong=$request->input('soluong');
        $products->size= $request->input('size');
        $products->gia= $request->input('gia');
        $products->giaKM= $request->input('giaKM');
        $products->km_tungay= $request->input('km_tungay');
        $products->km_denngay= $request->input('km_denngay');
        $products->loai_mat= $request->input('loai_mat');
        $products->loai_day= $request->input('loai_day');
        $products->loai_kinh= $request->input('loai_kinh');
        $products->mau_day= $request->input('mau_day');
        $products->mau_mat= $request->input('mau_mat');
        $products->mau_vo= $request->input('mau_vo');
        $products->nangluong= $request->input('nangluong');
        $products->mota= $request->input('mota');
        
        $products->img = $request->input('img');
        
        if($request->file('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('backend/img/product/', $filename);
            $products->img = $filename;
        }
        $products->save();
        
        return redirect()->route('product.index')->with("success","Thêm sản phẩm thành công !");
    }
    public function editProductIndex($id){
        $products=Sanpham::find($id);
        $brands=Thuonghieu::all();
        $caterogys=Danhmuc::all();
        $userlog = Auth::user();
        return view("backend.editProduct",compact('products','userlog','brands','caterogys'));
    }
    public function editProduct(Request $request, $id){
        $messages = [
            'img.image' => 'Tệp phải là hình ảnh.',
            'img.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'img.max' => 'Ảnh không được lớn hơn 2MB.',
            'gia.min' => 'Giá không được nhỏ hơn 0.',
            'giaKM.min' => 'Giá khuyến mãi không được nhỏ hơn 0.',
            'size.min' => 'Kích thước phải là số dương lớn hơn 0.',
            'soluong.min' => 'Số lượng nhập phải lớn hơn 0.'
        ];
    
        $request->validate([
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gia' => 'required|numeric|min:0',
            'giaKM' => 'nullable|numeric|min:0',
            'size' => 'required|numeric|min:0',
            'soluong' => 'required|integer|min:0',
        ], $messages);

        $products= Sanpham::findOrFail($id);
        $products->danhmuc_id=$request->input('danhmuc_id');
        $products->thuonghieu_id=$request->input('thuonghieu_id');
        $products->name=$request->input('name');
        $products->soluong=$request->input('soluong');
        $products->size= $request->input('size');
        $products->gia= $request->input('gia');
        $products->giaKM= $request->input('giaKM');
        $products->km_tungay= $request->input('km_tungay');
        $products->km_denngay= $request->input('km_denngay');
        $products->loai_mat= $request->input('loai_mat');
        $products->loai_day= $request->input('loai_day');
        $products->loai_kinh= $request->input('loai_kinh');
        $products->mau_day= $request->input('mau_day');
        $products->mau_mat= $request->input('mau_mat');
        $products->mau_vo= $request->input('mau_vo');
        $products->nangluong= $request->input('nangluong');
        $products->trangthai= $request->input('trangthai');
        $products->mota= $request->input('mota');
        
        
        if($request->file('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('backend/img/product/', $filename);
            $products->img = $filename;
        }
        $products->save();
        return redirect()->route('product.index')->with("success","Sửa thông tin sản phẩm thành công !");
    }
    public function deleteProduct(Request $request, $id){
        $products = Sanpham::find($id);
        if(!$products) {
            return redirect()->back()->with('error', 'sản phẩm không tồn tại.');
        }
        if ($products->sp_chitiet()->exists()) {
            return redirect()->back()->with('error', 'Không thể xóa sản phẩm này vì có ràng buộc với chi tiết đơn hàng.');
        }
        $products->delete();
        return redirect()->route('product.index')->with('success','Xóa sản phẩm thành công');
    }
    
}
