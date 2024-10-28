@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data IDO</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-edit"></i> Edit Data</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('idos.update', $ido->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Input Judul -->
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $ido->judul }}" class="form-control @error('judul') is-invalid @enderror" required>
                            @error('judul')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Dropdown untuk Pemilihan Bulan -->
                        <div class="form-group">
                            <label>Bulan</label>
                            <select id="monthSelector" name="bulan" class="form-control" onchange="updateDates()">
                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $month)
                                    <option value="{{ $index + 1 }}" {{ $ido->bulan == ($index + 1) ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tabel untuk Variabel, Sub-Variabel, dan Tanggal -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="35" class="text-center">Judul: <span id="judulDisplay">{{ $ido->judul }}</span></th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">VARIABEL</th>
                                        <th rowspan="2">SUB VARIABEL</th>
                                        <th colspan="1" class="text-center">TANGGAL</th>
                                        <th rowspan="2">Total</th>
                                        <th rowspan="2">Sasaran</th>
                                        <th rowspan="2">Hasil (%)</th>
                                    </tr>
                                    <tr id="dateHeader"></tr>
                                </thead>
                                <tbody id="dataBody">
                                    <tr>
                                        <td rowspan="2">
                                            <input type="text" name="variabel" value="{{ $ido->variabel }}" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="text" name="sub_variabel_1" value="{{ $ido->sub_variabel_1 }}" class="form-control" required>
                                        </td>
                                        <td id="datesColumn1" class="d-flex justify-content-start"></td>
                                        <td><input type="number" name="total_1" id="total_1" value="{{ $ido->total_1 }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="sub_variabel_2" value="{{ $ido->sub_variabel_2 }}" class="form-control" required>
                                        </td>
                                        <td id="datesColumn2" class="d-flex justify-content-start"></td>
                                        <td><input type="number" name="total_2" id="total_2" value="{{ $ido->total_2 }}" readonly></td>
                                        <td rowspan="2">
                                            <div style="position: relative;">
                                                <input type="number" name="sasaran" value="{{ $ido->sasaran }}" pattern="\d*" required style="padding-right: 30px;">
                                                <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="position: relative;">
                                                <input type="number" name="hasil" id="hasil" value="{{ $ido->hasil }}" readonly style="padding-right: 30px;">
                                                <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">%</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tombol untuk Submit -->
                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript untuk Kalkulasi dan Dinamis Tanggal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const judulInput = document.querySelector('input[name="judul"]');
        const judulDisplay = document.getElementById('judulDisplay');

        judulInput.addEventListener('input', function () {
            judulDisplay.textContent = judulInput.value;
        });

        updateDates();
    });

    function updateDates() {
        const month = document.getElementById('monthSelector').value;
        const year = new Date().getFullYear();
        const daysInMonth = new Date(year, month, 0).getDate();

        const datesColumn1 = document.getElementById('datesColumn1');
        const datesColumn2 = document.getElementById('datesColumn2');

        datesColumn1.innerHTML = '';
        datesColumn2.innerHTML = '';

        for (let i = 1; i <= daysInMonth; i++) {
            datesColumn1.innerHTML += `
                <div style="text-align: center;">${i}</div>
                <input type="number" name="data_pertanggal_1[${i}]" class="data-input" data-sub="1" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">`;

            datesColumn2.innerHTML += `
                <div style="text-align: center;">${i}</div>
                <input type="number" name="data_pertanggal_2[${i}]" class="data-input" data-sub="2" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">`;
        }
    }

    function calculateTotalsAndResult() {
        const dataInputs = document.querySelectorAll('.data-input');
        let total1 = 0;
        let total2 = 0;

        dataInputs.forEach(input => {
            const sub = input.dataset.sub;
            const value = parseFloat(input.value) || 0;

            if (sub === '1') total1 += value;
            if (sub === '2') total2 += value;
        });

        document.getElementById('total_1').value = total1;
        document.getElementById('total_2').value = total2;

        const hasilField = document.getElementById('hasil');

        if (total2 !== 0) {
            const result = (total1 / total2) * 100;
            hasilField.value = result.toFixed(2);
        } else {
            hasilField.value = '0';
        }
    }
</script>
@stop
