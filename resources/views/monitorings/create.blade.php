@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-plus"></i> Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('monitorings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Dropdown untuk Pemilihan Bulan -->
                        <div class="form-group">
                            <label>Bulan</label>
                            <select id="monthSelector" name="bulan" class="form-control" onchange="updateDates()" required>
                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $month)
                                    <option value="{{ $index + 1 }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tabel untuk Variabel, Sub-Variabel, dan Tanggal -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="6">VARIABEL</th>
                                        <th rowspan="6">SUB VARIABEL</th>
                                        <th colspan="1" class="text-center">TANGGAL</th>
                                        <th rowspan="6">Total</th>
                                        <th rowspan="6">Hasil (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Baris untuk Input -->
                                    <tr>
                                        <td rowspan="6">
                                            <input type="text" name="variabel" required>
                                        </td>
                                        <td rowspan="3">
                                            <input type="text" name="sub_variabel_1" required>
                                        </td>
                                        <td id="datesColumn1" class="d-flex justify-content-start">
                                            <tr></tr>
                                        </td>
                                        <td></td>
                                        <td><input type="number" name="total_1" id="total_1" readonly></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            <input type="text" name="sub_variabel_2" required>
                                        </td>
                                        <td id="datesColumn2" class="d-flex justify-content-start">
                                            <tr></tr>
                                        </td>
                                        <td></td>
                                        <td><input type="number" name="total_2" id="total_2" readonly></td>
                                        <td>
                                            <div style="position: relative;">
                                                <input type="number" name="hasil" id="hasil" readonly style="padding-right: 30px;">
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
                        <button class="btn btn-warning btn-reset" type="reset">
                            <i class="fa fa-redo"></i> Reset
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
        updateDates(); // Memperbarui tanggal saat halaman pertama kali dimuat
    });

    function updateDates() {
        const month = document.getElementById('monthSelector').value;
        const year = new Date().getFullYear(); // Ambil tahun saat ini
        const daysInMonth = new Date(year, month, 0).getDate();

        // Update kolom tanggal untuk kedua sub-variabel
        const datesColumn1 = document.getElementById('datesColumn1');
        const datesColumn2 = document.getElementById('datesColumn2');

        datesColumn1.innerHTML = '';
        datesColumn2.innerHTML = '';

        for (let i = 1; i <= daysInMonth; i++) {
            datesColumn1.innerHTML += `
            <div class="dates-column">
                <div style="text-align: center;">${i}</div>
                    <input type="number" name="data_pertanggal_1[${i}]" class="data-input" data-group="1" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">
                    <input type="number" name="data_pertanggal_2[${i}]" class="data-input" data-group="1" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">
                    <input type="number" name="data_pertanggal_3[${i}]" class="data-input" data-group="1" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">
            </div>`;
            datesColumn2.innerHTML += `
            <div class="dates-column">
                <div style="text-align: center;">${i}</div>
                    <input type="number" name="data_pertanggal_4[${i}]" class="data-input" data-group="2" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">
                    <input type="number" name="data_pertanggal_5[${i}]" class="data-input" data-group="2" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">
                    <input type="number" name="data_pertanggal_6[${i}]" class="data-input" data-group="2" data-day="${i}" oninput="calculateTotalsAndResult()" style="width: 50px; text-align: right;">
            </div>`;
        }
    }

    function calculateTotalsAndResult() {
        const dataInputs = document.querySelectorAll('.data-input');
        let total1 = 0;
        let total2 = 0;

        dataInputs.forEach(input => {
            const group = input.dataset.group;
            const value = parseFloat(input.value) || 0;

            if (group === '1') total1 += value;
            if (group === '2') total2 += value;
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
<style>
    .dates-column {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .dates-column input {
        width: 50px;
        margin: 2px;
        text-align: center;
    }
</style>
@stop