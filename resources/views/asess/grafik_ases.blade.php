@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Rawat Jalan - Kepatuhan Assessment</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-chart-line"></i> Grafik Kepatuhan Assessment </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('asess.grafik_ases') }}" method="GET" class="d-inline-block">
                        <div class="form-group">
                            <label for="tahun">Pilih Tahun:</label>
                            <input type="number" id="tahun" name="tahun" value="{{ $tahun }}" class="form-control" min="2000" max="{{ date('Y') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                    <form action="{{ route('your.navigate.route') }}" method="POST" class="d-inline-block ml-2">
                        @csrf
                        <button type="submit" class="btn btn-success" name="back"
                            {{ session('current_page_index', 0) == 0 ? 'disabled' : '' }}>
                            Back
                        </button>
                    </form>

                    <form action="{{ route('your.navigate.route') }}" method="POST" class="d-inline-block ml-2">
                        @csrf
                        @php
                            // Ambil array pages dari Controller atau session
                            $pages = session('pages', []); // Pastikan $pages terdefinisi sebagai array
                        @endphp
                        <button type="submit" class="btn btn-success" name="next"
                            {{ session('current_page_index', 0) == count($pages) - 1 ? 'disabled' : '' }}>
                            Next
                        </button>
                    </form>

                    <canvas id="assessmentChart" class="mt-4" style="height: 400px; width: 100%;"></canvas>

                    <!-- Menampilkan total patuh dan tidak patuh per bulan -->
                    <div class="mt-4">
                        <h5>Total Kepatuhan dan Tidak Patuh per Bulan</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Assessment Pasien</th>
                                    <th>Total Assessment Patuh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chartData['labels'] as $index => $bulan)
                                    <tr>
                                        <td>{{ $bulan }}</td>
                                        <td>{{ $chartData['totalPatuh'][$index] }}</td>
                                        <td>{{ $chartData['totalTidakPatuh'][$index] }}</td>
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
    var ctx = document.getElementById('assessmentChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line', // Tipe grafik garis
        data: {
            labels: @json($chartData['labels']), // Nama bulan
            datasets: [{
                label: 'Kepatuhan Bulanan (%)',
                data: @json($chartData['capaian']),
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4 // Membuat grafik garis gelombang
            }, {
                label: 'Target 80%',
                data: @json($chartData['target']),
                borderColor: 'red',
                borderWidth: 2,
                fill: false,
                borderDash: [10, 5] // Garis putus-putus untuk target
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
@endsection
