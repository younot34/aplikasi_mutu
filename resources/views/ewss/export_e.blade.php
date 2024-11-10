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
                    <form action="{{ route('ewss.export_e') }}" method="GET" class="d-inline-block">
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
                                <th scope="col">Tanggal</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col" colspan="2"><center>Dokumen EWS</center></th>
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

                                foreach ($ews as $no => $ewss) {
                                    $terisis = 0;
                                    $tidakterisis = 0;
                                    
                                    if(
                                        $ewss->terisi == '✔️'
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
                            @foreach ($ews as $no => $ewss)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                <td>{{ $ewss->tanggal }}</td>
                                <td>{{ $ewss->no_rm }}</td>
                                <td>{{ $ewss->nama_pasien }}</td>
                                <td>{{ $ewss->terisi }}</td>
                                <td>{{ $ewss->tidak_terisi }}</td>
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
