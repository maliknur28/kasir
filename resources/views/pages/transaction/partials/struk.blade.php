<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Transaksi</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">
</head>

<body>

    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-4 m-auto">
                <div class="card struk-print">
                    <div class="card-body">
                        <h3 class="text-center">KASIR</h3>
                        <hr>

                        <p>Nota: {{ $transaction->id }}</p>
                        <p>Waktu: {{ $transaction->time }}</p>
                        <p>Kasir: {{ $transaction->user->name }}</p>
                        <p>Anggota:
                            @if ($transaction->member_id)
                                {{ $transaction->member->name }}
                            @else
                                -
                            @endif
                        </p>
                        <hr>

                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Kuantitas</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactionDetails as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->price }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>{{ $detail->subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <p>Diskon:
                            @if ($transaction->member_id)
                                {{ $transaction->member->discount->total_discount }}
                            @else
                                -
                            @endif
                        </p>
                        <p>Total Harga: {{ $transaction->total_price }}</p>
                        <p>Bayar: {{ $transaction->pay }}</p>
                        <p>Kembali: {{ $transaction->back }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('transaction') }}" class="btn btn-secondary">Kembali</a>
                    <button type="button" class="btn btn-success" id="print">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        function print() {
            const printContents = document.querySelector(".struk-print")[0].outerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        document.querySelector('#print').addEventListener('click', print);
    </script>
</body>

</html>
