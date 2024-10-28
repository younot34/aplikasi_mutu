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
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan Farmasi </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('farmasis.laporan-bulanan') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('farmasis.laporan-bulanan.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>No RM</th>
                                <th>R/</th>
                                <th>Nama Obat</th>
                                <th>Total Obat Fornas</th>
                                <th>Total Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmasis as $no => $farmasi)
                                @foreach ($farmasi->obats as $index => $obat)
                                    <tr>
                                        @if ($index == 0)
                                            <td rowspan="{{ $farmasi->obats->count() }}">{{ date('d/m/Y', strtotime($farmasi->waktu)) }}</td>
                                            <td rowspan="{{ $farmasi->obats->count() }}">{{ $no + 1 }}</td>
                                            <td rowspan="{{ $farmasi->obats->count() }}">{{ $farmasi->nama_px }}</td>
                                            <td rowspan="{{ $farmasi->obats->count() }}">{{ $farmasi->no_rm }}</td>
                                        @endif
                                        <td>
                                            @foreach ($farmasi->nama_obats as $index => $nama_obatss)
                                            <div>{{ $nama_obatss->r }}</div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($farmasi->nama_obats as $index => $nama_obatss)
                                            <div>{{ $nama_obatss->nama_obat }}</div>
                                            @endforeach
                                        </td>
                                        <td>{{ $obat->total_obat_fornas }}</td>
                                        <td>{{ $obat->total_item }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right"><center><strong>JUMLAH</strong></center></td>
                                <td><strong>{{ $totalObatFornas }}</strong></td>
                                <td><strong>{{ $totalItem }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><center><strong>Persentase</strong></center></td>
                                <td colspan="8">
                                    <strong>
                                        <center>
                                            @if ($totalItem > 0)
                                                {{ round(($totalObatFornas / $totalItem) * 100, 2) }}%
                                            @else
                                                0%
                                            @endif
                                        </center>
                                    </strong>
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
