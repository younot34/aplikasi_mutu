@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>LABORATORIUM</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i>Laporan Bulanan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('nilai_kritiss.export_lab') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">No.RM</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Unit Asal</th>
                                <th scope="col">Dokter Pengirim</th>
                                <th scope="col">Jenis Pelayanan</th>
                                <th scope="col">Waktu Sampling</th>
                                <th scope="col">Waktu Selsai Pemeriksaan</th>
                                <th scope="col">Waktu Hasil Diterima Dokter/Perawat</th>
                                <th scope="col">Waktu Selisih (menit)</th>
                                <th scope="col">Hasil Pemeriksaan Nilai Kritis</th>
                                <th scope="col">Pemberi Informasi</th>
                                <th scope="col">Penerima Informasi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_kritis as $no => $nilai_kriti)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                    <td>{{ $nilai_kriti->tanggal }}</td>
                                    <td>{{ $nilai_kriti->no_rm }}</td>
                                    <td>{{ $nilai_kriti->nama_pasien }}</td>
                                    <td>{{ $nilai_kriti->unit_asal }}</td>
                                    <td>{{ $nilai_kriti->dokter_pengirim }}</td>
                                    <td>{{ $nilai_kriti->jenis_pelayanan }}</td>
                                    <td>{{ $nilai_kriti->waktu_sampling }}</td>
                                    <td>{{ $nilai_kriti->waktu_selsai }}</td>
                                    <td>{{ $nilai_kriti->waktu_diterima }}</td>
                                    <td>
                                        @php
                                            $waktuSelesai = \Carbon\Carbon::parse($nilai_kriti->waktu_selsai);
                                            $waktuDiterima = \Carbon\Carbon::parse($nilai_kriti->waktu_diterima);
                                            $selisih = $waktuSelesai->diffInMinutes($waktuDiterima);
                                        @endphp
                                        {{ $selisih }} menit
                                    </td>
                                    <td>{!! nl2br(e($nilai_kriti->hasil_pemeriksaan_nilai_kritis)) !!}</td>
                                    <td>{{ $nilai_kriti->pemberi_informasi }}</td>
                                    <td>{{ $nilai_kriti->penerima_informasi }}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="10" class="text-right"><center><strong>Jumlah Selisih Waktu <= 30 menit</strong></center></td>
                                    <td colspan="4" class="text-right">
                                        @php
                                            $dataKurangDari30 = $nilai_kritis->filter(function ($item) {
                                                $waktuSelesai = \Carbon\Carbon::parse($item->waktu_selsai);
                                                $waktuDiterima = \Carbon\Carbon::parse($item->waktu_diterima);
                                                $selisih = $waktuSelesai->diffInMinutes($waktuDiterima);
                                                return $selisih <= 30;
                                            })->count();
                                        @endphp
                                        <center><strong>{{ $dataKurangDari30 }}</strong></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10" class="text-right"><center><strong>Jumlah data</strong></center></td>
                                    <td colspan="4" class="text-right">
                                        @php
                                            $totalData = $nilai_kritis->count();
                                        @endphp
                                        <center><strong>{{ $totalData }}</strong></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10" class="text-right"><center><strong>Persentase</strong></center></td>
                                    <td colspan="4" class="text-right">
                                        @php
                                            $persentaseKurangDari30 = $totalData > 0 ? ($dataKurangDari30 / $totalData) * 100 : 0;
                                        @endphp
                                        <center><strong>{{ number_format($persentaseKurangDari30, 2) }}%</strong></center>
                                    </td>
                                </tr>
                            </tbody>
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
