@extends('backend.layout.master')
@section('title','Quản lý danh mục | DongHoShop')


@section('body')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Danh Mục</h4>
                <ul class="breadcrumbs">
                    <li class="nav-item">
                        <a href="{{route('createCaterogy.index')}}"><button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="" data-target="">
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
            <form method="GET" action="{{ route('caterogy.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label class="form-label">ID</label>
                        <input type="number" name="filter_id" value="{{ request('filter_id') }}" placeholder="ID danh mục" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Tên Danh Mục</label>
                        <input type="text" name="filter_name" value="{{ request('filter_name') }}" placeholder="Tên danh mục" class="form-control" />
                    </div>
                    <div class="text-end col-md-4 mt-3">
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
                                @if(!($caterogys->isEmpty()))
                                <!-- table hiển thị danh mục -->
                                <table class="table table-head-bg-success">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 20px;">STT</th>
                                            <th scope="col" style="font-size: 20px;">ID</th>
                                            <th scope="col" style="font-size: 20px;">Tên Danh Mục</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caterogys as $i=>$caterogy)

                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$caterogy->id}}</td>
                                            <td>{{$caterogy->tenDM}}</td>
                                            <td>
                                                <a href="{{route('editCaterogy.index',['id'=>$caterogy->id])}}">
                                                    <button type="button" class="btn btn-round btn-edit" data-toggle="">
                                                        <i class="fas fa-solid fa-wrench"></i>
                                                        Sửa
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('caterogy.delete', $caterogy->id) }}" class="delete-user" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
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
										<p class="text-center">Không tìm thấy danh mục</p>
										@endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        {{ $caterogys->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endsection