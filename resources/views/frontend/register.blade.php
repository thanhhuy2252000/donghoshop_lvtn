<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký | Donghoshop</title>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/transparent-login-form.css')}}">
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

    <div class="loginBox">

        <h2>Đăng Ký Tài Khoản</h2>
        @if ($errors->any())
        <div class="alert" style="display: flex; justify-content: center;">
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
        <form action="{{route('user.register')}}" method="post" id="registrationForm">
            @csrf
            <p>Họ tên</p>
            <input type="text" name="name" placeholder="Nhập họ tên" required>
            <p>Email</p>
            <input type="text" name="email" placeholder="Nhập email" required>
            <p>Mật khẩu</p>
            <input type="password" name="password" id="password" placeholder="nhập mật khẩu" required>
            <p>Nhập lại mật khẩu</p>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="nhập lại mật khẩu" required>
            <input type="submit" name="" value="Đăng ký">
            <a class="txt2" href="{{route('userLogin.index')}}">Trở lại trang đăng nhập</a></h4>

        </form>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert('Mật khẩu nhập lại không khớp.');
                event.preventDefault();
            }
        });
    </script>
</body>

</html>