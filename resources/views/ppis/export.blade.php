@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Farmasi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan Imprs </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('imprs.export') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('imprs.export.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Resep Terverifikasi Double Check</th>
                                <th>Resep High Alert</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($imprs as $no => $imprss)
                                <tr>
                                    <td style="text-align: center">{{ ++$no + ($imprs->currentPage()-1) * $imprs->perPage() }}</td>
                                    <td>{{ date('d/m/Y', strtotime($imprss->waktu)) }}</td>
                                    <td>
                                        @foreach ($imprss->reseps as $resep)
                                            <div>{{ $resep->resep_terverifikasi }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($imprss->reseps as $resep)
                                            <div>{{ $resep->resep_high_alert }}</div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-right"><center><strong>HASIL AKHIR</strong></center></td>
                                <td colspan="2">
                                    <strong>
                                        @php
                                            $totalHighAlert = 0;
                                            $totalTerverifikasi = 0;

                                            foreach ($imprs as $imprss) {
                                                $totalHighAlert += $imprss->reseps->sum('resep_high_alert');
                                                $totalTerverifikasi += $imprss->reseps->sum('resep_terverifikasi');
                                            }
                                        @endphp

                                        @if ($totalHighAlert > 0)
                                            <center>{{ ($totalTerverifikasi / $totalHighAlert)  * 100 }}%</center>
                                        @else
                                            0%
                                        @endif
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $ppis->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
