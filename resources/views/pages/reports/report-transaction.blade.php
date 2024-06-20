@extends('layout.main')

@section('page')

@section('head')
    Laporan Transaksi
    <hr>
@endsection

@section('content')
    <form action="{{ route('filter.transaction') }}" method="post" class="d-grid">
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
                        <table class="table table-hover align-middle caption-top">
                            <caption>Data Transaksi</caption>
                            <thead class="table-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>Nota</th>
                                    <th>Waktu</th>
                                    <th>Petugas</th>
                                    <th>Anggota</th>
                                    <th>Diskon</th>
                                    <th>Total Harga</th>
                                    <th>Bayar</th>
                                    <th>Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->time }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>
                                            @if ($transaction->member_id)
                                                {{ $transaction->member->name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->member_id)
                                                {{ $transaction->member->discount->total_discount }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $transaction->total_price }}</td>
                                        <td>{{ $transaction->pay }}</td>
                                        <td>{{ $transaction->back }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modalDetail{{ $transaction->id }}"><i
                                                    class="bi bi-eye"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">Belum terdapat data transaksi</div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @foreach ($transactions as $transaction)
        <div class="modal fade" id="modalDetail{{ $transaction->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Detail Transaksi
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-print">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Nota</th>
                                        <th>Waktu</th>
                                        <th>Petugas</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Kuantitas</th>
                                        <th>Subtotal</th>
                                        <th>Anggota</th>
                                        <th>Diskon</th>
                                        <th>Total Harga</th>
                                        <th>Bayar</th>
                                        <th>Kembali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->time }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->transactionDetail->product->name }}</td>
                                        <td>{{ $transaction->transactionDetail->product->price }}</td>
                                        <td>{{ $transaction->transactionDetail->qty }}</td>
                                        <td>{{ $transaction->transactionDetail->subtotal }}</td>
                                        <td>
                                            @if ($transaction->member)
                                                {{ $transaction->member->name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->member)
                                                {{ $transaction->member->discount->total_discount }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $transaction->total_price }}</td>
                                        <td>{{ $transaction->pay }}</td>
                                        <td>{{ $transaction->back }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@endsection

