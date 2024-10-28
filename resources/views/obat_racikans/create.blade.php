@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Obat Racikan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('obat_racikans.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror">
                            @error('nama_pasien')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>Resep Masuk</label>
                            <input type="time" id="resep_masuk" name="resep_masuk" class="form-control @error('resep_masuk') is-invalid @enderror" onchange="calculateWaktuPelayanan()">
                            @error('resep_masuk')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>Resep Diserahkan</label>
                            <input type="time" id="resep_diserahkan" name="resep_diserahkan" class="form-control @error('resep_diserahkan') is-invalid @enderror" onchange="calculateWaktuPelayanan()">
                            @error('resep_diserahkan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>Waktu Pelayanan (Menit)</label>
                            <input type="text" id="waktu_pelayanan" name="waktu_pelayanan" class="form-control @error('waktu_pelayanan') is-invalid @enderror" readonly>
                            @error('waktu_pelayanan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                </div>

                <script>
                    function calculateWaktuPelayanan() {
                        const resepMasuk = document.getElementById('resep_masuk').value;
                        const resepDiserahkan = document.getElementById('resep_diserahkan').value;

                        if (resepMasuk && resepDiserahkan) {
                            // Convert time to Date objects
                            const timeMasuk = new Date('1970-01-01T' + resepMasuk + 'Z');
                            const timeDiserahkan = new Date('1970-01-01T' + resepDiserahkan + 'Z');

                            // Calculate the difference in milliseconds
                            const diff = timeDiserahkan - timeMasuk;

                            // Convert milliseconds to minutes
                            const minutes = Math.floor(diff / 1000 / 60);

                            // Set the waktu_pelayanan field with the calculated minutes
                            if (minutes >= 0) {
                                document.getElementById('waktu_pelayanan').value = minutes;
                            } else {
                                document.getElementById('waktu_pelayanan').value = 'Invalid Time';
                            }
                        }
                    }
                </script>
            </div>
        </div>
    </section>
</div>
@stop
