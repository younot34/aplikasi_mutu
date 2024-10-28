@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>LABORATORIUM</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> MONITORING IDENTIFIKASI SAMPLE</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('monitorings.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin|petugas8|petugas9|petugas10|petugas11|petugas12|petugas13')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('monitorings.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('monitorings.create') }}" class="btn btn-primary" style="padding-top: 10px;">
                                            <i class="fa fa-plus-circle"></i> TAMBAH
                                        </a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q" placeholder="cari berdasarkan">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endhasanyrole
                    </form>


                    <div class="table-responsive">
                        @foreach ($monitorings as $item)
                        @php
                            // Ambil bulan dari tanggal di monitoring_lab_pertanggals
                            $monthNames = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                                4 => 'April', 5 => 'Mei', 6 => 'Juni',
                                7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                                10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];

                            // Ambil semua bulan dari tanggal yang ada di monitoring_lab_pertanggals
                            $dates = $item->monitoring_lab_pertanggals->pluck('tanggal')->map(function ($date) {
                                return \Carbon\Carbon::parse($date)->month;
                            })->unique();

                            // Mengambil nama bulan yang unik
                            $uniqueMonths = $dates->map(function ($month) use ($monthNames) {
                                return $monthNames[$month];
                            });
                        @endphp
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="6">NO</th>
                                    <th rowspan="6">VARIABEL</th>
                                    <th rowspan="6">SUB VARIABEL</th>
                                    <th colspan="{{ $maxTanggalCount }}" class="text-center">{{ $uniqueMonths->join(', ') }}</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2">Hasil (%)</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    @for ($i = 1; $i <= $maxTanggalCount; $i++)
                                        <th>{{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="6">{{ $item->id }}</td>
                                    <td rowspan="6">{{ $item->variabel }}</td>
                            
                                    <!-- Baris untuk data_pertanggal_1 -->
                                    <td rowspan="3">{{ $item->sub_variabel_1 }}</td>
                                    @foreach ($item->monitoring_lab_pertanggals as $montang)
                                        <td>{{ $montang->data_pertanggal_1 ?? 0 }}</td>
                                    @endforeach
                            
                                    <!-- Tambahkan kolom kosong jika jumlah monitoring_lab_pertanggals lebih sedikit dari 3 -->
                                    @for ($i = count($item->monitoring_lab_pertanggals); $i < 3; $i++)
                                        <td></td>
                                    @endfor
                            
                                    <td rowspan="3">{{ $item->total_1 ?? 0 }}</td>
                                    <td rowspan="6">{{ $item->hasil }}%</td>
                                    <td class="text-center" rowspan="6">
                                        @can('monitorings.edit')
                                            <a href="{{ route('monitorings.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        @can('monitorings.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            
                                <!-- Baris untuk data_pertanggal_2 -->
                                <tr>
                                    @foreach ($item->monitoring_lab_pertanggals as $montang)
                                        <td>{{ $montang->data_pertanggal_2 ?? 0 }}</td>
                                    @endforeach
                            
                                    @for ($i = count($item->monitoring_lab_pertanggals); $i < 3; $i++)
                                        <td></td>
                                    @endfor
                                </tr>
                            
                                <!-- Baris untuk data_pertanggal_3 -->
                                <tr>
                                    @foreach ($item->monitoring_lab_pertanggals as $montang)
                                        <td>{{ $montang->data_pertanggal_3 ?? 0 }}</td>
                                    @endforeach
                            
                                    @for ($i = count($item->monitoring_lab_pertanggals); $i < 3; $i++)
                                        <td></td>
                                    @endfor
                                </tr>
                            
                                <!-- Baris untuk data_pertanggal_4 -->
                                <tr>
                                    <td rowspan="3">{{ $item->sub_variabel_2 }}</td>
                                    @foreach ($item->monitoring_lab_pertanggals as $montang)
                                        <td>{{ $montang->data_pertanggal_4 ?? 0 }}</td>
                                    @endforeach
                            
                                    @for ($i = count($item->monitoring_lab_pertanggals); $i < 3; $i++)
                                        <td></td>
                                    @endfor
                                    <td rowspan="3">{{ $item->total_2 ?? 0 }}</td>
                                </tr>
                            
                                <!-- Baris untuk data_pertanggal_5 -->
                                <tr>
                                    @foreach ($item->monitoring_lab_pertanggals as $montang)
                                        <td>{{ $montang->data_pertanggal_5 ?? 0 }}</td>
                                    @endforeach
                            
                                    @for ($i = count($item->monitoring_lab_pertanggals); $i < 3; $i++)
                                        <td></td>
                                    @endfor
                                </tr>
                            
                                <!-- Baris untuk data_pertanggal_6 -->
                                <tr>
                                    @foreach ($item->monitoring_lab_pertanggals as $montang)
                                        <td>{{ $montang->data_pertanggal_6 ?? 0 }}</td>
                                    @endforeach
                            
                                    @for ($i = count($item->monitoring_lab_pertanggals); $i < 3; $i++)
                                        <td></td>
                                    @endfor
                                </tr>
                            </tbody>                                                                               
                        </table>
                        @endforeach
                        <div style="text-align: center">
                            {{$monitorings->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    //ajax delete
    function Delete(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "APAKAH KAMU YAKIN?",
            text: "INGIN MENGHAPUS DATA INI!",
            icon: "warning",
            buttons: [
                'TIDAK',
                'YA'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                //ajax delete
                jQuery.ajax({
                    url: "{{ route('monitorings.index') }}/" + id,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function(response) {
                        if (response.status == "success") {
                            swal({
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                icon: 'success',
                                timer: 1000,
                                buttons: false,
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                icon: 'error',
                                timer: 1000,
                                buttons: false,
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                return true;
            }
        });
    }
</script>
@stop
