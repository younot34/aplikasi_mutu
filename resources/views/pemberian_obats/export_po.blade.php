@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Farmasi - Tidak Adanya Kesalahan Pemberian Obat</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('pemberian_obats.export_po') }}" method="GET" class="d-inline-block">
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
                                <th>NO.RM</th>
                                <th>Tidak Salahan Dalam Pemberian Obat</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totaltidakSalah = 0;
                                $totalsalah = 0;

                                foreach ($pemberian_obats as $no => $pemberian_obat) {
                                    $tidakSalahs = 0;
                                    $salah = 0;
                                    
                                    if(
                                        $pemberian_obat->tidakSalah == '✔️'
                                    ){
                                        $totaltidakSalah++;
                                    }else{
                                        $totalsalah++;
                                    }
                                    $totaltidakSalah += $tidakSalahs;
                                    $totalsalah += $salah;
                                }
                                $totalSemua = $totaltidakSalah + $totalsalah;
                                $persentase = $totalSemua > 0 ? ($totaltidakSalah / $totalSemua) * 100 : 0;
                            @endphp
                            @foreach ($pemberian_obats as $no => $pemberian_obat)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $pemberian_obat->tanggal }}</td>
                                    <td>{{ $pemberian_obat->nama_pasien }}</td>
                                    <td>{{ $pemberian_obat->no_rm }}</td>
                                    <td>{{ $pemberian_obat->tidakSalah }}</td>
                                    <td>{{ $pemberian_obat->keterangan }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right"><center><strong>Jumlah Kesalahan Yang Terjadi</strong></center></td>
                                <td><center><strong>{{ $totalsalah }}</strong></center></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><center><strong>Persentase</strong></center></td>
                                <td>
                                    <center>
                                        <strong>
                                            @if ($persentase > 0)
                                                {{ round($persentase, 2) }}%
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
