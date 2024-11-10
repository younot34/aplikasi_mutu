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
                    <h4><i class="fas fa-exam"></i>Tidak Adanya Kesalahan Pemberian Obat</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('pemberian_obats.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('pemberian_obats.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('pemberian_obats.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q" placeholder="Cari berdasarkan tanggal">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI</button>
                                </div>
                            </div>
                            @can('pemberian_obats.export_po')
                                <a href="{{ route('pemberian_obats.export_po') }}" class="btn btn-sm btn-primary">Laporan Bulanan
                                    <i class="fa fa-door-open"></i>
                                </a>
                            @endcan
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width: 6%">NO.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>NO.RM</th>
                                    <th>Tidak Salahan Dalam Pemberian Obat</th>
                                    <th>Keterangan</th>
                                    <th style="text-align: center;width: 15%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemberian_obats as $no => $pemberian_obat)
                                <tr>
                                    <td style="text-align: center">{{ ++$no + ($pemberian_obats->currentPage()-1) * $pemberian_obats->perPage() }}</td>
                                    <td>{{ $pemberian_obat->tanggal }}</td>
                                    <td>{{ $pemberian_obat->nama_pasien }}</td>
                                    <td>{{ $pemberian_obat->no_rm }}</td>
                                    <td>{{ $pemberian_obat->tidakSalah }}</td>
                                    <td>{{ $pemberian_obat->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pemberian_obats.edit', $pemberian_obat->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil-alt"></i> Edit
                                        </a>
                                        <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $pemberian_obat->id }}">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $pemberian_obats->links("vendor.pagination.bootstrap-4") }}
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
                    url: "{{ route('pemberian_obats.index') }}/" + id,
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
