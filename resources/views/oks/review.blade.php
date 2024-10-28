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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.RM</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>Umur</th>
                                    <th>Diagnosa</th>
                                    <th>Tindakan Operasi</th>
                                    <th>Dokter OP</th>
                                    <th>Dokter Anest</th>
                                    <th>Jenis OP</th>
                                    <th>Asuransi</th>
                                    <th>Rencana Tindakan</th>
                                    <th>Sign In</th>
                                    <th>Time Out</th>
                                    <th>Sign Out</th>
                                    <th>Penandaan Lokasi OP</th>
                                    <th>Kelengkapan SSC</th>
                                    <th>Penundaan OP Elektif <= 2 jam</th>
                                    <th>Penundaan OP Elektif > 2 jam</th>
                                    <th>SC Emergensi <= 30 menit</th>
                                    <th>SC Emergensi > 30 menit</th>
                                    <th>Keterangan</th>
                                    <th>Kendala</th>
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
                                            <th> ${item.tanggal}</th>
                                            <th> ${item.no_rm}</th>
                                            <th> ${item.nama_pasien}</th>
                                            <th> ${item.umur}</th>
                                            <th> ${item.diagnosa}</th>
                                            <th> ${item.tindakan_operasi}</th>
                                            <th> ${item.dokter_op}</th>
                                            <th> ${item.dokter_anest}</th>
                                            <th> ${item.jenis_op}</th>
                                            <th> ${item.asuransi}</th>
                                            <th> ${item.rencana_tindakan}</th>
                                            <th> ${item.signin}</th>
                                            <th> ${item.time_out}</th>
                                            <th> ${item.sign_out}</th>
                                            <th> ${item.penandaan_lokasi_op}</th>
                                            <th> ${item.kelengkapan_ssc}</th>
                                            <th> ${item.penundaan_op_elektif1}</th>
                                            <th> ${item.penundaan_op_elektif}</th>
                                            <th> ${item.sc_emergensi1}</th>
                                            <th> ${item.sc_emergensi}</th>
                                            <th> ${item.keterangan}</th>
                                            <th> ${item.kendala}</th>
                                            <th>
                                                <form action="/oks/delete/${item.id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
