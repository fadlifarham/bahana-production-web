@extends('layouts.admin.app')

@section('header')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">

				<div class="row align-items-center py-4">
					<div class="col-lg-6 col-7">
						<h6 class="h2 text-white d-inline-block mb-0">Tambah User</h6>
						<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
							<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
								<li class="breadcrumb-item"><a href="{{ route('landing') }}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="{{ route('userIndex') }}">User</a></li>
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
					<h3 class="mb-0">Tambah User</h3>
				</div>

				<div class="card-body">
					<form action="{{ route('userCreatePost') }}" method="POST" enctype="multipart/form-data">

						{{ csrf_field() }}

						<div class="form-group">
							<label for="name" class="form-control-label">Nama</label>
							<input class="form-control" type="text" placeholder="Masukkan Nama" name="name" id="name">
						</div>

						<div class="form-group">
							<label for="email" class="form-control-label">Email</label>
							<input class="form-control" type="text" placeholder="Masukkan Email" name="email" id="email">
						</div>

						<div class="form-group">
							<label for="password" class="form-control-label">Password</label>
							<input class="form-control" type="password" placeholder="Masukkan Password" name="password" id="password">
						</div>

						<div class="form-group">
							<label for="role" class="form-control-label">Role</label>
							<select class="form-control" id="role" name="role">
								<option disabled selected>-- Pilih Role --</option>
								@foreach ($roles as $role)
								<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for="photo" class="form-control-label">Foto</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="photo" name="photo" lang="id">
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

