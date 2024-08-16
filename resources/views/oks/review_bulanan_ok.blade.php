@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Review Bulanan OK</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review bulanan OK </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('oks.review_bulanan_ok') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('oks.review_bulanan_ok') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                    <table class='table table-bordered mt-4'>
                        <thead>
                            <tr>
                                <th>Nama Pasien</th>
                                <th>No. RM</th>
                                <th>Diagnosa</th>
                                <th>Nama Dokter</th>
                                <th>Tanggal</th>
                                <th>Waktu Pelaksanaan</th>
                                <th>Waktu Pending</th>
                                <th>Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oks as $ok)
                                <tr>
                                    <td>{{ $ok->nama_pasien }}</td>
                                    <td>{{ $ok->no_rm }}</td>
                                    <td>{{ $ok->diagnosa }}</td>
                                    <td>{{ $ok->nama_dokter }}</td>
                                    <td>{{ $ok->tanggal }}</td>
                                    <td>{{ $ok->waktu_pelaksanaan }}</td>
                                    <td>{{ $ok->waktu_pending }}</td>
                                    <td>{{ $ok->alasan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
