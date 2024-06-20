@extends('assets.asset')

@section('asset')
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-4 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Selamat Datang</h4>
                        <p class="card-text text-center">Silahkan login terlebih dahulu</p>
                        <form action="{{ route('login.proces') }}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="" />
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <label>Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <label>Password</label>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
