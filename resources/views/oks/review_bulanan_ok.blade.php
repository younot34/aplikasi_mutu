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
                    <h4><i class="fas fa-exam"></i> Review bulanan OK </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('oks.review_bulanan_ok') }}" method="GET" class="d-inline-block">
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
                                    <th colspan="4"><center>Indikator Mutu</center></th>
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
                                    <th>Penundaan OP Elektif</th>
                                    <th>SC Emergensi</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $lastDate = null; // Variabel untuk menyimpan tanggal terakhir yang ditampilkan
                                @endphp
                                @foreach ($oks as $item)
                                    <tr>
                                        <td>
                                            @if ($item->tanggal != $lastDate)
                                                {{ $item->tanggal }}
                                                @php
                                                    $lastDate = $item->tanggal; // Update tanggal terakhir yang ditampilkan
                                                @endphp
                                            @endif
                                        </td>
                                        <td> {{$item->no_rm}}</td>
                                        <td> {{$item->nama_pasien}}</td>
                                        <td> {{$item->umur}}</td>
                                        <td> {{$item->diagnosa}}</td>
                                        <td> {{$item->tindakan_operasi}}</td>
                                        <td> {{$item->dokter_op}}</td>
                                        <td> {{$item->dokter_anest}}</td>
                                        <td> {{$item->jenis_op}}</td>
                                        <td> {{$item->asuransi}}</td>
                                        <td> {{$item->rencana_tindakan}}</td>
                                        <td> {{$item->signin}}</td>
                                        <td> {{$item->time_out}}</td>
                                        <td> {{$item->sign_out}}</td>
                                        <td> {{$item->penandaan_lokasi_op}}</td>
                                        <td> {{$item->kelengkapan_ssc}}</td>
                                        <td> {{$item->penundaan_op_elektif}}</td>
                                        <td> {{$item->sc_emergensi}}</td>
                                        <td> {{$item->keterangan}}</td>
                                        <td> {{$item->kendala}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$oks->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
