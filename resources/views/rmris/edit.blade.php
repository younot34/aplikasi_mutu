@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Rekam Medis</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit Kelengkapan RI</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('rmris.update', $rmri->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        @foreach ($rmri as $rmr)
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
                                    <td><input type="text" name="rmris[{{ $rmr->id }}][no_rm]" value="{{ old('rmris.' . $rmr->id . '.no_rm', $rmr->no_rm) }}" class="form-control"></td>
                                    <td>Resume Medis</td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][resume_ada]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.resume_ada', $rmr->resume_ada) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][resume_tidakAda]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.resume_tidakAda', $rmr->resume_tidakAda) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][resume_lengkap]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.resume_lengkap', $rmr->resume_lengkap) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][resume_tidak]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.resume_tidak', $rmr->resume_tidak) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pengantar Pasien</td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][pengantar_ada]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.pengantar_ada', $rmr->pengantar_ada) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][pengantar_tidakAda]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.pengantar_tidakAda', $rmr->pengantar_tidakAda) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][pengantar_lengkap]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.pengantar_lengkap', $rmr->pengantar_lengkap) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][pengantar_tidak]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.pengantar_tidak', $rmr->pengantar_tidak) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>CPPT</td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][cppt_ada]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.cppt_ada', $rmr->cppt_ada) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][cppt_tidakAda]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.cppt_tidakAda', $rmr->cppt_tidakAda) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][cppt_lengkap]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.cppt_lengkap', $rmr->cppt_lengkap) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][cppt_tidak]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.cppt_tidak', $rmr->cppt_tidak) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>General Consent</td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][general_ada]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.general_ada', $rmr->general_ada) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][general_tidakAda]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.general_tidakAda', $rmr->general_tidakAda) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][general_lengkap]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.general_lengkap', $rmr->general_lengkap) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][general_tidak]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.general_tidak', $rmr->general_tidak) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Informed Consent</td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][informed_ada]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.informed_ada', $rmr->informed_ada) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][informed_tidakAda]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.informed_tidakAda', $rmr->informed_tidakAda) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][informed_lengkap]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.informed_lengkap', $rmr->informed_lengkap) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="rmris[{{ $rmr->id }}][informed_tidak]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.informed_tidak', $rmr->informed_tidak) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Keterangan (Lengkap / Tidak Lengkap)</td>
                                    <td colspan="2">
                                        <input type="text" name="rmris[{{ $rmr->id }}][keterangan_lengkap]" class="form-control" list="data_list" value="{{ old('rmris.' . $rmr->id . '.keterangan_lengkap', $rmr->keterangan_lengkap) }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
