@php
    $iteration = 0;
@endphp

@extends('layouts.main')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="card-title">History Bid Lelang</div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Cabai</th>
                    <th>Harga Awal</th>
                    <th>Harga Akhir</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($history_lelang->data as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_cabai }}</td>
                    <td class="harga">Rp{{ $item->open_bid }}</td>
                    <td class="harga">Rp{{ $item->harga_akhir }}</td>
                    @if ($item->status_lelang == 'Menang')
                    <td><label class="badge badge-success">{{ $item->status_lelang }}</label></td>
                    @else
                    <td><label class="badge badge-danger">{{ $item->status_lelang }}</label></td>
                    @endif
                    <td>{{ $item->tanggal_mulai }}</td>
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

@endsection

@push('scripts')

    <script>
      function formatNumber(num) {
        return num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').replace('.', ',');
      };

      document.addEventListener("DOMContentLoaded", function() {
        const harga = document.querySelectorAll('.harga');

        harga.forEach(function(element) {
          let num = parseFloat(element.textContent.replace('Rp', '').replace(/,/g, ''));
          element.textContent = 'Rp' + formatNumber(num);
        });
      });
    </script>
    
@endpush