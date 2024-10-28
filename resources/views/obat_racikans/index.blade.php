@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>FARMASI</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i>Waktu Tunggu Obat Racikan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('obat_racikans.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('obat_racikans.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('obat_racikans.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q" placeholder="Cari berdasarkan tanggal">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI</button>
                                </div>
                            </div>
                            @can('obat_racikans.export_or')
                                <a href="{{ route('obat_racikans.export_or') }}" class="btn btn-sm btn-primary">Laporan Bulanan
                                    <i class="fa fa-door-open"></i>
                                </a>
                            @endcan
                            {{-- @can('obat_racikans.grafik_doublecheck')
                                <a href="{{ route('obat_racikans.grafik_doublecheck') }}" class="btn btn-sm btn-primary">Laporan Tahunan
                                    <i class="fa fa-door-open"></i>
                                </a>
                            @endcan --}}
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width: 6%">NO.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>Resep Masuk</th>
                                    <th>Resep Diserahkan</th>
                                    <th>Waktu Pelayanan</th>
                                    <th style="text-align: center;width: 15%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obat_racikans as $no => $obat)
                                <tr>
                                    <td style="text-align: center">{{ ++$no + ($obat_racikans->currentPage()-1) * $obat_racikans->perPage() }}</td>
                                    <td>{{ $obat->tanggal }}</td>
                                    <td>{{ $obat->nama_pasien }}</td>
                                    <td>{{ $obat->resep_masuk }}</td>
                                    <td>{{ $obat->resep_diserahkan }}</td>
                                    <td>{{ $obat->waktu_pelayanan }} menit</td>
                                    <td class="text-center">
                                        <a href="{{ route('obat_racikans.edit', $obat->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil-alt"></i> Edit
                                        </a>
                                        <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $obat->id }}">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $obat_racikans->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function Delete(id) {
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "APAKAH KAMU YAKIN?",
            text: "INGIN MENGHAPUS DATA INI!",
            icon: "warning",
            buttons: ['TIDAK', 'YA'],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "{{ route('obat_racikans.index') }}/" + id,
                    type: 'DELETE',
                    data: { "_token": token },
                    success: function (response) {
                        if (response.status == "success") {
                            swal("BERHASIL!", "DATA BERHASIL DIHAPUS!", "success").then(function() {
                                location.reload();
                            });
                        } else {
                            swal("GAGAL!", "DATA GAGAL DIHAPUS!", "error").then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }
</script>
@endsection
