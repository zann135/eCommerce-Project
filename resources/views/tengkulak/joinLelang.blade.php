@extends('layouts.main')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Lelang Jaya Jaya Jaya</div>
                <div class="p-5 d-flex justify-content-between">
                <div class="border border-2 col-md-6 p-5 me-2">
                  <h4 class="ms-3 mb-4">Deskripsi Lelang:</h4>
                  <div class="ms-4 d-flex align-items-center">
                    <ul>
                      <li>Nama Lelang: Jaya Jaya Jaya</li>
                      <li>Jenis: Cabai Merah</li>
                      <li>Kualitas: Grade A</li>
                      <li>Jumlah: 10 kg</li>
                    </ul>
                  </div>
                </div>
                <div class="border border-2 col-md-6 p-5 text-center">
                    <h4 class="ms-3 mb-4">Bid Tertinggi oleh:</h4>
                    <div class="d-flex align-items-center">
                        <div class="col-md-6">Antonio Sukamuljo</div>
                        <div class="col-md-6">Sebesar: Rp50.000,00</div>
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
                          <div class="col-sm-10">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white">Rp</span>
                              </div>
                              <input type="text" name="bidding" class="form-control bidding" aria-label="bidding">
                            </div>
                          </div>
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

@push('scripts')
    <script>
      // make input bidding format 1.000,00
      $(document).ready(function() {
        $('.bidding').on('keyup', function() {
          var input = $(this).val();
          var number = input.replace(/[^\d]/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          $(this).val(number);
        });
      });
    </script>
@endpush