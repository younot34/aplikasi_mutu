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
                    <h4><i class="fas fa-exam"></i>REGISTRASI PELAPORAN HASIL NILAI KRITIS LABORATORIUM</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('nilai_kritiss.index') }}" method="GET">
                    @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin|petugas8|petugas9|petugas10|petugas11|petugas12|petugas13')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('nilai_kritiss.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('nilai_kritiss.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan tanggal">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                            @can('nilai_kritiss.export_lab')
                                <a href="{{ route('nilai_kritiss.export_lab') }}" class="btn btn-sm btn-primary"> Laporan Bulanan
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
                                <th scope="col">Unit Asal</th>
                                <th scope="col">Dokter Pengirim</th>
                                <th scope="col">Jenis Pelayanan</th>
                                <th scope="col">Waktu Sampling</th>
                                <th scope="col">Waktu Selsai Pemeriksaan</th>
                                <th scope="col">Waktu Hasil Diterima Dokter/Perawat</th>
                                <th scope="col">Selisih Waktu</th>
                                <th scope="col">Hasil Pemeriksaan Nilai Kritis</th>
                                <th scope="col">Pemberi Informasi</th>
                                <th scope="col">Penerima Informasi</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_kritis as $no => $nilai_kriti)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($nilai_kritis->currentPage()-1) * $nilai_kritis->perPage() }}</th>
                                    <td>{{ $nilai_kriti->tanggal }}</td>
                                    <td>{{ $nilai_kriti->no_rm }}</td>
                                    <td>{{ $nilai_kriti->nama_pasien }}</td>
                                    <td>{{ $nilai_kriti->unit_asal }}</td>
                                    <td>{{ $nilai_kriti->dokter_pengirim }}</td>
                                    <td>{{ $nilai_kriti->jenis_pelayanan }}</td>
                                    <td>{{ $nilai_kriti->waktu_sampling }}</td>
                                    <td>{{ $nilai_kriti->waktu_selsai }}</td>
                                    <td>{{ $nilai_kriti->waktu_diterima }}</td>
                                    <td>{{ $nilai_kriti->selisih_waktu}}</td>
                                    <td>{!! nl2br(e($nilai_kriti->hasil_pemeriksaan_nilai_kritis)) !!}</td>
                                    <td>{{ $nilai_kriti->pemberi_informasi }}</td>
                                    <td>{{ $nilai_kriti->penerima_informasi }}</td>
                                    <td class="text-center">

                                        @can('nilai_kritiss.edit')
                                            <a href="{{ route('nilai_kritiss.edit', $nilai_kriti->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('nilai_kritiss.delete')
                                            <button onClick="Delete(id)" class="btn btn-sm btn-danger" id="{{ $nilai_kriti->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$nilai_kritis->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("nilai_kritiss.index") }}/"+id,
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
