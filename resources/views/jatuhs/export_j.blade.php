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
                    <form action="{{ route('jatuhs.export_j') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    {{-- <form action="{{ route('jatuhs.export_j.export') }}" method="GET" class="d-inline-block ml-2">
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
                                <th scope="col" colspan="2"><center>Resiko Jatuh</center></th>
                                <th scope="col" colspan="3"><center>Upaya Pencegahan Resiko Jatuh</center></th>
                                <th scope="col">Jumlah</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Rendah</th>
                                <th>Tinggi</th>
                                <th>Kancing Kuning</th>
                                <th>Segitiga Resiko Jatuh</th>
                                <th>Pemasangan Handreal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jatuh as $no => $jatuhs)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no + ($jatuh->currentPage()-1) * $jatuh->perPage() }}</th>
                                <td>{{ $jatuhs->tanggal }}</td>
                                <td>{{ $jatuhs->no_rm }}</td>
                                <td>{{ $jatuhs->nama_px }}</td>
                                <td>{{ $jatuhs->rendah }}</td>
                                <td>{{ $jatuhs->tinggi }}</td>
                                <td>{{ $jatuhs->kancing }}</td>
                                <td>{{ $jatuhs->segitiga }}</td>
                                <td>{{ $jatuhs->handreal }}</td>
                                <td>
                                    <strong>
                                        @php
                                            $totalRendah = 0;
                                            $totalTinggi = 0;
                                            $totalKancing = 0;
                                            $totalSegitiga = 0;
                                            $totalHandreal = 0;
                                            foreach ($jatuh as $jatuhs) {
                                                $totalRendah += $jatuhs->rendah === '✔️' ? 1 : 0;
                                                $totalTinggi += $jatuhs->tinggi === '✔️' ? 1 : 0;
                                                $totalKancing += $jatuhs->kancing === '✔️' ? 1 : 0;
                                                $totalSegitiga += $jatuhs->segitiga === '✔️' ? 1 : 0;
                                                $totalHandreal += $jatuhs->handreal === '✔️' ? 1 : 0;
                                            }
                                            $result = $totalRendah + $totalTinggi + $totalKancing + $totalSegitiga + $totalHandreal;
                                        @endphp
                                            <center>{{$result}}</center>
                                    </strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $jatuh->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
