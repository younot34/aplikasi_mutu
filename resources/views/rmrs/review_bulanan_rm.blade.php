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
                                    <th>Tanggal</th>
                                    <th>No</th>
                                    <th>No.RM</th>
                                    <th>Asesment</th>
                                    <th>CPPT</th>
                                    <th>Resep</th>
                                    <th>Resume</th>
                                    <th>Lengkap</th>
                                    <th>Tidak Lengkap</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $lastDate = null; // Variabel untuk menyimpan tanggal terakhir yang ditampilkan
                                @endphp

                                @foreach ($rmr as $item)
                                    <tr>
                                        <td>
                                            @if ($item->tanggal != $lastDate)
                                                {{ $item->tanggal }}
                                                @php
                                                    $lastDate = $item->tanggal; // Update tanggal terakhir yang ditampilkan
                                                @endphp
                                            @endif
                                        </td>
                                        <td>{{ $item->no }}</td>
                                        <td>{{ $item->no_rm }}</td>
                                        <td>{{ $item->asesmen }}</td>
                                        <td>{{ $item->cppt }}</td>
                                        <td>{{ $item->resep }}</td>
                                        <td>{{ $item->resume }}</td>
                                        <td>{{ $item->lengkap }}</td>
                                        <td>{{ $item->tidak }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
