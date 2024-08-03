@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit imprs</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit imprs</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('imprs.update', $imprs->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="waktu" value="{{ $imprs->waktu ? date('Y-m-d\TH:i', strtotime($imprs->waktu)) : date('Y-m-d\TH:i') }}" class="form-control @error('waktu') is-invalid @enderror">
                            @error('waktu')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div id="resep-container">
                            @foreach ($imprs->reseps as $index => $resep)
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Resep Terverifikasi Double Check</label>
                                        <input type="number" name="resep_terverifikasi[]" value="{{ $resep->resep_terverifikasi }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Resep High Alert</label>
                                        <input type="number" name="resep_high_alert[]" value="{{ $resep->resep_high_alert }}" class="form-control">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah resep</button> --}}
                    </form>
                </div>
                <script src="{{ asset('js/resep.js') }}"></script>
            </div>
        </div>
    </section>
</div>

@stop
