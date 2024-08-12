@extends('frontend.layout.master')
@section('title','Thanh toán | DongHoShop')


@section('body')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{route('frontend.index')}}">Home</a></li>
                <li class="active">Thanh toán</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="checkbox-form">
                    <h3>Chi tiết thanh toán</h3>
                    <div class="row">
                        <!-- <div class="col-md-12">
                            <div class="country-select clearfix">
                                <label>Quốc gia <span class="required">*</span></label>
                                <input disabled type="text" value="Việt Nam">
                                <select class="nice-select wide">
                                        <option data-display="Bangladesh">Bangladesh</option>
                                        <option value="uk">London</option>
                                        <option value="rou">Romania</option>
                                        <option value="fr">French</option>
                                        <option value="de">Germany</option>
                                        <option value="aus">Australia</option>
                                    </select>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Họ tên <span class="required">*</span></label>
                                <input placeholder="" type="text" name="name" required value="{{$userlog->name}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Địa chỉ <span class="required">*</span></label>
                                <input placeholder="Địa chỉ" type="text" name="diachi" required value="{{$userlog->diachi}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Email <span class="required">*</span></label>
                                <input placeholder="nhập email" type="email" name="email" required value="{{$userlog->email}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Số điện thoại <span class="required">*</span></label>
                                <input type="text" name="sdt" required value="{{$userlog->sdt}}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Kiểm tra thông tin trước khi đặt</label>
                            </div>
                            <div class="order-button-payment">
                                <a href="{{route('cart.index')}}">Quay lại giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="your-order">
                    <h3>Đơn hàng của bạn</h3>
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th class="cart-product-total">Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cart) > 0)
                                @php $total = 0; $tax = 0.1; $totalTax = 0;@endphp
                                @foreach (session('cart',[]) as $id => $details)
                                @php
                                if ($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) {
                                $totalPrice = $details['giaKM'] * $details['quantity']; 
                                } else {
                                $totalPrice = $details['gia'] * $details['quantity'] ; 
                                }
                                $total += $totalPrice;
                                $totalTax = $total * (1 + $tax);
                                @endphp
                                <tr class="cart_item">
                                    <td class="cart-product-name"> {{ $details['name'] }}</td>
                                    <td><strong class="product-quantity"> × {{ $details['quantity'] }}</strong></td>
                                    <td class="cart-product-total"><span class="amount">{{number_format($totalPrice)}} đ</span></td>
                                </tr>

                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <th>Tổng tạm tính:</th>
                                    <td><strong><span class="amount">{{number_format($total)}} đ</span></strong></td>
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    
                                </tr>
                                <tr>
                                    <th></th>
                                    <td class="cart-product-name"> +10% thuế/ tổng đơn</td>
                                </tr>
                                <tr class="order-total">
                                    <th>Tổng đơn hàng:</th>
                                    <td><strong><span class="amount">{{number_format($totalTax)}} đ</span></strong></td>
                                    <input type="hidden" name="totalTax" value="{{ $totalTax }}">
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div id="accordion">
                                @if (count($cart) > 0)
                                    <div class="card-checkout" required>
                                        <label>PHƯƠNG THỨC THANH TOÁN</label><br />

                                        <label class="form-radio-label-checkout">
                                            <input class="form-radio-input-checkout" type="radio" name="radioPTTT" value="COD" required checked><span class="form-radio-sign">Thanh toán khi nhận hàng</span>
                                        </label>
                                        <label class="form-radio-label-checkout">
                                            <input class="form-radio-input-checkout" type="radio" name="radioPTTT" value="momo" required><span class="form-radio-sign">Momo</span>
                                        </label>
                                    </div>  
                                @else
                                    <div class="card-checkout" required>
                                        
                                    </div>
                                @endif
                                
                                <!-- <div class="card">
                                    <div class="card-header" id="#payment-3">
                                        <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                PayPal
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            
                            @if (count($cart) > 0)
                                <div class="order-button-payment">
                                    <button type="submit">Đặt Hàng</button>
                                </div>
                            @else
                                <div class="alert alert-danger mt-2">
                                    Giỏ hàng của bạn đang trống, không thể đặt hàng.
                                </div>
                                <div class="order-button-payment">
                                    <button><a href="{{route('frontend.index')}}">Quay lại trang chủ</a></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<!--Checkout Area End-->

@endsection