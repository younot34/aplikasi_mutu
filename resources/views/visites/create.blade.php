@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('visites.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('start') is-invalid @enderror">
                        </div>
                        <div class="form-group col-md-3">
                            <label>No.RM</label>
                            <input type="text" name="no_rm" class="form-control" placeholder="no rm" pattern="\d*">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_px" class="form-control" placeholder="nama pasien">
                        </div>
                        <div class="form-group col-md-3">
                            <label>06.00-14.00</label>
                            <input type="text" name="jam6sampai14" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>>14.00</label>
                            <input type="text" name="kurang14" class="form-control" list="data_list">
                            <datalist id="data_list">
                                <option value="✔️"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Dokter Spesialis</label>
                            <input type="text" name="dokter_spesial" class="form-control" list="data_list_dok">
                            <datalist id="data_list_dok">
                                <option value="dr.Albert Novriadi,Sp.OG"></option>
                                <option value="dr.Muharrom Hijrie Nurpatikana,Sp.B"></option>
                                <option value="dr.Sulistyo Suharto,M,Si.,Med.,Sp.A"></option>
                                <option value="dr.Padmi Bektilestari,Sp.PD"></option>
                                <option value="dr.Kurniawan Agung Yuwono,Sp.PD"></option>
                                <option value="dr.Lestari Handayani,Sp.N"></option>
                                <option value="dr.Idha Widiastuti,SE.MM"></option>
                                <option value="dr.F.Bayu Satria,Sp.JP,FIHA"></option>
                            </datalist>
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
