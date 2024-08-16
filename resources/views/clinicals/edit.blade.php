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
                    <form action="{{ route('clinicals.update', $clinical->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="number" name="no_rm" value="{{$clinical->no_rm ?? old('no_rm')}}" class="form-control" placeholder="no rm">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_px" value="{{$clinical->nama_px ?? old('nama_px')}}" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Ca Cervik</label>
                            <input type="text" name="ca_cervik" value="{{$clinical->ca_cervik ?? old('ca_cervik')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>TB</label>
                            <input type="text" name="tb" value="{{$clinical->tb ?? old('tb')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>HT</label>
                            <input type="text" name="ht" value="{{$clinical->ht ?? old('ht')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>HIV</label>
                            <input type="text" name="hiv" value="{{$clinical->hiv ?? old('hiv')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>DM</label>
                            <input type="text" name="dm" value="{{$clinical->dm ?? old('dm')}}" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Masuk Ranap</label>
                            <input type="date" name="masuk" value="{{ $clinical->masuk ? date('Y-m-d', strtotime($clinical->masuk)) : date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Keluar Ranap</label>
                            <input type="date" name="keluar" value="{{ $clinical->keluar ? date('Y-m-d', strtotime($clinical->keluar)) : date('Y-m-d') }}" class="form-control">
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
