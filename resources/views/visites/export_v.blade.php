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
                    <form action="{{ route('visites.export_v') }}" method="GET" class="d-inline-block">
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
                                <th scope="col" colspan="2"><center>Jam Visite Dokter</center></th>
                                <th scope="col">Dokter Spesialis</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center"> 06.00-14.00</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">>14.00</th> <!-- Subkolom "Benar Alamat" -->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visite as $no => $visites)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                <td>{{ $visites->tanggal }}</td>
                                <td>{{ $visites->no_rm }}</td>
                                <td>{{ $visites->nama_px }}</td>
                                <td>{{ $visites->jam6sampai14 }}</td>
                                <td>{{ $visites->kurang14 }}</td>
                                <td>{{ $visites->dokter_spesial }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>HASIL AKHIR</strong></center></td>
                                <td colspan="1">
                                    <strong>
                                        @php
                                            $totalJam6sampai14 = 0;

                                            foreach ($visite as $visites) {
                                                $totalJam6sampai14 += $visites->jam6sampai14 === '✔️' ? 1 : 0;
                                            }
                                            $result = $totalJam6sampai14;
                                        @endphp
                                            <center>{{$result}}</center>
                                    </strong>
                                </td>
                                <td colspan="1">
                                    <strong>
                                        @php
                                            $totalKurang14 = 0;

                                            foreach ($visite as $visites) {
                                                $totalKurang14 += $visites->kurang14 === '✔️' ? 1 : 0;
                                            }
                                            $resultt = $totalKurang14
                                        @endphp
                                            <center>{{$resultt}}</center>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>PERSENTASE</strong></center></td>
                                <td colspan="1">
                                    <strong>
                                        <center>
                                            @if ($totalJam6sampai14 > 0)
                                                {{ round(($totalJam6sampai14 / ($totalJam6sampai14 + $totalKurang14)) * 100, 2) }}%
                                            @else
                                                0%
                                            @endif
                                        </center>
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
