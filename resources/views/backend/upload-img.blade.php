@extends('backend.layout.master')
@section('title','Upload img | DongHoShop')


@section('body')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Thêm Hình</h4>
            </div>
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('imgs.upload')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">	
                                        <div class="form-group">
                                            <label for="sanpham_id">Id sản phẩm</label>
                                            <input type="text" class="form-control" name="sanpham_id" placeholder="Nhập id sản phẩm muốn thêm ảnh" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại hình</label>
                                            <select class="form-control" name="loaihinh" id="exampleFormControlSelect1">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Hình ảnh</label>
                                            <input type="file" name="imgs" class="form-control-file" id="exampleFormControlFile1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{route('imgs.index')}}"><button type="button" class="btn btn-danger">Hủy</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection