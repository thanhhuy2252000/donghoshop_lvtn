@extends('backend.layout.master')
@section('title','Trang chủ | DongHoShop')


@section('body')

<div class="main-panel">
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Trang chủ | Thống kê</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="page-inner mt--5">
			<div class="row mt--2">
				<div class="col-md-8">
					<div class="card full-height">
						<div class="card-body">
							<div class="card-title">Thống kê tổng thể</div>
							<div class="card-category">Thống kê trong tháng</div>
							<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="circles-11"></div>
									<h6 class="fw-bold mt-3 mb-0">Người dùng mới</h6>
									<h4>{{ $countNewUsers }}</h4>
								</div>
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="circles-22"></div>
									<h6 class="fw-bold mt-3 mb-0">Đơn hàng mới</h6>
									<h4>{{ $orderOfMonth }}</h4>
								</div>
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="circles-33"></div>
									<h6 class="fw-bold mt-3 mb-0">Sản phẩm đã bán</h6>
									<h4>{{ $productsSold }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card full-height">
						<div class="card-body">
							<div class="card-title">Thống kê doanh thu</div>
							<div class="row py-2">
								<div class="col-md-6 d-flex flex-column justify-content-around">
									<div>
										<h6 class="fw-bold text-uppercase text-danger op-8">Doanh thu hệ thống Logic</h6>
										<h3 class="fw-bold">{{ $totalAll }} vnđ</h3>
									</div>
									<div>
										<h6 class="fw-bold text-uppercase text-danger op-8">Đơn hàng hệ thống</h6>
										<h3 class="fw-bold ">{{ $orderAll }}</h3>
									</div>
								</div>
								<div class="col-md-6 d-flex flex-column justify-content-around">
									<div>
										<h6 class="fw-bold text-uppercase text-success op-8">Doanh thu hoàn tất</h6>
										<h3 class="fw-bold">{{ $totalAllDone }} vnđ</h3>
									</div>
									<div>
										<h6 class="fw-bold text-uppercase text-success op-8">Đơn hàng hoàn thành</h6>
										<h3 class="fw-bold">{{ $orderAllDone }}</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<div class="card-head-row">
								<div class="card-title">Người dùng mới trong tháng</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>STT</th>
											<th>Ảnh</th>
											<th>Tên</th>
											<th>Email</th>
											<th>Sdt</th>
											<th>Địa chỉ</th>
										</tr>
									</thead>
									<tbody>
										@forelse($newUsers as $index => $user)
										<tr>
											<td>{{ $index + 1 }}</td>
											<td>
												@if(!$user->avt)
												<img src="{{asset('backend/img/avatar/blank.jpg')}}" alt="avatar" width="70px" height="70">
												@else
												<img src="{{asset('backend/img/avatar/'.$user->avt)}}" alt="avatar" width="70px" height="70">
												@endif
											</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->sdt }}</td>
											<td>{{ $user->diachi }}</td>
										</tr>
										@empty
										<tr>
											<td colspan="4">Không có người dùng mới trong tháng này.</td>
										</tr>
										@endforelse
									</tbody>
								</table>
								<div class="pagination-container">
									{{ $newUsers->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-primary">
						<div class="card-header">
							<div class="card-title">Doanh thu trong tháng</div>
							<div class="card-category">Tháng {{$currentMonth}} - {{$currentYear}}</div>
						</div>
						<div class="card-body pb-0">
							<div class="mb-2">
								<h1>{{$totalOfMonth}} vnđ</h1>
							</div>
						</div>
						<div class="card-body pb-0">------------------------------------------------</div>
						<div class="card-header">
							<div class="card-title">Doanh thu hoàn tất trong tháng</div>
							<div class="card-category">Tháng {{$currentMonth}} - {{$currentYear}}</div>
						</div>
						<div class="card-body pb-0">
							<div class="mb-2">
								<h1>{{$totalOfMonthDone}} vnđ</h1>
							</div>
						</div>
						
					</div>
					<div class="card">
						<div class="card-body pb-0">
							<div class="h1 fw-bold float-right text-warning">{{$pre_monthTransactions}} %</div>
							<h2 class="mb-4">{{$monthTransactions}}</h2>
							<p class="text-muted">Giao dịch</p>
							<div class="pull-in sparkline-fix">
								<div id="lineChart"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Sản phẩm bán chạy</div>
						</div>
						<div class="card-body pb-0">
							<div class="d-flex flex-column">
								@foreach($productTops as $i => $product)
								<div class="d-flex justify-content-between align-items-center mb-3">
									<td>{{$i + 1}}</td>
									<td>
										<img src="{{asset('backend/img/product/'.$product->img)}}" alt="avatar" width="70px" height="70">
									</td>
									<h5 class="text-info fw-bold">{{ $product->name }}</h5>
									<span class="badge bg-success">{{ $product->total_sold }} chiếc</span>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>




	@endsection