<div style="width: 600px; margin: 0 auto;">
    <div style="text-align:center;">
        <h2>Xin chào {{$user->name}}</h2>
        <p>Email này được gửi từ DongHoShop để lấy lại mật khẩu cho bạn</p>
        <p>Vui lòng click vào "Đặt lại mật khẩu" để tiếp tục</p>
        <p>Chú ý: mã xác nhận trong link chỉ có hiệu lực trong 10 phút !</p>
        <p>
            <a href="{{route('userResetPassword.index',['user'=>$user->id,'token'=>$user->remember_token])}}"
            style="display:inline-block; background:blue; color:#fff; padding:7px 25px; font-weight:bold;">Đặt lại mật khẩu</a>
        </p>
    </div>
</div>