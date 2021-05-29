@extends('layouts.admin.app')

@section('header')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">

				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Keranjang Saya</h6>
						<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
							<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
								<li class="breadcrumb-item"><a href="{{ route('landing') }}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Keranjang</li>
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
    @if (count($carts) > 0)
		<form method="POST" action="{{ route('cartPost', $carts[0]->order_id) }}">
			{{ csrf_field() }}
			@foreach($carts as $cart)
			<div class="row">
				<div class="col-lg-12">
					<div class="card" style="">
						{{-- <img class="card-img-top" src="{{ $cart->image }}" alt="Card image cap"> --}}
						<div class="card-body">
              <div class="row">
                <div class="col-lg-3">
                  <img class="card-img-top" src="{{ $cart->product->image }}" alt="Card image cap" style="max-height: 10rem; max-width: 10rem;">
                </div>
                <div class="col-lg-9">
                  <h5 class="card-title">{{ $cart->product->name }}</h5>
                  <p class="card-text">{{ $cart->product->description }}</p>
                  <div class="row">
										<div class="col-lg-1">
											<p class="card-text">Jumlah</p>
										</div>
										<div class="col-lg-2">
											<input name="cart-{{ $cart->id }}" id="amount-cart-{{ $cart->id }}" type="number" value="{{ $cart->amount }}" >
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-1">
											<p class="card-text">Harga</p>
										</div>
										<div class="col-lg-2">
											<p class="card-text">Rp <span id="price-cart-{{ $cart->id }}">@currency($cart->price * $cart->amount)</span></p>
										</div>
									</div>
                </div>
              </div>
							{{-- <a href="{{ route('cartOrder', $$cart->id) }}" class="btn btn-primary">Pesan</a> --}}
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<div class="row">
				<div class="col-lg-6">
					<a href="{{ route('cartDelete', $carts[0]->order_id) }}"><button type="button" class="btn btn-danger btn-block">Kosongkan Keranjang</button></a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn btn-primary btn-block">Pesan Barang</button>
				</div>
			</div>
			</form>
			{{-- <div class="col-lg-6">
				<form method="POST" action="{{ route('cartDelete', $carts[0]->order_id) }}">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger btn-block">Kosongkan Keranjang</button>
        </form>
			</div>
      <div class="col-lg-6">
        <form method="POST" action="{{ route('cartPost', $carts[0]->order_id) }}">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-primary btn-block">Pesan Barang</button>
        </form>
      </div> --}}
      <br>
      <hr>
		@else
			<div class="col">
				<div class="card">
					<div class="card-body">
						Keranjang Anda Kosong
					</div>
				</div>
			</div>
		@endif
    {{-- <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Keranjang</h3>
        </div>
        <div class="card-body">
          
        </div>
      </div>
    </div> --}}
	</div>
@endsection

@section('script')
	<script>
		
		$(document).ready(function() {
			@foreach($carts as $cart)
				$("#amount-cart-{{ $cart->id }}").keyup(function() {
					var value = $(this).val() * {{ $cart->price }};
					$("#price-cart-{{ $cart->id }}").text(format(value));
				});
			@endforeach
		});

		var format = function(num){
      var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
      if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
      }
      str = str.split("").reverse();
      for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
          output.push(str[j]);
          if(i%3 == 0 && j < (len - 1)) {
            output.push(".");
          }
          i++;
        }
      }
      formatted = output.reverse().join("");
      return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
	</script>
@endsection