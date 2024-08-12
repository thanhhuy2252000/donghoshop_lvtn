@extends('backend.layout.master')
@section('title','Sửa thông tin Sản phẩm | DongHoShop')


@section('body')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Sửa thông tin Sản phẩm</h4>

            </div>
            <div class="row">
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
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('product.edit',['id'=> $products->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Danh mục</label>
                                            <select class="form-control" name="danhmuc_id" id="exampleFormControlSelect1" value="{{$products->danhmuc_id}}">
                                                @foreach ($caterogys as $caterogy)
                                                    <option value="{{$caterogy->id }}" {{ $products->danhmuc_id == $caterogy->id ? 'selected' : '' }}>{{$caterogy->tenDM}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Thương hiệu</label>
                                            <select class="form-control" name="thuonghieu_id" id="exampleFormControlSelect1" value="{{$products->thuonghieu_id}}">
                                                <!-- ý tưởng xử dụng foreach lấy thương hiệu ra, nếu thương hiệu cập nhật thì
                                                  select cũng tự động cập nhật các option-->
                                                @foreach ($brands as $brand)
                                                    <option value="{{$brand->id}}" {{ $products->thuonghieu_id == $brand->id ? 'selected' : '' }}>{{$brand->tenTH}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{$products->name}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="size">size</label>
                                            <input type="number" class="form-control" name="size" placeholder="Nhập size" value="{{$products->size}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="soluong">Số lượng</label>
                                            <input type="number" class="form-control" name="soluong" placeholder="Số lượng sản phẩm nhập" value="{{$products->soluong}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gia">Giá</label>
                                            <input type="number" class="form-control" name="gia" placeholder="Nhập giá" value="{{$products->gia}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="giaKM">Giá Khuyến mãi</label>
                                            <input type="number" class="form-control" name="giaKM" placeholder="Nhập giá khuyến mãi" value="{{$products->giaKM}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="km_tungay">Ngày bắt đầu khuyến mãi</label>
                                            <input type="datetime-local" name="km_tungay" class="form-control" value="{{$products->km_tungay}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="km_denngay">Ngày kết thúc khuyến mãi</label>
                                            <input type="datetime-local" name="km_denngay" class="form-control" value="{{$products->km_denngay}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">	
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại dây</label>
                                            <select class="form-control" name="loai_day" id="exampleFormControlSelect1" value="{{$products->loai_day}}">
                                                <option value="Dây da" @if($products->loai_day == 'Dây da') selected @endif>Dây da</option>
                                                <option value="Dây nhựa" @if($products->loai_day == 'Dây nhựa') selected @endif>Dây nhựa</option>
                                                <option value="Dây thép" @if($products->loai_day == 'Dây thép') selected @endif>Dây thép</option>
                                                <option value="Dây thép lưới" @if($products->loai_day == 'Dây thép lưới') selected @endif>Dây thép lưới</option>
                                                <option value="Dây cao su" @if($products->loai_day == 'Dây cao su') selected @endif>Dây cao su</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại mặt</label>
                                            <select class="form-control" name="loai_mat" id="exampleFormControlSelect1" value="{{$products->loai_mat}}">
                                                <option value="Tròn" @if($products->loai_mat == 'Tròn') selected @endif>Tròn</option>
                                                <option value="Vuông" @if($products->loai_mat == 'Vuông') selected @endif>Vuông</option>
                                                <option value="Hình chữ nhật" @if($products->loai_mat == 'Hình chữ nhật') selected @endif>Hình chữ nhật</option>
                                                <option value="Oval & Elip" @if($products->loai_mat == 'Oval & Elip') selected @endif>Oval & Elip</option>
                                                <option value="Tonneau" @if($products->loai_mat == 'Tonneau') selected @endif>Tonneau</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại kính</label>
                                            <select class="form-control" name="loai_kinh" id="exampleFormControlSelect1" value="{{$products->loai_kinh}}">
                                                <option value="Kính saphire" @if($products->loai_kinh == 'Kính saphire') selected @endif>Kính Saphire</option>
                                                <option value="Kính mineral" @if($products->loai_kinh == 'Kính mineral') selected @endif>Kính Mineral</option>
                                                <option value="Kính acrylic" @if($products->loai_kinh == 'Kính acrylic') selected @endif>Kính Acrylic</option>
                                                <option value="Kính cường lực" @if($products->loai_kinh == 'Kính cường lực') selected @endif>Kính Cường Lực</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Màu dây</label>
                                            <select class="form-control" name="mau_day" id="exampleFormControlSelect1" value="{{$products->mau_day}}">
                                                <option value="Đen" @if($products->mau_day == 'Đen') selected @endif>Đen</option>
                                                <option value="Trắng" @if($products->mau_day == 'Trắng') selected @endif>Trắng</option>
                                                <option value="Xám" @if($products->mau_day == 'Xám') selected @endif>Xám</option>
                                                <option value="Bạc" @if($products->mau_day == 'Bạc') selected @endif>Bạc</option>
                                                <option value="Đỏ" @if($products->mau_day == 'Đỏ') selected @endif>Đỏ</option>
                                                <option value="Xanh dương" @if($products->mau_day == 'Xanh dương') selected @endif>Xanh dương</option>
                                                <option value="Xanh lá" @if($products->mau_day == 'Xanh lá') selected @endif>Xanh lá</option>
                                                <option value="Cam" @if($products->mau_day == 'Cam') selected @endif>Cam</option>
                                                <option value="Vàng" @if($products->mau_day == 'Vàng') selected @endif>Vàng</option>
                                                <option value="Hồng" @if($products->mau_day == 'Hồng') selected @endif>Hồng</option>
                                                <option value="Nâu" @if($products->mau_day == 'Nâu') selected @endif>Nâu</option>
                                                <option value="Tím" @if($products->mau_day == 'Tím') selected @endif>Tím</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Màu mặt</label>
                                            <select class="form-control" name="mau_mat" id="exampleFormControlSelect1" value="{{$products->mau_mat}}">
                                                <option value="Đen" @if($products->mau_mat == 'Đen') selected @endif>Đen</option>
                                                <option value="Trắng" @if($products->mau_mat == 'Trắng') selected @endif>Trắng</option>
                                                <option value="Xám" @if($products->mau_mat == 'Xám') selected @endif>Xám</option>
                                                <option value="Bạc" @if($products->mau_mat == 'Bạc') selected @endif>Bạc</option>
                                                <option value="Đỏ" @if($products->mau_mat == 'Đỏ') selected @endif>Đỏ</option>
                                                <option value="Xanh dương" @if($products->mau_mat == 'Xanh dương') selected @endif>Xanh dương</option>
                                                <option value="Xanh lá" @if($products->mau_mat == 'Xanh lá') selected @endif>Xanh lá</option>
                                                <option value="Cam" @if($products->mau_mat == 'Cam') selected @endif>Cam</option>
                                                <option value="Vàng" @if($products->mau_mat == 'Vàng') selected @endif>Vàng</option>
                                                <option value="Hồng" @if($products->mau_mat == 'Hồng') selected @endif>Hồng</option>
                                                <option value="Nâu" @if($products->mau_mat == 'Nâu') selected @endif>Nâu</option>
                                                <option value="Tím" @if($products->mau_mat == 'Tím') selected @endif>Tím</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Màu vỏ</label>
                                            <select class="form-control" name="mau_vo" id="exampleFormControlSelect1" value="{{$products->mau_vo}}">
                                                <option value="Đen" @if($products->mau_vo == 'Đen') selected @endif>Đen</option>
                                                <option value="Trắng" @if($products->mau_vo == 'Trắng') selected @endif>Trắng</option>
                                                <option value="Xám" @if($products->mau_vo == 'Xám') selected @endif>Xám</option>
                                                <option value="Bạc" @if($products->mau_vo == 'Bạc') selected @endif>Bạc</option>
                                                <option value="Đỏ" @if($products->mau_vo == 'Đỏ') selected @endif>Đỏ</option>
                                                <option value="Xanh dương" @if($products->mau_vo == 'Xanh dương') selected @endif>Xanh dương</option>
                                                <option value="Xanh lá" @if($products->mau_vo == 'Xanh lá') selected @endif>Xanh lá</option>
                                                <option value="Cam" @if($products->mau_vo == 'Cam') selected @endif>Cam</option>
                                                <option value="Vàng" @if($products->mau_vo == 'Vàng') selected @endif>Vàng</option>
                                                <option value="Hồng" @if($products->mau_vo == 'Hồng') selected @endif>Hồng</option>
                                                <option value="Nâu" @if($products->mau_vo == 'Nâu') selected @endif>Nâu</option>
                                                <option value="Tím" @if($products->mau_vo == 'Tím') selected @endif>Tím</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Năng lượng</label>
                                            <select class="form-control" name="nangluong" id="exampleFormControlSelect1" value="{{$products->nangluong}}">
                                                <option value="Pin" @if($products->nangluong == 'Pin') selected @endif>Pin</option>
                                                <option value="Automatic" @if($products->nangluong == 'Automatic') selected @endif>Automatic</option>
                                                <option value="Eco" @if($products->nangluong == 'Eco') selected @endif>Eco</option>
                                                <option value="Kinetic" @if($products->nangluong == 'Kinetic') selected @endif>Kinetic</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Trạng thái</label>
                                            <select class="form-control" name="trangthai" id="exampleFormControlSelect1" value="{{$products->trangthai}}">
                                                <option value="1" @if($products->trangthai == '1') selected @endif>Bình thường</option>
                                                <option value="0" @if($products->trangthai == '0') selected @endif>Ngưng bán</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Mô tả</span>
												</div>
												<textarea class="form-control" aria-label="With textarea" name="mota">{{$products->mota}}</textarea>
											</div>
										</div>
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Hình ảnh</label>
                                            <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1" >
                                            @if($products->img)
                                                <img src="{{ asset('backend/img/product/' . $products->img) }}" width="100">
                                            @else
                                                <p>Không có ảnh</p>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{route('product.index')}}"><button type="button" class="btn btn-danger">Hủy</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection