@extends('backend.layout.master')
@section('title','Quản lý hình ảnh | DongHoShop')


@section('body')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Hình Sản Phẩm</h4>
                <ul class="breadcrumbs">
                    <li class="nav-item">
                        <a href="{{route('uploadimgs.index')}}"><button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="" data-target="">
                                <i class="fa fa-plus"></i>
                                Thêm
                            </button></a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                </ul>
            </div>
            <!-- Form Bộ Lọc -->
            <form method="GET" action="{{ route('imgs.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label class="form-label">ID</label>
                        <input type="number" name="filter_id" id="filter_id" value="{{ request('filter_id') }}" placeholder="ID hình ảnh" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-2">
                    <label for="filter_loaihinh" class="mr-2">Loại</label>
					<select name="filter_loaihinh" id="filter_loaihinh" class="form-control">
						<option value="">---</option>
						<option value="1" {{ request('filter_loaihinh') == '1' ? 'selected' : '' }}>1 </option>
						<option value="2" {{ request('filter_loaihinh') == '2' ? 'selected' : '' }}>2 </option>
                        <option value="3" {{ request('filter_loaihinh') == '3' ? 'selected' : '' }}>3 </option>
				    </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">ID sản phẩm</label>
                        <input type="number" name="filter_sanpham_id" id="filter_sanpham_id" value="{{ request('filter_sanpham_id') }}" placeholder="ID sản phẩm" class="form-control" />
                    </div>
                    <div class="text-end col-md-3 mt-3">
                        <button type="submit" class="btn btn-light"><i class="bi bi-funnel"></i> Lọc</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body ">
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
                                @if(!($imgs->isEmpty()))
                                <table class="table table-head-bg-primary mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 20px;">STT</th>
                                            <th scope="col" style="font-size: 20px;">ID Sản phẩm</th>
                                            <th scope="col" style="font-size: 20px;">ID hình</th>
                                            <th scope="col" style="font-size: 20px;">Hình</th>
                                            <th scope="col" style="font-size: 20px;">Loại hình</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($imgs as $i=>$img)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$img->sanpham_id}}</td>
                                            <td>{{$img->id}}</td>
                                            <td><img src="{{asset('backend/img/product/'.$img->imgs)}}" width="70px"></td>
                                            <td>{{$img->loaihinh}}</td>
                                            <td>
                                                <a href="{{route('editimgs.index',['id'=>$img->id])}}">
                                                    <button type="button" class="btn btn-round btn-edit" data-toggle="">
                                                        <i class="fas fa-solid fa-wrench"></i>
                                                        Sửa
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('imgs.delete',['id'=>$img->id])}}" class="delete-user" onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?')">
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
                                <p class="text-center">Không tìm thấy hình ảnh</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
								{{ $imgs->links() }}
                    </div>
            </div>
        </div>
        @endsection