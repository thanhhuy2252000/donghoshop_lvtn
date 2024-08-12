<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | DongHoShop</title>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/transparent-login-form.css')}}">
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div class="loginBox">
    <h2>Đặt lại mật khẩu</h2>
    @if(Session::has('success'))
        <div class="alert" style="display: flex; justify-content: center; color:aqua;">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert" style="display: flex; justify-content: center; color:bisque;">
            {{ Session::get('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert" style="display: flex; justify-content: center; color:bisque;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('resetPassword.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <p>Email</p>
        <input type="text" name="email" placeholder="Nhập email" required>
        <p>Mật khẩu</p>
        <input type="password" name="password" placeholder="Nhập mật khẩu" required>
        <p>Nhập lại mật khẩu</p>
        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
        <input type="submit" name="" value="Đặt lại mật khẩu">
        @error('email') <small class="help-block">{{$message}}</small>@enderror
    </form>
</div>


</body>

</html>