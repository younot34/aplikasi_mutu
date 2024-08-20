@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>RAwat INAP</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Bulanan </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('ris.export_ri') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    {{-- <form action="{{ route('ris.export_ri.export') }}" method="GET" class="d-inline-block ml-2">
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
                                <th scope="col">Sift</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Alamat</th>
                                <th scope="col" colspan="2"><center>Pemberian Obat</center></th>
                                <th scope="col" colspan="2"><center>Pemberian Darah</center></th>
                                <th scope="col" colspan="2"><center>Pengambilan Sample</center></th>
                                <th scope="col" colspan="2"><center>Pemberian Tindakan</center></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                                <th style="width: 15%;text-align: center"> benar nama</th> <!-- Subkolom "Benar Nama" -->
                                <th style="width: 15%;text-align: center">benar alamat</th> <!-- Subkolom "Benar Alamat" -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ri as $no => $ris)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no + ($ri->currentPage()-1) * $ri->perPage() }}</th>
                                <td>{{ $ris->tanggal }}</td>
                                <td>{{ $ris->sift }}</td>
                                <td>{{ $ris->no_rm }}</td>
                                <td>{{ $ris->nama_px }}</td>
                                <td>{{ $ris->alamat }}</td>
                                <td>
                                    @foreach ($ris->pobats as $pobat)
                                        <div>{{ $pobat->benar_namao }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ris->pobats as $pobat)
                                        <div>{{ $pobat->benar_alamato }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ris->pdarahs as $pdarah)
                                        <div>{{ $pdarah->benar_namad }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ris->pdarahs as $pdarah)
                                        <div>{{ $pdarah->benar_alamatd }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ris->psamples as $psample)
                                        <div>{{ $psample->benar_namas }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ris->psamples as $psample)
                                        <div>{{ $psample->benar_alamats }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ris->ptindakans as $ptindakan)
                                        <div>{{ $ptindakan->benar_namat }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ris->ptindakans as $ptindakan)
                                        <div>{{ $ptindakan->benar_alamatt }}</div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $ri->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
