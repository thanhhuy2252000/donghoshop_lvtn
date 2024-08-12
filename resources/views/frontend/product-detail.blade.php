@extends('frontend.layout.master')
@section('title','Chi tiết sản phẩm | DongHoShop')

@section('body')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{route('frontend.index')}}">Home</a></li>
                <li class="active">Single Product</li>
            </ul>
        </div>
    </div>
</div>

<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">

                        @foreach ($imgs->sp_hinhsanpham as $imgitem)
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{asset('backend/img/product/'.$imgitem->imgs)}}" data-gall="myGallery">
                                <img src="{{asset('backend/img/product/'.$imgitem->imgs)}}" alt="product image">
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">
                        @foreach ($imgs->sp_hinhsanpham as $imgitem)
                        <div class="sm-image"><img src='{{asset('backend/img/product/'.$imgitem->imgs)}}' alt="product image thumb"></div>
                        @endforeach
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
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
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h1>{{$product->name}}</h1>
                        <div class="rating-box pt-20">
                            <span>Đánh giá sản phẩm</span>
                            <ul class="rating rating-with-review-item">
                                @for ($i = 1; $i <= 5; $i++) <li>
                                    @if ($i <= $rating) <i class="fa fa-star"></i>
                                        @else
                                        <i class="fa fa-star-o"></i>
                                        @endif
                                        </li>
                                        @endfor
                                        <li style="color:red; padding-left:15px; margin-top: 10px; font-size: 14px;">{{ $rating }} / 5</li>
                                        <li>({{ $ratingCount }} đánh giá)</li>
                            </ul>
                        </div>
                        <div class="price-box pt-20">
                            @if($product->giaKM != null && $product->km_tungay <= now() && now() <=$product->km_denngay)
                                <span class="new-price new-price-2">{{ number_format($product->giaKM)}} đ</span>
                                <span class="old-price-2">{{ number_format($product->gia)}} đ</span>
                                <span class="discount-percentage" style="color:red;">-{{number_format((($product->gia-$product->giaKM)/$product->gia)*100,1)}}%</span>
                                @else
                                <span class="new-price">{{ number_format($product->gia)}} đ</span>
                                @endif
                        </div>
                        <div class="product-variants">
                            <div class="produt-variants-size">
                                <label>Kích Thước</label>
                                <span>{{ $product->size}}mm</span>
                            </div>
                        </div>
                        @if ($product->soluong > 0)
                        <div class="single-add-to-cart">
                            <form action="{{ route('cart.add') }}" class="cart-quantity" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="km_tungay" value="{{ $product->km_tungay }}">
                                <input type="hidden" name="km_denngay" value="{{ $product->km_denngay }}">
                                <button class="add-to-cart" type="submit">Thêm vào giỏ</button>
                            </form>
                        </div>
                        @else
                        <div class="single-add-to-cart">
                            <div class="cart-quantity">
                                <button class="add-to-cart">Hết hàng</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Mô tả</span></a></li>
                        <li><a data-toggle="tab" href="#product-details"><span>Thông tin chi tiết</span></a></li>
                        <li><a data-toggle="tab" href="#reviews"><span>Đánh giá (đọc/viết đánh giá)</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    <span>{{$product->mota}}</span>
                </div>
            </div>
            <div id="product-details" class="tab-pane" role="tabpanel">
                <div class="product-details-manufacturer">
                    <p><span>Thương hiệu: </span>{{$product->sp_thuonghieu->tenTH}}</p>
                    <p><span>Giới tính: </span>
                    {{$product->sp_danhmuc->tenDM}}
                    </p>
                    <p><span>Size: </span>{{$product->size}}</p>
                    <p><span>Loại dây: </span>{{$product->loai_day}}</p>
                    <p><span>Loại mặt: </span>{{$product->loai_mat}}</p>
                    <p><span>Loại kính: </span>{{$product->loai_kinh}}</p>
                    <p><span>Màu dây: </span>{{$product->mau_day}}</p>
                    <p><span>Màu mặt: </span>{{$product->mau_mat}}</p>
                    <p><span>Màu vỏ: </span>{{$product->mau_vo}}</p>
                    <p><span>Năng lượng máy: </span>{{$product->nangluong}}</p>
                </div>
            </div>
            <div id="reviews" class="tab-pane" role="tabpanel">
                <div class="product-reviews">
                    <div class="product-details-comment-block">
                        <div class="comment-review" style="padding-right:10px; margin: 10px;">
                            <span>Đánh giá sản phẩm</span>
                            <ul class="rating">
                                @for ($i = 1; $i <= 5; $i++) 
                                    <li>
                                        @if ($i <= $rating) 
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    </li>
                                @endfor
                                <li style="color:red; padding-left:15px; margin-top: 10px; font-size: 14px;">{{ $rating }} / 5</li>
                                <li>({{ $ratingCount }} đánh giá)</li>
                            </ul>
                        </div>
                        <div class="review-btn">
                            <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Viết đánh giá của bạn!</a>
                        </div>
                        <div class="comment-author-infos ">
                            <span>-----------------------------------------</span>
                        </div>
                        <!--Các bình luận đánh giá -->
                        <div class="li-comment-section">
                            <h3>Các bình luận đánh giá mới nhất</h3>
                            <ul id="comment-list">
                                @foreach($initialComments as $index => $comment)
                                <li class="comment-item">
                                    <div class="author-avatar pt-15">
                                        @if(!$comment->rating_us->avt)
                                        <img src="{{ asset('backend/img/avatar/blank.jpg') }}" alt="avatar" width="80px" height="80px">
                                        @else
                                        <img src="{{ asset('backend/img/avatar/' . $comment->rating_us->avt) }}" alt="avatar" width="80px" height="80px">
                                        @endif
                                    </div>
                                    <div class="comment-body pl-15">
                                        <h5 class="comment-author pt-15">{{ $comment->rating_us->name }}</h5>
                                        <div class="comment-post-date">
                                            {{ $comment->formatted_date }}
                                        </div>
                                        <!-- hiện số sao của mỗi bình luận đánh giá -->
                                        <div class="comment-rating">
                                            @for ($i = 1; $i <= 5; $i++) 
                                                @if ($i <= $comment->rating) 
                                                    <i class="fa fa-star" style="color:#fed700"></i>
                                                @else
                                                    <i class="fa fa-star-o" style="color:#e3e3e3; border-color:#fed700;"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </li>
                                @endforeach
                                <div id="more-comments" style="display: none;">
                                    @foreach($comments->slice(3) as $comment)
                                    <li class="comment-item">
                                        <div class="author-avatar pt-15">
                                            @if(!$comment->rating_us->avt)
                                            <img src="{{ asset('backend/img/avatar/blank.jpg') }}" alt="avatar" width="80px" height="80px">
                                            @else
                                            <img src="{{ asset('backend/img/avatar/' . $comment->rating_us->avt) }}" alt="avatar" width="80px" height="80px">
                                            @endif
                                        </div>
                                        <div class="comment-body pl-15">
                                            <h5 class="comment-author pt-15">{{ $comment->rating_us->name }}</h5>
                                            <div class="comment-post-date">
                                                {{ $comment->formatted_date }}
                                            </div>
                                            <!-- hiện số sao của mỗi bình luận đánh giá -->
                                            <div class="comment-rating">
                                                @for ($i = 1; $i <= 5; $i++) 
                                                    @if ($i <= $comment->rating) 
                                                        <i class="fa fa-star" style="color:#fed700"></i>
                                                    @else
                                                        <i class="fa fa-star-o" style="color:#e3e3e3; border-color:#fed700;"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </div>
                            </ul>
                            @if($show_all_comments)
                            <div class="show-comment">
                                <button id="show-more-comments" class="">Hiện tất cả bình luận đánh giá</button>
                            </div>
                            <div class="hidden-comment">
                                <button id="show-less-comments" class="btn btn-secondary" style="display: none;">Ẩn bớt</button>
                            </div>
                            @endif
                        </div>
                        <!--end bình luận -->
                        <!-- Begin Quick View | Modal Area -->
                        <div class="modal fade modal-wrapper" id="mymodal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h3 class="review-page-title">Viết đánh giá</h3>
                                        <div class="modal-inner-area row">
                                            <div class="col-lg-6">
                                                <div class="li-review-product">
                                                    <img src="{{asset('backend/img/product/'.$product->img)}}" alt="Li's Product">
                                                    <div class="li-review-product-desc">
                                                        <p class="li-product-name">{{$product->name}}</p>
                                                        <p>
                                                            <span>{{$product->mota}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="li-review-content">
                                                    <!-- Begin Feedback Area -->
                                                    <div class="feedback-area">
                                                        <div class="feedback">
                                                            <h3 class="feedback-title">Phản hồi</h3>
                                                            <form action="{{ route('product.rate',['id'=> $product->id]) }}" method="POST">
                                                                @csrf
                                                                <p class="your-opinion">
                                                                    <label>Đánh giá</label>
                                                                    <span>
                                                                        <select name="rating" class="star-rating">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <p class="feedback-form">
                                                                    <label for="feedback">Viết đánh giá sản phẩm chi tiết</label>
                                                                    <textarea id="feedback" name="comment" cols="45" rows="8"></textarea>
                                                                </p>
                                                                <div class="feedback-input">
                                                                    <div class="feedback-btn pb-15">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">Hủy</button>
                                                                        <button type="submit" onclick="return confirmSubmission()">Gửi</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Feedback Area End Here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick View | Modal Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-30 pb-50">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Sản phẩm tương tự:</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($otherProducts as $otherProduct)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{route('productDetail.index',['id'=>$otherProduct->id,'slug' => Str::slug($otherProduct->name)])}}">
                                        <img src="{{asset('backend/img/product/'.$otherProduct->img)}}" alt="Li's Product Image">

                                    </a>
                                    <!-- xét khuyến mãi logo trên sản phẩm-->
                                    @if ($otherProduct->giaKM != null && $otherProduct->km_tungay <= now() && now() <=$otherProduct->km_denngay)
                                        <span class="sticker-1">Sale</span>
                                        @else
                                        <span class="sticker">New</span>
                                        @endif

                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <h4><a class="product_name" href="{{route('productDetail.index',['id'=>$otherProduct->id,'slug' => Str::slug($otherProduct->name)])}}">{{$otherProduct->name}}</a></h4>
                                        <div class="price-box">
                                            @if($otherProduct->giaKM != null && $otherProduct->km_tungay <= now() && now() <=$otherProduct->km_denngay)
                                                <span class="new-price new-price-2">{{ number_format($otherProduct->giaKM) }} đ</span>
                                                <span class="old-price">{{ number_format($otherProduct->gia) }} đ</span>
                                                <span class="discount-percentage">-{{number_format((($otherProduct->gia-$otherProduct->giaKM)/$otherProduct->gia)*100,1)}}%</span>
                                                @else
                                                <span class="new-price">{{ number_format($otherProduct->gia) }} đ</span>
                                                @endif

                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <form action="{{ route('cart.add') }}" class="cart-quantity" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $otherProduct->id }}">
                                                <input type="hidden" name="km_tungay" value="{{ $otherProduct->km_tungay }}">
                                                <input type="hidden" name="km_denngay" value="{{ $otherProduct->km_denngay }}">
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
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->
<script>
document.getElementById('show-more-comments').addEventListener('click', function() {
    var moreComments = document.getElementById('more-comments');
    var showMoreBtn = document.getElementById('show-more-comments');
    var showLessBtn = document.getElementById('show-less-comments');
    
    moreComments.style.display = 'block';
    showMoreBtn.style.display = 'none';
    showLessBtn.style.display = 'inline-block';
});

document.getElementById('show-less-comments').addEventListener('click', function() {
    var moreComments = document.getElementById('more-comments');
    var showMoreBtn = document.getElementById('show-more-comments');
    var showLessBtn = document.getElementById('show-less-comments');
    
    moreComments.style.display = 'none';
    showMoreBtn.style.display = 'inline-block';
    showLessBtn.style.display = 'none';
});
function confirmSubmission() {
    return confirm("Vui lòng kiểm tra trước khi gửi! \nSố sao tương đương mức độ hài lòng của bạn về sản phẩm. \nNội dung đánh giá của bạn sẽ là dữ liệu đánh giá tuyệt đối cho sản phẩm của chúng tôi ! \nMọi sai sót của sản phẩm hoặc từ shop, vui lòng liên hệ để nhận hỗ trợ. \nBạn xác nhận gửi?");
}
</script>
@endsection