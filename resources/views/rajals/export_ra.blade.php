@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>RAWAT JALAN</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('rajals.export_ra') }}" method="GET" class="d-inline-block">
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
                                <th scope="col">Poli</th>
                                <th scope="col" colspan="2"><center>Waktu Tunggu < 60mnt </center></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center">Patuh</th>
                                <th style="width: 15%;text-align: center">Tidak Patuh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rajal as $no => $rajals)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no + ($rajal->currentPage()-1) * $rajal->perPage() }}</th>
                                <td>{{ $rajals->tanggal }}</td>
                                <td>{{ $rajals->poli }}</td>
                                <td><center>{{ $rajals->patuh }}</center></td>
                                <td><center>{{ $rajals->tidak_patuh }}</center></td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="3" class="text-right"><center><strong>TOTAL</strong></center></td>
                                <td colspan="1">
                                    <strong>
                                        @php
                                            $totalpatuh = 0;

                                            foreach ($rajal as $rajals) {
                                                $totalpatuh += $rajals->patuh;
                                            }
                                            $result = $totalpatuh;
                                        @endphp
                                            <center>{{$result}}</center>
                                    </strong>
                                </td>
                                <td colspan="1">
                                    <strong>
                                        @php
                                            $totaltidak_patuh = 0;

                                            foreach ($rajal as $rajals) {
                                                $totaltidak_patuh += $rajals->tidak_patuh;
                                            }
                                            $resultt = $totaltidak_patuh
                                        @endphp
                                            <center>{{$resultt}}</center>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $rajal->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
