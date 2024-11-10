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
                            <input type="text" name="no_rm" value="{{$clinical->no_rm ?? old('no_rm')}}" class="form-control" pattern="\d*" placeholder="no rm">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_px" value="{{$clinical->nama_px ?? old('nama_px')}}" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Diagnosa</label>
                            <input type="text" name="diagnosa" value="{{$clinical->diagnosa ?? old('diagnosa')}}" class="form-control" placeholder="diagnosa" list="data_list_diagnosa">
                            <datalist id="data_list_diagnosa">
                                <option value="Ca Cervik"></option>
                                <option value="TB"></option>
                                <option value="HT"></option>
                                <option value="HIV"></option>
                                <option value="DM"></option>
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
                        <div class="form-group col-md-3">
                            <label>Patuh</label>
                            <input type="text" name="patuh" value="{{$clinical->patuh ?? old('patuh')}}"  class="form-control" list="patuh">
                            <datalist id="patuh">
                                <option value="✔️"></option>
                                <option value="❌"></option>
                            </datalist>
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
