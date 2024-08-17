@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>PPI</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('ppis.export') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('ppis.export.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Unit</th>
                                <th>Tanggal</th>
                                <th>Observer</th>
                                <th>Profesi</th>
                                <th>Jumlah</th>
                                <th>Opp</th>
                                <th>Indikasi</th>
                                <th>Cuci Tangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ppis as $no => $ppiss)
                                <tr>
                                    <td style="text-align: center">{{ ++$no + ($ppis->currentPage()-1) * $ppis->perPage() }}</td>
                                    <td>{{ $ppiss->unit }}</td>
                                    <td>{{ $ppiss->tanggal }}</td>
                                    <td>{{ $ppiss->observer }}</td>
                                    <td>
                                        @foreach ($ppiss->profesis as $profesi)
                                            <div>{{ $profesi->profesi }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->profesis as $profesi)
                                            <div>{{ $profesi->jumlah }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->indikasis as $indikasi)
                                            <div>{{ $indikasi->opp }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->indikasis as $indikasi)
                                            <div>{{ $indikasi->indikasi }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ppiss->indikasis as $indikasi)
                                            <div>{{ $indikasi->cuci_tangan }}</div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
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
