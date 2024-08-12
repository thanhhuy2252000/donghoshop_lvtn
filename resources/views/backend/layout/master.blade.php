<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('backend/img/icon.ico')}}" type="image/x-icon" />
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	
	<!-- Fonts and icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="{{asset('backend/js/plugin/webfont/webfont.min.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/circles/0.0.6/circles.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.8.0/chart.min.js"></script>
	
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('backend/css/fonts.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/atlantis.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/atlantis.css')}}">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('backend/css/demo.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/fonts.css')}}">
	<link rel="stylesheet" href="{{asset('backend/js/atlantis.js')}}">
	<link rel="stylesheet" href="{{asset('backend/js/atlantis2.js')}}">
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="{{route('admin.index')}}" class="logo">
					<img src="{{asset('backend/img/logo.svg')}}" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item hidden-caret">
							<a href="{{route('frontend.index')}}">
								<div style="color:antiquewhite;">Click here back FrontendPage</div>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">

							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									@if(!$userlog->avt)
									<img src="{{asset('backend/img/avatar/blank.jpg')}}" alt="..." class="avatar-img rounded-circle">
									@else
									<img src="{{asset('backend/img/avatar/'.$userlog->avt)}}" alt="..." class="avatar-img rounded-circle">
									@endif
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg">
												@if(!$userlog->avt)
												<img src="{{asset('backend/img/avatar/blank.jpg')}}" alt="image profile" class="avatar-img rounded">
												@else
												<img src="{{asset('backend/img/avatar/'.$userlog->avt)}}" alt="image profile" class="avatar-img rounded">
												@endif
											</div>
											<div class="u-text">
												<h4>{{$userlog->name}}</h4>
												<p class="text-muted">{{$userlog->email}}</p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{route('admin.changePasswordIndex')}}">Đổi mật khẩu</a>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{route('admin.logout')}}">Đăng xuất</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">

			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{asset('backend/img/avatar/'.$userlog->avt)}}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{$userlog->name}}
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="{{route('admin.changePasswordIndex')}}">
											<span class="link-collapse">Đổi mật khẩu</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href="{{route('admin.index')}}">
								<i class="fas fa-home"></i>
								<p>Trang chủ | Thống kê</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('user.index')}}">
								<i class="fas fa-regular fa-user"></i>
								<p>Quản lý User</p>
							</a>
						</li>
						<!-- <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li> -->
						<li class="nav-item">
							<a href="{{route('caterogy.index')}}">
								<i class="fas fa-solid fa-list"></i>
								<p>Quản lý Danh mục</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('brand.index')}}">
								<i class="bi bi-bootstrap"></i>
								<p>Quản lý Thương hiệu</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('product.index')}}">
								<i class="bi bi-smartwatch"></i>
								<p>Quản lý Sản phẩm</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('order.index')}}">
								<i class="bi bi-cart3"></i>
								<p>Quản lý Đơn hàng</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('rating.index')}}">
								<i class="bi bi-chat-dots"></i>
								<p>Quản lý Đánh giá- bình luận</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('imgs.index')}}">
								<i class="bi bi-file-image"></i>
								<p>Quản lý Hình sản phẩm</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<!--- bodybackend -->
		@yield('body')



		<!-- footer start -->
		<footer class="footer">
			<div class="container-fluid">
				<nav class="pull-left">
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="https://www.themekita.com">
								ThemeKita
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								Help
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								Licenses
							</a>
						</li>
					</ul>
				</nav>
				<div class="copyright ml-auto">
					2024, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
				</div>
			</div>
		</footer>
	</div>

	<!-- Custom template | don't include it in your project! -->
	<div class="custom-template">
		<div class="title">Settings</div>
		<div class="custom-content">
			<div class="switcher">
				<div class="switch-block">
					<h4>Logo Header</h4>
					<div class="btnSwitch">
						<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
						<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
						<br />
						<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
					</div>
				</div>
				<div class="switch-block">
					<h4>Navbar Header</h4>
					<div class="btnSwitch">
						<button type="button" class="changeTopBarColor" data-color="dark"></button>
						<button type="button" class="changeTopBarColor" data-color="blue"></button>
						<button type="button" class="changeTopBarColor" data-color="purple"></button>
						<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
						<button type="button" class="changeTopBarColor" data-color="green"></button>
						<button type="button" class="changeTopBarColor" data-color="orange"></button>
						<button type="button" class="changeTopBarColor" data-color="red"></button>
						<button type="button" class="changeTopBarColor" data-color="white"></button>
						<br />
						<button type="button" class="changeTopBarColor" data-color="dark2"></button>
						<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
						<button type="button" class="changeTopBarColor" data-color="purple2"></button>
						<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
						<button type="button" class="changeTopBarColor" data-color="green2"></button>
						<button type="button" class="changeTopBarColor" data-color="orange2"></button>
						<button type="button" class="changeTopBarColor" data-color="red2"></button>
					</div>
				</div>
				<div class="switch-block">
					<h4>Sidebar</h4>
					<div class="btnSwitch">
						<button type="button" class="selected changeSideBarColor" data-color="white"></button>
						<button type="button" class="changeSideBarColor" data-color="dark"></button>
						<button type="button" class="changeSideBarColor" data-color="dark2"></button>
					</div>
				</div>
				<div class="switch-block">
					<h4>Background</h4>
					<div class="btnSwitch">
						<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
						<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
						<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
						<button type="button" class="changeBackgroundColor" data-color="dark"></button>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="{{asset('backend/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{asset('backend/js/core/popper.min.js')}}"></script>
	<script src="{{asset('backend/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{asset('backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('backend/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{asset('backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
	<!-- Datatables -->
	<script src="{{asset('backend/js/plugin/datatables/datatables.min.js')}}"></script>
	<!-- Atlantis JS -->

	<script src="{{asset('backend/js/plugin/chart.js/chart.min.js')}}"></script>
	<script src="{{asset('backend/js/plugin/chart-circle/circles.min.js')}}"></script>
	<script src="{{asset('backend/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('backend/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
	<script src="{{asset('backend/js/plugin/webfont/webfont.min.js')}}"></script>

	<script src="{{asset('backend/js/atlantis.min.js')}}"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{asset('backend/js/setting-demo2.js')}}"></script>
	<script src="{{asset('backend/js/setting-demo.js')}}"></script>
	<script src="{{asset('backend/js/demo.js')}}"></script>

	<!--end footer -->
</body>

</html>