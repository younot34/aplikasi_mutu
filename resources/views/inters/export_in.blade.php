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
                    <form action="{{ route('inters.export_in') }}" method="GET" class="d-inline-block">
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
                                <th scope="col" colspan="2"><center>Intervensi Risiko Jatuh</center></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center">Terisi</th>
                                <th style="width: 15%;text-align: center">Tidak Terisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalterisi = 0;
                                $totaltidak_terisi = 0;

                                foreach ($inter as $no => $inters) {
                                    $terisis = 0;
                                    $tidakterisis = 0;
                                    
                                    if(
                                        $inters->terisi == '✔️'
                                    ){
                                        $totalterisi++;
                                    }else{
                                        $totaltidak_terisi++;
                                    }
                                    $totalterisi += $terisis;
                                    $totaltidak_terisi += $tidakterisis;
                                }
                                $totalSemua = $totalterisi + $totaltidak_terisi;
                                $persentase = $totalSemua > 0 ? ($totalterisi / $totalSemua) * 100 : 0;
                            @endphp
                            @foreach ($inter as $no => $inters)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                <td>{{ $inters->tanggal }}</td>
                                <td>{{ $inters->no_rm }}</td>
                                <td>{{ $inters->nama_pasien }}</td>
                                <td>{{ $inters->terisi }}</td>
                                <td>{{ $inters->tidak_terisi }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>HASIL AKHIR</strong></center></td>
                                <td colspan="1">
                                    <strong>
                                            <center>{{$totalterisi}}</center>
                                    </strong>
                                </td>
                                <td colspan="1">
                                    <strong>
                                            <center>{{$totaltidak_terisi}}</center>
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
