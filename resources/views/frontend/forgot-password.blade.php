<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quên mật khẩu | DongHoShop</title>
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/transparent-login-form.css')}}">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
	<div class="backhome">
		<a href="{{route('userLogin.index')}}"><button>Đăng nhập</button></a>
	</div>
	<div class="loginBox">
    <h2>Lấy lại mật khẩu</h2>
    @if(Session::has('error'))
        <div class="alert" style="display: flex; justify-content: center;">
            {{ Session::get('error') }}
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert" style="display: flex; justify-content: center;">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('forgotPassword.send') }}" method="post">
        @csrf
        <p>Email lấy mật khẩu</p>
        <input type="text" name="email" placeholder="Nhập email đã đăng ký lấy mật khẩu" required>
        <input type="submit" name="" value="Gửi">
        @error('email') <small class="help-block">{{$message}}</small>@enderror
    </form>
</div>

</body>

</html>