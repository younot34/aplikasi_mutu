@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>mutus</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> mutus</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('mutus.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('mutus.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('mutus.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama mutu">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAME</th>
                                <th scope="col">TIME</th>
                                <th scope="col">TOTAL QUESTION</th>
                                @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                                <th scope="col">ASSIGN KARYAWAN</th>
                                @endhasanyrole
                                @hasrole('karyawan')
                                <th scope="col">SCORE</th>
                                @endhasrole
                                <th scope="col">START</th>
                                <th scope="col">END</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($mutus as $no => $mutu)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($mutus->currentPage()-1) * $mutus->perPage() }}</th>
                                    <td>{{ $mutu->name }}</td>
                                    <td>{{ $mutu->time }}</td>
                                    <td>{{ $mutu->total_question }}</td>
                                    @hasanyrole('petugas|admin')
                                    <td>{{ $mutu->users->count() }}</td>
                                    @endhasanyrole
                                    @hasrole('karyawan')
                                    <td>{{  $user->getScore(Auth()->id(), $mutu->id) !== null ? $user->getScore(Auth()->id(), $mutu->id) : "Belum dikerjakan"  }}</td>
                                    @endhasrole
                                    <td>{{ TanggalID($mutu->start) }}</td>
                                    <td>{{ TanggalID($mutu->end) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('mutus.show', $mutu->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('mutus.edit')
                                            <a href="{{ route('mutus.edit', $mutu->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        {{-- @hasanyrole('petugas|admin')
                                        <a href="{{ route('mutus.karyawan', $mutu->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-door-open"></i>
                                        </a>
                                        @endhasanyrole --}}

                                        @can('mutus.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $mutu->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$mutus->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("mutus.index") }}/"+id,
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
