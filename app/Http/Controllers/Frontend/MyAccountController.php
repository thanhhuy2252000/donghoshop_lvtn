<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Sanpham;
use App\Models\Danhmuc;
use App\Models\Hinhsanpham;
use App\Models\Thuonghieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    public function myAccount()
    {   
        $brands = Thuonghieu::all();
        $userlog = Auth::user();
        return view("frontend.account", compact("brands","userlog"));
    }
    public function updateAccountInfo(Request $request)
    {
        $messages = [
            'name.required' => 'Tên là bắt buộc !',
            'name.max' => 'Tên tối đa 255 ký tự !',
            'sdt.digits_between' => 'Số điện thoại có độ dài 10 đến 12 chữ số !',
            'sdt.numeric' => 'Số điện thoại là chữ số !',
            'avt.image' => 'Tệp phải là hình ảnh.',
            'avt.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'avt.max' => 'Ảnh không được lớn hơn 2MB.',
        ];
        $request->validate([
            'name' => 'required|max:255',
            'sdt' => 'nullable|digits_between:10,12|numeric',
            'diachi' => 'nullable|max:255',
            'avt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],$messages);

        $userId = Auth::id();
        $user = User::find($userId);

        if ($user) {
            $existingUser = User::where('sdt', $request->input('sdt'))->where('id', '!=', $userId)->first();
            if ($existingUser) {
                return redirect()->back()->with('error', 'Số điện thoại này đã được sử dụng.');
            }
            $user->name = $request->input('name');
            $user->gioitinh = $request->input('gioitinh') == 'Nam' ? 0 : 1;
            $user->diachi = $request->input('diachi');
            $user->sdt = $request->input('sdt');
            
            if ($request->filled('old_password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return back()->with('error', 'Mật khẩu cũ không chính xác.');
                }
            if ($request->input('password')) {
                $request->validate([
                    'password' => 'required|min:3',
                    'confirm_password' => 'required|same:password',
                ]);
                $user->password = Hash::make($request->input('password'));
            }
        }
            if ($request->file('avt')) {
                $file = $request->file('avt');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('backend/img/avatar/', $filename);
                $user->avt = $filename;
            }
            $user->save();
            return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công.');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
        }
    }
    
}
