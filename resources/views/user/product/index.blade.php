@extends('layouts.admin.app')

@section('header')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">

				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Barang</h6>
						<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
							<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
								<li class="breadcrumb-item"><a href="{{ route('landing') }}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Barang</li>
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
		@if (count($products) > 0)
			@foreach($products as $product)
				<div class="col-lg-3">
					<div class="card" style="width: 18rem;">
						<img class="card-img-top" src="{{ $product->image }}" style="height: 18rem; max-width: 18rem;" alt="Card image cap">
						<div class="card-body">
							{{-- <h5 class="card-title">{{ $product->name }}</h5>
							<p class="card-text">{{ $product->description }}</p>
							<a href="{{ route('productOrder', $product->id) }}" class="btn btn-primary">Pesan</a> --}}
							<form action="{{ route('productPostOrder', $product->id) }}" method="POST">
								{{ csrf_field() }}
								<h5 class="card-title">{{ $product->name }}</h5>
								<p class="card-text">Rp @currency($product->price)</p>
								{{-- <a href="{{ route('productOrder', $product->id) }}" class="btn btn-primary">Pesan</a> --}}
								<button type="submit" class="btn btn-primary">Pesan</button>
							</form>
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="col">
				<div class="card">
					<div class="card-body">
						Data TIdak Tersedia
					</div>
				</div>
			</div>
		@endif
	</div>

	<form id="deleteForm" action="" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
@endsection

@section('script')
	<script>
		
		function deleteBarang(id)
		{
			var id = id;
			var url = '{{ route("userDelete", ":id") }}';
			url = url.replace(':id', id);
			$("#deleteForm").attr('action', url);
			$("#deleteForm").submit();
		}
		
	</script>
@endsection