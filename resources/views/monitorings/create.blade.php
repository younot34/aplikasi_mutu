@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>MONITORING IDENTIFIKASI SAMPLE</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-plus"></i> Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('monitorings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d', time()); ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="text" name="no_rm" class="form-control" placeholder="no rm" pattern="\d*">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Patuh</label>
                            <input type="text" name="patuh"  class="form-control" list="patuh">
                            <datalist id="patuh">
                                <option value="✔️"></option>
                                <option value="❌"></option>
                            </datalist>
                        </div>
                        <!-- Tombol untuk Submit -->
                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                        <button class="btn btn-warning btn-reset" type="reset">
                            <i class="fa fa-redo"></i> Reset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
