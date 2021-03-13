@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('layouts._left')
            </div>
            <div class="col-md-9">
                @yield('body')
            </div>
        </div>
    </div>
@endsection
