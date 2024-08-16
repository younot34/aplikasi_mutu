@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>OK</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review OK </h4>
                </div>
                <div class="card-body">
                    <div class="date-buttons">
                        @foreach ($tanggal as $date)
                            <button class="btn btn-primary date-btn" data-date="{{ $date->format('Y-m-d') }}">
                                {{ $date->format('d/m/Y') }}
                            </button>
                        @endforeach
                    </div>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>nama_pasien</th>
                                <th>no_rm</th>
                                <th>diagnosa</th>
                                <th>nama_dokter</th>
                                <th>tanggal</th>
                                <th>waktu_pelaksanaan</th>
                                <th>waktu_pending</th>
                                <th>alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan diisi di sini -->
                        </tbody>
                    </table>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const buttons = document.querySelectorAll('.date-btn');
                            if (buttons.length === 0) {
                                console.error('No date buttons found');
                            } else {
                                // Ambil tanggal dari tombol pertama sebagai default
                                const defaultDate = buttons[0].getAttribute('data-date');
                                loadData(defaultDate);

                                buttons.forEach(button => {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault(); // Mencegah halaman reload
                                        const date = this.getAttribute('data-date');
                                        loadData(date);
                                    });
                                });
                            }
                        });

                        function loadData(date) {
                            console.log('Tanggal yang dikirim:', date); // Debugging: pastikan tanggal yang dikirim benar
                            fetch(`/oks/review/${date}`)
                                .then(response => {
                                    console.log(response.url); // Debugging: pastikan data diterima di view
                                    return response.json();
                                })
                                .then(data => {
                                    console.log(data); // Debugging: pastikan data diterima di view
                                    const tbody = document.querySelector('table tbody');
                                    tbody.innerHTML = ''; // Kosongkan tabel
                                    data.forEach(item => {
                                        const row = `<tr>
                                            <td>${item.nama_pasien}</td>
                                            <td>${item.no_rm}</td>
                                            <td>${item.diagnosa}</td>
                                            <td>${item.nama_dokter}</td>
                                            <td>${item.tanggal}</td>
                                            <td>${item.waktu_pelaksanaan}</td>
                                            <td>${item.waktu_pending}</td>
                                            <td>${item.alasan}</td>
                                        </tr>`;
                                        tbody.innerHTML += row;
                                    });
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    </script>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateButtons = document.querySelectorAll('.date-btn');
        dateButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const date = this.getAttribute('data-date');
                window.location.href = `?tanggal=${date}`;
            });
        });
    });
</script>
@stop
