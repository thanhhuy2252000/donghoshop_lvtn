@extends('frontend.layout.master')
@section('title','Thông tin cá nhân | DongHoShop')

@section('body')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{route('frontend.index')}}">Home</a></li>
                <li class="active">Thông tin cá nhân</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="li-comment-section-account">
                <ul>
                    <li>
                        <div class="author-avatar pt-15">
                            @if(!$userlog->avt)
                            <img src="{{asset('backend/img/avatar/blank.jpg')}}" alt="avatar" width="150px" height="150px">
                            @else
                            <img src="{{asset('backend/img/avatar/'.$userlog->avt)}}" alt="avatar" width="150px" height="150px">
                            @endif

                        </div>
                        <div class="comment-body pl-15">
                            <h5 class="comment-author pt-15">{{$userlog->name}}</h5>
                            <div class="comment-post-date">
                            </div>
                            <p>-----------------------------------------------------------------------------------------------------------------------------------------</p>
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
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
                        </div>
                    </li>

                </ul>
            </div>

            <div class="col-sm-12 ">
                <form action="{{ route('myAccount.update') }}" method="POST" onsubmit="return confirmUpdate();" enctype="multipart/form-data">
                    @csrf
                    @method ('PUT')
                    <div class="login-form">
                        <h4 class="login-title">Thông tin cá nhân</h4>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-20">
                                <label>Hộ và tên</label>
                                <input class="mb-0" type="text" id="nameInput" placeholder="Họ và tên" value="{{$userlog->name}}" name="name">
                            </div>
                            <div class="col-md-6 col-12 mb-20">
                                <label>Giới tính</label>
                                <select class="mb-0" id="gioitinhInput" name="gioitinh" required>
                                    <option value="Nam" {{ $userlog->gioitinh == 0 ? 'selected' : '' }}>Nam</option>
                                    <option value="Nữ" {{ $userlog->gioitinh == 1 ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-20">
                                <label>Email</label>
                                <input class="mb-0" type="email" id="emailInput" placeholder="Email" value="{{ $userlog->email }}" name="email" disabled>
                            </div>
                            <div class="col-md-6 col-12 mb-20">
                                <label>Số điện thoại</label>
                                <input class="mb-0" type="text" id="sdtInput" placeholder="nhập số điện thoại" value="{{ $userlog->sdt }}" name="sdt">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Địa chỉ</label>
                                <input class="mb-0" type="text" id="diachiInput" placeholder="Địa chỉ" value="{{ $userlog->diachi }}" name="diachi">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label for="exampleFormControlFile1">Avatar</label>
                                @if($userlog->avt)
                                <input type="file" name="avt" id="avtInput" class="form-control-file">
                                @else
                                <input type="file" name="avt" id="avtInput" class="form-control-file">
                                <p>Không có ảnh</p>
                                @endif
                            </div>
                            <div class="col-12 mb-20">
                                <a href="#" id="togglePasswordFields">Bạn muốn thay đổi mật khẩu? Hãy bấm vào đây</a>
                            </div>
                            <div class="col-md-6 mb-20" id="oldPasswordSection" style="display: none;">
                                <label>Mật khẩu cũ</label>
                                <input class="mb-0" type="password" id="oldPasswordInput" placeholder="Mật khẩu cũ" name="old_password">
                            </div>
                            <div class="col-md-6 mb-20" id="passwordSection" style="display: none;">
                                <label>Mật khẩu mới</label>
                                <input class="mb-0" type="password" id="passwordInput" placeholder="Mật khẩu mới" name="password">
                            </div>
                            <div class="col-md-6 mb-20" id="confirmPasswordSection" style="display: none;">
                                <label>Nhập lại mật khẩu</label>
                                <input class="mb-0" type="password" id="confirmPasswordInput" placeholder="Nhập lại mật khẩu" name="confirm_password">
                            </div>
                            <div class="col-12">
                                <button id="saveButton" style="display: none;" class="register-button mt-0">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePasswordFields = document.getElementById('togglePasswordFields');
        const passwordFields = document.querySelectorAll('#oldPasswordSection, #passwordSection, #confirmPasswordSection');
        const saveButton = document.getElementById('saveButton');
        const fileInput = document.getElementById('avtInput'); // Đảm bảo biến này được định nghĩa đúng

        let passwordFieldsVisible = false;
        let isFileSelected = false; // Biến để theo dõi sự thay đổi của file

        // Toggle password fields
        togglePasswordFields.addEventListener('click', function(event) {
            event.preventDefault();
            passwordFieldsVisible = !passwordFieldsVisible;
            passwordFields.forEach(field => field.style.display = passwordFieldsVisible ? 'block' : 'none');
            saveButton.style.display = passwordFieldsVisible ? 'block' : 'none';
        });

        // Check file input change
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                isFileSelected = fileInput.files.length > 0; // Cập nhật trạng thái của file
                checkChanges(); // Gọi lại checkChanges để cập nhật trạng thái nút Lưu
            });
        }

        // Check changes in other fields
        function checkChanges() {
            const originalData = {
                name: "{{ $userlog->name }}",
                gioitinh: "{{ $userlog->gioitinh == 0 ? 'Nam' : 'Nữ' }}",
                email: "{{ $userlog->email }}",
                sdt: "{{ $userlog->sdt }}",
                diachi: "{{ $userlog->diachi }}",
                password: ""
            };

            const currentData = {
                name: document.getElementById('nameInput').value,
                gioitinh: document.getElementById('gioitinhInput').value,
                email: document.getElementById('emailInput').value,
                sdt: document.getElementById('sdtInput').value,
                diachi: document.getElementById('diachiInput').value,
                password: document.getElementById('passwordInput').value
            };

            const hasChanges = Object.keys(originalData).some(key => {
                return key === 'password' ?
                    currentData[key] !== originalData[key] :
                    currentData[key] !== originalData[key];
            });

            // Hiển thị nút Lưu nếu có thay đổi hoặc có file được chọn
            saveButton.style.display = hasChanges || isFileSelected || passwordFieldsVisible ? 'block' : 'none';
        }

        
        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', checkChanges);
            input.addEventListener('change', checkChanges); // Đảm bảo rằng sự kiện change cũng được xử lý
        });

        
        checkChanges();
    });


    function confirmUpdate() {
        var password = document.getElementById("passwordInput").value;
        var confirmPassword = document.getElementById("confirmPasswordInput").value;

        if (document.getElementById("oldPasswordSection").style.display === 'block') {
            if (oldPasswordSection === '') {
                alert("Mật khẩu cũ không được để trống !");
                return false;
            }
            if (password === '') {
                alert("Mật khẩu mới không được để trống !");
                return false;
            }
            if (confirmPassword === '') {
                alert("Nhập lại mật khẩu không được để trống !");
                return false;
            }
            if (password !== confirmPassword) {
                alert("Mật khẩu nhập lại không khớp !");
                return false;
            }
        }

        return confirm('Bạn có chắc chắn muốn thay đổi thông tin không?');
    }
</script>


@endsection