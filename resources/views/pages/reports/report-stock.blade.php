@extends('layout.main')

@section('page')

@section('head')
    Laporan Stok
    <hr>
@endsection

@section('content')
    <form action="{{ route('filter.stock') }}" method="post" class="d-grid">
        @csrf
        <div class="row">
            <div class="col-5 mt-2 mb-2">
                <div class="input-group">
                    <input type="date" name="start_date" class="form-control">
                    <input type="date" name="end_date" class="form-control">
                    <button type="submit" class="input-group-text btn btn-info text-white">Filter</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col mt-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-success" id="print">Cetak</button>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle caption-top" id="table-print">
                            <caption>Data Stok</caption>
                            <thead class="table-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Stok Masuk</th>
                                    <th>Stok Keluar</th>
                                    <th>Total Stok</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($stocks as $stock)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $stock->product->name }}</td>
                                        <td>{{ $stock->stock_in }}</td>
                                        <td>{{ $stock->stock_out }}</td>
                                        <td>{{ $stock->product->stock }}</td>
                                        <td>{{ $stock->updated_at }}</td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">Belum terdapat laporan stok.</div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $stocks->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
