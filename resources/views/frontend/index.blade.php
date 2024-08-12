@extends('frontend.layout.master')
@section('title','Trang chủ | DongHoShop')


@section('body')

<!-- Header Area End Here -->
<!-- Begin Slider With Banner Area -->
<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Slider Area -->
            <div class="col-lg-8 col-md-8">
                <div class="slider-area">
                    <div class="slider-active owl-carousel">
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide align-center-left  animation-style-01 bg-1">
                            <div class="slider-progress"></div>
                        </div>
                        <div class="single-slide align-center-left animation-style-02 bg-2">
                            <div class="slider-progress"></div>
                        </div>
                        <div class="single-slide align-center-left animation-style-01 bg-3">
                            <div class="slider-progress"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                <div class="li-banner">
                    <a href="#">
                        <img src="{{asset('frontend/images/banner/1_1.jpg')}}" alt="">
                    </a>
                </div>
                <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                    <a href="#">
                        <img src="{{asset('frontend/images/banner/1_2.jpg')}}" alt="">
                    </a>
                </div>
            </div>
            <!-- Li Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Slider With Banner Area End Here -->

<!-- Begin Li's  Product Area -->
<section class="product-area li-laptop-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span><a href="{{ route('search.result', ['query' => 'Nam']) }}">Đồng hồ nam</a></span>
                    </h2>

                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($donghonams as $product)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">
                                        <img src="{{asset('backend/img/product/'.$product->img)}}" alt="Li's Product Image">

                                    </a>
                                    <!-- xét khuyến mãi logo trên sản phẩm-->
                                    @if ($product->soluong == 0)
                                    <span class="sticker-2">Hết</span>
                                    @elseif ($product->giaKM != null && $product->km_tungay <= now() && now() <=$product->km_denngay)
                                        <span class="sticker-1">Sale</span>
                                        @else
                                        <span class="sticker">New</span>
                                        @endif

                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <h4><a class="product_name" href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">{{$product->name}}</a></h4>
                                        <div class="price-box">
                                            @if($product->giaKM != null && $product->km_tungay <= now() && now() <=$product->km_denngay)
                                                <span class="new-price new-price-2">{{ number_format($product->giaKM) }} đ</span>
                                                <span class="old-price">{{ number_format($product->gia) }} đ</span>
                                                <span class="discount-percentage">-{{number_format((($product->gia-$product->giaKM)/$product->gia)*100,1)}}%</span>
                                                @else
                                                <span class="new-price">{{ number_format($product->gia) }} đ</span>
                                                @endif

                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            @if ($product->soluong > 0)
                                            <form action="{{ route('cart.add') }}" class="cart-quantity" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="km_tungay" value="{{ $product->km_tungay }}">
                                                <input type="hidden" name="km_denngay" value="{{ $product->km_denngay }}">
                                                <button class="add-to-cart add-cart active" type="submit">Thêm vào giỏ</button>
                                            </form>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Li's  Product Area -->
<section class="product-area li-laptop-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span><a href="{{ route('search.result', ['query' => 'Nữ']) }}">Đồng hồ nữ</a></span>
                    </h2>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($donghonus as $product)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">
                                        <img src="{{asset('backend/img/product/'.$product->img)}}" alt="Li's Product Image">
                                    </a>
                                    <!-- xét khuyến mãi logo trên sản phẩm-->
                                    @if ($product->soluong == 0)
                                    <span class="sticker-2">Hết</span>
                                    @elseif ($product->giaKM != null && $product->km_tungay <= now() && now() <=$product->km_denngay)
                                        <span class="sticker-1">Sale</span>
                                        @else
                                        <span class="sticker">New</span>
                                        @endif

                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">


                                        </div>
                                        <h4><a class="product_name" href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">{{$product->name}}</a></h4>
                                        <div class="price-box">
                                            @if($product->giaKM != null && $product->km_tungay <= now() && now() <=$product->km_denngay)
                                                <span class="new-price new-price-2">{{ number_format($product->giaKM) }} đ</span>
                                                <span class="old-price">{{ number_format($product->gia) }} đ</span>
                                                <span class="discount-percentage">-{{number_format((($product->gia-$product->giaKM)/$product->gia)*100,1)}}%</span>
                                                @else
                                                <span class="new-price">{{ number_format($product->gia) }} đ</span>
                                                @endif

                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            @if ($product->soluong > 0)
                                            <form action="{{ route('cart.add') }}" class="cart-quantity" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="km_tungay" value="{{ $product->km_tungay }}">
                                                <input type="hidden" name="km_denngay" value="{{ $product->km_denngay }}">
                                                <button class="add-to-cart add-cart active" type="submit">Thêm vào giỏ</button>
                                            </form>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Single Banner Area -->
            <div class="col-lg-4 col-md-4 text-center">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('frontend/images/banner/1_3.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
            <!-- Begin Single Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('frontend/images/banner/1_4.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
            <!-- Begin Single Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('frontend/images/banner/1_5.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Static Banner Area End Here -->
<!-- Begin Li's  Product Area -->
<section class="product-area li-laptop-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span><a href="{{ route('search.result', ['query' => 'Đồng hồ đôi']) }}">Đồng hồ đôi</a></span>
                    </h2>

                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($donghodois as $product)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">
                                        <img src="{{asset('backend/img/product/'.$product->img)}}" alt="Li's Product Image">
                                    </a>
                                    <!-- xét khuyến mãi logo trên sản phẩm-->
                                    @if ($product->soluong == 0)
                                    <span class="sticker-2">Hết</span>
                                    @elseif ($product->giaKM != null && $product->km_tungay <= now() && now() <=$product->km_denngay)
                                        <span class="sticker-1">Sale</span>
                                        @else
                                        <span class="sticker">New</span>
                                        @endif

                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">

                                        </div>
                                        <h4><a class="product_name" href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">{{$product->name}}</a></h4>
                                        <div class="price-box">
                                            @if($product->giaKM != null && $product->km_tungay <= now() && now() <=$product->km_denngay)
                                                <span class="new-price new-price-2">{{ number_format($product->giaKM) }} đ</span>
                                                <span class="old-price">{{ number_format($product->gia) }} đ</span>
                                                <span class="discount-percentage">-{{number_format((($product->gia-$product->giaKM)/$product->gia)*100,1)}}%</span>
                                                @else
                                                <span class="new-price">{{ number_format($product->gia) }} đ</span>
                                                @endif

                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            @if ($product->soluong > 0)
                                            <form action="{{ route('cart.add') }}" class="cart-quantity" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="km_tungay" value="{{ $product->km_tungay }}">
                                                <input type="hidden" name="km_denngay" value="{{ $product->km_denngay }}">
                                                <button class="add-to-cart add-cart active" type="submit">Thêm vào giỏ</button>
                                            </form>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->

@endsection