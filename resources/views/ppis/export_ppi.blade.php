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
                    <!-- Form gabungan untuk memilih bulan dan unit -->
                    <form action="{{ route('ppis.export_ppi') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" id="bulan" name="bulan" value="{{ request('bulan', $bulan) }}" class="form-control">
                        </div>

                        @if(auth()->user()->hasRole('admin') || auth()->user()->unit === 'PPI')
                            <div class="form-group">
                                <label for="unit">Pilih Unit:</label>
                                <select name="unit" id="unit" class="form-control" onchange="this.form.submit()">
                                    <option value="">Pilih Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->unit }}" {{ request('unit') == $unit->unit ? 'selected' : '' }}>
                                            {{ $unit->unit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>

                    <!-- Tabel untuk menampilkan data -->
                    <div class="table-responsive">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Unit</th>
                                    <th>Tanggal</th>
                                    <th>Observer</th>
                                    <th>Profesi</th>
                                    <th>Jumlah Patuh</th>
                                    <th>Opp</th>
                                    <th>Indikasi</th>
                                    <th>Cuci Tangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalJumlahPatuh = 0;
                                    $totalCuciTangan = 0;
                                    $totalDataOpp = 0;  // Penghitung jumlah data opp
                                @endphp
                                @foreach ($ppis as $no => $ppiss)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $ppiss->unit }}</td>
                                        <td>{{ $ppiss->tanggal }}</td>
                                        <td>{{ $ppiss->observer }}</td>
                                        <td>
                                            @foreach ($ppiss->profesis as $profesi)
                                                <div>{{ $profesi->profesi }}</div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($ppiss->profesis as $profesi)
                                                <div>{{ $profesi->jumlah }}</div>
                                                @php
                                                    $totalJumlahPatuh += $profesi->jumlah; // Total jumlah patuh
                                                @endphp
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($ppiss->indikasis as $indikasiss)
                                                <div>{{ $indikasiss->opp }}</div>
                                                @php
                                                    $totalDataOpp++; // Menghitung total data opp
                                                @endphp
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($ppiss->indikasis as $indikasiss)
                                                <div>{{ $indikasiss->indikasi }}</div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($ppiss->indikasis as $indikasiss)
                                                <div>{{ $indikasiss->cuci_tangan }}</div>
                                                @php
                                                    $totalCuciTangan++; // Menghitung total data cuci tangan
                                                @endphp
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: right"><strong>Total:</strong></td>
                                    <td><strong>patuh : {{ $totalJumlahPatuh }}</strong></td>
                                    <td><strong>tidak patuh : {{ $totalDataOpp - $totalJumlahPatuh }}</strong></td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right"><strong>Persentase Patuh (%):</strong></td>
                                    <td colspan="4">
                                        <strong>
                                            @if($totalCuciTangan > 0)
                                                {{ round(($totalJumlahPatuh / $totalCuciTangan) * 100, 2) }}%
                                            @else
                                                0%
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right"><strong>Total Data Opp:</strong></td>
                                    <td colspan="4"><strong>{{ $totalDataOpp }}</strong></td> <!-- Total data opp ditampilkan -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div style="text-align: center">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
