@extends('layout.main')

@section('page')

@section('head')
    Diskon
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col mt-2 mb-3">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle caption-top">
                            <caption>Data Diskon</caption>
                            <thead class="table-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>Minimal Transaksi</th>
                                    <th>Total Diskon (%)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($discounts as $discount)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $discount->minimum_purchase }}</td>
                                        <td>{{ $discount->total_discount }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $discount->id }}"><i
                                                    class="bi bi-pencil"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($discounts as $discount)
        <div class="modal fade" id="modalEdit{{ $discount->id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Atur Diskon
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('discount.update', $discount->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Minimal Transaksi</label>
                                <input type="number" class="form-control" name="minimum_purchase"
                                    value="{{ $discount->minimum_purchase }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Diskon</label>
                                <input type="number" class="form-control" name="total_discount"
                                    value="{{ $discount->total_discount }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">Atur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@endsection
