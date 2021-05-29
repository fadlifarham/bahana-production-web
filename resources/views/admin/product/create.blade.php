@extends('layouts.admin.app')

@section('header')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">

				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Tambah Barang</h6>
						<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
							<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
								<li class="breadcrumb-item"><a href="{{ route('landing') }}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="{{ route('adminProductIndex') }}">Barang</a></li>
								<li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
		<div class="col">
			<div class="card">
				
				<div class="card-header border-0">
					<h3 class="mb-0">Tambah Barang</h3>
				</div>

				<div class="card-body">
					<form action="{{ route('adminProductStore') }}" method="POST" enctype="multipart/form-data">

						{{ csrf_field() }}

						<div class="form-group">
							<label for="name" class="form-control-label">Nama</label>
							<input class="form-control" type="text" placeholder="Masukkan Nama" name="name" id="name">
						</div>

						<div class="form-group">
							<label for="email" class="form-control-label">Harga</label>
							<input class="form-control" type="text" placeholder="Masukkan Harga" name="price" id="price">
						</div>

						<div class="form-group">
							<label for="password" class="form-control-label">Stok</label>
							<input class="form-control" type="number" placeholder="Masukkan Stok" name="stock" id="stock">
						</div>

						<div class="form-group">
							<label for="photo" class="form-control-label">Foto</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="photo" name="image" lang="id">
								<label class="custom-file-label" for="photo">Pilih File</label>
							</div>
						</div>

						<div class="form-group text-right">
							<button type="submit" class="btn btn-icon btn-primary">Submit</button>
							{{-- <input type="button" value="Submit"> --}}
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
  <script>

    $(document).ready(function() {
      $("#price").keyup(function() {
        var value = $(this).val();
        $(this).val(format(value));
      });
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
            output.push(",");
          }
          i++;
        }
      }
      formatted = output.reverse().join("");
      return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
  </script>
@endsection
