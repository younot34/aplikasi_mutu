@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Cuci Tangan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah Cuci Tangan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('ppis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="form-group col-md-8">
                                <label>Indikasi Cuci Tangan = 5 Momen</label>
                                <ol>
                                    <li>Sebelum Kontak Dengan Pasien</li>
                                    <li>Sebelum prosedur Bersih / Aseptik</li>
                                    <li>Setelah Prosedur / Risiko Terpapar Cairan Tubuh</li>
                                    <li>Setelah Kontak Dengan Pasien</li>
                                    <li>Setelah Kontak Dengan Area Sekitar Pasien</li>
                                </ol>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>unit</label>
                                    <input type="text" name="unit" class="form-control" placeholder="unit (Optional)">
                                    @error('unit')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tanggal</label>
                                    <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('tanggal') is-invalid @enderror">
                                    @error('tanggal')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Observer</label>
                                    <input type="text" name="observer" class="form-control" placeholder="observer (Optional)">
                                    @error('observer')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Profesi</label>
                                    <input type="text" name="profesi[]" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jumlah</label>
                                    <input type="number" name="jumlah[]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="ppi-container">
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
                                            <input type="number" name="opp[]">
                                        </td>
                                        <td>
                                            <input type="number" name="indikasi[]" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="1"></option>
                                                <option value="2"></option>
                                                <option value="3"></option>
                                                <option value="4"></option>
                                                <option value="5"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="cuci_tangan[]" class="form-control" list="data_list_cuci">
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
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-light" type="button" id="add-ppi-button">Tambah OPP</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                    <script src="{{ asset('js/custom.js') }}"></script>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
