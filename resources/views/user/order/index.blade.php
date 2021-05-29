@extends('layouts.admin.app')

@section('header')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">

				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Pesanan Saya</h6>
						<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
							<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
								<li class="breadcrumb-item"><a href="{{ route('landing') }}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Pesanan Saya</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		@foreach($orders as $order)
			<div class="col-lg-12">
				<div class="card" style="">
					{{-- <img class="card-img-top" src="{{ $cart->image }}" alt="Card image cap"> --}}
					<div class="card-body">
						<div class="row">
							{{-- <div class="col-lg-3">
								<img class="card-img-top" src="/img/test.png" alt="Card image cap" style="max-height: 10rem; max-width: 10rem;">
							</div> --}}
							<div class="col-lg-12">
								<h5 class="card-title">Pesanan {{ $order->id }}</h5>
								<p>
									@if ($order->status == 1)
										<span class="badge badge-warning">Menunggu Pembayaran</span>
									@elseif ($order->status == 2)
										<span class="badge badge-danger">Menunggu Konfirmasi</span>
									@else 
										<span class="badge badge-success">Telah Dikonfirmasi</span>
									@endif
								</p>
								<div class="text-right">
									<a href="{{ route('orderDetail', $order->id) }}"><button class="btn btn-primary text-right">Lihat</button></a>
								</div>
								<br>
								{{-- <p class="card-text">{{ $cart->product->description }}</p> --}}
								{{-- <p>Jumlah : {{ $cart->amount }}</p> --}}
								<div class="row">
									@foreach ($order->productOrders as $cart)
									<div class="col-lg-12">
										<div class="card" style="">
											{{-- <img class="card-img-top" src="{{ $cart->image }}" alt="Card image cap"> --}}
											<div class="card-body">
												<div class="row">
													<div class="col-lg-2">
														<img class="card-img-top" src="{{ $cart->product->image }}" alt="Card image cap" style="max-height: 5rem; max-width: 5rem;">
													</div>
													<div class="col-lg-10">
														<h5 class="card-title">{{ $cart->product->name }}</h5>
														{{-- <p class="card-text">{{ $cart->product->description }}</p> --}}
														<p class="card-text">{{ $cart->amount }} barang x Rp @currency($cart->price)</p>
													</div>
												</div>
												{{-- <a href="{{ route('cartOrder', $$cart->id) }}" class="btn btn-primary">Pesan</a> --}}
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<div class="text-right">
									<p class="card-text">Total Belanja</p>
									<p class="card-text"><strong>Rp @currency($order->total_paid)</strong></p>
								</div>
							</div>
						</div>
						{{-- <a href="{{ route('cartOrder', $$cart->id) }}" class="btn btn-primary">Pesan</a> --}}
					</div>
				</div>
			</div>
		@endforeach
		<br>
		<hr>
	</div>
@endsection