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
                    <form action="{{ route('dpjps.update', $dpjp->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="{{ $dpjp->tanggal ? date('Y-m-d\TH:i', strtotime($dpjp->tanggal)) : date('Y-m-d\TH:i') }}" class="form-control ">
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="number" name="no_rm" value="{{$dpjp->no_rm ?? old('no_rm')}}" class="form-control" placeholder="no rm">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" value="{{$dpjp->nama_pasien ?? old('nama_pasien')}}" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Terverifikasi</label>
                            <input type="text" name="terverifikasi" value="{{$dpjp->terverifikasi ?? old('terverifikasi')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tidak Terverifikasi</label>
                            <input type="text" name="tidak_terverifikasi" value="{{$dpjp->tidak_terverifikasi ?? old('tidak_terverifikasi')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>DPJP</label>
                            <input type="text" name="dpjp" value="{{$dpjp->dpjp ?? old('dpjp')}}" class="form-control" placeholder="nama dpjp">
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
