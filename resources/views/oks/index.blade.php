@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>OK</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> OK</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('oks.index') }}" method="GET" class="d-inline-block">
                        @hasanyrole('petugas1|petugas2|petugas3|petugas4|petugas5|petugas6|petugas7|direktur|karyawan|admin')
                        <form id="bulanForm" action="{{ route('oks.review_bulanan_ok') }}" method="GET" class="d-inline-block">
                            <div class="form-group">
                                <label for="bulan">Pilih Bulan:</label>
                                <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </form>
                        @can('oks.review_bulanan_ok')
                            <form action="{{ route('oks.review_bulanan_ok') }}" method="GET" class="d-inline-block">
                                <button type="submit" class="btn btn-sm btn-primary review-bulanan-btn">
                                    <i class="fa fa-door-open"></i> Laporan Bulanan INM
                                </button>
                            </form>
                        @endcan
                        @can('oks.review_bulanan_ok_imprs')
                            <form action="{{ route('oks.review_bulanan_ok_imprs') }}" method="GET" class="d-inline-block">
                                <button type="submit" class="btn btn-sm btn-primary review-bulanan-btn">
                                    <i class="fa fa-door-open"></i> Laporan Bulanan IMPRS
                                </button>
                            </form>
                        @endcan
                        @can('oks.review_bulanan_ok_unit')
                            <form action="{{ route('oks.review_bulanan_ok_unit') }}" method="GET" class="d-inline-block">
                                <button type="submit" class="btn btn-sm btn-primary review-bulanan-btn">
                                    <i class="fa fa-door-open"></i> Laporan Bulanan UNIT
                                </button>
                            </form>
                        @endcan
                        @endhasanyrole
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($date = $tanggal; $date <= $akhirBulan; $date->addDay())
                                    @php
                                        $hasData = \App\Models\Oks::whereDate('tanggal', $date->format('Y-m-d'))->exists();
                                        $bgColor = $hasData ? 'bg-success text-white' : '';
                                    @endphp
                                    <tr>
                                        <td class="{{ $bgColor }}">{{ $date->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ route('oks.create', ['date' => $date->format('Y-m-d')]) }}" class="btn btn-success">Create</a>
                                            <a href="#" class="btn btn-warning edit-btn" data-date="{{ $date->format('Y-m-d') }}">Edit</a>
                                            {{-- <button class="btn btn-danger delete-btn" data-date="{{ $date->format('Y-m-d') }}">Delete</button> --}}
                                            <a href="#" class="btn btn-info review-btn" data-date="{{ $date->format('Y-m-d') }}">Review</a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const editButtons = document.querySelectorAll('.edit-btn');
                                    const deleteButtons = document.querySelectorAll('.delete-btn');
                                    const reviewButtons = document.querySelectorAll('.review-btn');
                                    const rows = document.querySelectorAll('tbody tr');
                                    editButtons.forEach(button => {
                                        button.addEventListener('click', function (event) {
                                            event.preventDefault();
                                            const date = this.getAttribute('data-date');
                                            fetch(`/oks/${date}/edit`)
                                                .then(response => {
                                                    if (response.status === 404) {
                                                        alert('Data tidak ditemukan');
                                                    } else {
                                                        window.location.href = `/oks/${date}/edit`;
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });
                                        });
                                    });
                                    deleteButtons.forEach(button => {
                                        button.addEventListener('click', function (event) {
                                            event.preventDefault();
                                            const date = this.getAttribute('data-date');
                                            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                                                fetch(`/oks/${date}`, {
                                                    method: 'DELETE',
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                    }
                                                })
                                                .then(response => {
                                                    if (response.status === 404) {
                                                        alert('Data tidak ditemukan');
                                                    } else if (response.status === 200) {
                                                        alert('Data berhasil dihapus');
                                                        location.reload();
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });
                                            }
                                        });
                                    });
                                    reviewButtons.forEach(button => {
                                        button.addEventListener('click', function (event) {
                                            event.preventDefault();
                                            const date = this.getAttribute('data-date');
                                            fetch(`/oks/${date}`)
                                                .then(response => {
                                                    if (response.status === 404) {
                                                        alert('Data tidak ditemukan');
                                                    } else {
                                                        window.location.href = `/oks/${date}`;
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });
                                        });
                                    });
                                    rows.forEach(row => {
                                        const date = row.querySelector('td:first-child').innerText;

                                        fetch(`/oks/check-data/${date}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.hasData) {
                                                    row.classList.add('bg-success', 'text-white');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                            });
                                    });
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
