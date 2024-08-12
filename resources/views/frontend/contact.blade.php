@extends('frontend.layout.master')
@section('title','Liên hệ | DongHoShop')


@section('body')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{route('frontend.index')}}">Home</a></li>
                <li class="active">Liên hệ</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="li-section-title capitalize mb-25">
                    <h2><span></span></h2>
                </div>
            </div>
        </div> <!-- section title end -->
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
    
<!-- Begin Counterup Area -->
<div class="counterup-area">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <!-- Begin Limupa Counter Area -->
                <div class="limupa-counter white-smoke-bg">
                    <div class="container">
                        <div class="counter-img">
                            <img src="images/about-us/icon/1.png" alt="">
                        </div>
                        <div class="counter-info">
                            <div class="counter-number">
                                <h3 class="counter">1</h3>
                            </div>
                            <div class="counter-text">
                                <span>HÃY HÀI LÒNG VỚI BẢN THÂN</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- limupa Counter Area End Here -->
            </div>
            <div class="col-lg-3 col-md-6">
                <!-- Begin limupa Counter Area -->
                <div class="limupa-counter gray-bg">
                    <div class="counter-img">
                        <img src="images/about-us/icon/2.png" alt="">
                    </div>
                    <div class="counter-info">
                        <div class="counter-number">
                            <h3 class="counter">2</h3>
                        </div>
                        <div class="counter-text">
                            <span>MỌI NỖ LỰC SẼ ĐƯỢC ĐỀN ĐÁP</span>
                        </div>
                    </div>
                </div>
                <!-- limupa Counter Area End Here -->
            </div>
            <div class="col-lg-3 col-md-6">
                <!-- Begin limupa Counter Area -->
                <div class="limupa-counter white-smoke-bg">
                    <div class="counter-img">
                        <img src="images/about-us/icon/3.png" alt="">
                    </div>
                    <div class="counter-info">
                        <div class="counter-number">
                            <h3 class="counter">612</h3>
                        </div>
                        <div class="counter-text">
                            <span>SỐ GIỜ LÀM VIỆC</span>
                        </div>
                    </div>
                </div>
                <!-- limupa Counter Area End Here -->
            </div>
            <div class="col-lg-3 col-md-6">
                <!-- Begin limupa Counter Area -->
                <div class="limupa-counter gray-bg">
                    <div class="counter-img">
                        <img src="images/about-us/icon/4.png" alt="">
                    </div>
                    <div class="counter-info">
                        <div class="counter-number">
                            <h3 class="counter">2024</h3>
                        </div>
                        <div class="counter-text">
                            <span>HOÀN THÀNH LUẬN VĂN TỐT NGHIỆP</span>
                        </div>
                    </div>
                </div>
                <!-- limupa Counter Area End Here -->
            </div>
        </div>
    </div>
</div>
<!-- Counterup Area End Here -->
<!-- team area wrapper start -->
<div class="team-area pt-60 pt-sm-44">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="li-section-title capitalize mb-25">
                    <h2><span></span></h2>
                </div>
            </div>
        </div> <!-- section title end -->
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team-member mb-60 mb-sm-30 mb-xs-30">
                    <div class="team-thumb">
                        <img src="{{asset(('frontend/images/about-us/avtfake.jpg'))}}" alt="Our Team Member">
                    </div>
                    <div class="team-content text-center">
                        <h3>Lê Thanh Huy</h3>
                        <p>Khoa CNTT - Lớp D18_TH12</p>
                        <p>MSSV: DH51804755</p>
                        <div class="team-social">
                            <a href="https://www.facebook.com/huy0522"><i class="fa fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div> <!-- end single team member -->
        </div> <!-- end row -->
    </div>
</div>
<!-- team area wrapper end -->


@endsection