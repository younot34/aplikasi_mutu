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
                                <th>Nama PX</th>
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
                                        @endif
                                        <td>{{ $obat->r }}</td>
                                        <td>{{ $obat->nama_obat }}</td>
                                        <td>{{ $obat->total_obat_fornas }}</td>
                                        <td>{{ $obat->total_item }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right"><strong>JUMLAH</strong></td>
                                <td><strong>{{ $totalObatFornas }}</strong></td>
                                <td><strong>{{ $totalItem }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@stop