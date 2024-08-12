@extends('backend.layout.master')
@section('title','Sửa thông tin danh mục | DongHoShop')


@section('body')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Sửa thông tin danh mục</h4>

            </div>
            <div class="row">
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
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('caterogy.edit',['id'=>$caterogys->id])}}" methods="post">
                        @csrf
                        @method ('PATCH')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Tên danh mục</label>
                                            <input type="text" class="form-control" name="tenDM"  placeholder="Tên danh mục" value="{{$caterogys->tenDM}}" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{route('caterogy.index')}}"><button type="button" class="btn btn-danger">Hủy</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection