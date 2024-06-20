@extends('assets.asset')

@section('asset')
    @include('component.navbar')

    @yield('page')
    <div class="container">
        <h4 class="mt-3">@yield('head')</h4>
        @yield('content')
    </div>
@endsection
