@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Farmasi - Kepatuhan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Laporan Double Check </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('imprs.grafik_doublecheck') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="tahun">Pilih Tahun:</label>
                            <input type="number" id="tahun" name="tahun" value="{{ $tahun }}" class="form-control" min="2000" max="{{ date('Y') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('imprs.index') }}" method="GET" class="d-inline-block ml-2">
                        <button type="submit" class="btn btn-success">back</button>
                    </form>

                    <!-- Grafik Tahunan -->
                    <div class="mt-4">
                        <canvas id="imprsChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        var ctx = document.getElementById('imprsChart').getContext('2d');
                        var imprsChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: {!! json_encode($months) !!}, // ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
                                datasets: [
                                    {
                                        label: 'Capaian',
                                        data: {!! json_encode($achievements) !!}, // Data capaian dari hasil akhir
                                        borderColor: 'blue',
                                        fill: false,
                                        cubicInterpolationMode: 'monotone'
                                    },
                                    {
                                        label: 'Target 80%',
                                        data: Array(12).fill(80), // Target 80% untuk semua bulan
                                        borderColor: 'red',
                                        borderDash: [10, 5],
                                        fill: false,
                                        cubicInterpolationMode: 'monotone'
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: 100
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
