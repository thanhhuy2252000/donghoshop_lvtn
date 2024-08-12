@extends('frontend.layout.master')
@section('title','Kết quả tìm kiếm | DongHoShop')


@section('body')
<!-- Begin Li's Breadcrumb Area -->

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{route('frontend.index')}}">Home</a></li>
                <li class="active">Kết quả tìm kiếm "{{ request()->input('query') }}"</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        @if($products->isEmpty())

        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2">
                <!-- Begin Li's Banner Area -->
                <div class="single-banner shop-page-banner">
                    <img src="{{asset('frontend/images/bg-banner/2.jpg')}}" alt="Li's Static Banner">
                </div>
                <div class="shop-top-bar mt-30">
                    <span>Xin lỗi vì không tìm thấy sản phẩm nào tương tự từ khóa bạn muốn tìm. Hãy nhập từ khóa khác để tìm kiếm !</span>
                </div>
                <div class="paginatoin-area" style="border:0cap ;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 pt-xs-15">

                        </div>
                        <div class="col-lg-6 col-md-6">
                            <ul class="pagination-box pt-xs-20 pb-xs-15">
                                <h5><a href="{{route('frontend.index')}}" class="checkoutt">Trở về trang chủ</a></h5>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
                <!--sidebar-categores-box start  -->
                <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                    <div class="sidebar-title">
                        <h2>Danh mục tìm kiếm</h2>
                    </div>
                    <!-- category-sub-menu start -->
                    <div class="category-sub-menu">
                        <ul>
                            <li class="has-sub"><a href="# ">Thương hiệu</a>
                                <ul>
                                    @foreach ($brands as $brand)
                                    <li value="{{$brand->id}}"><a href="{{ route('search.result', ['query' => $brand->tenTH]) }}">{{$brand->tenTH}}</a></li>
                                    @endforeach
                            </li>
                        </ul>
                        </li>
                        <li class="has-sub"><a href="#">Danh mục</a>
                            <ul>
                                @foreach ($caterogys as $caterogy)
                                <li value="{{$caterogy->id}}"><a href="{{ route('search.result', ['query' => $caterogy->tenDM]) }}">{{$caterogy->tenDM}}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        </ul>
                    </div>
                    <!-- category-sub-menu end -->
                </div>
                <!--sidebar-categores-box end  -->
                <!--sidebar-categores-box start  -->
                <form id="filterForm" action="{{ route('search.result') }}" method="GET">
                    <input type="hidden" name="query" value="{{ request()->input('query') }}">

                    <!-- Bộ lọc -->
                    <div class="sidebar-categores-box ">
                        <div class="sidebar-title">
                            <h2>Lọc theo</h2>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Khoảng giá</a>
                                    <ul>
                                        <li><input type="checkbox" name="gia" value="-1tr"> Dưới 1 tr</li>
                                        <li><input type="checkbox" name="gia" value="1-5tr"> Từ 1-5 tr</li>
                                        <li><input type="checkbox" name="gia" value="5-10tr"> Từ 5-10 tr</li>
                                        <li><input type="checkbox" name="gia" value="10tr+"> Trên 10 tr</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Thương hiệu</a>
                                    <ul>
                                        @foreach ($brands as $brand)
                                        <li><input type="checkbox" name="brand" value="{{$brand->tenTH}}"> {{$brand->tenTH}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Danh mục</a>
                                    <ul>
                                        @foreach ($caterogys as $caterogy)
                                        <li><input type="checkbox" name="caterogy" value="{{$caterogy->tenDM}}"> {{$caterogy->tenDM}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Loại Dây</a>
                                    <ul>
                                        <li><input type="checkbox" name="loai_day" value="Dây da"> Dây da</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây nhựa"> Dây nhựa</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây thép"> Dây thép</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây thép lưới"> Dây thép lưới</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây cao su"> Dây cao su</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Loại mặt</a>
                                    <ul>
                                        <li><input type="checkbox" name="loai_mat" value="Vuông"> Vuông</li>
                                        <li><input type="checkbox" name="loai_mat" value="Tròn"> Tròn</li>
                                        <li><input type="checkbox" name="loai_mat" value="Hình chữ nhật"> Hình chữ nhật</li>
                                        <li><input type="checkbox" name="loai_mat" value="Oval & Elip"> Oval & Elip</li>
                                        <li><input type="checkbox" name="loai_mat" value="Tonneau"> Tonneau</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Loại kính</a>
                                    <ul>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Saphire"> Kính Saphire</li>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Mineral"> Kính Mineral</li>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Acrylic"> Kính Acrylic</li>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Cường Lực"> Kính Cường Lực</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox color-categoriy"><a href="#">Màu Dây</a>
                                    <ul>
                                        <li><input type="checkbox" name="mau_day" value="Trắng"> Trắng <span class="White color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Đen"> Đen <span class="Black color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Cam"> Cam <span class="Orange color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Xanh dương"> Xanh dương <span class="Blue color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Xanh lá"> Xanh lá <span class="Green color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Đỏ"> Đỏ <span class="Red color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Vàng"> Vàng <span class="Yellow color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Xám"> Xám <span class="Gray color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Bạc"> Bạc <span class="Silver color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Hồng"> Hồng <span class="Pink color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Tím"> Tím <span class="Purple color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Nâu"> Nâu <span class="Brown color-search"></span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox color-categoriy"><a href="#">Màu vỏ</a>
                                    <ul>
                                        <li><input type="checkbox" name="mau_vo" value="Trắng"> Trắng <span class="White color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Đen"> Đen <span class="Black color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Cam"> Cam <span class="Orange color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Xanh dương"> Xanh dương <span class="Blue color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Xanh lá"> Xanh lá <span class="Green color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Đỏ"> Đỏ <span class="Red color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Vàng"> Vàng <span class="Yellow color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Xám"> Xám <span class="Gray color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Bạc"> Bạc <span class="Silver color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Hồng"> Hồng <span class="Pink color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Tím"> Tím <span class="Purple color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Nâu"> Nâu <span class="Brown color-search"></span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox color-categoriy"><a href="#">Màu mặt</a>
                                    <ul>
                                        <li><input type="checkbox" name="mau_mat" value="Trắng"> Trắng <span class="White color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Đen"> Đen <span class="Black color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Cam"> Cam <span class="Orange color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Xanh dương"> Xanh dương <span class="Blue color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Xanh lá"> Xanh lá <span class="Green color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Đỏ"> Đỏ <span class="Red color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Vàng"> Vàng <span class="Yellow color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Xám"> Xám <span class="Gray color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Bạc"> Bạc <span class="Silver color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Hồng"> Hồng <span class="Pink color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Tím"> Tím <span class="Purple color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Nâu"> Nâu <span class="Brown color-search"></span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Kích thước</a>
                                    <ul>
                                        <li><input type="checkbox" name="size" value="20-30mm"> 20-30 mm</li>
                                        <li><input type="checkbox" name="size" value="30-40mm"> 30-40 mm</li>
                                        <li><input type="checkbox" name="size" value="40-50mm"> 40-50 mm</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15 order-button-payment">
                            <button type="submit" id="filterButton" style="display: none;">Áp dụng bộ lọc</button>
                        </div>
                    </div>
                </form>
                <div class="sidebar-categores-box mb-sm-0 mb-xs-0">
                    <div class="sidebar-title">
                        <h2>Từ khóa phổ biến</h2>
                    </div>
                    <div class="category-tags">
                        <ul>
                            <li><a href="{{ route('search.result', ['query' => 'đồng hồ nam']) }}">đồng hồ nam</a></li>
                            <li><a href="{{ route('search.result', ['query' => 'đồng hồ nữ']) }}">đồng hồ nữ</a></li>
                        </ul>
                    </div>
                    <!-- category-sub-menu end -->
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2">
                <!-- Begin Li's Banner Area -->
                <div class="single-banner shop-page-banner">

                    <img src="{{asset('frontend/images/bg-banner/2.jpg')}}" alt="Li's Static Banner">

                </div>
                <!-- Li's Banner Area End Here -->
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                            </ul>
                        </div>
                        <div class="toolbar-amount">
                            <span></span>
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    <div class="product-select-box">
                        <div class="product-short">
                            <form method="GET" action="{{ route('search.result') }}" id="sortForm">
                                <input type="hidden" name="query" value="{{ request('query') }}">
                                @foreach(request()->except('sort') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <select name="sort" onchange="document.getElementById('sortForm').submit()">
                                    <option value="">Sắp xếp theo</option>
                                    <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Tên sản phẩm (A-Z)</option>
                                    <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Tên sản phẩm (Z-A)</option>
                                    <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                    <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">
                                                    <img src="{{asset('backend/img/product/'.$product->img)}}" alt="Li's Product Image">
                                                </a>
                                                <!-- xét khuyến mãi logo trên sản phẩm-->
                                                @if ($product->giaKM != null)
                                                <span class="sticker-1">Sale</span>
                                                @else
                                                <span class="sticker">New</span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <h4><a class="product_name" href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">{{$product->name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($product->giaKM != null)
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
                                                        <form action="{{ route('cart.add') }}" class="cart-quantity" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                                            <button class="add-to-cart add-cart active" type="submit">Thêm vào giỏ</button>
                                                        </form>
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
                        <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    @foreach ($products as $product)
                                    <div class="row product-layout-list">
                                        <div class="col-lg-3 col-md-5 ">
                                            <div class="product-image">
                                                <a href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">
                                                    <img src="{{asset('backend/img/product/'.$product->img)}}" alt="Li's Product Image">
                                                </a>
                                                <!-- xét khuyến mãi logo trên sản phẩm-->
                                                @if ($product->giaKM != null)
                                                <span class="sticker-1">Sale</span>
                                                @else
                                                <span class="sticker">New</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-7">
                                            <div class="product_desc">
                                                <div class="product_desc_info">

                                                    <h4><a class="product_name" href="{{route('productDetail.index',['id'=>$product->id,'slug' => Str::slug($product->name)])}}">{{$product->name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($product->giaKM != null)
                                                        <span class="new-price new-price-2">{{ number_format($product->giaKM) }} đ</span>
                                                        <span class="old-price">{{ number_format($product->gia) }} đ</span>
                                                        <span class="discount-percentage">-{{number_format((($product->gia-$product->giaKM)/$product->gia)*100,1)}}%</span>
                                                        @else
                                                        <span class="new-price">{{ number_format($product->gia) }} đ</span>
                                                        @endif
                                                    </div>
                                                    <p>{{ $product->mota }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <form action="{{ route('cart.add') }}" class="cart-quantity" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <button class="add-to-cart add-cart active" type="submit">Thêm vào giỏ</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="paginatoin-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 pt-xs-15">
                                    <p></p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <!-- {{ $products->links() }} -->
                                    <ul class="pagination-box pt-xs-20 pb-xs-15">
                                        <li class="{{ $products->onFirstPage() ? 'disabled' : '' }}">
                                            <a href="{{ $products->appends(request()->query())->previousPageUrl() }}" class="Previous">
                                                <i class="fa fa-chevron-left"></i> Previous
                                            </a>
                                        </li>
                                        @foreach(range(1, $products->lastPage()) as $i)
                                        <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $products->appends(request()->query())->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endforeach
                                        <li class="{{ $products->hasMorePages() ? '' : 'disabled' }}">
                                            <a href="{{ $products->appends(request()->query())->nextPageUrl() }}" class="Next">
                                                Next <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
                <!--sidebar-categores-box start  -->
                <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                    <div class="sidebar-title">
                        <h2>Danh mục tìm kiếm</h2>
                    </div>
                    <!-- category-sub-menu start -->
                    <div class="category-sub-menu">
                        <ul>
                            <li class="has-sub"><a href="# ">Thương hiệu</a>
                                <ul>
                                    @foreach ($brands as $brand)
                                    <li value="{{$brand->id}}"><a href="{{ route('search.result', ['query' => $brand->tenTH]) }}">{{$brand->tenTH}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <li class="has-sub"><a href="#">Danh mục</a>
                                <ul>
                                    @foreach ($caterogys as $caterogy)
                                    <li value="{{$caterogy->id}}"><a href="{{ route('search.result', ['query' => $caterogy->tenDM]) }}">{{$caterogy->tenDM}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- category-sub-menu end -->
                </div>
                <!--sidebar-categores-box end  -->
                <!--sidebar-categores-box start  -->
                <form id="filterForm" action="{{ route('search.result') }}" method="GET">
                    <input type="hidden" name="query" value="{{ request()->input('query') }}">

                    <!-- Bộ lọc -->
                    <div class="sidebar-categores-box ">
                        <div class="sidebar-title">
                            <h2>Lọc theo</h2>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Khoảng giá</a>
                                    <ul>
                                        <li><input type="checkbox" name="gia" value="-1tr"> Dưới 1 tr</li>
                                        <li><input type="checkbox" name="gia" value="1-5tr"> Từ 1-5 tr</li>
                                        <li><input type="checkbox" name="gia" value="5-10tr"> Từ 5-10 tr</li>
                                        <li><input type="checkbox" name="gia" value="10tr+"> Trên 10 tr</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Thương hiệu</a>
                                    <ul>
                                        @foreach ($brands as $brand)
                                        <li><input type="checkbox" name="brand" value="{{$brand->tenTH}}"> {{$brand->tenTH}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Danh mục</a>
                                    <ul>
                                        @foreach ($caterogys as $caterogy)
                                        <li><input type="checkbox" name="caterogy" value="{{$caterogy->tenDM}}"> {{$caterogy->tenDM}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Loại Dây</a>
                                    <ul>
                                        <li><input type="checkbox" name="loai_day" value="Dây da"> Dây da</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây nhựa"> Dây nhựa</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây thép"> Dây thép</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây thép lưới"> Dây thép lưới</li>
                                        <li><input type="checkbox" name="loai_day" value="Dây cao su"> Dây cao su</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Loại mặt</a>
                                    <ul>
                                        <li><input type="checkbox" name="loai_mat" value="Vuông"> Vuông</li>
                                        <li><input type="checkbox" name="loai_mat" value="Tròn"> Tròn</li>
                                        <li><input type="checkbox" name="loai_mat" value="Hình chữ nhật"> Hình chữ nhật</li>
                                        <li><input type="checkbox" name="loai_mat" value="Oval & Elip"> Oval & Elip</li>
                                        <li><input type="checkbox" name="loai_mat" value="Tonneau"> Tonneau</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Loại kính</a>
                                    <ul>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Saphire"> Kính Saphire</li>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Mineral"> Kính Mineral</li>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Acrylic"> Kính Acrylic</li>
                                        <li><input type="checkbox" name="loai_kinh" value="Kính Cường Lực"> Kính Cường Lực</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox color-categoriy"><a href="#">Màu Dây</a>
                                    <ul>
                                        <li><input type="checkbox" name="mau_day" value="Trắng"> Trắng <span class="White color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Đen"> Đen <span class="Black color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Cam"> Cam <span class="Orange color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Xanh dương"> Xanh dương <span class="Blue color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Xanh lá"> Xanh lá <span class="Green color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Đỏ"> Đỏ <span class="Red color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Vàng"> Vàng <span class="Yellow color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Xám"> Xám <span class="Gray color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Bạc"> Bạc <span class="Silver color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Hồng"> Hồng <span class="Pink color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Tím"> Tím <span class="Purple color-search"></span></li>
                                        <li><input type="checkbox" name="mau_day" value="Nâu"> Nâu <span class="Brown color-search"></span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox color-categoriy"><a href="#">Màu vỏ</a>
                                    <ul>
                                        <li><input type="checkbox" name="mau_vo" value="Trắng"> Trắng <span class="White color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Đen"> Đen <span class="Black color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Cam"> Cam <span class="Orange color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Xanh dương"> Xanh dương <span class="Blue color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Xanh lá"> Xanh lá <span class="Green color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Đỏ"> Đỏ <span class="Red color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Vàng"> Vàng <span class="Yellow color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Xám"> Xám <span class="Gray color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Bạc"> Bạc <span class="Silver color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Hồng"> Hồng <span class="Pink color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Tím"> Tím <span class="Purple color-search"></span></li>
                                        <li><input type="checkbox" name="mau_vo" value="Nâu"> Nâu <span class="Brown color-search"></span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox color-categoriy"><a href="#">Màu mặt</a>
                                    <ul>
                                        <li><input type="checkbox" name="mau_mat" value="Trắng"> Trắng <span class="White color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Đen"> Đen <span class="Black color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Cam"> Cam <span class="Orange color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Xanh dương"> Xanh dương <span class="Blue color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Xanh lá"> Xanh lá <span class="Green color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Đỏ"> Đỏ <span class="Red color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Vàng"> Vàng <span class="Yellow color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Xám"> Xám <span class="Gray color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Bạc"> Bạc <span class="Silver color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Hồng"> Hồng <span class="Pink color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Tím"> Tím <span class="Purple color-search"></span></li>
                                        <li><input type="checkbox" name="mau_mat" value="Nâu"> Nâu <span class="Brown color-search"></span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pt-xs-10 category-sub-menu">
                            <ul>
                                <li class="has-sub filter-sub-titel categori-checkbox"><a href="#">Kích thước</a>
                                    <ul>
                                        <li><input type="checkbox" name="size" value="20-30mm"> 20-30 mm</li>
                                        <li><input type="checkbox" name="size" value="30-40mm"> 30-40 mm</li>
                                        <li><input type="checkbox" name="size" value="40-50mm"> 40-50 mm</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15 order-button-payment">
                            <button type="submit" id="filterButton" style="display: none;">Áp dụng bộ lọc</button>
                        </div>
                    </div>
                </form>
                <!--sidebar-categores-box end  -->
                <!-- category-sub-menu start -->
                <div class="sidebar-categores-box mb-sm-0 mb-xs-0">
                    <div class="sidebar-title">
                        <h2>Từ khóa phổ biến</h2>
                    </div>
                    <div class="category-tags">
                        <ul>
                            <li><a href="{{ route('search.result', ['query' => 'đồng hồ nam']) }}">đồng hồ nam</a></li>
                            <li><a href="{{ route('search.result', ['query' => 'đồng hồ nữ']) }}">đồng hồ nữ</a></li>
                        </ul>
                    </div>
                    <!-- category-sub-menu end -->
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Content Wraper Area End Here -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const filterButton = document.getElementById('filterButton');

        // Theo dõi sự thay đổi trên các input
        filterForm.addEventListener('change', function() {
            // Kiểm tra xem có bất kỳ điều kiện nào được chọn
            const isAnySelected = Array.from(filterForm.elements).some(input => {
                return (input.type === 'checkbox' && input.checked) || (input.type === 'select' && input.value);
            });

            // Hiển thị hoặc ẩn nút lọc
            filterButton.style.display = isAnySelected ? 'block' : 'none';
        });
    });
</script>
@endsection