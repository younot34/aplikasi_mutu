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
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('clinicals.export_c') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col" colspan="5"><center>Diagnosa</center></th>
                                <th scope="col" colspan="2"><center>Waktu</center></th>
                                <th scope="col" colspan="2"><center>Patuh</center></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Masuk Ranap</th>
                                <th>Keluar Ranap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalpatuh = 0;
                                $totaltidak_patuh = 0;

                                foreach ($clinical as $no => $clinicals) {
                                    $patuhs = 0;
                                    $tidakpatuhs = 0;

                                    if(
                                        $clinicals->patuh == '✔️'
                                    ){
                                        $totalpatuh++;
                                    }else{
                                        $totaltidak_patuh++;
                                    }
                                    $totalpatuh += $patuhs;
                                    $totaltidak_patuh += $tidakpatuhs;
                                }
                                $totalSemua = $clinical->count();
                                $persentase = $totalSemua > 0 ? ($totalpatuh / $totalSemua) * 100 : 0;
                            @endphp
                            @foreach ($clinical as $no => $clinicals)
                                <tr>
                                    <th scope="row" style="text-align: center">{{$loop->iteration }}</th>
                                    <td>{{ $clinicals->no_rm }}</td>
                                    <td>{{ $clinicals->nama_px }}</td>
                                    <td>{{ $clinicals->diagnosa }}</td>
                                    <td>{{ $clinicals->masuk }}</td>
                                    <td>{{ $clinicals->keluar }}</td>
                                    <td>{{ $clinicals->patuh }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>HASIL AKHIR</strong></center></td>
                                <td colspan="1">
                                    <strong>
                                            <center>Patuh:{{$totalpatuh}}</center>
                                    </strong>
                                </td>
                                <td colspan="1">
                                    <strong>
                                            <center>Tidak Patuh:{{$totaltidak_patuh}}</center>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>PERSENTASE</strong></center></td>
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
