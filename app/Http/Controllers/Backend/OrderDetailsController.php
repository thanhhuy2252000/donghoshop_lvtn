<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Chitiet_donhang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Redirect;

class OrderDetailsController extends Controller
{
    public function index($id){
        $orderDetails=Chitiet_donhang::with('ct_sanpham')->where('donhang_id', $id)->get();
        $userlog =Auth::user();
        return view("backend.orderDetails",compact("orderDetails","userlog"));
    }
}
