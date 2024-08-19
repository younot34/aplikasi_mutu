@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>PPI</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i>Audit Penggunaan Alat Pelindung Diri</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('apds.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('apds.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('apds.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan unit apds">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                            @can('apds.export_apd')
                                <a href="{{ route('apds.export_apd') }}" class="btn btn-sm btn-primary"> Laporan Bulanan
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
                                <th scope="col">Unit</th>
                                <th scope="col">Nama Petugas</th>
                                <th scope="col">Profesi</th>
                                <th scope="col">Tindakan</th>
                                <th scope="col" colspan="6"><center>APD yang digunakan</center></th>
                                <th scope="col" colspan="2"><center>Ketepatan</center></th>
                                <th scope="col" >Keterangan</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Topi</th>
                                <th>Kacamata/faceshield</th>
                                <th>Masker</th>
                                <th>Gown</th>
                                <th>Sarung Tangan</th>
                                <th>Sepatu</th>
                                <th>Ya</th>
                                <th>Tidak</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($apd as $no => $apds)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($apd->currentPage()-1) * $apd->perPage() }}</th>
                                    <td>{{ $apds->tanggal }}</td>
                                    <td>{{ $apds->unit }}</td>
                                    <td>{{ $apds->nama_petugas }}</td>
                                    <td>{{ $apds->profesi }}</td>
                                    <td>{{ $apds->tindakan }}</td>
                                    <td>{{ $apds->topi }}</td>
                                    <td>{{ $apds->kacamata }}</td>
                                    <td>{{ $apds->masker }}</td>
                                    <td>{{ $apds->gown }}</td>
                                    <td>{{ $apds->sarung_tangan }}</td>
                                    <td>{{ $apds->sepatu }}</td>
                                    <td>{{ $apds->ya }}</td>
                                    <td>{{ $apds->tidak }}</td>
                                    <td>{{ $apds->keterangan }}</td>
                                    <td class="text-center">

                                        @can('apds.edit')
                                            <a href="{{ route('apds.edit', $apds->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('apds.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $apds->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$apd->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("apds.index") }}/"+id,
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
