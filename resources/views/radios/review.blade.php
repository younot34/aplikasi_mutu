@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Radiologi</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review Radiologi </h4>
                </div>
                <div class="card-body">
                    <div class="date-buttons">
                        @foreach ($tanggal as $date)
                            <button class="btn btn-primary date-btn" data-date="{{ $date->format('Y-m-d') }}">
                                {{ $date->format('d/m/Y') }}
                            </button>
                        @endforeach
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No.RO</th>
                                    <th>Nama Pasien</th>
                                    <th>No.RM</th>
                                    <th>Umur</th>
                                    <th>Diagnosa</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Dokter Pengirim</th>
                                    <th>Petugas</th>
                                    <th>Kv/MAs</th>
                                    <th>Jumlah Foto</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Tarif</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const buttons = document.querySelectorAll('.date-btn');
                            if (buttons.length === 0) {
                                console.error('No date buttons found');
                            } else {
                                // Get the date from the first button as the default
                                const defaultDate = buttons[0].getAttribute('data-date');
                                loadData(defaultDate);

                                buttons.forEach(button => {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault(); // Prevent page reload
                                        const date = this.getAttribute('data-date');
                                        loadData(date);
                                    });
                                });
                            }
                        });

                        function loadData(date) {
                            console.log('Sending date:', date); // Debugging: ensure the date sent is correct
                            fetch(`/radios/review/${date}`)
                                .then(response => {
                                    console.log(response.url); // Debugging: ensure data is received in the view
                                    return response.json();
                                })
                                .then(data => {
                                    console.log(data); // Debugging: ensure data is received in the view
                                    const tbody = document.querySelector('table tbody');
                                    tbody.innerHTML = ''; // Clear the table
                                    data.forEach(item => {
                                        const row = `<tr>
                                            <td>${item.tanggal}</td>
                                            <td>${item.no_ro}</td>
                                            <td>${item.nama_pasien}</td>
                                            <td>${item.no_rm}</td>
                                            <td>${item.umur}</td>
                                            <td>${item.diagnosa}</td>
                                            <td>${item.jenis_pemeriksaan}</td>
                                            <td>${item.dokter_pengirim}</td>
                                            <td>${item.petugas}</td>
                                            <td>${item.kvmas}</td>
                                            <td>${item.jumlah_foto}</td>
                                            <td>${item.mulai}</td>
                                            <td>${item.selesai}</td>
                                            <td>${item.tarif}</td>
                                            <td>${item.keterangan}</td>
                                            <td>
                                                <form action="/radios/delete/${item.id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
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
@stop
