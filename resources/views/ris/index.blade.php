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
                    <h4><i class="fas fa-exam"></i>Kepatuhan Indentifikasi Pasien</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('ris.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('ris.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('ris.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan tanggal ris">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                            @can('ris.export')
                                <a href="{{ route('ris.export') }}" class="btn btn-sm btn-primary">
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
                                <th scope="col">Sift</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama PX</th>
                                <th scope="col">Alamat</th>
                                <th scope="col" colspan="2"><center>Pemberian Obat</center></th>
                                <th scope="col" colspan="2"><center>Pemberian Darah</center></th>
                                <th scope="col" colspan="2"><center>Pengambilan Sample</center></th>
                                <th scope="col" colspan="2"><center>Pemberian Tindakan</center></th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($ri as $no => $ris)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($ri->currentPage()-1) * $ri->perPage() }}</th>
                                    <td>{{ $ris->tanggal }}</td>
                                    <td>{{ $ris->sift }}</td>
                                    <td>{{ $ris->no_rm }}</td>
                                    <td>{{ $ris->nama_px }}</td>
                                    <td>{{ $ris->alamat }}</td>
                                    <td>
                                        @foreach ($ris->pobats as $pobat)
                                            <div>{{ $pobat->benar_namao }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ris->pobats as $pobat)
                                            <div>{{ $pobat->benar_alamato }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ris->pdarahs as $pdarah)
                                            <div>{{ $pdarah->benar_namad }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ris->pdarahs as $pdarah)
                                            <div>{{ $pdarah->benar_alamatd }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ris->psamples as $psample)
                                            <div>{{ $psample->benar_namas }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ris->psamples as $psample)
                                            <div>{{ $psample->benar_alamats }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ris->ptindakans as $ptindakan)
                                            <div>{{ $ptindakan->benar_namat }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ris->ptindakans as $ptindakan)
                                            <div>{{ $ptindakan->benar_alamatt }}</div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">

                                        @can('ris.edit')
                                            <a href="{{ route('ris.edit', $ris->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('ris.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $ris->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$ri->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("ris.index") }}/"+id,
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
