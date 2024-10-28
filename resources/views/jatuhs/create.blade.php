@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jatuhs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label>Cari Pasien</label>
                            <div class="input-group">
                                <input type="text" id="nama_pasien_search" class="form-control" placeholder="Cari Nama Pasien" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCariPasien">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal"  class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="text" name="no_rm" class="form-control" placeholder="no rm" pattern="\d*">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_px" class="form-control" placeholder="nama pasien">
                        </div>
                        <div>
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Resiko Jatuh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group col-md-3">
                                                    <label>Rendah</label>
                                                    <input type="text" name="rendah" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Tinggi</label>
                                                    <input type="text" name="tinggi" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Upaya Pencegahan Resiko Jatuh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                 <div class="form-group col-md-3">
                                                    <label>Kancing Kuning</label>
                                                    <input type="text" name="kancing" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Segitiga Resiko Jatuh</label>
                                                    <input type="text" name="segitiga" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Pemasangan Handreal</label>
                                                    <input type="text" name="handreal" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Cari Pasien -->
    <div class="modal fade" id="modalCariPasien" tabindex="-1" role="dialog" aria-labelledby="modalCariPasienLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCariPasienLabel">Cari Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="search_pasien" class="form-control mb-3" placeholder="Masukkan Nama Pasien...">
                    <div id="result_pencarian_pasien">
                        <!-- Hasil pencarian akan ditampilkan di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Event ketika input di modal berubah
            $('#search_pasien').on('keyup', function() {
                let search = $(this).val();
                if (search.length > 0) {
                    $.ajax({
                        url: "{{ route('search.pasien') }}",
                        type: 'GET',
                        data: { search: search },
                        success: function(data) {
                            let html = '<ul class="list-group">';
                            let seen = {}; // Objek untuk menyimpan pasien yang sudah ditampilkan

                            data.forEach(function(pasien) {
                                let key = `${pasien.no_rm}-${pasien.nama_pasien}`;

                                // Hanya tambahkan ke daftar jika pasien belum ada di objek 'seen'
                                if (!seen[key]) {
                                    seen[key] = true; // Tandai pasien ini sebagai sudah dilihat

                                    html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>${pasien.nama_pasien} - ${pasien.no_rm}</span>
                                        <button type="button" class="btn btn-primary pilih-pasien"
                                            data-no_rm="${pasien.no_rm}"
                                            data-nama_px="${pasien.nama_pasien}">
                                            Pilih
                                        </button>
                                    </li>`;
                                }
                            });

                            html += '</ul>';
                            $('#result_pencarian_pasien').html(html);
                        }
                    });
                }
            });

            // Event ketika tombol "Pilih" diklik
            $(document).on('click', '.pilih-pasien', function() {
                let no_rm = $(this).data('no_rm');
                let nama_pasien = $(this).data('nama_px');

                // Isi input form
                $('input[name="no_rm"]').val(no_rm);
                $('input[name="nama_px"]').val(nama_pasien);

                // Tutup modal
                $('#modalCariPasien').modal('hide');
            });
        });
    </script>
</div>

@stop
