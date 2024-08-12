<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
class UserController extends Controller
{
    public function index(Request $request){
        $query = User::query();

        if ($request->filled('filter_id')) {
            $query->where('id', $request->filter_id);
        }
        if ($request->has('filter_name') && $request->filter_name != '') {
            $query->where('name', 'like', '%' . $request->filter_name . '%');
        }
        if ($request->has('filter_email') && $request->filter_email != '') {
            $query->where('email', 'like', '%' . $request->filter_email . '%');
        }
        if ($request->has('filter_status') && $request->filter_status != '') {
            $query->where('trangthai', $request->filter_status);
        }
        if ($request->filled('filter_gioitinh')) {
            $query->where('gioitinh', $request->filter_gioitinh);
        }
        if ($request->filled('filter_loai')) {
            $query->where('loai', $request->filter_loai);
        }
        if ($request->has('filter_date_from') && $request->filter_date_from != '') {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->has('filter_date_to') && $request->filter_date_to != '') {
            $query->whereDate('updated_at', '>=', $request->filter_date_to);
        }
        $users=$query->orderBy('created_at', 'desc')->paginate(5)->appends(request()->query());
        $user = User::find(Auth::user()->id);
        $userlog = Auth::user();
        return view("backend.user",compact("users","user","userlog"));
    }
    
    public function editUser(Request $request, $id){
        $users = User::findOrFail($id);
        $users->trangthai = $request->input('trangthai');
        $users->save();
        return redirect()->route('user.index')->with("success","Cập nhật user thành công !");
    }
    public function deleteUser($id){
        $users = User::find($id);
        if(!$users) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }
        if($users->us_donhangs()->exists()){
            return redirect()->back()->with('error', 'Không thể xóa vì ràng buộc với bảng đơn hàng.');
        }
        if (Auth::guard('web')->check() && Auth::guard('web')->id() == $users->id) {
            return redirect()->back()->with('error', 'Không thể xóa user đang sử dụng.');
        }
        if (Auth::guard('admin')->check() && Auth::guard('admin')->id() == $users->id) {
            return redirect()->back()->with('error', 'Không thể xóa user đang sử dụng.');
        }
        $users->delete();
        return redirect()->route('user.index')->with('success','Xóa user thành công');
    }
    
}
