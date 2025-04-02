@extends('layouts.landing')

@section('content')
@php
    $act = 'err';
    $title = 'Too Many Requests';
    $kontak = App\Models\KontakModel::first();
@endphp

<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s" style="height: 650px;">
    <div class="container text-center py-5">
        <div class="row justify-content-center text-white">
            <div class="col-lg-6">
                <i class="bi bi-exclamation-triangle display-1"></i>
                <h1 class="display-1 mt-2 text-white">429</h1>
                <h1 class="mb-4 text-white">Too Many Requests</h1>
                <p class="mb-4">{{ __($exception->getMessage() ?: 'Terdapat kesalahan!') }}</p>
                <a class="btn btn-primary py-3 px-4" href="{{ route('landing.home') }}">Go Back To Home</a>
            </div>
        </div>
    </div>
</div>

@endsection
