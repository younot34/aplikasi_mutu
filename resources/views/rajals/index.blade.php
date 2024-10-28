@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>RAWAT JALAN</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i>WAKTU TUNGGU < 60 MENIT</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('rajals.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin|petugas8|petugas9|petugas10|petugas11|petugas12|petugas13')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('rajals.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('rajals.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan tanggal rajals">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                            @can('rajals.export_ra')
                                <a href="{{ route('rajals.export_ra') }}" class="btn btn-sm btn-primary"> Laporan Bulanan
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
                                <th scope="col">Poli</th>
                                <th scope="col" colspan="2"><center>Waktu Tunggu < 60mnt </center></th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center">Jumlah Pasien Poli</th>
                                <th style="width: 15%;text-align: center">Pasien Patuh</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($rajal as $no => $rajals)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($rajal->currentPage()-1) * $rajal->perPage() }}</th>
                                    <td>{{ $rajals->tanggal }}</td>
                                    <td>{{ $rajals->poli }}</td>
                                    <td><center>{{ $rajals->patuh }}</center></td>
                                    <td><center>{{ $rajals->tidak_patuh}}</center></td>
                                    <td class="text-center">

                                        @can('rajals.edit')
                                            <a href="{{ route('rajals.edit', $rajals->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('rajals.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $rajals->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$rajal->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<script>
    //ajax delete
    function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
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
                        url: "{{ route("rajals.index") }}/"+id,
                        data:   {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
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
            })
        }
</script>
@stop
