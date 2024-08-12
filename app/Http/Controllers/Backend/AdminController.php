<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donhang;
use App\Models\Chitiet_donhang;
use App\Models\Sanpham;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $userlog = Auth::user();
        //đếm thời gian
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        // thống kê người dùng mới
        $newUsers = User::whereMonth('created_at', $currentMonth)->paginate(5);
        $countNewUsers = User::whereMonth('created_at', $currentMonth)->count();
        //thống kê tấ cả đơn hàng
        $orderAll = Donhang::where('trangthai', '!=', 'đã hủy')->count();
        $orderOfMonth = Donhang::where('trangthai', '!=', 'đã hủy')
            ->whereMonth('created_at', $currentMonth)->count();
        //thống kê tấ cả đơn hàng đã hoàn tất
        $orderAllDone = Donhang::where('trangthai','Đã giao')->count();
        $orderOfMonthDone = Donhang::where('trangthai', 'Đã giao')
            ->whereMonth('created_at', $currentMonth)
            ->count();
        // số lượng sản phẩm bán ra
        $productsSold = Chitiet_donhang::whereHas('ct_donhang', function ($query) {
            $query->where('trangthai', '!=', 'đã hủy');
            })
            ->whereMonth('created_at', $currentMonth)
            ->sum('soluong');
        //tổng doanh thu trong tháng
        $totalOfMonth = number_format(Donhang::where('trangthai', '!=', 'đã hủy')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('tongDH'));
         
        //tổng doanh thu trong tháng đã hoàn tất 
        $totalOfMonthDone = number_format(Donhang::where('trangthai', 'đã giao')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('tongDH'));

        $totalAll = number_format(Donhang::where('trangthai', '!=', 'đã hủy')->sum('tongDH'));
        $totalAllDone = number_format(Donhang::where('trangthai', 'đã giao')->sum('tongDH'));

        // Lấy số lượng đã giao dịch hiện tại trong tháng
        $monthTransactions = Donhang::where('trangthai', 'đã giao')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Lấy số lượng đã giao dịch tháng trước
        $pre_monthTransactions = Donhang::where('trangthai', 'đã giao')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        // Tính phần trăm tăng trưởng (hoặc giảm)
        if ($pre_monthTransactions > 0) {
        $transactionGrowthPercentage = (($monthTransactions - $pre_monthTransactions) / $pre_monthTransactions) * 100;
        } else {
        $transactionGrowthPercentage = $monthTransactions > 0 ? 100 : 0;
        }


        // Truy vấn tổng số lượng đã bán ra của các sản phẩm
        $topSellingProductsData = Chitiet_donhang::whereHas('ct_donhang', function ($query) {
            $query->where('trangthai', 'đã giao');})
            ->select('sanpham_id', DB::raw('SUM(soluong) as total_sold'))
            ->groupBy('sanpham_id')
            ->orderBy('total_sold', 'desc')
            ->take(3)
            ->get();

        // Lấy thông tin sản phẩm từ IDs
        $productIds = $topSellingProductsData->pluck('sanpham_id');
        $productTops = Sanpham::whereIn('id', $productIds)->get();

        // Thêm số lượng bán vào thông tin sản phẩm
        $productTops->map(function($product) use ($topSellingProductsData) {
            $product->total_sold = $topSellingProductsData->where('sanpham_id', $product->id)->first()->total_sold;
            return $product;
        });
        // Đánh số thứ tự cho sản phẩm
        $productTops = $productTops->sortByDesc('total_sold')->values();

        return view("backend.index",compact('userlog','newUsers','countNewUsers',
             'orderOfMonth','orderAll', 'totalOfMonth','totalAll',
             'orderOfMonthDone','orderAllDone', 'totalOfMonthDone','totalAllDone',
             'currentMonth','currentYear','productsSold',
             'pre_monthTransactions','monthTransactions','productTops'));
    }
    public function login(){
        return view("backend.login");
    }
    public function checkLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['loai'] = 1;
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('error','Email hoặc mật khẩu không chính xác hoặc bạn không có quyền truy cập adminpage !');
        
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('adminLogin.index');
    }
    public function changePasswordindex(){
        $userlog = Auth::user();
        return view("backend.change-password-admin", compact('userlog'));
    }
    public function changePassword(Request $request, $id)
    {
        $messages = [
            'passwordOld.required' => 'Mật khẩu cũ là bắt buộc !',
            'passwordNew.required' => 'Mật khẩu mới là bắt buộc !',
            'passwordNew.regex' => 'Mật khẩu mới phải có ít nhất 6 ký tự, không có khoảng trống.',
            'passwordConfirm.required' => 'Mật khẩu nhập lại là bắt buộc !',
            'passwordConfirm.same' => 'Mật khẩu nhập lại không trùng khớp !',
        ];
        $request->validate([
            'passwordOld' => 'required',
            'passwordNew' => [
                'required',
                'regex:/^\S{6,}$/u'
            ],
            'passwordConfirm' => 'required|same:passwordNew',
        ],$messages);

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }
        if (!Hash::check($request->input('passwordOld'), $user->password)) {
            return redirect()->back()->with('error', 'Mật khẩu cũ không chính xác.');
        }
        $user->password = Hash::make($request->input('passwordNew'));
        $user->save();

        return redirect()->route('admin.changePasswordIndex')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}
