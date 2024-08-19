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
                    <form action="{{ route('clinicals.export_c') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    {{-- <form action="{{ route('clinicals.export_c.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form> --}}
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col" colspan="5"><center>Diagnosa</center></th>
                                <th scope="col" colspan="2"><center>Waktu</center></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Ca Cervik</th>
                                <th>TB</th>
                                <th>HT</th>
                                <th>HIV</th>
                                <th>DM</th>
                                <th>Masuk Ranap</th>
                                <th>Keluar Ranap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinical as $no => $clinicals)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($clinical->currentPage()-1) * $clinical->perPage() }}</th>
                                    <td>{{ $clinicals->no_rm }}</td>
                                    <td>{{ $clinicals->nama_px }}</td>
                                    <td>{{ $clinicals->ca_cervik }}</td>
                                    <td>{{ $clinicals->tb }}</td>
                                    <td>{{ $clinicals->ht }}</td>
                                    <td>{{ $clinicals->hiv }}</td>
                                    <td>{{ $clinicals->dm }}</td>
                                    <td>{{ $clinicals->masuk }}</td>
                                    <td>{{ $clinicals->keluar }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $clinical->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
