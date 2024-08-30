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
</div>

@stop
