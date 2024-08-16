@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('visites.update', $visite->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="{{ $visite->tanggal ? date('Y-m-d\TH:i', strtotime($visite->tanggal)) : date('Y-m-d\TH:i') }}" class="form-control @error('start') is-invalid @enderror">
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="number" name="no_rm" value="{{$visite->no_rm ?? old('no_rm')}}" class="form-control" placeholder="no rm">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_px" value="{{$visite->nama_px ?? old('nama_px')}}" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>06.00-14.00</label>
                            <input type="text" name="jam6sampai14" value="{{$visite->jam6sampai14 ?? old('jam6sampai14')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>>14.00</label>
                            <input type="text" name="kurang14" value="{{$visite->kurang14 ?? old('kurang14')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Dokter Spesialis</label>
                            <input type="text" name="dokter_spesial" value="{{$visite->dokter_spesial ?? old('dokter_spesial')}}" class="form-control">
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah resep</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
