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
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col" colspan="2"><center>Resiko Jatuh</center></th>
                                <th scope="col" colspan="3"><center>Upaya Pencegahan Resiko Jatuh</center></th>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalLengkap = 0;
                                $totalTidakLengkap = 0;
                                foreach ($jatuh as $no => $jatuhs) {
                                    $lengkap = 0;
                                    $tidakLengkap = 0;

                                    // Memeriksa kondisi untuk total lengkap
                                    if (
                                        $jatuhs->tinggi == '✔️' &&
                                        $jatuhs->kancing == '✔️' &&
                                        $jatuhs->segitiga == '✔️' &&
                                        $jatuhs->handreal == '✔️'
                                    ) {
                                        $totalLengkap++;
                                    } else {
                                        // Jika tidak lengkap, increment totalTidakLengkap
                                        $totalTidakLengkap++;
                                    }

                                    $totalLengkap += $lengkap;
                                    $totalTidakLengkap += $tidakLengkap;
                                }
                                $persentase = $totalTidakLengkap > 0 ? ($totalLengkap / $totalTidakLengkap) * 100 : 0;
                            @endphp
                            @foreach ($jatuh as $no => $jatuhs)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                <td>{{ $jatuhs->tanggal }}</td>
                                <td>{{ $jatuhs->no_rm }}</td>
                                <td>{{ $jatuhs->nama_px }}</td>
                                <td>{{ $jatuhs->rendah }}</td>
                                <td>{{ $jatuhs->tinggi }}</td>
                                <td>{{ $jatuhs->kancing }}</td>
                                <td>{{ $jatuhs->segitiga }}</td>
                                <td>{{ $jatuhs->handreal }}</td>
                            </tr>
                             @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>Total Lengkap :</strong></center></td>
                                <td colspan="5">
                                    <strong>
                                            <center>{{$totalLengkap}}</center>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>Total Tidak Lengkap :</strong></center></td>
                                <td colspan="5">
                                    <strong>
                                            <center>{{$totalTidakLengkap}}</center>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><center><strong>Persentase :</strong></center></td>
                                <td colspan="5">
                                    <strong>
                                            <center>{{number_format($persentase,2)}}%</center>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
