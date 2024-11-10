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
                            @can('monitorings.export_moni')
                                <a href="{{ route('monitorings.export_moni') }}" class="btn btn-sm btn-primary"> Laporan Bulanan
                                    <i class="fa fa-door-open"></i>
                                </a>
                            @endcan
                        </div>
                    @endhasanyrole
                    </form>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No.RM</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Patuh</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monitoring as $no => $monitorings)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($monitoring->currentPage()-1) * $monitoring->perPage() }}</th>
                                    <td>{{ $monitorings->tanggal }}</td>
                                    <td>{{ $monitorings->no_rm }}</td>
                                    <td>{{ $monitorings->nama_pasien }}</td>
                                    <td>{{ $monitorings->patuh }}</td>
                                    <td class="text-center">

                                        @can('monitorings.edit')
                                            <a href="{{ route('monitorings.edit', $monitorings->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('monitorings.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $monitorings->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$monitoring->links("vendor.pagination.bootstrap-4")}}
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
