@extends('backend.layout.master')
@section('title','Chi tiết đơn hàng | DongHoShop')


@section('body')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Chi tiết đơn hàng</h4>
                <ul class="breadcrumbs">
                    <li class="separator">
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body table-responsive">
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                                <table class="table table-head-bg-success">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 20px;">STT</th>
                                            <th scope="col" style="font-size: 20px;">ID Chi tiết đơn hàng</th>
                                            <th scope="col" style="font-size: 20px;">IMG</th>
                                            <th scope="col" style="font-size: 20px;">Tên sản phẩm</th>
                                            <th scope="col" style="font-size: 20px;">Số lượng</th>
                                            <th scope="col" style="font-size: 20px;">Tổng</th>
                                            <th scope="col" style="font-size: 20px;">Giá gốc</th>
                                            <th scope="col" style="font-size: 20px;">Giá bán</th>
                                            <th scope="col" style="font-size: 20px;">Ngày tạo</th>
                                            <th scope="col" style="font-size: 20px;">Ngày update</th>
                                            <th scope="col" style="font-size: 20px;">ID đơn hàng</th>
                                            <th scope="col" style="font-size: 20px;">ID sản phẩm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetails as $i=>$itemDetail)

                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$itemDetail->id}}</td>
                                            <td><img src="{{asset('backend/img/product/'.$itemDetail->ct_sanpham->img)}}" width="70px"></td>
                                            <td>{{$itemDetail->ct_sanpham->name}}</td>
                                            <td>{{$itemDetail->soluong}}</td>
                                            <td>{{$itemDetail->tong}}</td>
                                            <td>{{$itemDetail->giagoc}}</td>
                                            <td>{{$itemDetail->giaban}}</td>
                                            <td>{{$itemDetail->created_at}}</td>
                                            <td>{{$itemDetail->updated_at}}</td>
                                            <td>{{$itemDetail->donhang_id}}</td>
                                            <td>{{$itemDetail->sanpham_id}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection