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
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>No.RM</label>
                                    <input type="text" name="no_rm" class="form-control" pattern="\d*">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Nama Pasien</label>
                                    <input type="text" name="nama_pasien" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Umur</label>
                                    <input type="number" name="umur" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Diagnosa</label>
                                    <input type="text" name="diagnosa" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tindakan Operasi</label>
                                    <input type="text" name="tindakan_operasi" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dokter OP</label>
                                    <input type="text" name="dokter_op" class="form-control" list="data_list_dok">
                                    <datalist id="data_list_dok">
                                        <option value="dr.Albert Novriadi,Sp.OG"></option>
                                        <option value="dr.Muharrom Hijrie Nurpatikana,Sp.B"></option>
                                    </datalist>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dokter Anest</label>
                                    <input type="text" name="dokter_anest" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jenis OP</label>
                                    <input type="text" name="jenis_op" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Asuransi</label>
                                    <input type="text" name="asuransi" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Rencana Tindakan</label>
                                    <input type="datetime-local" name="rencana_tindakan" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sign In</label>
                                    <input type="datetime-local" name="signin" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Time Out</label>
                                    <input type="datetime-local" name="time_out" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sign Out</label>
                                    <input type="datetime-local" name="sign_out" class="form-control">
                                </div>
                            </div>
                            <div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Penandaan Lokasi OP</label>
                                        <input type="text" name="penandaan_lokasi_op" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kelengkapan SSC</label>
                                        <input type="text" name="kelengkapan_ssc" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Penundaan OP Elektif >2 Jam</label>
                                        <input type="text" name="penundaan_op_elektif" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>SC Emergensi Kategori 1 >30mnt</label>
                                        <input type="text" name="sc_emergensi" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kendala</label>
                                <input type="text" name="kendala" class="form-control">
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
