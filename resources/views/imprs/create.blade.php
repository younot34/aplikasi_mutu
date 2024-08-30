@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah imprs</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah imprs</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('imprs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="date" name="waktu" value="<?= date('Y-m-d'); ?>" class="form-control @error('start') is-invalid @enderror">
                            @error('waktu')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div id="resep-container">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Resep Terverifikasi Double Check</label>
                                    <input type="number" name="resep_terverifikasi[]" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Resep High Alert</label>
                                    <input type="number" name="resep_high_alert[]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah Resep</button> --}}
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                </div>
                <script src="{{ asset('js/resep.js') }}"></script>
            </div>
        </div>
    </section>
</div>

@stop
