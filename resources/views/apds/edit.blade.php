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
                    <form action="{{ route('apds.update', $apd->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $apd->tanggal ? date('Y-m-d', strtotime($apd->tanggal)) : date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Unit</label>
                            <input type="text" name="unit" value="{{$apd->unit ?? old('unit')}}" class="form-control" list="data_unit">
                            <datalist id="data_unit">
                                <option value="IGD"></option>
                                <option value="LABORAT"></option>
                                <option value="RAWAT JALAN"></option>
                                <option value="HCU"></option>
                                <option value="MATERNITAS / VK"></option>
                                <option value="RAWAT INAP"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Petugas</label>
                            <input type="text" name="nama_petugas" value="{{$apd->nama_petugas ?? old('nama_petugas')}}" class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Profesi</label>
                            <input type="text" name="profesi" value="{{$apd->profesi ?? old('profesi')}}" class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tindakan</label>
                            <input type="text" name="tindakan" value="{{$apd->tindakan ?? old('tindakan')}}" class="form-control" >
                        </div>
                        <div>
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>APD yang Digunakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                               <div class="form-group col-md-3">
                                                    <label>Topi</label>
                                                    <input type="text" name="topi" value="{{$apd->topi ?? old('topi')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Kacamata/ faceshield</label>
                                                    <input type="text" name="kacamata" value="{{$apd->kacamata ?? old('kacamata')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Masker</label>
                                                    <input type="text" name="nasker" value="{{$apd->nasker ?? old('nasker')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Gown</label>
                                                    <input type="text" name="gown" value="{{$apd->gown ?? old('gown')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Sarung Tangan</label>
                                                    <input type="text" name="sarung_tangan" value="{{$apd->sarung_tangan ?? old('sarung_tangan')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Sepatu</label>
                                                    <input type="text" name="sepatu" value="{{$apd->sepatu ?? old('sepatu')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ketepatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group col-md-3">
                                                    <label>Ya</label>
                                                    <input type="text" name="ya" value="{{$apd->ya ?? old('ya')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Tidak</label>
                                                    <input type="text" name="tidak" value="{{$apd->tidak ?? old('tidak')}}" class="form-control" list="data_list">
                                                    <datalist id="data_list">
                                                        <option value="✔️"></option>
                                                    </datalist>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" value="{{$apd->keterangan ?? old('keterangan')}}" class="form-control" >
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
