@extends('layouts.main')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      {{-- <div class="d-flex justify-content-end">
        <div class="col-md-3 d-flex justify-content-end me-4 mb-3">
          <button type="button" class="btn btn-success btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#tambahLelang">
            <i class="mdi mdi-plus"></i> Tambah Lelang
          </button>
        </div>
      </div> --}}
      <div class="col-md-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title">List Lelang</div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="10%">No</th>
                    <th width="30%">Nama Lelang</th> 
                    <th class="text-center" width="15%">Waktu Mulai</th>
                    <th class="text-center" width="15%">Waktu Berakhir</th>
                    <th class="text-center" width="15%">Status</th>
                    <th class="text-center" width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($list_lelang_tersedia->data as $item)
                    @php

                      if ($item->status_lelang == 0) {
                        $status = '<label class="badge badge-danger">Belum Dimulai</label>';
                        $button = '<div class="w-75 d-flex justify-content-center"><a href="" class="btn btn-light disabled">Join</a></div>';
                      } else if ($item->status_lelang == 1) {
                        $status = '<label class="badge badge-warning">Sedang Berlangsung</label>';
                        $button = '<div class="w-75 d-flex justify-content-center">
                                    <a href="join_lelang/'.$item->id_lelang.'" class="btn btn-primary">Join</a>
                                  </div>';
                      } else if ($item->status_lelang == 2) {
                        $status = '<label class="badge badge-danger">Belum Bayar</label>';
                        $button = '<div class="w-75 d-flex justify-content-center"><a href="" class="btn btn-light disabled">Expired</a></div>';
                      } else {
                        $status = '<label class="badge badge-success">Sudah Bayar</label>';
                        $button = '<div class="w-75 d-flex justify-content-center"><a href="" class="btn btn-light disabled">Expired</a></div>';
                      }
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

<!-- Modal -->
<form class="forms-sample">
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
              <label for="tanggal" class="col-sm-4 col-form-label">Tanggal Lelang</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_mulai" class="col-sm-4 col-form-label">Waktu Mulai Lelang</label>
              <div class="col-sm-8">
                <input type="time" class="form-control" id="tanggal_mulai" placeholder="Waktu Mulai Lelang">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_selesai" class="col-sm-4 col-form-label">Waktu Selesai Lelang</label>
              <div class="col-sm-8">
                <input type="time" class="form-control" id="tanggal_selesai" placeholder="Waktu Selesai Lelang">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection