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
                    <h4><i class="fas fa-exam"></i> PPI</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('ppis.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('ppis.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('ppis.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan unit ppis">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                            @can('ppis.export')
                                <a href="{{ route('ppis.export') }}" class="btn btn-sm btn-primary">
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
                                <th scope="col">Unit</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Observer</th>
                                <th scope="col">Profesi</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Opp</th>
                                <th scope="col">Indikasi</th>
                                <th scope="col">Cuci Tangan</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppis as $no => $ppiss)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($ppis->currentPage()-1) * $ppis->perPage() }}</th>
                                    <td>{{ $ppiss->unit }}</td>
                                    <td>{{ $ppiss->tanggal }}</td>
                                    <td>{{ $ppiss->observer }}</td>
                                    <td>
                                        @foreach ($ppiss->profesis as $profesi)
                                            <div>{{ $profesi->profesi }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->profesis as $profesi)
                                            <div>{{ $profesi->jumlah }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->indikasis as $indikasi)
                                            <div>{{ $indikasi->opp }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->indikasis as $indikasi)
                                            <div>{{ $indikasi->indikasi }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->indikasis as $indikasi)
                                            <div>{{ $indikasi->cuci_tangan }}</div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">

                                        @can('ppis.edit')
                                            <a href="{{ route('ppis.edit', $ppiss->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('ppis.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $ppiss->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$ppis->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("ppis.index") }}/"+id,
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
