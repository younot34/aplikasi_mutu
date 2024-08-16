@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit ok</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit ok</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('oks.update', $oks->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        <div id="resep-container">
                            <div class="form-group">
                                <label>Waktu Pelaksanaan</label>
                                <input type="datetime-local" name="waktu_pelaksanaan" value="{{ $oks->waktu_pelaksanaan ? date('Y-m-d\TH:i', strtotime($oks->waktu_pelaksanaan)) : date('Y-m-d\TH:i') }}" class="form-control @error('waktu_pelaksanaan') is-invalid @enderror">

                                @error('waktu_pelaksanaan')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Waktu Pending</label>
                                <input type="datetime-local" name="waktu_pending" value="{{ $oks->waktu_pending ? date('Y-m-d\TH:i', strtotime($oks->waktu_pending)) : '' }}" class="form-control @error('waktu_pending') is-invalid @enderror">

                                @error('waktu_pending')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alasan</label>
                                <input type="text" name="alasan" value="{{ $oks->alasan ?? old('alasan') }}" class="form-control">
                                @error('alasan')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div id="obat-container">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Nama Pasien</label>
                                                <input type="text" name="nama_pasien" value="{{ $oks->nama_pasien }}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>No RM</label>
                                                <input type="number" name="no_rm" value="{{ $oks->no_rm }}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Diagnosa</label>
                                                <input type="text" name="diagnosa" value="{{ $oks->diagnosa }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Nama Dokter</label>
                                                <input type="text" name="nama_dokter" value="{{ $oks->nama_dokter }}" class="form-control">
                                            </div>
                                        </div>
                            </div>
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah resep</button> --}}
                    </form>
                </div>
                {{-- <script src="{{ asset('js/resep.js') }}"></script> --}}
            </div>
        </div>
    </section>
</div>

@stop
