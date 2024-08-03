@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah farmasi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah farmasi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('farmasis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="waktu" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('start') is-invalid @enderror">
                            @error('waktu')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama PX</label>
                            <input type="text" name="nama_px" value="{{ old('nama_px') }}" class="form-control">
                            @error('nama_px')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No_RM</label>
                            <input type="text" name="no_rm" value="{{ old('no_rm') }}" class="form-control">
                            @error('no_rm')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div id="obat-container">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>R/</label>
                                    <input type="number" name="r[]" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Nama Obat</label>
                                    <input type="text" name="nama_obat[]" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Total Obat Fornas</label>
                                    <input type="number" name="total_obat_fornas[]" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Total Item</label>
                                    <input type="number" name="total_item[]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-light" type="button" id="add-obat-button">Tambah Obat</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                </div>
                <script src="{{ asset('js/custom.js') }}"></script>
            </div>
        </div>
    </section>
</div>

@stop
