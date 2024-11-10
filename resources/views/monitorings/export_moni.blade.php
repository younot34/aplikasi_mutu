@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>LABORATORIUM - MONITORING IDENTIFIKASI SAMPLE</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('monitorings.export_moni') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nama Pasien</th>
                                <th>No.RM</th>
                                <th>Patuh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalpatuh = 0;
                                $totaltidak_patuh = 0;

                                foreach ($monitoring as $no => $monitorings) {
                                    $patuhs = 0;
                                    $tidakpatuhs = 0;

                                    if(
                                        $monitorings->patuh == '✔️'
                                    ){
                                        $totalpatuh++;
                                    }else{
                                        $totaltidak_patuh++;
                                    }
                                    $totalpatuh += $patuhs;
                                    $totaltidak_patuh += $tidakpatuhs;
                                }
                                $totalSemua = $totalpatuh + $totaltidak_patuh;
                                $persentase = $totalSemua > 0 ? ($totalpatuh / $totalSemua) * 100 : 0;
                            @endphp
                            @foreach ($monitoring as $no => $monitorings)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                    <td>{{ $monitorings->tanggal }}</td>
                                    <td>{{ $monitorings->no_rm }}</td>
                                    <td>{{ $monitorings->nama_pasien }}</td>
                                    <td>{{ $monitorings->patuh }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right"><center><strong>HASIL AKHIR</strong></center></td>
                                <td colspan="1">
                                    <strong>
                                            <center>Patuh:{{$totalpatuh}}</center>
                                    </strong>
                                </td>
                                <td colspan="1">
                                    <strong>
                                            <center>Tidak Patuh: {{$totaltidak_patuh}}</center>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><center><strong>PERSENTASE</strong></center></td>
                                <td colspan="2">
                                    <strong>
                                        @if ($persentase > 0)
                                            <center>{{ number_format($persentase, 2) }}%</center>
                                        @else
                                            0%
                                        @endif
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
