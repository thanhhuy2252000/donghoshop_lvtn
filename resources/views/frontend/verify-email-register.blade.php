<div style="width: 600px; margin: 0 auto;">
    <div style="text-align:center;">
        <h2>Xin chào {{ $user->name }} !</h2>
        <p>Vui lòng nhấn vào nút bên dưới để xác nhận địa chỉ email của bạn:</p>
        <p>Mã xác nhận có hiệu lực trong vòng 10 phút !.</p>
        <p>Nếu bạn không yêu cầu đăng ký, vui lòng bỏ qua email này.</p>
        <p>Xin cảm ơn !</p>
        <p>
            <a href="{{ $verificationUrl }}"
               style="display:inline-block; background:blue; color:#fff; padding:7px 25px; font-weight:bold;">
                Xác nhận đăng ký
            </a>
        </p>
    </div>
</div>