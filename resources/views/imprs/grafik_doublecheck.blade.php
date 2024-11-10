@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Farmasi - Kepatuhan Double Check High Alert</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-chart-line"></i> Grafik Kepatuhan Double Check High Alert </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('imprs.grafik_doublecheck') }}" method="GET" class="d-inline-block">
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

                    <!-- Grafik Tahunan -->
                    <div class="mt-4">
                        <canvas id="imprsChart" style="height: 400px; width: 100%;"></canvas>
                    </div>

                    <!-- Menampilkan total resep terverifikasi dan high alert per bulan -->
                    <div class="mt-4">
                        <h5>Total Resep per Bulan</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Resep Terverifikasi</th>
                                    <th>Total Resep High Alert</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($months as $index => $bulan)
                                    <tr>
                                        <td>{{ $bulan }}</td>
                                        <td>{{ $totalTerverifikasi[$index] }}</td>
                                        <td>{{ $totalHighAlert[$index] }}</td>
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
    // Fungsi untuk membuat grafik
    function createImprsChart(months, achievements) {
        var ctx = document.getElementById('imprsChart').getContext('2d');
        var imprsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Capaian',
                        data: achievements,
                        borderColor: 'blue',
                        fill: true,
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    },
                    {
                        label: 'Target 80%',
                        data: Array(12).fill(80),
                        borderColor: 'red',
                        borderWidth: 2,
                        fill: false,
                        borderDash: [10, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100
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
    }

    // Menjalankan fungsi setelah konten dimuat
    document.addEventListener('DOMContentLoaded', function () {
        var months = {!! json_encode($months) !!}; // Mengambil data bulan dari backend
        var achievements = {!! json_encode($achievements) !!}; // Mengambil data capaian dari backend
        createImprsChart(months, achievements); // Memanggil fungsi untuk membuat grafik
    });
</script>
@stop
