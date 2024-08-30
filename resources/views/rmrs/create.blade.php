@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah RM</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah Kelengkapan Rajal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rmrs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                        <div id="resep-container">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>No</label>
                                    <input type="number" name="no" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>No.RM</label>
                                    <input type="number" name="no_rm" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Asesment</label>
                                    <input type="text" name="asesmen" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>CPPT</label>
                                    <input type="text" name="cppt" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Resep</label>
                                    <input type="text" name="resep" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Resume</label>
                                    <input type="text" name="resume" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Lengkap</label>
                                    <input type="text" name="lengkap" class="form-control" list="data_list_rm">
                                    <datalist id="data_list_rm">
                                        <option value="✔️"></option>
                                    </datalist>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tidak Lengkap</label>
                                    <input type="text" name="tidak" class="form-control" list="data_list_rmt">
                                    <datalist id="data_list_rmt">
                                        <option value="✔️"></option>
                                    </datalist>
                                </div>
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
