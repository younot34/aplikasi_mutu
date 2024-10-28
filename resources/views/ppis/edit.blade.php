@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit PPI</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('ppis.update', $ppis->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group col-md-3">
                            <label>unit</label>
                            <input type="text" name="unit" value="{{$ppis->unit ?? old('unit') }}" class="form-control" placeholder="unit (Optional)" list="data_unit">
                            <datalist id="data_unit">
                                <option value="IGD"></option>
                                <option value="LABORAT"></option>
                                <option value="RAWAT JALAN"></option>
                                <option value="HCU"></option>
                                <option value="MATERNITAS / VK"></option>
                                <option value="RAWAT INAP"></option>
                            </datalist>
                            @error('unit')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="tanggal" value="{{ $ppis->tanggal ? date('Y-m-d\TH:i', strtotime($ppis->tanggal)) : date('Y-m-d\TH:i') }}" class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observer</label>
                            <input type="text" name="observer" value="{{ $ppis->observer ?? old('observer')  }}" class="form-control" placeholder="observer (Optional)">
                            @error('observer')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            @foreach ($ppis->profesis as $index => $profesiss)
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Profesi</label>
                                    <input type="text" name="profesi[]" value="{{ $profesiss->profesi }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Jumlah</label>
                                    <input type="number" name="jumlah[]" value="{{ $profesiss->jumlah }}" class="form-control" readonly>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="ppi-container">
                            @foreach ($ppis->indikasis as $index => $indikasiss)
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
                                            <input type="number" name="opp[]" value="{{ $indikasiss->opp }}">
                                        </td>
                                        <td>
                                            <input type="number" name="indikasi[]" value="{{ $indikasiss->indikasi }}" class="form-control" list="data_list">
                                            <datalist id="data_list">
                                                <option value="1"></option>
                                                <option value="2"></option>
                                                <option value="3"></option>
                                                <option value="4"></option>
                                                <option value="5"></option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" name="cuci_tangan[]" value="{{ $indikasiss->cuci_tangan }}" class="form-control" list="data_list_cuci">
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
                            @endforeach
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-light" type="button" id="add-ppi-button">Tambah OPP</button>
                        {{-- <button class="btn btn-light" type="button" id="add-resep-button">Tambah resep</button> --}}
                    </form>
                    <script>
                        // Fungsi untuk menghitung jumlah cuci tangan
                        function hitungJumlah() {
                            const cuciTanganFields = document.querySelectorAll('input[name="cuci_tangan[]"]');
                            const jumlahFields = document.querySelectorAll('input[name="jumlah[]"]');
                        
                            // Variabel untuk menghitung total cuci tangan yang bukan "tidak"
                            let totalCuciTangan = 0;
                        
                            // Loop melalui semua input cuci tangan
                            cuciTanganFields.forEach((field) => {
                                // Jika nilai input bukan "tidak", hitung sebagai cuci tangan yang valid
                                if (field.value.toLowerCase() !== "tidak") {
                                    totalCuciTangan++;
                                }
                            });
                        
                            // Perbarui semua input jumlah dengan total cuci tangan yang dihitung
                            jumlahFields.forEach((field) => {
                                field.value = totalCuciTangan; // Isi otomatis nilai jumlah
                            });
                        }
                        
                        // Pasang event listener saat halaman dimuat pertama kali
                        document.addEventListener('DOMContentLoaded', function() {
                            const cuciTanganFields = document.querySelectorAll('input[name="cuci_tangan[]"]');
                        
                            // Hitung jumlah cuci tangan saat halaman pertama kali dimuat
                            hitungJumlah();
                        
                            // Pasang event listener pada semua input cuci_tangan yang sudah ada
                            cuciTanganFields.forEach((field) => {
                                field.addEventListener('change', hitungJumlah);
                            });
                        
                            const addPpiButton = document.getElementById('add-ppi-button');
                            if (addPpiButton) {
                                addPpiButton.addEventListener('click', function(event) {
                                    event.stopImmediatePropagation();
                        
                                    var container = document.getElementById('ppi-container');
                                    var newRow = document.createElement('div');
                                    newRow.className = 'form-row';
                                    newRow.innerHTML = `
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
                                    `;
                                    container.appendChild(newRow);
                        
                                    // Pasang event listener baru untuk input cuci_tangan yang baru ditambahkan
                                    const newCuciTanganField = newRow.querySelector('input[name="cuci_tangan[]"]');
                                    newCuciTanganField.addEventListener('change', hitungJumlah);
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
