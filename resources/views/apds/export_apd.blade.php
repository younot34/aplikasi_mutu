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
                            <input type="month" id="bulan" name="bulan" value="{{ request('bulan', $bulan) }}" class="form-control">
                        </div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->unit === 'PPI')
                            <div class="form-group">
                                <label for="unit">Pilih Unit:</label>
                                <!-- Dropdown to select unit -->
                                <select name="unit" class="form-control" onchange="this.form.submit()">
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
                    <div class="table-responsive">
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
                            @foreach ($apd as $apds)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
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

                                            $totalKeseluruhan = $totalYa + $totalTidak;
                                        @endphp
                                        <center>{{ $totalYa }}</center>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-right"><center><strong>Persentase Ya</strong></center></td>
                                <td colspan="3">
                                    <strong>
                                        @if($totalKeseluruhan > 0)
                                            <center>{{ round(($totalYa / $totalKeseluruhan) * 100, 2) }}%</center>
                                        @else
                                            <center>0%</center>
                                        @endif
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
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