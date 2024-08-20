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
                    <form action="{{ route('ris.update', $ri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="{{ $ri->tanggal ? date('Y-m-d\TH:i', strtotime($ri->tanggal)) : date('Y-m-d\TH:i') }}" class="form-control @error('start') is-invalid @enderror">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sift</label>
                            <input type="text" name="sift" value="{{$ri->sift ?? old('sift')}}" class="form-control" placeholder="sift" list="data_list">
                            <datalist id="data_list">
                                <option value="pagi"></option>
                                <option value="Siang"></option>
                                <option value="Malam"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="number" name="no_rm" value="{{$ri->no_rm ?? old('no_rm')}}" class="form-control" placeholder="no rm">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_px" value="{{$ri->nama_px ?? old('nama_px')}}" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat" value="{{$ri->alamat ?? old('alamat')}}" class="form-control" placeholder="alamat">
                        </div>
                        @foreach ($ri->pobats as $index => $pobat)
                        <div id="ri-container">
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemberian Obat</th>
                                            <th>Pemberian Darah</th>
                                            <th>Pengambilan Sample</th>
                                            <th>Pemberian Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="benar_namao[]"  value="{{$pobat->benar_namao}}">
                                            <input type="text" name="benar_alamato[]"value="{{$pobat->benar_alamato}}">
                                        </td>
                                        @foreach($ri->pdarahs as $index => $pdarah)
                                        <td>
                                            <input type="text" name="benar_namad[]"  value="{{$pdarah->benar_namad}}">
                                            <input type="text" name="benar_alamatd[]"value="{{$pdarah->benar_alamatd}}">
                                        </td>
                                        @endforeach
                                        @foreach($ri->psamples as $index => $psample)
                                        <td>
                                            <input type="text" name="benar_namas[]"  value="{{$psample->benar_namas}}">
                                            <input type="text" name="benar_alamats[]"value="{{$psample->benar_alamats}}">
                                        </td>
                                        @endforeach
                                        @foreach($ri->ptindakans as $index => $ptindakan)
                                        <td>
                                            <input type="text" name="benar_namat[]"  value="{{$ptindakan->benar_namat}}">
                                            <input type="text" name="benar_alamatt[]"value="{{$ptindakan->benar_alamatt}}">
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah resep</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
