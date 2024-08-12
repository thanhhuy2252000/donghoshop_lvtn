
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập Admin | DongHoShop</title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="http://infiniteiotdevices.com/images/logo.png" rel="icon" sizes="16x16" type="image/gif" />
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/login-form-5.css')}}">
</head>
<body>
	<div class="box">
		<h2>Đăng Nhập</h2>
		@if(Session::has('error'))
		<div class="alert" style="display: flex; justify-content: center;">
			{{ Session::get('error') }}
		</div>
		@endif
		<form action="{{route('admin.checkLogin')}}" method="post">
		@csrf
			<div class="inputBox">
				<input type="text" name="email" required placeholder="             nhập email admin">
				<label>Email</label>
			</div>
			<div class="inputBox">
				<input type="password" name="password" required placeholder="                 nhập mật khẩu">
				<label>Mật khẩu</label>
			</div>
			<input type="submit" value="Đăng nhập">
		</form>
		
		</ul>
		<!-- <h4>Create account? <a href="#">Sign Up</a></h4> -->
	</div>
</body>
</html>