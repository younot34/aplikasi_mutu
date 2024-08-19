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
                    <form action="{{ route('apds.export_apd') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    {{-- <form action="{{ route('apds.export_apd.export') }}" method="GET" class="d-inline-block ml-2">
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
                                <th scope="col">Unit</th>
                                <th scope="col">Nama Petugas</th>
                                <th scope="col">Profesi</th>
                                <th scope="col">Tindakan</th>
                                <th scope="col" colspan="6"><center>APD yang digunakan</center></th>
                                <th scope="col" colspan="2"><center>Ketepatan</center></th>
                                <th scope="col" >Keterangan</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Topi</th>
                                <th>Kacamata/faceshield</th>
                                <th>Masker</th>
                                <th>Gown</th>
                                <th>Sarung Tangan</th>
                                <th>Sepatu</th>
                                <th>Ya</th>
                                <th>Tidak</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apd as $no => $apds)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no + ($apd->currentPage()-1) * $apd->perPage() }}</th>
                                <td>{{ $apds->tanggal }}</td>
                                <td>{{ $apds->unit }}</td>
                                <td>{{ $apds->nama_petugas }}</td>
                                <td>{{ $apds->profesi }}</td>
                                <td>{{ $apds->tindakan }}</td>
                                <td>{{ $apds->topi }}</td>
                                <td>{{ $apds->kacamata }}</td>
                                <td>{{ $apds->masker }}</td>
                                <td>{{ $apds->gown }}</td>
                                <td>{{ $apds->sarung_tangan }}</td>
                                <td>{{ $apds->sepatu }}</td>
                                <td>{{ $apds->ya }}</td>
                                <td>{{ $apds->tidak }}</td>
                                <td>{{ $apds->keterangan }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="12" class="text-right"><center><strong>HASIL AKHIR YA</strong></center></td>
                                <td colspan="3">
                                    <strong>
                                        @php
                                            $totalYa = 0;
                                            $totalTidak = 0;

                                            foreach ($apd as $apds) {
                                                $totalYa += $apds->ya === '✔️' ? 1 : 0;
                                                $totalTidak += $apds->tidak === '✔️' ? 1 : 0;
                                            }
                                            $result = ($totalYa + $totalTidak) - $totalTidak;
                                        @endphp
                                            <center>{{$result}}</center>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $apd->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
