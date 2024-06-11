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
        <div class="card">
          <div class="card-body">
            <div class="card-title">List Lelang</div>
            <div class="table-responsive">
              <table class="table table-hover" data-form="lelangTable">
                <thead>
                  <tr>
                    <th class="text-center" width="10%">No</th>
                    <th width="30%">Nama Lelang</th> 
                    <th class="text-center" width="15%">Tanggal Mulai</th>
                    <th class="text-center" width="15%">Tanggal Selesai</th>
                    <th class="text-center" width="15%">Status</th>
                    <th class="text-center" width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($list_lelang_tersedia->data as $item)
                    @php
<<<<<<< Updated upstream
                      $now = \Carbon\Carbon::now();
                      $tanggal_mulai = \Carbon\Carbon::parse($item->tanggal_mulai);
                      $tanggal_selesai = \Carbon\Carbon::parse($item->tanggal_selesai);

                      if ($tanggal_mulai < $now AND $tanggal_selesai > $now) {
=======
                      if ($item->status_lelang == 0) {
                        $status = '<label class="badge badge-danger">Belum Dimulai</label>';
                      } else if ($item->status_lelang == 1) {
>>>>>>> Stashed changes
                        $status = '<label class="badge badge-warning">Sedang Berlangsung</label>';
                      } else if ($item->status_lelang == 2) {
                        $status = '<label class="badge badge-danger">Belum Bayar</label>';
                      } else {
<<<<<<< Updated upstream
                        if ($tanggal_mulai > $now) {
                          $status = '<label class="badge badge-danger">Belum Dimulai</label>';
                          $button = '<div class="w-75 d-flex justify-content-center"><a href="" class="btn btn-light disabled">Join</a></div>';
                          $iteration1 += 1;
                        } else {
                          continue;
                        }
=======
                        $status = '<label class="badge badge-success">Sudah Bayar</label>';
>>>>>>> Stashed changes
                      }

                      $button = '<a href="'.route('edit_lelang', $item->id_lelang).'" class="btn btn-warning btn-rounded btn-sm me-2"><i class="mdi mdi-pencil"></i></a>
                      <a href="'.route('delete_lelang', $item->id_lelang).'"><button type="button" class="btn btn-danger btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLelang"><i class="mdi mdi-delete"></i></button></a>';
                    @endphp
                  <tr>
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
              <label for="tanggal_mulai" class="col-sm-4 col-form-label">Tanggal Mulai Lelang</label>
              <div class="col-sm-8">
                <input type="datetime-local" class="form-control" id="tanggal_mulai" placeholder="Tanggal Mulai Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_berakhir" class="col-sm-4 col-form-label">Tanggal Selesai Lelang</label>
              <div class="col-sm-8">
                <input type="datetime-local" class="form-control" id="tanggal_berakhir" placeholder="Tanggal Selesai Lelang">
              </div>
            </div>
            <div class="form-group row">
<<<<<<< Updated upstream
              <label for="tanggal_mulai" class="col-sm-4 col-form-label">Waktu Mulai Lelang</label>
              <div class="col-sm-8">
                <input type="time" class="form-control" id="tanggal_mulai" placeholder="Waktu Mulai Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_selesai" class="col-sm-4 col-form-label">Waktu Selesai Lelang</label>
              <div class="col-sm-8">
                <input type="time" class="form-control" id="tanggal_selesai" placeholder="Waktu Selesai Lelang">
=======
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
>>>>>>> Stashed changes
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
<form class="forms-sample" action="{{ route('delete_lelang') }}" method="DELETE">
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
      $('table[data-form]="lelangTable"').on('click', )
    </script>
@endpush