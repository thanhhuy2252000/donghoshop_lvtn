@extends('backend.layout.master')
@section('title','Đổi mật khẩu admin | DongHoShop')


@section('body')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Đổi mật khẩu admin</h4>

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
                        <form action="{{route('admin.changePassword',['id'=> $userlog->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="password">Mật khẩu cũ</label>
                                            <input type="password" class="form-control" name="passwordOld" id="passwordOld" placeholder="Mật khẩu cũ" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Mật khẩu mới</label>
                                            <input type="password" class="form-control" name="passwordNew" id="passwordNew" placeholder="Mật khẩu mới" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Nhập lại mật khẩu</label>
                                            <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" placeholder="nhập lại mật khẩu" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{route('admin.index')}}"><button type="button" class="btn btn-danger">Hủy</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection