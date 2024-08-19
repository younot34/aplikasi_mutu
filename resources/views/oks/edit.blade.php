@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit ok</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit ok</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('oks.update', $oks->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                
                        @foreach ($oks as $ok)
                        <div id="resep-container" style="margin-bottom: 10px;">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>No.RM</label>
                                    <input type="number" name="oks[{{ $ok->id }}][no_rm]" value="{{ $ok->no_rm }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Nama Pasien</label>
                                    <input type="text" name="oks[{{ $ok->id }}][nama_pasien]" value="{{ $ok->nama_pasien }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Umur</label>
                                    <input type="number" name="oks[{{ $ok->id }}][umur]" value="{{ $ok->umur }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Diagnosa</label>
                                    <input type="text" name="oks[{{ $ok->id }}][diagnosa]" value="{{ $ok->diagnosa }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tindakan Operasi</label>
                                    <input type="text" name="oks[{{ $ok->id }}][tindakan_operasi]" value="{{ $ok->tindakan_operasi }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dokter OP</label>
                                    <input type="text" name="oks[{{ $ok->id }}][dokter_op]" value="{{ $ok->dokter_op }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dokter Anest</label>
                                    <input type="text" name="oks[{{ $ok->id }}][dokter_anest]" value="{{ $ok->dokter_anest }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jenis OP</label>
                                    <input type="text" name="oks[{{ $ok->id }}][jenis_op]" value="{{ $ok->jenis_op }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Asuransi</label>
                                    <input type="text" name="oks[{{ $ok->id }}][asuransi]" value="{{ $ok->asuransi }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Rencana Tindakan</label>
                                    <input type="datetime-local" name="oks[{{ $ok->id }}][rencana_tindakan]" value="{{ $ok->rencana_tindakan ? date('Y-m-d\TH:i', strtotime($ok->rencana_tindakan)) : '' }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sign In</label>
                                    <input type="datetime-local" name="oks[{{ $ok->id }}][signin]" value="{{ $ok->signin ? date('Y-m-d\TH:i', strtotime($ok->signin)) : '' }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Time Out</label>
                                    <input type="datetime-local" name="oks[{{ $ok->id }}][time_out]" value="{{ $ok->time_out ? date('Y-m-d\TH:i', strtotime($ok->time_out)) : '' }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sign Out</label>
                                    <input type="datetime-local" name="oks[{{ $ok->id }}][sign_out]" value="{{ $ok->sign_out ? date('Y-m-d\TH:i', strtotime($ok->sign_out)) : '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Penandaan Lokasi OP</label>
                                    <input type="text" name="oks[{{ $ok->id }}][penandaan_lokasi_op]" value="{{ $ok->penandaan_lokasi_op }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Kelengkapan SSC</label>
                                    <input type="text" name="oks[{{ $ok->id }}][kelengkapan_ssc]" value="{{ $ok->kelengkapan_ssc }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Penundaan OP Elektif >2 Jam</label>
                                    <input type="text" name="oks[{{ $ok->id }}][penundaan_op_elektif]" value="{{ $ok->penundaan_op_elektif }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>SC Emergensi Kategori 1 >30mnt</label>
                                    <input type="text" name="oks[{{ $ok->id }}][sc_emergensi]" value="{{ $ok->sc_emergensi }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="oks[{{ $ok->id }}][keterangan]" value="{{ $ok->keterangan }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kendala</label>
                                <input type="text" name="oks[{{ $ok->id }}][kendala]" value="{{ $ok->kendala }}" class="form-control">
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
