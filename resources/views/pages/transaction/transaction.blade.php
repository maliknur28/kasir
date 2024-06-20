@extends('layout.main')

@section('page')

@section('head')
    Transaksi
    <hr>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-8 mt-2">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('transactionDetail.store') }}" method="post" class="row g-2">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">ID Produk</label>
                            <select class="form-select" id="id_product" name="id_product">
                                <option></option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->id }} - {{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kuantitas</label>
                            <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty"
                                name="qty">
                            @error('qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control bg-dark-subtle" id="name" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control bg-dark-subtle" id="price" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Subtotal</label>
                            <input type="number" class="form-control bg-dark-subtle" id="subtotal" name="subtotal" readonly>
                        </div>
                        <div class="col mb-5">
                            <button type="submit" class="btn btn-success float-end">Simpan</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle caption-top">
                            {{-- <caption>Keranjang</caption> --}}
                            <thead class="table-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($transactionDetails as $detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->price }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>{{ $detail->subtotal }}</td>
                                        <td>
                                            <form action="{{ route('transactionDetail.destroy', $detail->id) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin?')"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">Belum terdapat detail transaksi</div>
                                @endforelse
                                <tr>
                                    <td>Jumlah</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        @php
                                            $qty = 0;
                                            foreach ($transactionDetails as $detail) {
                                                $qty += $detail->qty;
                                            }
                                            echo $qty;
                                        @endphp
                                    </td>
                                    <td id="total">
                                        @php
                                            $subtotal = 0;
                                            foreach ($transactionDetails as $detail) {
                                                $subtotal += $detail->subtotal;
                                            }
                                            echo $subtotal;
                                        @endphp
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{ $transactionDetails->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <div class="col-4 mt-2">
            <form action="{{ route('transaction.store') }}" method="post">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Anggota</label>
                            <select class="form-select" id="id_member" name="id_member">
                                <option></option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->id }} - {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Diskon</label>
                            <input type="number" class="form-control bg-dark-subtle" id="discount" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Harga</label>
                            <input type="number" class="form-control bg-dark-subtle" id="total_price" name="total_price" readonly>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Bayar</label>
                            <input type="number" class="form-control" id="pay" name="pay">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kembali</label>
                            <input type="number" class="form-control bg-dark-subtle" id="back" name="back" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    {{-- <div class="col-6">
                        <a href="{{ route('transaction') }}" class="btn btn-secondary w-100">Kembali</a>
                    </div> --}}
                    <div class="col">
                        <button type="submit" class="btn btn-success w-100" id="btnPay">Bayar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@endsection
