<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sanpham;
use App\Models\Danhmuc;
use App\Models\Thuonghieu;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartIndex(){
        $userlog = Auth::user();
        $brands = Thuonghieu::all();
        $products = Sanpham::all();
        $total = 0;
        $cart = session()->get('cart', []);
        foreach ($cart as $id => $details) {
            $totalPrice = (($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) ? $details['giaKM'] : $details['gia']) * $details['quantity'];
            $cart[$id]['totalPrice'] = $totalPrice;
            $total += $totalPrice;
        }
        return view("frontend.cart",compact("brands","products","cart","total","userlog"));
    }
    public function addCart(Request $request){
        $product = SanPham::find($request->id);
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm!');
        }
        $cart = session()->get('cart', []);
        
        // Kiểm tra số lượng tồn kho
        $quantityInCart = isset($cart[$request->id]) ? $cart[$request->id]['quantity'] : 0;
        if ($product->soluong < $quantityInCart + 1) {
            return redirect()->route('cart.index')->with('error', 'Số lượng sản phẩm trong kho không đủ!');
        }

        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        } else {
            $cart[$request->id] = [
                'id' =>$product->id,
                "name" => $product->name,
                "quantity" => 1,
                "gia" => $product->gia,
                "giaKM" => $product->giaKM,
                "km_tungay" =>$product->km_tungay,
                "km_denngay" => $product->km_denngay,
                "slug" => $product->slug,
                "img" => $product->img,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng !');
    }
    
    public function updateQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;

        $cart = session()->get('cart');

        $product = SanPham::find($id);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy sản phẩm!'], 400);
        }
        if (isset($cart[$id])) {
            // Kiểm tra số lượng tồn kho
            if ($product->soluong < $quantity) {
                return response()->json(['status' => 'error', 'message' => 'Số lượng sản phẩm trong kho không đủ!'], 400);
            }
            
            $cart[$id]['quantity'] = $quantity;

            if ($cart[$id]['giaKM'] != 0 && $cart[$id]['km_tungay'] <= now() && now() <= $cart[$id]['km_denngay']) {
                $cart[$id]['totalPrice'] = $cart[$id]['giaKM'] * $quantity; // Giá khuyến mãi
            } else {
                $cart[$id]['totalPrice'] = $cart[$id]['gia'] * $quantity; // Giá gốc
            }

            session()->put('cart', $cart);

            // Tính toán lại tổng giá trị và tổng số tiền
            $subtotal = array_sum(array_column($cart, 'totalPrice'));
            $total = $subtotal; // Nếu có phí vận chuyển thì tính thêm vào đây

            return response()->json([
                'status' => 'success',
                'cart' => $cart,
                'subtotal' => $subtotal,
                'total' => $total,
                'itemTotalPrice' => $cart[$id]['totalPrice'],
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Lỗi không xác định!'], 400);
    }

    public function removeCart($id){
        $cart = session()->get('cart'); // Lấy giỏ hàng từ session

        if (isset($cart[$id])) {
            unset($cart[$id]); // Xóa sản phẩm từ giỏ hàng
    
            if (count($cart) > 0) {
                session()->put('cart', $cart); // Cập nhật lại giỏ hàng trong session
            } else {
                session()->forget('cart'); // Xóa session giỏ hàng nếu giỏ hàng trống
            }
            return redirect()->back()->with('error', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng!');
    }
    public function clearCart(){
        session()->forget('cart'); // Xóa session giỏ hàng

    return redirect()->back()->with('error', 'Tất cả sản phẩm đã được xóa khỏi giỏ hàng!');
    }
    
}
