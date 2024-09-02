@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Review Bulanan RM</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review bulanan RM </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rmrs.review_bulanan_rm') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('rmrs.review_bulanan_rm.export') }}" method="GET" class="d-inline-block ml-2">
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
                                $lastDate = null; // Variabel untuk menyimpan tanggal terakhir yang ditampilkan
                                $no = 1;
                                $totalJumlahBerkas = 0;
                                $totalLengkap = 0;
                                $totalTidak = 0;
                                @endphp

                                @foreach ($rmr as $date => $data)
                                @php
                                    // Hitung jumlah lengkap dan tidak untuk tanggal ini
                                    $jumlahLengkap = 0;
                                    $jumlahTidak = 0;

                                    foreach ($data as $item) {
                                        // Menghitung jumlah lengkap
                                        $jumlahLengkap += (
                                            ($item->lengkap === '✔️' ? 1 : 0)
                                        );

                                        // Menghitung jumlah tidak
                                        $jumlahTidak += (
                                            ($item->tidak === '✔️' ? 1 : 0)
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
                                        <td>{{ $item->no++ }}</td>
                                        <td>
                                            @if ($item->tanggal != $lastDate)
                                                {{ $item->tanggal }}
                                                @php
                                                    $lastDate = $item->tanggal; // Update tanggal terakhir yang ditampilkan
                                                @endphp
                                            @endif
                                        </td>
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
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
