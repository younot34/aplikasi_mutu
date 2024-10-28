@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Radio</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit Radio</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('radios.update', $radios->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        @foreach ($radios as $radio)
                        <div id="radio-container" style="margin-bottom: 10px;">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>No.RO</label>
                                    <input type="text" name="radios[{{ $radio->id }}][no_ro]" value="{{ $radio->no_ro }}" class="form-control" pattern="\d*">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Nama Pasien</label>
                                    <input type="text" name="radios[{{ $radio->id }}][nama_pasien]" value="{{ $radio->nama_pasien }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>No.RM</label>
                                    <input type="text" name="radios[{{ $radio->id }}][no_rm]" value="{{ $radio->no_rm }}" class="form-control" pattern="\d*">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Ruangan</label>
                                    <input type="text" name="radios[{{ $radio->id }}][ruangan]" value="{{ $radio->ruangan }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Umur</label>
                                    <input type="number" name="radios[{{ $radio->id }}][umur]" value="{{ $radio->umur }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jenis Pembayaran</label>
                                    <input type="text" name="radios[{{ $radio->id }}][jenis_pembayaran]" value="{{ $radio->jenis_pembayaran }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dokter Pengirim</label>
                                    <input type="text" name="radios[{{ $radio->id }}][dokter_pengirim]" value="{{ $radio->dokter_pengirim }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jenis Pemeriksaan</label>
                                    <input type="text" name="radios[{{ $radio->id }}][jenis_pemeriksaan]" value="{{ $radio->jenis_pemeriksaan }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Petugas</label>
                                    <input type="text" name="radios[{{ $radio->id }}][petugas]" value="{{ $radio->petugas }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>KV/MAs</label>
                                    <input type="text" name="radios[{{ $radio->id }}][kvmas]" value="{{ $radio->kvmas }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Mulai</label>
                                    <input type="time" name="radios[{{ $radio->id }}][mulai]" value="{{ $radio->mulai }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Selesai</label>
                                    <input type="time" name="radios[{{ $radio->id }}][selesai]" value="{{ $radio->selesai }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tarif</label>
                                    <input type="text" name="radios[{{ $radio->id }}][tarif]" value="{{ $radio->tarif }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="radios[{{ $radio->id }}][keterangan]" value="{{ $radio->keterangan }}" class="form-control">
                            </div>
                        </div>
                        <hr>
                        @endforeach

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
