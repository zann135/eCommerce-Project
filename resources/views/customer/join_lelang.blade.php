@extends('layouts.main')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Lelang Jaya Jaya Jaya</div>
                <div class="border border-2 rounded p-5 d-flex justify-content-between">
                <div class="border col-md-6 me-2 d-flex align-items-center">
                    <img src="{{ asset('images/cabe-merah.jpeg') }}" alt="" class="rounded w-25">
                    <span class="ms-4 align-items-center">
                        <h4>Jenis: Cabai Merah</h4>
                        <h4>Kualitas: Grade A</h4>
                        <h4>Jumlah: 10 kg</h4>
                    </span>
                </div>
                <div class="border col-md-6">
                    <h4 class="ms-3 mb-4">Bid Tertinggi oleh:</h4>
                    <div class="d-flex align-items-center">
                        <div class="col-md-6">
                            <img src="{{ asset('images/faces/face13.jpg') }}" alt="" class="rounded">
                            <span class="ms-4">Antonio Sukamuljo</span>
                        </div>
                        <div class="col-md-6">
                            Sebesar: Rp50.000,00
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
      <div class="row d-flex justify-content-end">
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Ajukan Bidding Anda (Minimal Kenaikan Rp1.000,00)" aria-label="bidding">
                          <div class="input-group-append">
                            <button class="btn btn-success" type="button">Bid</button>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection