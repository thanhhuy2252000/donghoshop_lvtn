@extends('frontend.layout.master')
@section('title','Home | DongHoShop')


@section('body')
<!-- Begin Li's Breadcrumb Area -->

<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="checkbox-form">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="cart-page-total">          
                    <a href="{{route('frontend.index')}}" class="checkoutt" >Tiếp tục mua hàng (trang chủ)</a>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="cart-page-total">          
                    <a href="{{route('orderList.index')}}" class="checkoutt" >Đơn hàng đã mua</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout Area End-->

@endsection