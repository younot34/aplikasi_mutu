@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit farmasi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit Farmasi</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('farmasis.update', $farmasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="waktu" value="{{ $farmasi->waktu ? date('Y-m-d\TH:i', strtotime($farmasi->waktu)) : date('Y-m-d\TH:i') }}" class="form-control @error('waktu') is-invalid @enderror">
                            @error('waktu')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nama PX</label>
                            <input type="text" name="nama_px" value="{{ $farmasi->nama_px ?? old('nama_px') }}" class="form-control">
                            @error('nama_px')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div id="obat-container">
                            @foreach ($farmasi->obats as $index => $obat)
                                <div class="form-row" id="obat-row-{{ $index }}">
                                    <div class="form-group col-md-3">
                                        <label>R/</label>
                                        <input type="number" name="r[]" value="{{ $obat->r }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Nama Obat</label>
                                        <input type="text" name="nama_obat[]" value="{{ $obat->nama_obat }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Total Obat Fornas</label>
                                        <input type="number" name="total_obat_fornas[]" value="{{ $obat->total_obat_fornas }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Total Item</label>
                                        <input type="number" name="total_item[]" value="{{ $obat->total_item }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeObatRow({{ $index }})">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-light" type="button" id="add-obat-button">Tambah Obat</button>
                    </form>
                </div>
                <script src="{{ asset('js/custom.js') }}"></script>
            </div>
        </div>
    </section>
</div>

@stop
