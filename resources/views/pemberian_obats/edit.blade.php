@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Tidak Adanya Kesalahan Pemberian Obat</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-edit"></i> Edit</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('pemberian_obats.update', $pemberian_obats->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $pemberian_obats->tanggal ?? old('tanggal')}}" class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" value="{{ $pemberian_obats->nama_pasien ?? old('nama_pasien')}}" class="form-control @error('nama_pasien') is-invalid @enderror">
                            @error('nama_pasien')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>NO.RM</label>
                            <input type="text" name="no_rm" value="{{ $pemberian_obats->no_rm ?? old('no_rm')}}" class="form-control" pattern="\d*">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Tidak Salahan Dalam Pemberian Obat</label>
                            <input type="text" name="tidakSalah" value="{{ $pemberian_obats->tidakSalah ?? old('tidakSalah')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                                <option value="❌"></option>
                            </datalist>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" value="{{ $pemberian_obats->keterangan ?? old('keterangan')}}" class="form-control">
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
