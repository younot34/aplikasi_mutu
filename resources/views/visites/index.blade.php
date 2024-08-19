@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>RAWAT INAP</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i>Kepatuhan Jam Visite Dokter Spesialis</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('visites.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('visites.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('visites.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan tanggal visites">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                            @can('visites.export_v')
                                <a href="{{ route('visites.export_v') }}" class="btn btn-sm btn-primary"> Laporan Bulanan
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
                                <th scope="col" colspan="2"><center>Jam Visite Dokter</center></th>
                                <th scope="col">Dokter Spesialis</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center"> 06.00-14.00</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">>14.00</th> <!-- Subkolom "Benar Alamat" -->
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($visite as $no => $visites)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($visite->currentPage()-1) * $visite->perPage() }}</th>
                                    <td>{{ $visites->tanggal }}</td>
                                    <td>{{ $visites->no_rm }}</td>
                                    <td>{{ $visites->nama_px }}</td>
                                    <td>{{ $visites->jam6sampai14 }}</td>
                                    <td>{{ $visites->kurang14 }}</td>
                                    <td>{{ $visites->dokter_spesial }}</td>
                                    <td class="text-center">

                                        @can('visites.edit')
                                            <a href="{{ route('visites.edit', $visites->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('visites.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $visites->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$visite->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("visites.index") }}/"+id,
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
