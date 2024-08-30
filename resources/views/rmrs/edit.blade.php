@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Rm</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit Kelengkapan Rajal</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('rmrs.update', $rmrs->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        @foreach ($rmrs as $rmr)
                        <div id="resep-container" style="margin-bottom: 10px;">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>No</label>
                                    <input type="number" name="rmrs[{{ $rmr->id }}][no]" value="{{ $rmr->no }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>No.RM</label>
                                    <input type="number" name="rmrs[{{ $rmr->id }}][no_rm]" value="{{ $rmr->no_rm }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Asesment</label>
                                    <input type="text" name="rmrs[{{ $rmr->id }}][asesmen]" value="{{ $rmr->asesmen }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>CPPT</label>
                                    <input type="text" name="rmrs[{{ $rmr->id }}][cppt]" value="{{ $rmr->cppt }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Resep</label>
                                    <input type="text" name="rmrs[{{ $rmr->id }}][resep]" value="{{ $rmr->resep }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Resume</label>
                                    <input type="text" name="rmrs[{{ $rmr->id }}][resume]" value="{{ $rmr->resume }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Lengkap</label>
                                    <input type="text" name="rmrs[{{ $rmr->id }}][lengkap]" value="{{ $rmr->lengkap }}" class="form-control" list="data_list_rm">
                                    <datalist id="data_list_rm">
                                        <option value="✔️"></option>
                                    </datalist>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tidak Lengkap</label>
                                    <input type="text" name="rmrs[{{ $rmr->id }}][tidak]" value="{{ $rmr->tidak }}" class="form-control" list="data_list_rm">
                                    <datalist id="data_list_rm">
                                        <option value="✔️"></option>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
