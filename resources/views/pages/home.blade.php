@extends('layout.main')

@section('page')

@section('head')
    Beranda
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-3 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Petugas</h4>
                    <h5 class="text-center">{{ $users }}</h5>
                </div>
            </div>
        </div>
        <div class="col-3 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Produk</h4>
                    <h5 class="text-center">{{ $products }}</h5>
                </div>
            </div>
        </div>
        <div class="col-3 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Diskon</h4>
                    <h5 class="text-center">{{ $discounts }} %</h5>
                </div>
            </div>
        </div>
        <div class="col-3 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Transaksi</h4>
                    <h5 class="text-center">{{ $transactions }}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
