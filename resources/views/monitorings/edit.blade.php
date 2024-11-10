@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>MONITORING IDENTIFIKASI SAMPLE</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-edit"></i> Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('monitorings.update', $monitorings->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="{{ $monitorings->tanggal ? date('Y-m-d\TH:i', strtotime($monitorings->tanggal)) : date('Y-m-d\TH:i') }}" class="form-control ">
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="text" name="no_rm" value="{{$monitorings->no_rm ?? old('no_rm')}}" class="form-control" placeholder="no rm" pattern="\d*">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" value="{{$monitorings->nama_pasien ?? old('nama_pasien')}}" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Patuh</label>
                            <input type="text" name="patuh" value="{{$monitorings->patuh ?? old('patuh')}}" class="form-control" list="patuh">
                            <datalist id="patuh">
                                <option value="✔️"></option>
                                <option value="❌"></option>
                            </datalist>
                        </div>
                        <!-- Tombol untuk Submit -->
                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
