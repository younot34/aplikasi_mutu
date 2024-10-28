@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Nilai Kritis Lab</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-edit"></i> Edit Nilai Kritis Lab</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('nilai_kritiss.update', $nilai_kritis->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form row">

                            <div class="form-group col-md-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" value="{{ old('tanggal', $nilai_kritis->tanggal) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>No RM</label>
                                <input type="text" name="no_rm" value="{{ old('no_rm', $nilai_kritis->no_rm) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Nama Pasien</label>
                                <input type="text" name="nama_pasien" value="{{ old('nama_pasien', $nilai_kritis->nama_pasien) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Unit Asal</label>
                                <input type="text" name="unit_asal" value="{{ old('unit_asal', $nilai_kritis->unit_asal) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Dokter Pengirim</label>
                                <input type="text" name="dokter_pengirim" value="{{ old('dokter_pengirim', $nilai_kritis->dokter_pengirim) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Jenis Pelayanan</label>
                                <input type="text" name="jenis_pelayanan" value="{{ old('jenis_pelayanan', $nilai_kritis->jenis_pelayanan) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Waktu Sampling</label>
                                <input type="time" name="waktu_sampling" value="{{ old('waktu_sampling', $nilai_kritis->waktu_sampling) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Waktu Selesai</label>
                                <input type="time" name="waktu_selsai" value="{{ old('waktu_selsai', $nilai_kritis->waktu_selsai) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Waktu Diterima</label>
                                <input type="time" name="waktu_diterima" value="{{ old('waktu_diterima', $nilai_kritis->waktu_diterima) }}" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label>Selisih Waktu</label>
                                <input type="text" id="selisih_waktu" name="selisih_waktu" value="{{ old('selisih_waktu', $nilai_kritis->selisih_waktu) }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Hasil Pemeriksaan Nilai Kritis</label>
                                <textarea name="hasil_pemeriksaan_nilai_kritis" class="form-control" rows="4">{{ old('hasil_pemeriksaan_nilai_kritis') ?? $nilai_kritis->hasil_pemeriksaan_nilai_kritis }}</textarea>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Pemberi Informasi</label>
                                <input type="text" name="pemberi_informasi" value="{{ old('pemberi_informasi', $nilai_kritis->pemberi_informasi) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Penerima Informasi</label>
                                <input type="text" name="penerima_informasi" value="{{ old('penerima_informasi', $nilai_kritis->penerima_informasi) }}" class="form-control">
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen input
        const waktuSelesaiInput = document.querySelector('input[name="waktu_selsai"]');
        const waktuDiterimaInput = document.querySelector('input[name="waktu_diterima"]');
        const selisihWaktuInput = document.getElementById('selisih_waktu');

        // Fungsi untuk menghitung selisih waktu dalam menit
        function hitungSelisihWaktu() {
            const waktuSelesai = waktuSelesaiInput.value;
            const waktuDiterima = waktuDiterimaInput.value;

            if (waktuSelesai && waktuDiterima) {
                const waktuSelesaiDate = new Date(`1970-01-01T${waktuSelesai}:00`);
                const waktuDiterimaDate = new Date(`1970-01-01T${waktuDiterima}:00`);

                // Hitung selisih waktu dalam menit
                const selisihWaktu = (waktuDiterimaDate - waktuSelesaiDate) / 1000 / 60;

                // Tampilkan hasil pada input "Selisih Waktu"
                selisihWaktuInput.value = selisihWaktu;
            }
        }

        // Event listener ketika waktu selesai atau waktu diterima diubah
        waktuSelesaiInput.addEventListener('change', hitungSelisihWaktu);
        waktuDiterimaInput.addEventListener('change', hitungSelisihWaktu);
    });
    </script>
@stop
