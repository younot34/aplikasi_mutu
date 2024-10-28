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
                    <form action="{{ route('dpjps.export_dp') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    {{-- <form action="{{ route('visites.export_v.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form> --}}
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col" colspan="2"><center>Catatan Komunikasi (TbAk)</center></th>
                                <th scope="col">DPJP</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center">Terverifikasi</th>
                                <th style="width: 15%;text-align: center">Tidak Terverifikasi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalterverif = 0;
                                $totaltidak_terverif = 0;

                                foreach ($dpjp as $no => $dpjps) {
                                    $terverifs = 0;
                                    $tidakterverifs = 0;
                                    
                                    if(
                                        $dpjps->terverifikasi == '✔️'
                                    ){
                                        $totalterverif++;
                                    }else{
                                        $totaltidak_terverif++;
                                    }
                                    $totalterverif += $terverifs;
                                    $totaltidak_terverif += $tidakterverifs;
                                }
                                $totalSemua = $totalterverif + $totaltidak_terverif;
                                $persentase = $totalSemua > 0 ? ($totalterverif / $totalSemua) * 100 : 0;
                            @endphp
                            @foreach ($dpjp as $no => $dpjps)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                <td>{{ $dpjps->tanggal }}</td>
                                <td>{{ $dpjps->no_rm }}</td>
                                <td>{{ $dpjps->nama_pasien }}</td>
                                <td>{{ $dpjps->terverifikasi }}</td>
                                <td>{{ $dpjps->tidak_terverifikasi }}</td>
                                <td>{{ $dpjps->dpjp }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>HASIL AKHIR</strong></center></td>
                                <td colspan="1">
                                    <strong>
                                            <center>{{$totalterverif}}</center>
                                    </strong>
                                </td>
                                <td colspan="1">
                                    <strong>
                                            <center>{{$totaltidak_terverif}}</center>
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
