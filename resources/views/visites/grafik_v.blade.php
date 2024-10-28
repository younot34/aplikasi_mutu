@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>RAWAT INAP - Kepatuhan Jam Visite Dokter</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-chart-line"></i> Grafik Kepatuhan Jam Visite Dokter</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('visites.grafik_v') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="tahun">Pilih Tahun:</label>
                            <input type="number" id="tahun" name="tahun" value="{{ $tahun }}" class="form-control" min="2000" max="{{ date('Y') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('your.navigatee.route') }}" method="POST" class="d-inline-block ml-2">
                        @csrf
                        <button type="submit" class="btn btn-success" name="back"
                            {{ session('current_page_index', 0) == 0 ? 'disabled' : '' }}>
                            Back
                        </button>
                    </form>

                    <form action="{{ route('your.navigatee.route') }}" method="POST" class="d-inline-block ml-2">
                        @csrf
                        @php
                            $pages = session('pages', []);
                        @endphp
                        <button type="submit" class="btn btn-success" name="next"
                            {{ session('current_page_index', 0) == count($pages) - 1 ? 'disabled' : '' }}>
                            Next
                        </button>
                    </form>

                    <canvas id="visiteChart" class="mt-4" style="height: 400px; width: 100%;"></canvas>

                    <div class="mt-4">
                        <h5>Detail Visite per Bulan</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Jam < 14.00</th>
                                    <th>Total Jam > 14.00</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPerBulan as $bulan => $data)
                                    <tr>
                                        <td>{{ $bulan }}</td>
                                        <td>{{ $data['total_jam_kurang_14'] }}</td>
                                        <td>{{ $data['total_jam_lebih_14'] }}</td>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('visiteChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Persentase Jam < 14.00 (%)',
                data: @json($chartData['persentase_kurang_14']),
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }, {
                label: 'Target 80%',
                data: @json($chartData['target']),
                borderColor: 'red',
                borderWidth: 2,
                fill: false,
                borderDash: [10, 5]
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw.toFixed(2) + '%';
                        }
                    }
                }
            }
        }
    });
</script>
@stop
