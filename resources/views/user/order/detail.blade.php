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
                <li class="breadcrumb-item"><a href="{{ route('orderIndex') }}">Pesanan Saya</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{ $order->id }}</li>
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
        <div class="card-header">
          <h3 class="mb-0">Pesanan Barang</h3>
        </div>
        <div class="card-body">
          @if ($order->status == 1)
            <form method="POST" action="{{ route('orderProofOfPayment', $order->id) }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <h6 class="heading-small text-muted mb-4">Informasi Pembayaran</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <li>
                        Mohon lakukan transfer pada nomor rekening berikut : <br> <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rekening <strong>BNI</strong> <strong>1234-5678-90</strong> a/n <strong>Ditha</strong> <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sejumlah <strong>Rp @currency($order->total_paid)</strong>
                      </li>
                      <br>
                      <li>
                        Jika sudah melakukan transfer mohon upload bukti transfer pada bagian di bawah ini
                      </li>
                    </div>
                  </div>
                  {{-- <div class="col-lg-6">
                    <div class="form-group text-center">
                      <img src="{{ $order->image }}" style="height: 20rem" >
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-email">Jumlah</label>
                          <input type="number" name="amount" id="input-email" class="form-control" value="1">
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <button class="btn btn-primary" type="submit">Pesan</button>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                </div>
              </div>
              <hr class="my-4" />
              <!-- Address -->
              <h6 class="heading-small text-muted mb-4">Bukti Pembayaran</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-address">Upload Bukti Transfer</label>
                      <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="customFileLang" lang="en">
                        <label class="custom-file-label" for="customFileLang">Select file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="col-md-6">
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">Upload</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          @elseif ($order->status == 2 || $order->status == 3)
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Detail Transaksi</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-address">Status</label>
                    @if ($order->status == 2)
                      <p><span class="badge badge-danger">Menunggu Konfirmasi</span></p>
                    @else 
                      <p><span class="badge badge-success">Telah Dikonfirmasi</span></p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="input-address">Tanggal Pemesanan</label>
                    <p>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:m') }} WIB</p>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4" />

            <h6 class="heading-small text-muted mb-4">Daftar Barang</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="row">
                    @foreach ($order->productOrders as $cart)
                    <div class="col-lg-12">
                      <div class="card" style="">
                        {{-- <img class="card-img-top" src="{{ $cart->image }}" alt="Card image cap"> --}}
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-2">
                              <img class="card-img-top" src="{{ asset($cart->product->image) }}" alt="Card image cap" style="max-height: 5rem; max-width: 5rem;">
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
            </div>
          @endif
        </div>
      </div>
    </div>
	</div>
@endsection