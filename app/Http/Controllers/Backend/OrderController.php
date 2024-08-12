<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Donhang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Redirect;
class OrderController extends Controller
{
    public function index(Request $request){
        $query = Donhang::query();

        if ($request->has('filter_tongDH')) {
            $filterTongDH = $request->filter_tongDH;
    
            if ($filterTongDH == '0-1000000') {
                $query->where('tongDH', '<', 1000000);
            } elseif ($filterTongDH == '1000000-5000000') {
                $query->whereBetween('tongDH', [1000000, 4999999]);
            } elseif ($filterTongDH == '5000000-10000000') {
                $query->whereBetween('tongDH', [5000000, 9999999]);
            } elseif ($filterTongDH == '10000000-') {
                $query->where('tongDH', '>', 10000000);
            }
        }
        if ($request->filled('filter_id')) {
            $query->where('id', $request->filter_id);
        }
        if ($request->filled('filter_user_id')) {
            $query->where('user_id', $request->filter_user_id);
        }
        
        if ($request->has('filter_created_at') && $request->filter_created_at != '') {
            $query->whereDate('created_at', '>=', $request->filter_created_at);
        }
        if ($request->has('filter_updated_at') && $request->filter_updated_at != '') {
            $query->whereDate('updated_at', '>=', $request->filter_updated_at);
        }
        $filters = [
            'name' => 'name',
            'pt_thanhtoan' => 'pt_thanhtoan',
            'trangthai' => 'trangthai',
        ];
        
        foreach ($filters as $field => $filter) {
            if ($value = $request->input("filter_$filter")) {
                $query->where($field, 'like', "%$value%");
            }
        }

        $orders=$query->orderBy('created_at', 'desc')->paginate(5)->appends($request->except('page'));
        $userlog =Auth::user();
        return view("backend.order",compact("orders","userlog"));
    }
    
    public function editOrder(Request $request, $id){
        $orders = Donhang::findOrFail($id);
        $orders->trangthai = $request->input('trangthai');
        $orders->save();
        return redirect()->route('order.index')->with("success","Cập nhật đơn hàng thành công !");
    }
    public function deleteOrder($id){
        $orders = Donhang::find($id);
        if(!$orders) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }
        foreach ($orders->dh_chitiet as $chitietdh) {
            $chitietdh->ct_rating()->delete(); // Xóa các rating của chi tiết đơn hàng
        }
        $orders->dh_chitiet()->delete();
        $orders->delete();
        return redirect()->route('order.index')->with('success','Xóa đơn hàng thành công');
    }
}
