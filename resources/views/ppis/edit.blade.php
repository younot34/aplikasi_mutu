@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit PPI</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit PPI</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('ppis.update', $ppis->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group col-md-3">
                            <label>unit</label>
                            <input type="text" name="unit" value="{{$ppis->unit ?? old('unit') }}" class="form-control" placeholder="unit (Optional)">
                            @error('unit')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="{{ $ppis->tanggal ? date('Y-m-d\TH:i', strtotime($ppis->tanggal)) : date('Y-m-d\TH:i') }}" class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observer</label>
                            <input type="text" name="observer" value="{{ $ppis->observer ?? old('observer')  }}" class="form-control" placeholder="observer (Optional)">
                            @error('observer')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            @foreach ($ppis->profesis as $index => $profesiss)
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Profesi</label>
                                    <input type="text" name="profesi[]" value="{{ $profesiss->profesi }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jumlah</label>
                                    <input type="number" name="jumlah[]" value="{{ $profesiss->jumlah }}" class="form-control">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="ppi-container">
                            @foreach ($ppis->indikasis as $index => $indikasiss)
                            <div class="form-row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>opp</th>
                                            <th>indikasi</th>
                                            <th>cuci tangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td rowspan="1">
                                            <input type="number" name="opp[]" value="{{ $indikasiss->opp }}">
                                        </td>
                                        <td>
                                            <input type="number" name="indikasi[]" value="{{ $indikasiss->indikasi }}" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="1"></option>
                                                <option value="2"></option>
                                                <option value="3"></option>
                                                <option value="4"></option>
                                                <option value="5"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="cuci_tangan[]" value="{{ $indikasiss->cuci_tangan }}" class="form-control" list="data_list_cuci">
                                            <datalist id="data_list_cuci">
                                                <option value="Rub"></option>
                                                <option value="Air M"></option>
                                                <option value="Tidak"></option>
                                                <option value="Gloves"></option>
                                            </datalist>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            @endforeach
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-light" type="button" id="add-ppi-button">Tambah OPP</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah resep</button> --}}
                    </form>
                    <script src="{{ asset('js/custom.js') }}"></script>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
