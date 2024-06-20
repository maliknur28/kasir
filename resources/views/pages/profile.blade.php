@extends('layout.main')

@section('page')

@section('head')
    Profil
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col mt-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ Auth::user()->phone }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" value="{{ Auth::user()->username }}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Peran</label>
                                    <input type="text" class="form-control bg-dark-subtle" value="{{ Auth::user()->role }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control bg-dark-subtle" value="{{ Auth::user()->status }}" readonly>
                                </div>
                                <div class="float-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
