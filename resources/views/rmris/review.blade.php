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
                                    <th>No</th>
                                    <th>Tanggal Pulang</th>
                                    <th>No.RM</th>
                                    <th>Nama Formulir</th>
                                    <th>Ada</th>
                                    <th>Tidak Ada</th>
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
                            fetch(`/rmris/review/${date}`)
                                .then(response => {
                                    console.log(response.url); // Debugging: pastikan data diterima di view
                                    return response.json();
                                })
                                .then(data => {
                                    console.log(data); // Debugging: pastikan data diterima di view
                                    const tbody = document.querySelector('table tbody');
                                    tbody.innerHTML = ''; // Kosongkan tabel
                                    data.forEach((item, index) => {
                                        const row = `<tr>
                                            <td>${index + 1}</td>
                                            <td>${item.tanggal}</td>
                                            <td>${item.no_rm}</td>
                                            <td>Resume Medis</td>
                                            <td>${item.resume_ada}</td>
                                            <td>${item.resume_tidakAda}</td>
                                            <td>${item.resume_lengkap}</td>
                                            <td>${item.resume_tidak}</td>
                                            <td>
                                                <form action="/rmris/delete/${item.id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>`;

                                        tbody.innerHTML += row;

                                        // Tambahkan form lain
                                        const forms = ['pengantar', 'cppt', 'general', 'informed'];
                                        forms.forEach(form => {
                                            const formRow = `<tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>${capitalize(form.replace('_', ' '))}</td>
                                                <td>${item[form + '_ada']}</td>
                                                <td>${item[form + '_tidakAda']}</td>
                                                <td>${item[form + '_lengkap']}</td>
                                                <td>${item[form + '_tidak']}</td>
                                                <td></td>
                                            </tr>`;
                                            tbody.innerHTML += formRow;
                                        });

                                        // Tambahkan baris untuk keterangan
                                        const keteranganRow = `<tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="4">Keterangan (Lengkap / Tidak Lengkap)</td>
                                            <td>${item.keterangan_lengkap}</td>
                                            <td></td>
                                        </tr>`;
                                        tbody.innerHTML += keteranganRow;
                                    });
                                })
                                .catch(error => console.error('Error:', error));
                        }

                        function capitalize(string) {
                            return string.charAt(0).toUpperCase() + string.slice(1);
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
