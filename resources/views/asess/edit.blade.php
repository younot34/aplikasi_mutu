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
                    <form action="{{ route('asess.update', $ases->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="{{ $ases->tanggal ? date('Y-m-d\TH:i', strtotime($ases->tanggal)) : date('Y-m-d\TH:i') }}" class="form-control ">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Poli</label>
                            <input type="text" name="poli" value="{{$ases->poli ?? old('poli')}}" class="form-control" placeholder="nama poli" list="data_list_poli">
                            <datalist id="data_list_poli">
                                <option value="Mata"></option>
                                <option value="Kandungan"></option>
                                <option value="Anak"></option>
                                <option value="Gigi"></option>
                                <option value="Penyakit Dalam"></option>
                                <option value="Saraf"></option>
                                <option value="Bedah"></option>
                                <option value="Jantung"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Jumlah Pasien Assesment</label>
                            <input type="number" name="patuh" value="{{$ases->patuh ?? old('patuh')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Assesment Tidak Patuh</label>
                            <input type="number" name="tidak_patuh" value="{{$ases->tidak_patuh ?? old('tidak_patuh')}}" class="form-control">
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
