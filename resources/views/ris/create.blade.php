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
                    <form action="{{ route('ris.store') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('start') is-invalid @enderror">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sift</label>
                            <input type="text" name="sift" class="form-control" placeholder="sift" list="data_list">
                            <datalist id="data_list">
                                <option value="pagi"></option>
                                <option value="Siang"></option>
                                <option value="Malam"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="text" name="no_rm" class="form-control" placeholder="no rm" pattern="\d*">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_px" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="alamat">
                        </div>
                        <div id="ri-container">
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemberian Obat</th>
                                            <th>Pemberian Darah</th>
                                            <th>Pengambilan Sample</th>
                                            <th>Pemberian Tindakan</th>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <label>benar nama</label>
                                            <input type="text" name="benar_namao[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamato[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <label>benar nama</label>
                                            <input type="text" name="benar_namad[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamatd[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <label>benar nama</label>
                                            <input type="text" name="benar_namas[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamats[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <label>benar nama</label>
                                            <input type="text" name="benar_namat[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamatt[]" class="form-control" list="data_list_benar">
                                            <datalist id="data_list_benar">
                                                <option value="✔️"></option>
                                            </datalist>
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
