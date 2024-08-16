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
                    <form action="{{ route('apds.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal"  class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Unit</label>
                            <input type="text" name="unit" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Profesi</label>
                            <input type="text" name="profesi" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tindakan</label>
                            <input type="text" name="tindakan" class="form-control">
                        </div>
                        <div>
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>APD yang Digunakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group col-md-3">
                                                    <label>Topi</label>
                                                    <input type="text" name="topi" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Kacamata/ faceshield</label>
                                                    <input type="text" name="kacamata" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Masker</label>
                                                    <input type="text" name="masker" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Gown</label>
                                                    <input type="text" name="gown" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Sarung Tangan</label>
                                                    <input type="text" name="sarung_tangan" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Sepatu</label>
                                                    <input type="text" name="sepatu" class="form-control" list="data_list">
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
                                            <th>Ketepatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                 <div class="form-group col-md-3">
                                                    <label>Ya</label>
                                                    <input type="text" name="ya" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Tidak</label>
                                                    <input type="text" name="tidak" class="form-control" list="data_list">
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
                        <div class="form-group col-md-3">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control">
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
