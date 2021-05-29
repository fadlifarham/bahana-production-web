@extends('layouts.admin.app')

@section('header')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">

				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Ganti Password</h6>
						<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
							<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
								<li class="breadcrumb-item"><a href="{{ route('landing') }}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="{{ route('userIndex') }}">User</a></li>
								<li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
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
					<h3 class="mb-0">Ganti Password</h3>
				</div>

				<div class="card-body">
					<form action="{{ route('userUpdatePassword', $id) }}" method="POST" enctype="multipart/form-data">

						{{ csrf_field() }}

						@if($errors->any())
							<div class="alert alert-danger" role="alert">
									<strong>Danger!</strong> {{$errors->first()}}
							</div>
						@endif

						<div class="form-group">
							<label for="oldPassword" class="form-control-label">Password Lama</label>
							<input class="form-control" type="password" placeholder="Masukkan Password Lama" name="oldPassword" id="oldPassword">
						</div>

						<div class="form-group">
							<label for="newPassword" class="form-control-label">Password Baru</label>
							<input class="form-control" type="password" placeholder="Masukkan Password Baru" name="newPassword" id="oldPassword">
						</div>

						<div class="form-group text-right">
							<button type="submit" class="btn btn-icon btn-primary">Submit</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection