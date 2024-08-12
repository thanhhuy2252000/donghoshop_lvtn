@extends('backend.layout.master')
@section('title','Quản lý đánh giá bình luận | DongHoShop')


@section('body')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Bình luận - Đánh giá sản phẩm</h4>
                <ul class="breadcrumbs">
                </ul>
            </div>
            <!-- Form Bộ Lọc -->
            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="{{ route('rating.index') }}" class="form-inline">
                        <div class="form-group mr-2">
                            <label for="filter_id" class="mr-2">ID rating</label>
                            <input type="text" name="filter_id" value="{{ request('filter_id') }}" placeholder="ID" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_user_name" class="mr-2">Tên người đánh giá</label>
                            <input type="text" name="filter_user_name" value="{{ request('filter_user_name') }}" placeholder="Tên người đánh giá" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_user_id" class="mr-2">ID người đánh giá</label>
                            <input type="text" name="filter_user_id" value="{{ request('filter_user_id') }}" placeholder="Id người đánh giá" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_sanpham_name" class="mr-2">Tên sản phẩm</label>
                            <input type="text" name="filter_sanpham_name" value="{{ request('filter_sanpham_name') }}" placeholder="Tên sản phẩm" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_sanpham_id" class="mr-2">ID sản phẩm</label>
                            <input type="text" name="filter_sanpham_id" value="{{ request('filter_sanpham_id') }}" placeholder="Id sản phẩm" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_trangthai" class="mr-2">Trạng thái</label>
                            <select name="filter_trangthai" id="filter_trangthai" class="form-control">
                                <option value="">Chọn trang thái</option>
                                <option value="0" {{ request('filter_trangthai') == '0' ? 'selected' : '' }}>Chưa duyệt</option>
                                <option value="1" {{ request('filter_trangthai') == '1' ? 'selected' : '' }}>Đã duyệt</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_rating" class="mr-2">Số sao</label>
                            <select name="filter_rating" id="filter_rating" class="form-control">
                                <option value="">Chọn số sao</option>
                                <option value="1" {{ request('filter_rating') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ request('filter_rating') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ request('filter_rating') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ request('filter_rating') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ request('filter_rating') == '5' ? 'selected' : '' }}>5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-light"><i class="bi bi-funnel"></i> Lọc</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
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
                            <!-- Bảng Sản Phẩm -->
                            <div class="table-responsive ">
                                @if(!($ratings->isEmpty()))
                                <table id="basic-datatables" class="display table table-striped table-hover table-head-bg-info thead th">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 20px;">STT</th>
                                            <th scope="col" style="font-size: 20px;">ID Rating</th>
                                            <th scope="col" style="font-size: 20px;">Tên người đánh giá</th>
                                            <th scope="col" style="font-size: 20px;">ID người đánh giá</th>
                                            <th scope="col" style="font-size: 20px;">Tên sản phẩm</th>
                                            <th scope="col" style="font-size: 20px;">Img sản phẩm</th>
                                            <th scope="col" style="font-size: 20px;">ID sản phẩm</th>
                                            <th scope="col" style="font-size: 20px; ">Bình luận</th>
                                            <th scope="col" style="font-size: 20px;">Số sao</th>
                                            <th scope="col" style="font-size: 20px;">Quản lý trạng thái</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ratings as $i=>$rating)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$rating->id}}</td>
                                            <td style="width:70px;">{{$rating->rating_us->name}}</td>
                                            <td>{{$rating->rating_us->id}}</td>
                                            <td>{{$rating->rating_ct->ct_sanpham->name}}</td>
                                            <td><img src="{{asset('backend/img/product/'.$rating->rating_ct->ct_sanpham->img)}}" width="70px"></td>
                                            <td>{{$rating->rating_ct->ct_sanpham->id}}</td>
                                            <td onclick="expandCell(this)" class="mota-css">{{$rating->comment}}</td>
                                            <td>{{$rating->rating}}</td>
                                            <form action="{{ route('rating.update', ['id' => $rating->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                                <td>
                                                    <select name="trangthai" id="trangthai" class="form-control" style="width:150px;">
                                                        <option value="0" {{ $rating->trangthai == 0 ? 'selected' : '' }}>Chưa duyệt</option>
                                                        <option value="1" {{ $rating->trangthai == 1 ? 'selected' : '' }}>Đã duyệt</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-round btn-edit">
                                                        <i class="bi bi-floppy"></i> Lưu
                                                    </button>
                                                </td>
                                            </form>
                                            <td>
                                                <a href="{{route('rating.delete',$rating->id)}}" class="delete-user" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận đánh giá này không?')">
                                                    <button type="button" class="btn btn-round btn-danger" data-toggle="">
                                                        <i class="fa fa-minus"></i>
                                                        Xóa
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p class="text-center">Không tìm thấy đánh giá</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    {{ $ratings -> links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- xử lý xổ mô tả để đọc -->
    <script>
        function expandCell(cell) {
            cell.classList.toggle('expanded');
        }
    </script>
    @endsection