@extends('backend.layout.master')
@section('title','Quản lý user | DongHoShop')


@section('body')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">User</h4>
				<ul class="breadcrumbs">
					
				</ul>
			</div>
			<!-- Bộ Lọc -->
			<div class="row">
				<div class="col-md-12">
					<form action="{{ route('user.index') }}" method="GET" class="form-inline">
						<div class="form-group mr-2">
							<label for="filter_name" class="mr-2">Tên người dùng</label>
							<input type="text" name="filter_name" id="filter_name" class="form-control" value="{{ request('filter_name') }}" placeholder="Tên người dùng">
						</div>
						<div class="form-group mr-2">
							<label for="filter_email" class="mr-2">E-Mail</label>
							<input type="text" name="filter_email" id="filter_email" class="form-control" value="{{ request('filter_email') }}" placeholder="Email">
						</div>
						<div class="form-group mr-2">
							<label for="filter_id" class="mr-2">ID</label>
							<input type="number" name="filter_id" id="filter_id" class="form-control" value="{{ request('filter_id') }}" placeholder="ID người dùng">
						</div>
						<div class="form-group mr-2">
							<label for="filter_status" class="mr-2">Trạng thái</label>
							<select name="filter_status" id="filter_status" class="form-control">
								<option value="">Tất cả</option>
								<option value="1" {{ request('filter_status') == '1' ? 'selected' : '' }}>Bình thường</option>
								<option value="0" {{ request('filter_status') == '0' ? 'selected' : '' }}>Ngưng hoạt động</option>
							</select>
						</div>
						<div class="form-group mr-2">
							<label for="filter_gioitinh" class="mr-2">Giới tính</label>
							<select name="filter_gioitinh" id="filter_gioitinh" class="form-control">
								<option value="">Tất cả</option>
								<option value="0" {{ request('filter_gioitinh') == '0' ? 'selected' : '' }}>Nam</option>
								<option value="1" {{ request('filter_gioitinh') == '1' ? 'selected' : '' }}>Nữ</option>
							</select>
						</div>
						<div class="form-group mr-2">
							<label for="filter_loai" class="mr-2">Loại</label>
							<select name="filter_loai" id="filter_loai" class="form-control">
								<option value="">Tất cả</option>
								<option value="1" {{ request('filter_loai') == '1' ? 'selected' : '' }}>1 (Quản trị viên)</option>
								<option value="0" {{ request('filter_loai') == '0' ? 'selected' : '' }}>0 (Người dùng)</option>
							</select>
						</div>
						<div class="form-group mr-2">
							<label for="filter_date_from" class="mr-2">Ngày tạo</label>
							<input type="date" name="filter_date_from" id="filter_date_from" class="form-control" value="{{ request('filter_date_from') }}">
						</div>
						<div class="form-group mr-2">
							<label for="filter_date_to" class="mr-2">Ngày cập nhật</label>
							<input type="date" name="filter_date_to" id="filter_date_to" class="form-control" value="{{ request('filter_date_to') }}">
						</div>
						<button type="submit" class="btn btn-light"><i class="bi bi-funnel"></i> Lọc</button>
					</form>
				</div>
			</div>
			<!-- hiển thị người dùng -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
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
								<div class="table-responsive ">
									@if(!($users->isEmpty()))
									<table id="basic-datatables" class="display table table-striped table-hover table-head-bg-info thead th">
										<thead>
											<tr>
												<th>STT</th>
												<th>Id</th>
												<th>Name</th>
												<th>Email</th>
												<th>Avatar</th>
												<th>Giới tính</th>
												<th>Số điện thoại</th>
												<th>Địa chỉ</th>
												<th>Loại</th>
												<th>Ngày tạo</th>
												<th>Ngày cập nhật</th>
												<th>Trạng thái</th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach ($users as $i=>$user)
											<tr>
												<td>{{++$i}}</td>
												<td>{{$user->id}}</td>
												<td>{{$user->name}}</td>
												<td>{{$user->email}}</td>
												<td>
													@if(!$user->avt)
													<img src="{{asset('backend/img/avatar/blank.jpg')}}" alt="avatar" width="70px">
													@else
													<img src="{{asset('backend/img/avatar/'.$user->avt)}}" alt="avatar" width="70px">
													@endif
												</td>
												<td>
													@if($user->gioitinh == '0')
													Nam
													@elseif($user->gioitinh == '1')
													Nữ
													@endif
												</td>
												<td>{{$user->sdt}}</td>
												<td>{{$user->diachi}}</td>
												<td>{{$user->loai}}</td>
												<td>{{$user->created_at}}</td>
												<td>{{$user->updated_at}}</td>
												<form action="{{route('user.edit',['id'=>$user->id])}}" method="post">
												@csrf
													<td>
														<select name="trangthai" id="trangthai" class="form-control" style="width:200px;">
															<option value="0" {{ $user->trangthai == 0 ? 'selected' : '' }}>Ngưng hoạt động</option>
															<option value="1" {{ $user->trangthai == 1 ? 'selected' : '' }}>Bình thường</option>
														</select>
													</td>
													<td>
														<button type="submit" class="btn btn-round btn-edit">
															<i class="bi bi-floppy"></i>
															Lưu
														</button>
													</td>
												</form>
												<td>
													<a href="{{ route('user.delete', $user->id) }}" class="delete-user" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
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
									<p class="text-center">Không tìm thấy người dùng</p>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						{{ $users->links() }}
					</div>
				</div>
			</div>
		</div>


		@endsection