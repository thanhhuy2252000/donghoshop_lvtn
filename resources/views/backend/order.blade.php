@extends('backend.layout.master')
@section('title','Quản lý đơn hàng | DongHoShop')


@section('body')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Đơn hàng</h4>
                <ul class="breadcrumbs">
                    <li class="separator">

                    </li>

                </ul>
            </div>
            <!-- Bộ Lọc -->
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('order.index') }}" method="GET" class="form-inline">
                        <div class="form-group mr-2">
                            <label for="filter_id" class="mr-2">ID</label>
                            <input type="number" name="filter_id" id="filter_id" class="form-control" value="{{ request('filter_id') }}" placeholder="ID đơn hàng">
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_name" class="mr-2">Tên người dùng</label>
                            <input type="text" name="filter_name" id="filter_name" class="form-control" value="{{ request('filter_name') }}" placeholder="Tên người dùng">
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_user_id" class="mr-2">ID</label>
                            <input type="number" name="filter_user_id" id="filter_user_id" class="form-control" value="{{ request('filter_user_id') }}" placeholder="ID người đặt đơn hàng">
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_tongDH" class="mr-2">Tổng đơn</label>
                            <select name="filter_tongDH" id="filter_tongDH" class="form-control">
                                <option value="">---</option>
                                <option value="0-1000000" {{ request('filter_tongDH') == '0-1000000' ? 'selected' : '' }}>Nhỏ hơn 1 triệu</option>
                                <option value="1000000-5000000" {{ request('filter_tongDH') == '1000000-5000000' ? 'selected' : '' }}>1-5 triệu</option>
                                <option value="5000000-10000000" {{ request('filter_tongDH') == '5000000-10000000' ? 'selected' : '' }}>5-10 triệu</option>
                                <option value="10000000-" {{ request('filter_tongDH') == '10000000-' ? 'selected' : '' }}>Lớn hơn 10 triệu</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_pt_thanhtoan" class="mr-2">Phương thức thanh toán</label>
                            <select name="filter_pt_thanhtoan" id="filter_pt_thanhtoan" class="form-control">
                                <option value="">---</option>
                                <option value="COD" {{ request('filter_pt_thanhtoan') == 'COD' ? 'selected' : '' }}>COD</option>
                                <option value="momo" {{ request('filter_pt_thanhtoan') == 'momo' ? 'selected' : '' }}>momo</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_trangthai" class="mr-2">Trạng thái</label>
                            <select name="filter_trangthai" id="filter_trangthai" class="form-control">
                                <option value="">---</option>
                                <option value="Chưa xác nhận" {{ request('filter_trangthai') == 'Chưa xác nhận' ? 'selected' : '' }}>Chưa xác nhận</option>
                                <option value="Đã xác nhận" {{ request('filter_trangthai') == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="Đã thanh toán" {{ request('filter_trangthai') == 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh toán</option>
                                <option value="Đang giao" {{ request('filter_trangthai') == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="Đã giao" {{ request('filter_trangthai') == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                                <option value="Đã hủy" {{ request('filter_trangthai') == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_created_at" class="mr-2">Ngày tạo</label>
                            <input type="date" name="filter_created_at" id="filter_created_at" class="form-control" value="{{ request('filter_created_at') }}">
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_updated_at" class="mr-2">Ngày cập nhật</label>
                            <input type="date" name="filter_updated_at" id="filter_updated_at" class="form-control" value="{{ request('filter_updated_at') }}">
                        </div>
                        <button type="submit" class="btn btn-light"><i class="bi bi-funnel"></i> Lọc</button>
                    </form>
                </div>
            </div>
            <!-- hiển thị đơn hàng -->
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
                                @if(!($orders->isEmpty()))
                                <table class="table table-head-bg-success">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 20px;">STT</th>
                                            <th scope="col" style="font-size: 20px;">ID đơn hàng</th>
                                            <th scope="col" style="font-size: 20px;">Tên người đặt</th>
                                            <th scope="col" style="font-size: 20px;">ID người đặt</th>
                                            <th scope="col" style="font-size: 20px;">Sdt</th>
                                            <th scope="col" style="font-size: 20px;">Địa Chỉ</th>
                                            <th scope="col" style="font-size: 20px;">Tổng đơn hàng</th>
                                            <th scope="col" style="font-size: 20px;">Phương thức thành toán</th>
                                            <th scope="col" style="font-size: 20px;">Ngày tạo</th>
                                            <th scope="col" style="font-size: 20px;">Ngày update</th>
                                            <th scope="col" style="font-size: 20px;">Trạng thái</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $i=>$order)

                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->name}}</td>
                                            <td>{{$order->user_id}}</td>
                                            <td>{{$order->sdt}}</td>
                                            <td>{{$order->diachi}}</td>
                                            <td>{{number_format($order->tongDH)}}</td>
                                            <td>{{$order->pt_thanhtoan}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->updated_at}}</td>
                                            <form action="{{ route('order.edit', ['id' => $order->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <td>
                                                    <select name="trangthai" id="trangthai" class="form-control" style="width:200px;">
                                                        @php
                                                        // Lấy trạng thái hiện tại
                                                        $currentStatus = $order->trangthai;

                                                        // Danh sách các trạng thái có thể có, bỏ trạng thái "Chưa giao"
                                                        $statuses = [
                                                        'Chưa xác nhận' => 'Chưa xác nhận',
                                                        'Đã xác nhận' => 'Đã xác nhận',
                                                        'Đã thanh toán' => 'Đã thanh toán',
                                                        'Đang giao' => 'Đang giao',
                                                        'Đã giao' => 'Đã giao',
                                                        'Đã hủy' => 'Đã hủy'
                                                        ];

                                                        // Xác định các trạng thái bị disable
                                                        $disableOptions = [];

                                                        if ($currentStatus !== 'Chưa xác nhận') {
                                                        $disableOptions[] = 'Chưa xác nhận';
                                                        }
                                                        if ($currentStatus === 'Đã thanh toán') {
                                                        $disableOptions[] = 'Chưa xác nhận';
                                                        $disableOptions[] = 'Đã xác nhận';
                                                        }
                                                        if ($currentStatus === 'Đang giao') {
                                                        $disableOptions = array_merge($disableOptions, ['Chưa xác nhận', 'Đã xác nhận', 'Đã thanh toán']);
                                                        }
                                                        if ($currentStatus === 'Đã giao') {
                                                            $disableOptions = array_merge($disableOptions, ['Chưa xác nhận', 'Đã xác nhận', 'Đã thanh toán','Đang giao']);
                                                        }
                                                        if ($currentStatus === 'Đã hủy') {
                                                        $disableOptions = array_keys($statuses); 
                                                        }
                                                        @endphp

                                                        @foreach ($statuses as $key => $status)
                                                        <option value="{{ $key }}" {{ $key === $currentStatus ? 'selected' : '' }}
                                                            @if (in_array($status, $disableOptions)) disabled @endif>
                                                            {{ $status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-round btn-edit">
                                                        <i class="bi bi-floppy"></i> Lưu
                                                    </button>
                                                </td>
                                            </form>
                                            <td class="nav-item">
                                                <a href="{{route('orderDetails.index',$order->id)}}">
                                                    <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="">
                                                        <i class="bi bi-ticket-detailed"></i>
                                                        Chi tiết
                                                    </button></a>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="{{route('order.delete', $order->id)}}" class="delete-user" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                                    <button type="button" class="btn btn-round btn-danger" data-toggle="">
                                                        <i class="fa fa-minus"></i>
                                                        Xóa
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p class="text-center">Không tìm thấy đơn hàng</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endsection