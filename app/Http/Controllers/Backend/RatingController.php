<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sanpham;
use App\Models\Thuonghieu;
use App\Models\Danhmuc;
use App\Models\User;
use App\Models\Rating;
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
use Illuminate\Support\Carbon;
class RatingController extends Controller
{
    public function index(Request $request){
        $query = Rating::query();

        if ($request->filled('filter_id')) {
            $query->where('id', $request->filter_id);
        }
        if ($request->filled('filter_user_id')) {
            $query->where('user_id', $request->filter_user_id);
        }
        if ($request->filled('filter_sanpham_id')) {
            $query->whereHas('rating_ct', function($q) use ($request) {
                $q->where('sanpham_id', $request->filter_sanpham_id);
            });
        }
        if ($request->filled('filter_trangthai')) {
            $query->where('trangthai', $request->filter_trangthai);
        }
        if ($request->filled('filter_rating')) {
            $query->where('rating', $request->filter_rating);
        }
        if ($request->filled('filter_user_name')) {
            $query->whereHas('rating_us', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filter_user_name . '%');
            });
        }
        if ($request->filled('filter_sanpham_name')) {
            $query->whereHas('rating_ct.ct_sanpham', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filter_sanpham_name . '%');
            });
        }
        
        $ratings = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->except('page'));
        $userlog =Auth::user();
        return view("backend.rating",compact("ratings","userlog"));
    }
    public function updateRating(Request $request, $id) {
        $rating = Rating::findOrFail($id);
        $rating->trangthai = $request->input('trangthai');
        $rating->save();
        return redirect()->route('rating.index')->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function deleteRating($id) {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return redirect()->route('rating.index')->with('success', 'Xóa đánh giá thành công.');
    }

}
