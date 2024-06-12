@extends('layouts.main')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <i class="mdi mdi-shopping fs-2"></i>
              <div class="display-4 mt-2 fw-bold harga">Rp{{ $pembelian }}</div>
              <div class="mt-2">Total Pembelian</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <i class="mdi mdi-invoice-text-clock fs-2"></i>
              <div class="display-4 mt-2 fw-bold harga">Rp{{ $belum_bayar }}</div>
              <div class="mt-2">Belum Bayar</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <i class="mdi mdi-account-cash fs-2"></i>
              <div class="display-4 mt-2 fw-bold">{{ $menang_lelang }}</div>
              <div class="mt-2">Menang Lelang</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <i class="mdi mdi-run fs-2"></i>
              <div class="display-4 mt-2 fw-bold">{{ $kalah_lelang }}</div>
              <div class="mt-2">Kalah Lelang</div>
            </div>
          </div>
        </div>
      </div>
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
                      <th>Harga Awal</th>
                      <th>Harga Akhir</th>
                      <th>Status</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Selesai</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($history_lelang->data as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td class="harga">Rp{{ $item->open_bid }}</td>
                      @if ($item->harga_akhir == null)
                      <td>-</td>
                      @else
                      <td class="harga">Rp{{ $item->harga_akhir }}</td>
                      @endif

                      @if ($item->status_lelang == 0)
                      <td><label class="badge badge-danger">Belum Dimulai</label></td>
                      @elseif ($item->status_lelang == 1)
                      <td><label class="badge badge-warning">Sedang Berlangsung</label></td>
                      @elseif ($item->status_lelang == 2)
                      <td><label class="badge badge-danger">Belum Bayar</label></td>
                      @else
                      <td><label class="badge badge-success">Sudah Bayar</label></td>
                      @endif
                      <td>{{ $item->tanggal_mulai }}</td>
                      <td>{{ $item->tanggal_selesai }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="card-title">History Menang Lelang</div>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Harga Awal</th>
                      <th>Harga Akhir</th>
                      <th>Status</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Selesai</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($history_menang_lelang->data as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td class="harga">Rp{{ $item->harga_awal }}</td>
                      <td class="harga">Rp{{ $item->harga_akhir }}</td>
                      @if ($item->status_lelang == 'Menang')
                      <td><label class="badge badge-success">{{ $item->status_lelang }}</label></td>
                      @else
                      <td><label class="badge badge-danger">{{ $item->status_lelang }}</label></td>
                      @endif
                      <td>{{ $item->tanggal_mulai }}</td>
                      <td>{{ $item->tanggal_selesai }}</td>
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
    <!-- content-wrapper ends -->
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