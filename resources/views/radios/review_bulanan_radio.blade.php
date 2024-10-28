@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Review Bulanan Radiologi</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review Bulanan Radiologi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('radios.review_bulanan_radio') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('radios.review_bulanan_radio.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                    <div class="table-responsive">
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No.RO</th>
                                    <th>Nama Pasien</th>
                                    <th>No.RM</th>
                                    <th>Umur</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Dokter Pengirim</th>
                                    <th>Petugas</th>
                                    <th>Kv/MAs</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Tarif</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($radios as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->no_ro }}</td>
                                        <td>{{ $item->nama_pasien }}</td>
                                        <td>{{ $item->no_rm }}</td>
                                        <td>{{ $item->umur }}</td>
                                        <td>{{ $item->jenis_pemeriksaan }}</td>
                                        <td>{{ $item->dokter_pengirim }}</td>
                                        <td>{{ $item->petugas }}</td>
                                        <td>{{ $item->kvmas }}</td>
                                        <td>{{ $item->mulai }}</td>
                                        <td>{{ $item->selesai }}</td>
                                        <td>{{ $item->tarif }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $radios->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
