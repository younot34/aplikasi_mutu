@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>mutu DETAIL</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Form {{ $mutu->name }} </h4>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Durasi Ujian : {{ $mutu->time }} Menit</li>
                        <li class="list-group-item">Durasi Jumlah Soal : {{ $mutu->total_question }} buah</li>
                        <li class="list-group-item">Ujian dibuka : {{ TanggalID($mutu->start) }}</li>
                        <li class="list-group-item">Ujian ditutup : {{ TanggalID($mutu->end) }}</li>
                    </ul>
                </div>
                <div class="card-footer">
                    @if (now() > $mutu->start && now()  < $mutu->end)
                        <a href="{{ route('mutus.start', $mutu->id) }}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">START</a>
                    @elseif (now() < $mutu->start)
                    <a onclick="goBack()" class="btn btn-warning btn-lg btn-block" role="button" aria-pressed="true">UJIAN BELUM DIBUKA - KEMBALI</a>
                    @elseif(now() > $mutu->end)
                    <a onclick="goBack()" class="btn btn-danger btn-lg btn-block" role="button" aria-pressed="true">UJIAN SUDAH DITUTUP - KEMBALI</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function goBack() {
    window.history.back();
}
</script>

@stop