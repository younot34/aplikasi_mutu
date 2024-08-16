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
                    <h4><i class="fas fa-exam"></i>Kepatuhan Terhadap Clinical Pathway</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('clinicals.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('clinicals.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('clinicals.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama pasien clinicals">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                            @can('clinicals.export')
                                <a href="{{ route('clinicals.export') }}" class="btn btn-sm btn-primary">
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
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col" colspan="5"><center>Diagnosa</center></th>
                                <th scope="col" colspan="2"><center>Waktu</center></th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Ca Cervik</th>
                                <th>TB</th>
                                <th>HT</th>
                                <th>HIV</th>
                                <th>DM</th>
                                <th>Masuk Ranap</th>
                                <th>Keluar Ranap</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinical as $no => $clinicals)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($clinical->currentPage()-1) * $clinical->perPage() }}</th>
                                    <td>{{ $clinicals->no_rm }}</td>
                                    <td>{{ $clinicals->nama_px }}</td>
                                    <td>{{ $clinicals->ca_cervik }}</td>
                                    <td>{{ $clinicals->tb }}</td>
                                    <td>{{ $clinicals->ht }}</td>
                                    <td>{{ $clinicals->hiv }}</td>
                                    <td>{{ $clinicals->dm }}</td>
                                    <td>{{ $clinicals->masuk }}</td>
                                    <td>{{ $clinicals->keluar }}</td>
                                    <td class="text-center">

                                        @can('clinicals.edit')
                                            <a href="{{ route('clinicals.edit', $clinicals->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('clinicals.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $clinicals->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$clinical->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("clinicals.index") }}/"+id,
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
