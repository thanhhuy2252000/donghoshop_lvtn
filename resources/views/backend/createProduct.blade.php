@extends('backend.layout.master')
@section('title','Thêm Sản phẩm | DongHoShop')


@section('body')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Thêm Sản phẩm</h4>

            </div>
            <div class="row">
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
                        <form action="{{route('product.create')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Danh mục</label>
                                            <select class="form-control" name="danhmuc_id" id="exampleFormControlSelect1">
                                                @foreach ($caterogys as $caterogy)
                                                    <option value="{{$caterogy->id}}">{{$caterogy->tenDM}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Thương hiệu</label>
                                            <select class="form-control" name="thuonghieu_id" id="exampleFormControlSelect1">
                                                <!-- ý tưởng xử dụng foreach lấy thương hiệu ra, nếu thương hiệu cập nhật thì
                                                  select cũng tự động cập nhật các option-->
                                                @foreach ($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->tenTH}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="size">size</label>
                                            <input type="number" class="form-control" name="size" placeholder="Nhập size"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="soluong">Số lượng</label>
                                            <input type="number" class="form-control" name="soluong" placeholder="Số lượng sản phẩm nhập"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gia">Giá</label>
                                            <input type="number" class="form-control" name="gia" placeholder="Nhập giá"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="giaKM">Giá Khuyến mãi</label>
                                            <input type="number" class="form-control" name="giaKM" placeholder="Nhập giá khuyến mãi" >
                                        </div>
                                        <div class="form-group">
                                            <label for="km_tungay">Ngày bắt đầu khuyến mãi</label>
                                            <input type="datetime-local" name="km_tungay" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="km_denngay">Ngày kết thúc khuyến mãi</label>
                                            <input type="datetime-local" name="km_denngay" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">	
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại dây</label>
                                            <select class="form-control" name="loai_day" id="exampleFormControlSelect1">
                                                <option value="Dây da">Dây da</option>
                                                <option value="Dây nhựa">Dây nhựa</option>
                                                <option value="Dây thép">Dây thép</option>
                                                <option value="Dây thép lưới">Dây thép lưới</option>
                                                <option value="Dây cao su">Dây cao su</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại mặt</label>
                                            <select class="form-control" name="loai_mat" id="exampleFormControlSelect1">
                                                <option value="Tròn">Tròn</option>
                                                <option value="Vuông">Vuông</option>
                                                <option value="Hình chữ nhật">Hình chữ nhật</option>
                                                <option value="Oval & Elip">Oval & Elip</option>
                                                <option value="Tonneau">Tonneau</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại kính</label>
                                            <select class="form-control" name="loai_kinh" id="exampleFormControlSelect1">
                                                <option value="Kính saphire">Kính Saphire</option>
                                                <option value="Kính mineral">Kính Mineral</option>
                                                <option value="Kính acrylic">Kính Acrylic</option>
                                                <option value="Kính cường lực">Kính Cường Lực</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Màu dây</label>
                                            <select class="form-control" name="mau_day" id="exampleFormControlSelect1">
                                                <option value="Đen">Đen</option>
                                                <option value="Trắng">Trắng</option>
                                                <option value="Xám">Xám</option>
                                                <option value="Bạc">Bạc</option>
                                                <option value="Đỏ">Đỏ</option>
                                                <option value="Xanh dương">Xanh dương</option>
                                                <option value="Xanh lá">Xanh lá</option>
                                                <option value="Cam">Cam</option>
                                                <option value="Vàng">Vàng</option>
                                                <option value="Hồng">Hồng</option>
                                                <option value="Nâu">Nâu</option>
                                                <option value="Tím">Tím</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Màu mặt</label>
                                            <select class="form-control" name="mau_mat" id="exampleFormControlSelect1">
                                                <option value="Đen">Đen</option>
                                                <option value="Trắng">Trắng</option>
                                                <option value="Xám">Xám</option>
                                                <option value="Bạc">Bạc</option>
                                                <option value="Đỏ">Đỏ</option>
                                                <option value="Xanh dương">Xanh dương</option>
                                                <option value="Xanh lá">Xanh lá</option>
                                                <option value="Cam">Cam</option>
                                                <option value="Vàng">Vàng</option>
                                                <option value="Hồng">Hồng</option>
                                                <option value="Nâu">Nâu</option>
                                                <option value="Tím">Tím</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Màu vỏ</label>
                                            <select class="form-control" name="mau_vo" id="exampleFormControlSelect1">
                                                <option value="Đen">Đen</option>
                                                <option value="Trắng">Trắng</option>
                                                <option value="Xám">Xám</option>
                                                <option value="Bạc">Bạc</option>
                                                <option value="Đỏ">Đỏ</option>
                                                <option value="Xanh dương">Xanh dương</option>
                                                <option value="Xanh lá">Xanh lá</option>
                                                <option value="Cam">Cam</option>
                                                <option value="Vàng">Vàng</option>
                                                <option value="Hồng">Hồng</option>
                                                <option value="Nâu">Nâu</option>
                                                <option value="Tím">Tím</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Năng lượng</label>
                                            <select class="form-control" name="nangluong" id="exampleFormControlSelect1">
                                                <option value="Pin">Pin</option>
                                                <option value="Automatic">Automatic</option>
                                                <option value="Eco">Eco</option>
                                                <option value="Kinetic">Kinetic</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Mô tả</span>
												</div>
												<textarea class="form-control" aria-label="With textarea" name="mota" required></textarea>
											</div>
                                            <!-- <label for="mota">Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="mota" placeholder="Nhập mô tả sản phẩm"  required> -->
										</div>
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Hình ảnh</label>
                                            <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1" required>
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