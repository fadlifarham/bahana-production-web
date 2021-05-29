@extends('layouts.admin.app')

@section('header')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">

				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Daftar Pesanan</h6>
						<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
							<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
								<li class="breadcrumb-item"><a href="{{ route('landing') }}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Daftar Pesanan</li>
							</ol>
						</nav>
					</div>
					{{-- <div class="col-lg-6 col-5 text-right">
						<a href="{{ route('userCreate') }}" class="btn btn-sm btn-neutral">Tambah User</a>
					</div> --}}
				</div>
				
			</div>
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		<div class="col">
			<div class="card">
				<!-- Card header -->
				<div class="card-header border-0">
					<h3 class="mb-0">User Table</h3>
				</div>
				<!-- Light table -->
				<div class="table-responsive">
					<table class="table align-items-center table-flush">
						<thead class="thead-light">
							<tr>
								<th scope="col" class="sort" data-sort="name">Nomor Tagihan</th>
								<th scope="col" class="sort" data-sort="budget">Pelanggan</th>
								<th scope="col" class="sort" data-sort="status">Status</th>
								{{-- <th scope="col">Users</th>
								<th scope="col" class="sort" data-sort="completion">Completion</th> --}}
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody class="list">
							
							@foreach ($orders as $order)
								<tr>
									<th scope="row">
										{{ $order->id }}
									</th>
									<td class="budget">
										{{ $order->user->name }}
									</td>
									<td>
										@if ($order->status == 1)
                      <span class="badge badge-warning">Menunggu Pembayaran</span>
                    @elseif ($order->status == 2)
                      <span class="badge badge-danger">Menunggu Konfirmasi</span>
                    @else 
                      <span class="badge badge-success">Telah Dikonfirmasi</span>
                    @endif
									</td>
									{{-- <td class="text-right">
										<div class="dropdown">
											<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-ellipsis-v"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
												<a class="dropdown-item" href="{{ route('userEdit', $order->id) }}">Edit</a>
												<a class="dropdown-item" href="{{ route('userEditPassword', $order->id) }}">Ganti Password</a>
												<a 
													class="dropdown-item" 
													href=""
													onclick="event.preventDefault(); deleteUser({{ $order->id }});"
												>Hapus</a>
											</div>
										</div>
									</td> --}}
                  <td class="text-right">
										@if ($order->status == 2 || $order->status == 3)
                    <a href="{{ route('adminOrderDetail', $order->id) }}"><button class="btn btn-primary">Lihat</button></a>
                    @endif
									</td>
								</tr>
							@endforeach

						</tbody>
					</table>
				</div>
				<!-- Card footer -->
				<div class="card-footer py-4">
					<nav aria-label="...">
						{{-- <ul class="pagination justify-content-end mb-0">
							<li class="page-item disabled">
								<a class="page-link" href="#" tabindex="-1">
									<i class="fas fa-angle-left"></i>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							<li class="page-item active">
								<a class="page-link" href="#">1</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
							</li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#">
									<i class="fas fa-angle-right"></i>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul> --}}
					</nav>
				</div>

			</div>
		</div>
	</div>

	<form id="deleteForm" action="" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
@endsection

@section('script')
	<script>
		
		function deleteUser(id)
		{
			var id = id;
			var url = '{{ route("userDelete", ":id") }}';
			url = url.replace(':id', id);
			$("#deleteForm").attr('action', url);
			$("#deleteForm").submit();
		}
		
	</script>
@endsection