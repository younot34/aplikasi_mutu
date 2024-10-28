@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Radio</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah Radio</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('radios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>No.RO</label>
                                <input type="text" name="no_ro" class="form-control" pattern="\d*">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Nama Pasien</label>
                                <input type="text" name="nama_pasien" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>No.RM</label>
                                <input type="text" name="no_rm" class="form-control" pattern="\d*">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Ruangan</label>
                                <input type="text" name="ruangan" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Umur</label>
                                <input type="number" name="umur" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Jenis Pembayaran</label>
                                <input type="text" name="jenis_pembayaran" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Dokter Pengirim</label>
                                <input type="text" name="dokter_pengirim" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Jenis Pemeriksaan</label>
                                <input type="text" name="jenis_pemeriksaan" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Petugas</label>
                                <input type="text" name="petugas" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>KV/MAs</label>
                                <input type="text" name="kvmas" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Mulai</label>
                                <input type="time" name="mulai" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Selesai</label>
                                <input type="time" name="selesai" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tarif</label>
                                <input type="text" name="tarif" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control">
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> SIMPAN
                        </button>
                        <button class="btn btn-warning btn-reset" type="reset">
                            <i class="fa fa-redo"></i> RESET
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
