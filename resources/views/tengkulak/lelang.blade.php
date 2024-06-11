@extends('layouts.main')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="d-flex justify-content-end">
        <div class="col-md-3 d-flex justify-content-end me-4 mb-3">
          <button type="button" class="btn btn-success btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#tambahLelang">
            <i class="mdi mdi-plus"></i> Tambah Lelang
          </button>
        </div>
      </div>
      <div class="col-md-12 mb-4">
        @if (session()->has('success'))
          <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
          </div>
        @elseif (session()->has('error'))
          <div class="alert alert-danger col-lg-12" role="alert">
            {{ session('error') }}
          </div>
        @endif
        <div class="card">
          <div class="card-body">
            <div class="card-title">List Lelang</div>
            <div class="table-responsive">
              <table class="table table-hover" data-form="lelangTable">
                <thead>
                  <tr>
                    <th class="text-center" width="10%">No</th>
                    <th width="30%">Nama Lelang</th> 
                    <th class="text-center" width="15%">Waktu Mulai</th>
                    <th class="text-center" width="15%">Waktu Selesai</th>
                    <th class="text-center" width="15%">Status</th>
                    <th class="text-center" width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($list_lelang_tersedia->data as $item)
                    @php
                      if ($item->status_lelang == 0) {
                        $status = '<label class="badge badge-danger">Belum Dimulai</label>';
                      } else if ($item->status_lelang == 1) {
                        $status = '<label class="badge badge-warning">Sedang Berlangsung</label>';
                      } else if ($item->status_lelang == 2) {
                        $status = '<label class="badge badge-danger">Belum Bayar</label>';
                      } else {
                        $status = '<label class="badge badge-success">Sudah Bayar</label>';
                      }

                      $button = '
                      <a href="/list_lelang_tengkulak/'. $item->id_lelang .'/edit" class="btn btn-warning btn-rounded btn-sm me-2">
                        <i class="mdi mdi-pencil"></i>
                      </a>
                      <button type="button" class="btn btn-danger btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLelang"><i class="mdi mdi-delete"></i></button>';
                    @endphp
                    <tr class="click" data-href="/join_lelang/{{ $item->id_lelang }}">
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $item->nama_lelang }}</td>
                      <td class="text-center">{{ $item->tanggal_mulai }}</td>
                      <td class="text-center">{{ $item->tanggal_selesai }}</td>
                      <td class="text-center">
                        {!! $status !!}
                      </td>
                      <td class="d-flex justify-content-center">
                        {!! $button !!}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for add lelang-->
<form class="forms-sample" action="{{ route('tambah_lelang') }}" method="POST">
  @csrf
  <div class="modal fade" id="tambahLelang" tabindex="-1" aria-labelledby="tambahLelangModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahLelangModal">Tambah Lelang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
              <label for="add_nama_lelang" class="col-sm-4 col-form-label">Nama Lelang</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="nama_lelang" id="add_nama_lelang" placeholder="Nama Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="add_tanggal_mulai" class="col-sm-4 col-form-label">Waktu Mulai Lelang</label>
              <div class="col-sm-8">
                <input type="datetime-local" class="form-control" name="waktu_mulai"  id="add_tanggal_mulai" placeholder="Waktu Mulai Lelang" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" onchange="updateMinEndDate()">
              </div>
            </div>
            <div class="form-group row">
              <label for="add_tanggal_berakhir" class="col-sm-4 col-form-label">Waktu Selesai Lelang</label>
              <div class="col-sm-8">
                <input type="datetime-local" class="form-control" name="waktu_selesai"  id="add_tanggal_berakhir" placeholder="Waktu Selesai Lelang" onchange="checkEndDate()">
              </div>
            </div>
            <div class="form-group row">
              <label for="add-open-bid" class="col-sm-4 col-form-label">Open Bid</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white">Rp</span>
                  </div>
                  <input type="number" name="harga_awal" class="form-control" aria-label="Jumlah">
                  <div class="input-group-append">
                    <span class="input-group-text">,00</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="add-kelipatan-bid" class="col-sm-4 col-form-label">Kelipatan Bid</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white">Rp</span>
                  </div>
                  <input type="number" name="kelipatan_bid" class="form-control" aria-label="Jumlah">
                  <div class="input-group-append">
                    <span class="input-group-text">,00</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="add_nama_cabai" class="col-sm-4 col-form-label">Nama Cabai</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="nama_cabai" id="add_nama_cabai" placeholder="Nama Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="add_total_cabai" class="col-sm-4 col-form-label">Total Cabai</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="total_cabai" id="add_nama_lelang" placeholder="Nama Lelang">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal for edit lelang-->
<form class="forms-sample" action="" method="POST">
  @csrf
  <div class="modal fade" id="tambahLelang" tabindex="-1" aria-labelledby="tambahLelangModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahLelangModal">Tambah Lelang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
              <label for="nama_lelang" class="col-sm-4 col-form-label">Nama Lelang</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_lelang" placeholder="Nama Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_mulai" class="col-sm-4 col-form-label">Waktu Mulai Lelang</label>
              <div class="col-sm-8">
                <input type="datetime-local" class="form-control" id="tanggal_mulai" placeholder="Waktu Mulai Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_berakhir" class="col-sm-4 col-form-label">Waktu Selesai Lelang</label>
              <div class="col-sm-8">
                <input type="datetime-local" class="form-control" id="tanggal_berakhir" placeholder="Waktu Selesai Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_berakhir" class="col-sm-4 col-form-label">Open Bid</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white">Rp</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                  <div class="input-group-append">
                    <span class="input-group-text">,00</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_berakhir" class="col-sm-4 col-form-label">Kelipatan Bid</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white">Rp</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                  <div class="input-group-append">
                    <span class="input-group-text">,00</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal for delete lelang-->
<form class="forms-sample" action="" method="DELETE">
  @csrf
  <div class="modal fade" id="deleteLelang" tabindex="-1" aria-labelledby="deleteLelangModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteLelangModal">Hapus Lelang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin ingin menghapus lelang ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-success">Yes</button>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection

@push('scripts')
    <script>
      function updateMinEndDate() {
        const startDate = document.getElementById('add_tanggal_mulai').value;
        document.getElementById('add_tanggal_berakhir').min = startDate;
      }

      function checkEndDate() {
        const startDate = document.getElementById('add_tanggal_mulai').value;
        const endDate = document.getElementById('add_tanggal_berakhir').value;

        if (endDate < startDate) {
          alert('Waktu selesai lelang tidak boleh kurang dari waktu mulai lelang');
          document.getElementById('add_tanggal_berakhir').value = '';
        }
      }
      
      $('.click').click(function() {
        window.location = $(this).data('href');
      })
    </script>
@endpush