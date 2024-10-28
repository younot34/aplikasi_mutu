@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Review Bulanan RM RI</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review Bulanan RM RI</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rmris.review_bulanan_rmi') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('rmris.review_bulanan_rmi.export') }}" method="GET" class="d-inline-block ml-2">
                        <div class="form-group">
                            <input type="hidden" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                    <div class="table-responsive">
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Berkas</th>
                                    <th>Lengkap</th>
                                    <th>Tidak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                $totalJumlahBerkas = 0;
                                $totalLengkap = 0;
                                $totalTidak = 0;
                                @endphp

                                @foreach ($reportData as $date => $data)
                                @php
                                    // Hitung jumlah lengkap dan tidak untuk tanggal ini
                                    $jumlahLengkap = 0;
                                    $jumlahTidak = 0;

                                    foreach ($data as $item) {
                                        // Menghitung jumlah lengkap
                                        $jumlahLengkap += (
                                            ($item->keterangan_lengkap === '✔️' ? 1 : 0)
                                        );

                                        // Menghitung jumlah tidak
                                        $jumlahTidak += (
                                            ($item->keterangan_lengkap === '❌' ? 1 : 0)
                                        );
                                    }

                                    // Jumlah berkas dihitung sebagai jumlah lengkap + jumlah tidak
                                    $jumlahBerkas = $jumlahLengkap + $jumlahTidak;

                                    // Tambahkan ke total
                                    $totalJumlahBerkas += $jumlahBerkas;
                                    $totalLengkap += $jumlahLengkap;
                                    $totalTidak += $jumlahTidak;
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $date }}</td>
                                    <td>{{ $jumlahBerkas }}</td>
                                    <td>{{ $jumlahLengkap }}</td>
                                    <td>{{ $jumlahTidak }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th>{{ $totalJumlahBerkas }}</th>
                                    <th>{{ $totalLengkap }}</th>
                                    <th>{{ $totalTidak }}</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right"><center><strong>Persentase</strong></center></td>
                                    <td colspan="5">
                                        <strong>
                                            <center>
                                                @if ($totalLengkap > 0)
                                                    {{ round(($totalLengkap / $totalJumlahBerkas) * 100, 2) }}%
                                                @else
                                                    0%
                                                @endif
                                            </center>
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
