@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah oks</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah oks Penundaan OP Elektif</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('oks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                        <div id="resep-container">
                            <div class="form-group">
                                <label>Waktu Masuk</label>
                                <input type="datetime-local" name="waktu_masuk" id="waktu_masuk" class="form-control @error('waktu_masuk') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label>Waktu Pelaksanaan</label>
                                <input type="datetime-local" name="waktu_pelaksanaan" id="waktu_pelaksanaan" class="form-control @error('waktu_pelaksanaan') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label>Waktu Pending</label>
                                <input type="text" name="waktu_pending" id="waktu_pending" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Alasan</label>
                                <input type="text" name="alasan" class="form-control" placeholder="Alasan (Optional)">
                            </div>
                            <div id="obat-container">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Nama Pasien</label>
                                        <input type="text" name="nama_pasien" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>No RM</label>
                                        <input type="text" name="no_rm" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Diagnosa</label>
                                        <input type="text" name="diagnosa" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Nama Dokter</label>
                                        <input type="text" name="nama_dokter" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                </div>
                        <script>
                            const waktuMasukInput = document.querySelector('#waktu_masuk');
                            const waktuPelaksanaanInput = document.querySelector('#waktu_pelaksanaan');
                            const waktuPendingInput = document.querySelector('#waktu_pending');

                            // Tambahkan event listener untuk menghitung selisih waktu
                            waktuMasukInput.addEventListener('change', hitungSelisihWaktu);
                            waktuPelaksanaanInput.addEventListener('change', hitungSelisihWaktu);

                            function hitungSelisihWaktu() {
                                const waktuMasuk = new Date(waktuMasukInput.value);
                                const waktuPelaksanaan = new Date(waktuPelaksanaanInput.value);

                                // Hitung selisih waktu dalam milidetik
                                const selisihWaktu = waktuPelaksanaan - waktuMasuk;

                                // Konversi selisih waktu ke menit dan jam
                                const selisihMenit = Math.floor(selisihWaktu / (1000 * 60));
                                const selisihJam = Math.floor(selisihMenit / 60);

                                // Isi nilai selisih waktu ke dalam input "Waktu Pending"
                                waktuPendingInput.value = `${selisihJam} jam ${selisihMenit % 60} menit`;
                            }
                        </script>
                <script src="{{ asset('js/resep.js') }}"></script>
            </div>
        </div>
    </section>
</div>

@stop
