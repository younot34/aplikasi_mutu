@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Farmasi - Obat Racikan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('obat_racikans.export_or') }}" method="GET" class="d-inline-block">
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
                                <th>Resep Masuk</th>
                                <th>Resep Diserahkan</th>
                                <th>Waktu Pelayanan (menit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $countLessThan60 = 0;  // Counter for pelayanan time less than or equal to 60 mins
                                $totalData = count($obat_racikans); // Total data for the month
                            @endphp
                            @foreach ($obat_racikans as $no => $obat_racikan)
                                @php
                                    // Calculate waktu pelayanan in minutes
                                    $waktu_pelayanan = \Carbon\Carbon::parse($obat_racikan->resep_diserahkan)
                                                        ->diffInMinutes(\Carbon\Carbon::parse($obat_racikan->resep_masuk));
                                    if ($waktu_pelayanan <= 60) {
                                        $countLessThan60++;
                                    }
                                @endphp
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y', strtotime($obat_racikan->tanggal)) }}</td>
                                    <td>{{ $obat_racikan->nama_pasien }}</td>
                                    <td>{{ $obat_racikan->resep_masuk }}</td>
                                    <td>{{ $obat_racikan->resep_diserahkan }}</td>
                                    <td>{{ $waktu_pelayanan }} menit</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right"><center><strong>Jumlah Waktu Pelayanan <= 60 Menit</strong></center></td>
                                <td><center><strong>{{ $countLessThan60 }}</strong></center></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><center><strong>Persentase Waktu Pelayanan <= 60 Menit</strong></center></td>
                                <td>
                                    <center>
                                        <strong>
                                            @if ($totalData > 0)
                                                {{ round(($countLessThan60 / $totalData) * 100, 2) }}%
                                            @else
                                                0%
                                            @endif
                                        </strong>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
