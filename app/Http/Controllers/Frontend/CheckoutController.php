<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sanpham;
use App\Models\Danhmuc;
use App\Models\Thuonghieu;
use App\Models\Donhang;
use App\Models\Chitiet_donhang;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkoutIndex()
    {
        $brands = Thuonghieu::all();
        $products = Sanpham::all();
        $userlog = Auth::user();
        $total = 0;
        $totalTax = 0;
        $tax = 0.1;

        $cart = session()->get('cart', []);
        foreach ($cart as $id => $details) {
            $totalPrice = (($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) ? $details['giaKM'] : $details['gia']) * $details['quantity'];
            $cart[$id]['totalPrice'] = $totalPrice;
            $total += $totalPrice;
            $totalTax = $total * (1 + $tax);
        }
        return view("frontend.checkout", compact("brands", "products", "userlog", "total", "cart", "totalTax"));
    }
    public function checkoutResult()
    {
        $brands = Thuonghieu::all();
        $products = Sanpham::all();
        $userlog = Auth::user();
        $total = 0;
        $totalTax = 0;
        $tax = 0.1;

        $cart = session()->get('cart', []);
        foreach ($cart as $id => $details) {
            $totalPrice = (($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) ? $details['giaKM'] : $details['gia']) * $details['quantity'];
            $cart[$id]['totalPrice'] = $totalPrice;
            $total += $totalPrice;
            $totalTax = $total * (1 + $tax);
        }
        return view("frontend.checkout-result", compact("brands", "products", "userlog", "total", "cart", "totalTax"));
    }
    public function checkoutStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'sdt' => 'required|string|max:15',
            'radioPTTT' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'totalTax' => 'required|numeric|min:0',
        ]);


        if ($request->radioPTTT == 'COD') {

            $order = new Donhang();
            $order->name = $request->name;
            $order->diachi = $request->diachi;
            $order->email = $request->email;
            $order->sdt = $request->sdt;
            $order->pt_thanhtoan = $request->radioPTTT;
            $order->tongDH = $request->totalTax;
            $order->user_id = Auth::id();
            $order->save();


            // Lưu chi tiết đơn hàng
            foreach (session('cart', []) as $id => $details) {
                $orderDetail = new Chitiet_donhang();
                $orderDetail->donhang_id = $order->id;
                $orderDetail->sanpham_id = $id;
                $orderDetail->soluong = $details['quantity'];
                $orderDetail->giagoc = $details['gia'];
                $orderDetail->giaban = ($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) ? $details['giaKM'] : $details['gia'];
                $orderDetail->tong = $orderDetail->giaban * $orderDetail->soluong;
                $orderDetail->save();

                // Giảm số lượng sản phẩm trong kho
                $sanpham = Sanpham::find($id);
                if ($sanpham) {
                    $sanpham->soluong -= $details['quantity'];
                    $sanpham->save();
                }
            }
            session()->forget('cart');
            return redirect()->route('checkout.result.index')->with('success', 'Đặt hàng thành công!');
        }
        if ($request->radioPTTT == 'momo') {
            function execPostRequest($url, $data)
            {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data)
                    )
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                //execute post
                $result = curl_exec($ch);
                //close connection
                curl_close($ch);
                return $result;
            }
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua ATM MoMo";
            $amount = $request->totalTax;
            $orderId = time() . "";
            $redirectUrl = "http://127.0.0.1:8000/checkout/result";
            $ipnUrl = "http://127.0.0.1:8000/checkout/result";
            $extraData = "";

            $requestId = time() . "";
            $requestType = "payWithATM";

            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            //Lưu đơn hàng
            $order = new Donhang();
            $order->name = $request->name;
            $order->diachi = $request->diachi;
            $order->email = $request->email;
            $order->sdt = $request->sdt;
            $order->pt_thanhtoan = $request->radioPTTT;
            $order->tongDH = $request->totalTax;
            $order->user_id = Auth::id();
            $order->trangthai = 'Đã thanh toán';
            $order->save();

            // Lưu chi tiết đơn hàng
            foreach (session('cart', []) as $id => $details) {
                $orderDetail = new Chitiet_donhang();
                $orderDetail->donhang_id = $order->id;
                $orderDetail->sanpham_id = $id;
                $orderDetail->soluong = $details['quantity'];
                $orderDetail->giagoc = $details['gia'];
                $orderDetail->giaban = ($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) ? $details['giaKM'] : $details['gia'];
                $orderDetail->tong = $orderDetail->giaban * $orderDetail->soluong;
                $orderDetail->save();

                // Giảm số lượng sản phẩm trong kho
                $sanpham = Sanpham::find($id);
                if ($sanpham) {
                    $sanpham->soluong -= $details['quantity'];
                    $sanpham->save();
                }
            }
            session()->forget('cart');
            return redirect()->to($jsonResult['payUrl'])->with('success', 'Đặt hàng thành công!');
        }
        return redirect()->route('checkout.result.index')->with('error', 'Đặt hàng thất bại !');
    }
    public function orderDetailList()
    {
        $brands = Thuonghieu::all();
        $products = Sanpham::all();
        $userlog = Auth::user();
        $orders = Donhang::where('user_id', $userlog->id)->orderBy('created_at', 'desc')->get();
        $orderDetails = Chitiet_donhang::whereIn('donhang_id', $orders->pluck('id'))->with('ct_sanpham')->get();
        $total = 0;
        $totalTax = 0;
        $tax = 0.1;

        $cart = session()->get('cart', []);
        foreach ($cart as $id => $details) {
            $totalPrice = (($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) ? $details['giaKM'] : $details['gia']) * $details['quantity'];
            $cart[$id]['totalPrice'] = $totalPrice;
            $total += $totalPrice;
            $totalTax = $total * (1 + $tax);
        }
        return view("frontend.order-detail-list", compact("brands", "products", "userlog", "total", "totalTax", "cart", "orders", "orderDetails"));
    }
    public function cancelOrder($id)
    {
        $userId = auth()->user()->id;
        $currentMonth = Carbon::now()->month;

        $cancelCount = Donhang::where('user_id', $userId)
            ->where('trangthai', 'Đã hủy')
            ->whereMonth('updated_at', $currentMonth)
            ->count();

        if ($cancelCount >= 10) {
            return redirect()->back()->with('error', 'Bạn đã hủy đơn hàng quá 10 lần trong tháng này. Vui lòng liên hệ Shop để được hỗ trợ !');
        }

        $order = Donhang::findOrFail($id);
        $order->trangthai = 'Đã hủy';
        $order->save();

        // Lấy các chi tiết đơn hàng của đơn hàng này
        $orderDetails = $order->dh_chitiet;

        // Cập nhật lại số lượng sản phẩm trong kho
        foreach ($orderDetails as $detail) {
            $product = $detail->ct_sanpham;
            if ($product) {
                $product->soluong += $detail->soluong; 
                $product->save();
            }
        }

        return redirect()->back()->with('error', 'Đã hủy đơn hàng thành công');
    }
}
