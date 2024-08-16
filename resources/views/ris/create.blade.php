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
                            <input type="number" name="no_rm" class="form-control" placeholder="no rm">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama PX</label>
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
                                            <input type="text" name="benar_namao[]" class="form-control">
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamato[]" class="form-control">
                                        </td>
                                        <td>
                                            <label>benar nama</label>
                                            <input type="text" name="benar_namad[]" class="form-control">
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamatd[]" class="form-control">
                                        </td>
                                        <td>
                                            <label>benar nama</label>
                                            <input type="text" name="benar_namas[]" class="form-control">
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamats[]" class="form-control">
                                        </td>
                                        <td>
                                            <label>benar nama</label>
                                            <input type="text" name="benar_namat[]" class="form-control">
                                            <label>benar alamat</label>
                                            <input type="text" name="benar_alamatt[]" class="form-control">
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
</div>

@stop
