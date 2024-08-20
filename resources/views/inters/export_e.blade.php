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
                                <th style="width: 15%;text-align: center">Terisis</th>
                                <th style="width: 15%;text-align: center">Tidak Terisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inter as $no => $inters)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no + ($inter->currentPage()-1) * $inter->perPage() }}</th>
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
                                        @php
                                            $totalterisi = 0;

                                            foreach ($inter as $inters) {
                                                $totalterisi += $inters->terisi === '✔️' ? 1 : 0;
                                            }
                                            $result = $totalterisi;
                                        @endphp
                                            <center>{{$result}}</center>
                                    </strong>
                                </td>
                                <td colspan="1">
                                    <strong>
                                        @php
                                            $totaltidak_terisi = 0;

                                            foreach ($inter as $inters) {
                                                $totaltidak_terisi += $inters->tidak_terisi === '✔️' ? 1 : 0;
                                            }
                                            $resultt = $totaltidak_terisi
                                        @endphp
                                            <center>{{$resultt}}</center>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $inter->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
