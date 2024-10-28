@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Rawat Inap</h1>
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
                    <div class="table-responsive">
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
                                    <th style="width: 15%;text-align: center"> Benar Nama</th>
                                    <th style="width: 15%;text-align: center">Benar Alamat</th>
                                    <th style="width: 15%;text-align: center"> Benar Nama</th>
                                    <th style="width: 15%;text-align: center">Benar Alamat</th>
                                    <th style="width: 15%;text-align: center"> Benar Nama</th>
                                    <th style="width: 15%;text-align: center">Benar Alamat</th>
                                    <th style="width: 15%;text-align: center"> Benar Nama</th>
                                    <th style="width: 15%;text-align: center">Benar Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Inisialisasi total patuh dan peluang
                                    $totalPatuh = 0;
                                    $totalPeluang = 0;

                                    foreach ($ri as $no => $ris) {
                                        $patuh = 0;
                                        $peluang = 0;

                                        foreach (['pobats', 'pdarahs', 'psamples', 'ptindakans'] as $type) {
                                            foreach ($ris->$type as $item) {
                                                // Perhitungan patuh
                                                if (
                                                    ($type == 'pobats' && $item->benar_namao == '✔️' && $item->benar_alamato == '✔️') ||
                                                    ($type == 'pdarahs' && $item->benar_namad == '✔️' && $item->benar_alamatd == '✔️') ||
                                                    ($type == 'psamples' && $item->benar_namas == '✔️' && $item->benar_alamats == '✔️') ||
                                                    ($type == 'ptindakans' && $item->benar_namat == '✔️' && $item->benar_alamatt == '✔️')
                                                ) {
                                                    $patuh++;
                                                }

                                                // Perhitungan peluang
                                                if (
                                                    ($type == 'pobats' && ($item->benar_namao == '✔️' || $item->benar_alamato == '✔️')) ||
                                                    ($type == 'pdarahs' && ($item->benar_namad == '✔️' || $item->benar_alamatd == '✔️')) ||
                                                    ($type == 'psamples' && ($item->benar_namas == '✔️' || $item->benar_alamats == '✔️')) ||
                                                    ($type == 'ptindakans' && ($item->benar_namat == '✔️' || $item->benar_alamatt == '✔️'))
                                                ) {
                                                    $peluang++;
                                                }
                                            }
                                        }

                                        // Akumulasi total patuh dan peluang
                                        $totalPatuh += $patuh > 0 ? 1 : 0; // Hitung sebagai 1 jika ada patuh
                                        $totalPeluang += $peluang > 0 ? 1 : 0; // Hitung sebagai 1 jika ada peluang
                                    }

                                    // Hitung persentase
                                    $persentaseKepatuhan = $totalPeluang > 0 ? ($totalPatuh / $totalPeluang) * 100 : 0;
                                ?>
                                @foreach ($ri as $no => $ris)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
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
                                <tr>
                                    <td colspan="14" style="text-align: right;">
                                        <center><strong>Persentase Kepatuhan: {{ number_format($persentaseKepatuhan, 2) }}%</strong></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="14" style="text-align: right;">
                                        <center><strong>Total patuh: {{ $totalPatuh }}</strong></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="14" style="text-align: right;">
                                        <center><strong>Total Peluang: {{ $totalPeluang }}</strong></center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
