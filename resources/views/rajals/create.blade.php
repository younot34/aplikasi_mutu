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
                    <form action="{{ route('rajals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d', time()); ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Poli</label>
                            <input type="text" name="poli" class="form-control" list="data_list_poli">
                            <datalist id="data_list_poli">
                                <option value="Mata"></option>
                                <option value="Kandungan"></option>
                                <option value="Anak"></option>
                                <option value="Gigi"></option>
                                <option value="Penyakit Dalam"></option>
                                <option value="Saraf"></option>
                                <option value="Bedah"></option>
                                <option value="Jantung"></option>
                                <option value="Gizi"></option>
                                <option value="Imunisasi"></option>
                                <option value="KB"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Jumlah Pasien Poli</label>
                            <input type="number" name="patuh" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Pasien Patuh</label>
                            <input type="number" name="tidak_patuh" class="form-control">
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
