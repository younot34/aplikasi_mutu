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
                            <input type="datetime-local" name="waktu" value="{{ $farmasi->waktu ?? date('Y-m-d\TH:i') }}" class="form-control @error('waktu') is-invalid @enderror">
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
            
                        <div class="form-group">
                            <label>R/</label>
                            <input type="number" name="r" value="{{ $farmasi->r ?? old('r') }}" class="form-control">
                            @error('r')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input type="text" name="nama_obat" value="{{ $farmasi->nama_obat ?? old('nama_obat') }}" class="form-control">
                            @error('nama_obat')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label>Total Obat Fornas</label>
                            <input type="number" name="total_obat_fornas" value="{{ $farmasi->total_obat_fornas ?? old('total_obat_fornas') }}" class="form-control">
                            @error('total_obat_fornas')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label>Total Item</label>
                            <input type="number" name="total_item" value="{{ $farmasi->total_item ?? old('total_item') }}" class="form-control">
                            @error('total_item')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-light" type="button" wire:click="addFarmasiInput" wire:loading.attr="disabled">Tambah Input</button>
                        <button class="btn btn-light" type="button" wire:click="addObatInput" wire:loading.attr="disabled">Tambah Obat</button>
                    </form>
                </div>
            </div>            
        </div>
    </section>
</div>

@stop
