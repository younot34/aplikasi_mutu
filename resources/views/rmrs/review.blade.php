@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>RM</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Review RM </h4>
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
                                    <th>No</th>
                                    <th>No.RM</th>
                                    <th>Asesment</th>
                                    <th>CPPT</th>
                                    <th>Resep</th>
                                    <th>Resume</th>
                                    <th>Lengkap</th>
                                    <th>Tidak Lengkap</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan diisi di sini -->
                            </tbody>
                        </table>
                    </div>
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
                            fetch(`/rmrs/review/${date}`)
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
                                            <th> ${item.tanggal}</th>
                                            <th> ${item.no}</th>
                                            <th> ${item.no_rm}</th>
                                            <th> ${item.asesmen}</th>
                                            <th> ${item.cppt}</th>
                                            <th> ${item.resep}</th>
                                            <th> ${item.resume}</th>
                                            <th> ${item.lengkap}</th>
                                            <th> ${item.tidak}</th>
                                            <th>
                                                <form action="/rmrs/delete/${item.id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </th>
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
