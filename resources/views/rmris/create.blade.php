@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah RM</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah Kelengkapan Rajal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rmris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                        <div id="rmri-container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No. RM</th>
                                        <th>Nama Formulir</th>
                                        <th>Ada</th>
                                        <th>Tidak Ada</th>
                                        <th>Lengkap</th>
                                        <th>Tidak Lengkap</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="no_rm" value="{{ old('no_rm') }}"></td>
                                        <td>Resume Medis</td>
                                        <td>
                                            <input type="text" name="resume_ada" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="resume_tidakAda" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="resume_lengkap" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="resume_tidak" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Pengantar Rawat Inap</td>
                                        <td>
                                            <input type="text" name="pengantar_ada" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="pengantar_tidakAda" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="pengantar_lengkap" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="pengantar_tidak" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>CPPT</td>
                                        <td>
                                            <input type="text" name="cppt_ada" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="cppt_tidakAda" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="cppt_lengkap" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="cppt_tidak" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>General Consent</td>
                                        <td>
                                            <input type="text" name="general_ada" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="general_tidakAda" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="general_lengkap" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="general_tidak" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Informed Consent</td>
                                        <td>
                                            <input type="text" name="informed_ada" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="informed_tidakAda" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="informed_lengkap" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="informed_tidak" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="✔️"></option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Keterangan (Lengkap / Tidak Lengkap)</td>
                                        <td colspan="4">
                                            <input type="text" name="keterangan_lengkap" class="form-control" list="data_list_lengkap">
                                            <datalist id="data_list_lengkap">
                                                <option value="✔️"></option>
                                                <option value="❌"></option>
                                            </datalist>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
