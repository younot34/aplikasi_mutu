@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Review Bulanan OK</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review bulanan OK IMPRS</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('oks.review_bulanan_ok_imprs') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('oks.review_bulanan_ok.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                    <div class="table-responsive">
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No.RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Umur</th>
                                    <th>Diagnosa</th>
                                    <th>Tindakan Operasi</th>
                                    <th>Dokter OP</th>
                                    <th>Dokter Anest</th>
                                    <th>Jenis OP</th>
                                    <th>Asuransi</th>
                                    <th>Rencana Tindakan</th>
                                    <th>Sign In</th>
                                    <th>Time Out</th>
                                    <th>Sign Out</th>
                                    <th colspan="6"><center>Indikator Mutu</center></th>
                                    <th>Keterangan</th>
                                    <th>Kendala</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Penandaan Lokasi OP</th>
                                    <th>Kelengkapan SSC</th>
                                    <th>Penundaan OP Elektif <= 2 jam</th>
                                    <th>Penundaan OP Elektif > 2 jam</th>
                                    <th>SC Emergensi <= 30 menit</th>
                                    <th>SC Emergensi > 30 menit</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalSsc = 0;
                                    $totalSsc1 = 0;
                                    $totalSscKeseluruhan = 0;
                                @endphp
                                @foreach ($oks as $item)
                                    @php

                                        // Menghitung total SSC
                                        if ($item->kelengkapan_ssc == '✔️') {
                                            $totalSsc++;
                                        }
                                        if ($item->kelengkapan_ssc == '❌') {
                                            $totalSsc1++;
                                        }

                                        $totalSscKeseluruhan = $totalSsc + $totalSsc1;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->no_rm }}</td>
                                        <td>{{ $item->nama_pasien }}</td>
                                        <td>{{ $item->umur }}</td>
                                        <td>{{ $item->diagnosa }}</td>
                                        <td>{{ $item->tindakan_operasi }}</td>
                                        <td>{{ $item->dokter_op }}</td>
                                        <td>{{ $item->dokter_anest }}</td>
                                        <td>{{ $item->jenis_op }}</td>
                                        <td>{{ $item->asuransi }}</td>
                                        <td>{{ $item->rencana_tindakan }}</td>
                                        <td>{{ $item->signin }}</td>
                                        <td>{{ $item->time_out }}</td>
                                        <td>{{ $item->sign_out }}</td>
                                        <td>{{ $item->penandaan_lokasi_op }}</td>
                                        <td>{{ $item->kelengkapan_ssc }}</td>
                                        <td>{{ $item->penundaan_op_elektif1 }}</td>
                                        <td>{{ $item->penundaan_op_elektif }}</td>
                                        <td>{{ $item->sc_emergensi1 }}</td>
                                        <td>{{ $item->sc_emergensi }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->kendala }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11"><strong><center>Total SSC: {{ $totalSsc }}</center></strong></td>
                                    <td colspan="17"></td>
                                </tr>
                                <tr>
                                    @if($totalSscKeseluruhan > 0)
                                        @php
                                            $persentaseSsc = ($totalSsc / $totalSscKeseluruhan) * 100;
                                        @endphp
                                        <td colspan="11"><strong><center>Persentase SSC: {{ number_format($persentaseSsc, 2) }}%</center></strong></td>
                                    @else
                                        <td colspan="11"><strong><center>Persentase SSC: 0%</center></strong></td>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>

                        <div style="text-align: center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
