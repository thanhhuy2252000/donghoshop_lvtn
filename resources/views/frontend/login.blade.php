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
	<div class="backhome">
		<a href="{{route('frontend.index')}}"><button>Trang chủ</button></a>
	</div>
	<div class="loginBox">

		<h2>Đăng Nhập Tài Khoản</h2>
		@if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li> 
                @endforeach
            </div>
        @endif
		@if(Session::has('error'))
		<div class="alert" style="display: flex; justify-content: center; color:bisque;">
			{{ Session::get('error') }}
		</div>
		@endif
		@if(Session::has('success'))
		<div class="alert" style="display: flex; justify-content: center; color:aqua;">
			{{ Session::get('success') }}
		</div>
		@endif
		<form action="{{route('user.checkLogin')}}" method="post">
			@csrf
			<p>Email</p>
			<input type="text" name="email" placeholder="Nhập email" required>
			<p>Mật khẩu</p>
			<input type="password" name="password" placeholder="nhập mật khẩu" required>
			<input type="submit" name="" value="Đăng nhập">
			<a href="{{route('userForgotPassword.index')}}" class="a">Quên mật khẩu?</a>
			<h5>Đăng nhập bằng</h5>
			<ul>
				<li><a href="{{route('user.github')}}" class="github"><i class="fa fa-brands fa-github"></i></a></li>
				<li><a href="{{route('user.google')}}" class="google"><i class="fa fa-google"></i></a></li>
			</ul>
			<h4>Tạo tài khoản? <a class="txt2" href="{{route('userRegister.index')}}">Đăng ký</a></h4>
			
		</form>
		
	</div>
</body>

</html>