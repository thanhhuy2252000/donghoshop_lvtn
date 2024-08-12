@extends('frontend.layout.master')
@section('title','Giỏ hàng | DongHoShop')


@section('body')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{route('frontend.index')}}">Home</a></li>
                <li class="active">Giỏ hàng</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                <div class="alert alert-success">
                    <span> {{ session('success') }}</span>
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger">
                    <span> {{ session('error') }}</span>
                </div>
                @endif

                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">Xóa</th>
                                    <th class="li-product-thumbnail">Hình ảnh</th>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="li-product-price">Giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Tổng giá sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cart) > 0)
                                @php $total = 0; @endphp
                                @foreach (session('cart',[]) as $id => $details)
                                @php
                                if ($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay']) {
                                $totalPrice = $details['giaKM'] * $details['quantity']; // Giá khuyến mãi
                                } else {
                                $totalPrice = $details['gia'] * $details['quantity']; // Giá gốc
                                }
                                $total += $totalPrice;
                                @endphp
                                <tr data-id="{{ $id }}">
                                    <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                                        @csrf
                                        <td class="li-product-remove"> <button type="submit" class="btn-remove-cart"><i class="fa fa-times"></i></button></td>
                                    </form>
                                    <td class="li-product-thumbnail" max-width="50px" max-height="50px"><a href="{{route('productDetail.index',[$id,'slug' => Str::slug($details['name'])])}}"><img src="{{asset('backend/img/product/'.$details['img'])}}" alt="Li's Product Image"></a></td>
                                    <td class="li-product-name" ><a href="{{route('productDetail.index',[$id,'slug' => Str::slug($details['name'])])}}">{{ $details['name'] }}</a></td>
                                    <td class="li-product-price"><span class="amount">
                                            @if($details['giaKM'] != 0 && $details['km_tungay'] <= now() && now() <= $details['km_denngay'])
                                            {{number_format($details['giaKM'])}}
                                            @else
                                            {{number_format($details['gia'])}}
                                            @endif
                                        </span></td>
                                    <td class="quantity">
                                        <div class="cart-cuttom-minus">
                                            <button class="dec btn-qty-inc-dec">-</button>
                                            <input type="text" data-session_id="{{ $details['id'] }}" name="quantity" value="{{ $details['quantity'] }}" class="cart_qty_update" min="1" disabled >
                                            <button class="inc btn-qty-inc-dec">+</button>
                                            
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span class="amount">{{number_format($totalPrice)}} </span> đ</td>
                                </tr>
                                @endforeach
                                @endif

                                @if ( count($cart) == 0)
                                <tr>
                                    <td colspan="6" style="text-align: center;">Giỏ hàng của bạn đang trống.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="coupon-all">
                                <button class="button-cart li-btn"><a href="{{route('frontend.index')}}">Chọn thêm sản phẩm</a></button>
                            </div>
                        </div>
                        @if (count($cart)!=0)
                            <div class="col-4">
                                <div class="coupon-all">
                                    <div class="coupon2">
                                        <form action="{{ route('cart.clear') }}" method="POST">
                                            @csrf
                                            <button class="button-cart li-btn" type="submit">Xóa toàn bộ giỏ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Tổng (đ) <span>{{number_format($total)}}</span> </li>
                                </ul>
                                <a href="{{route('checkout.index')}}" class="checkoutt" >Thanh toán</a>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    function updateCart(id, quantity) {
        $.ajax({
            url: "{{ route('cart.update') }}",
            method: 'patch',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: quantity
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('tr[data-id="' + id + '"] .product-subtotal .amount').text(response.itemTotalPrice);
                    $('.cart-page-total span').last().text(response.total);
                } else if (response.status === 'error') {
                    alert(response.message);
                    location.reload(); 
                }
            },
            error: function(response) {
                var errorMessage = 'Có lỗi xảy ra!';
                if (response.responseJSON && response.responseJSON.message) {
                    errorMessage = response.responseJSON.message;
                }
                alert(errorMessage);
                    location.reload(); 
            }
        });
    }

    $('.inc, .dec').on('click', function(e) {
        e.preventDefault();  // Ngăn chặn hành vi mặc định
        var input = $(this).siblings('.cart_qty_update');
        var quantity = parseInt(input.val());
        var id = input.data('session_id');

        if ($(this).hasClass('inc')) {
            quantity += 1;
        } else if ($(this).hasClass('dec')) {
            if (quantity > 1) {
                quantity -= 1;
            }
        }
        input.val(quantity);
        updateCart(id, quantity);
    });
});
</script>

@endsection