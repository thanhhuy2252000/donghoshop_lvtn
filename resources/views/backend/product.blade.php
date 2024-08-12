@extends('backend.layout.master')
@section('title','Quản lý sản phẩm | DongHoShop')


@section('body')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Sản phẩm</h4>
                <ul class="breadcrumbs">

                    <li class="nav-item">
                        <a href="{{route('createProduct.index')}}"><button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="" data-target="">
                                <i class="fa fa-plus"></i>
                                Thêm
                            </button></a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                </ul>
            </div>
            <!-- Form Bộ Lọc -->
            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="{{ route('product.index') }}" class="form-inline">
                        <div class="form-group mr-2">
                            <label for="filter_id" class="mr-2">ID</label>
                            <input type="text" name="filter_id" value="{{ request('filter_id') }}" placeholder="ID" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_name" class="mr-2">Tên sản phẩm</label>
                            <input type="text" name="filter_name" value="{{ request('filter_name') }}" placeholder="Tên sản phẩm" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_size" class="mr-2">Size</label>
                            <input type="text" name="filter_size" value="{{ request('filter_size') }}" placeholder="Size" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_price_range" class="mr-2">Khoảng giá</label>
                            <select name="filter_price_range" id="filter_price_range" class="form-control">
                                <option value="">Chọn khoảng giá</option>
                                <option value="under_1m" {{ request('filter_price_range') == 'under_1m' ? 'selected' : '' }}>Nhỏ hơn 1 triệu</option>
                                <option value="1m_5m" {{ request('filter_price_range') == '1m_5m' ? 'selected' : '' }}>1 triệu đến 5 triệu</option>
                                <option value="5m_10m" {{ request('filter_price_range') == '5m_10m' ? 'selected' : '' }}>5 triệu đến 10 triệu</option>
                                <option value="above_10m" {{ request('filter_price_range') == 'above_10m' ? 'selected' : '' }}>Lớn hơn 10 triệu</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_km_tungay" class="mr-2">Ngày bắt đầu khuyến mãi</label>
                            <input type="date" name="filter_km_tungay" id="filter_km_tungay" value="{{ request('filter_km_tungay') }}" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_km_denngay" class="mr-2">Ngày kết thúc khuyến mãi</label>
                            <input type="date" name="filter_km_denngay" id="filter_km_denngay" value="{{ request('filter_km_denngay') }}" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_soluong" class="mr-2">Số lượng</label>
                            <input type="text" name="filter_soluong" value="{{ request('filter_soluong') }}" placeholder="Số lượng" class="form-control" />
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_loai_day" class="mr-2">Loại dây</label>
                            <select name="filter_loai_day" id="filter_loai_day" class="form-control">
                                <option value="">Chọn loại dây</option>
                                <option value="Dây da" {{ request('filter_loai_day') == 'Dây da' ? 'selected' : '' }}>Dây da</option>
                                <option value="Dây nhựa" {{ request('filter_loai_day') == 'Dây nhựa' ? 'selected' : '' }}>Dây nhựa</option>
                                <option value="Dây thép" {{ request('filter_loai_day') == 'Dây thép' ? 'selected' : '' }}>Dây thép</option>
                                <option value="Dây thép lưới" {{ request('filter_loai_day') == 'Dây thép lưới' ? 'selected' : '' }}>Dây thép lưới</option>
                                <option value="Dây cao su" {{ request('filter_loai_day') == 'Dây cao su' ? 'selected' : '' }}>Dây cao su</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_loai_mat" class="mr-2">Loại mặt</label>
                            <select name="filter_loai_mat" id="filter_loai_mat" class="form-control">
                                <option value="">Chọn loại mặt</option>
                                <option value="Tròn" {{ request('filter_loai_mat') == 'Tròn' ? 'selected' : '' }}>Tròn</option>
                                <option value="Vuông" {{ request('filter_loai_mat') == 'Vuông' ? 'selected' : '' }}>Vuông</option>
                                <option value="Hình chữ nhật" {{ request('filter_loai_mat') == 'Hình chữ nhật' ? 'selected' : '' }}>Hình chữ nhật</option>
                                <option value="Oval & Elip" {{ request('filter_loai_mat') == 'Oval & Elip' ? 'selected' : '' }}>Oval & Elip</option>
                                <option value="Tonneau" {{ request('filter_loai_mat') == 'Tonneau' ? 'selected' : '' }}>Tonneau</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_loai_kinh" class="mr-2">Loại kính</label>
                            <select name="filter_loai_kinh" id="filter_loai_kinh" class="form-control">
                                <option value="">Chọn loại kính</option>
                                <option value="Kính saphire" {{ request('filter_loai_kinh') == 'Kính saphire' ? 'selected' : '' }}>Kính saphire</option>
                                <option value="Kính mineral" {{ request('filter_loai_kinh') == 'Kính mineral' ? 'selected' : '' }}>Kính mineral</option>
                                <option value="Kính acrylic" {{ request('filter_loai_kinh') == 'Kính acrylic' ? 'selected' : '' }}>Kính acrylic</option>
                                <option value="Kính cường lực" {{ request('filter_loai_kinh') == 'Kính cường lực' ? 'selected' : '' }}>Kính cường lực</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_mau_day" class="mr-2">Màu dây</label>
                            <select name="filter_mau_day" id="filter_mau_day" class="form-control">
                                <option value="">Chọn màu dây</option>
                                <option value="Đen" {{ request('filter_mau_day') == 'Đen' ? 'selected' : '' }}>Đen</option>
                                <option value="Trắng" {{ request('filter_mau_day') == 'Trắng' ? 'selected' : '' }}>Trắng</option>
                                <option value="Xám" {{ request('filter_mau_day') == 'Xám' ? 'selected' : '' }}>Xám</option>
                                <option value="Bạc" {{ request('filter_mau_day') == 'Bạc' ? 'selected' : '' }}>Bạc</option>
                                <option value="Đỏ" {{ request('filter_mau_day') == 'Đỏ' ? 'selected' : '' }}>Đỏ</option>
                                <option value="Xanh dương" {{ request('filter_mau_day') == 'Xanh dương' ? 'selected' : '' }}>Xanh dương</option>
                                <option value="Xanh lá" {{ request('filter_mau_day') == 'Xanh lá' ? 'selected' : '' }}>Xanh lá</option>
                                <option value="Cam" {{ request('filter_mau_day') == 'Cam' ? 'selected' : '' }}>Cam</option>
                                <option value="Vàng" {{ request('filter_mau_day') == 'Vàng' ? 'selected' : '' }}>Vàng</option>
                                <option value="Hồng" {{ request('filter_mau_day') == 'Hồng' ? 'selected' : '' }}>Hồng</option>
                                <option value="Nâu" {{ request('filter_mau_day') == 'Nâu' ? 'selected' : '' }}>Nâu</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_mau_mat" class="mr-2">Màu mặt</label>
                            <select name="filter_mau_mat" id="filter_mau_mat" class="form-control">
                                <option value="">Chọn màu mặt</option>
                                <option value="Đen" {{ request('filter_mau_mat') == 'Đen' ? 'selected' : '' }}>Đen</option>
                                <option value="Trắng" {{ request('filter_mau_mat') == 'Trắng' ? 'selected' : '' }}>Trắng</option>
                                <option value="Xám" {{ request('filter_mau_mat') == 'Xám' ? 'selected' : '' }}>Xám</option>
                                <option value="Bạc" {{ request('filter_mau_mat') == 'Bạc' ? 'selected' : '' }}>Bạc</option>
                                <option value="Đỏ" {{ request('filter_mau_mat') == 'Đỏ' ? 'selected' : '' }}>Đỏ</option>
                                <option value="Xanh dương" {{ request('filter_mau_mat') == 'Xanh dương' ? 'selected' : '' }}>Xanh dương</option>
                                <option value="Xanh lá" {{ request('filter_mau_mat') == 'Xanh lá' ? 'selected' : '' }}>Xanh lá</option>
                                <option value="Cam" {{ request('filter_mau_mat') == 'Cam' ? 'selected' : '' }}>Cam</option>
                                <option value="Vàng" {{ request('filter_mau_mat') == 'Vàng' ? 'selected' : '' }}>Vàng</option>
                                <option value="Hồng" {{ request('filter_mau_mat') == 'Hồng' ? 'selected' : '' }}>Hồng</option>
                                <option value="Nâu" {{ request('filter_mau_mat') == 'Nâu' ? 'selected' : '' }}>Nâu</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_nangluong" class="mr-2">Năng lượng</label>
                            <select name="filter_nangluong" id="filter_nangluong" class="form-control">
                                <option value="">Chọn năng lượng</option>
                                <option value="Pin" {{ request('filter_nangluong') == 'Pin' ? 'selected' : '' }}>Pin</option>
                                <option value="Automatic" {{ request('filter_nangluong') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                <option value="Eco" {{ request('filter_nangluong') == 'Eco' ? 'selected' : '' }}>Eco</option>
                                <option value="Kinetic" {{ request('filter_nangluong') == 'Kinetic' ? 'selected' : '' }}>Kinetic</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_trangthai" class="mr-2">Trạng thái</label>
                            <select name="filter_trangthai" id="filter_trangthai" class="form-control">
                                <option value="">Chọn trạng thái</option>
                                <option value="1" {{ request('filter_trangthai') == '1' ? 'selected' : '' }}>Bình thường</option>
                                <option value="0" {{ request('filter_trangthai') == '0' ? 'selected' : '' }}>Ngưng bán</option>
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
                            @if(!($products->isEmpty()))
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                <thead>
                                    <tr>
                                        <th scope="col" style="font-size: 20px;">STT</th>
                                        <th scope="col" style="font-size: 20px;">ID</th>
                                        <th scope="col" style="font-size: 20px;">Tên Sản phẩm</th>
                                        <th scope="col" style="font-size: 20px;">Img</th>
                                        <th scope="col" style="font-size: 20px;">Size</th>
                                        <th scope="col" style="font-size: 20px;">Giá</th>
                                        <th scope="col" style="font-size: 20px;">Giá khuyến mãi</th>
                                        <th scope="col" style="font-size: 20px;">Ngày bắt đầu khuyến mãi</th>
                                        <th scope="col" style="font-size: 20px;">Ngày kết thúc khuyến mãi</th>
                                        <th scope="col" style="font-size: 20px;">Số lượng</th>
                                        <th scope="col" style="font-size: 20px;">Loại dây</th>
                                        <th scope="col" style="font-size: 20px;">Loại mặt</th>
                                        <th scope="col" style="font-size: 20px;">Loại kính</th>
                                        <th scope="col" style="font-size: 20px;">Màu dây</th>
                                        <th scope="col" style="font-size: 20px;">Màu mặt</th>
                                        <th scope="col" style="font-size: 20px;">Màu vỏ</th>
                                        <th scope="col" style="font-size: 20px;">Năng lượng máy</th>
                                        <th scope="col" style="font-size: 20px;">Mô tả</th>
                                        <th scope="col" style="font-size: 20px;">Trạng thái</th>
                                        <th scope="col" style="font-size: 20px;">Danh mục</th>
                                        <th scope="col" style="font-size: 20px;">Thương hiệu</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $i=>$product)

                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td><img src="{{asset('backend/img/product/'.$product->img)}}" width="70px"></td>
                                        <td>{{$product->size}}</td>
                                        <td>{{number_format($product->gia)}}</td>
                                        <td>{{number_format($product->giaKM)}}</td>
                                        <td>{{$product->km_tungay}}</td>
                                        <td>{{$product->km_denngay}}</td>
                                        <td>{{$product->soluong}}</td>
                                        <td>{{$product->loai_day}}</td>
                                        <td>{{$product->loai_mat}}</td>
                                        <td>{{$product->loai_kinh}}</td>
                                        <td>{{$product->mau_day}}</td>
                                        <td>{{$product->mau_mat}}</td>
                                        <td>{{$product->mau_vo}}</td>
                                        <td>{{$product->nangluong}}</td>
                                        <td onclick="expandCell(this)" class="mota-css">
                                            {{$product->mota}}
                                        </td>
                                        <td>
                                            @if($product->trangthai == 1)
                                            Bình thường
                                            @elseif($product->trangthai == 0)
                                            Ngưng bán
                                            @endif
                                        </td>
                                        <td>{{$product->danhmuc_id}}</td>
                                        <td>{{$product->thuonghieu_id}}</td>
                                        <td>
                                            <a href="{{route('editProduct.index',['id'=>$product->id])}}">
                                                <button type="button" class="btn btn-round btn-edit" data-toggle="">
                                                    <i class="fas fa-solid fa-wrench"></i>
                                                    Sửa
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('product.delete', $product->id)}}" class="delete-user" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
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
                            <p class="text-center">Không tìm thấy sản phẩm</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    {{ $products->links() }}
                </div>
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