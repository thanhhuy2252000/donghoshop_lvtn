@extends('frontend.layout.master')
@section('title','Đơn hàng | DongHoShop')


@section('body')
<!-- Begin Li's Breadcrumb Area -->

<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
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
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">DANH SÁCH ĐƠN HÀNG</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mt-3">
                            @if($orders->isEmpty())
                                <p>Bạn chưa có đơn hàng nào.</p>
                            @else
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Đơn hàng</th>
                                    <th scope="col">
                                        Thông tin sản phẩm
                                    </th>
                                    <th scope="col">Tổng Đơn</th>
                                    <th scope="col">Phương thức thanh toán</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $id => $order)
                                    <tr>
                                        <td>{{++$id}}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            @foreach($orderDetails->where('donhang_id', $order->id) as $orderDetail)
                                                <a href="{{route('productDetail.index',['id'=>$orderDetail->ct_sanpham->id,'slug' => Str::slug($orderDetail->ct_sanpham->name)])}}">
                                                    <div><img src="{{asset('backend/img/product/'.$orderDetail->ct_sanpham->img )}}" width="70px"></div>
                                                    <div><span style="font-weight: bold;">Tên: </span>{{ $orderDetail->ct_sanpham->name }}</div>
                                                </a>
                                                <div><span style="font-weight: bold;">Số lượng:</span> {{ $orderDetail->soluong }} </div>
                                                <div><span style="font-weight: bold;">Giá:</span> {{ number_format($orderDetail->giaban) }} đ</div>
                                            @endforeach
                                        </td>
                                        <td>{{ number_format($order->tongDH) }} đ</td>
                                        <td>{{ $order->pt_thanhtoan }}</td>
                                        <td>{{ $order->trangthai }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            @if($order->trangthai != 'Đã hủy')
                                                @if($order->trangthai == 'Đã giao')
                                                    <form action="{{route('productDetail.index',['id'=>$orderDetail->ct_sanpham->id,'slug' => Str::slug($orderDetail->ct_sanpham->name )])}}" class="cart-quantity" method="get">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $orderDetail->ct_sanpham->id }}">
                                                        <button class="btn btn-buy" type="submit">Mua lại</button>
                                                    </form>
                                                @elseif($order->trangthai == 'Đang giao')
                                                    <button class="btn btn-round btn-danger" style="cursor: not-allowed; opacity: 0.6;">Hủy</but>
                                                @else  
                                                    <form action="{{ route('order.cancel', ['id' => $order->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')">Hủy</button>
                                                    </form>
                                                @endif
                                            @else
                                                <button class="btn btn-round btn-danger" style="cursor: not-allowed; opacity: 0.6;">Hủy</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="cart-page-total">
                    <a href="{{route('frontend.index')}}" class="checkoutt">Trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout Area End-->

@endsection