@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Obat</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit Obat</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('list.update', $list->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input type="varchar" name="list_obat" value="{{ $list->list_obat ?? old('list_obat') }}" class="form-control">
                            @error('list_obar')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah resep</button> --}}
                    </form>
                </div>
                {{-- <script src="{{ asset('js/resep.js') }}"></script> --}}
            </div>
        </div>
    </section>
</div>

@stop
