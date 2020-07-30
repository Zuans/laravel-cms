@extends('layouts.app')

@section('title','Dashboard')

@section('style')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-2">
        @include('layouts.navside')
    </div>
    <div class="col-lg-10">
        <div class="container p-2">
            <div class="container-wrapper">
                <h1>Your Info</h1>
                <hr style="border: 1.7px solid gray;" class="text-dark w-100">
                <div class="row mt-5 pt-2">
                    <div class="col-lg-6">
                        <div class="card bg-dark text-white px-2 mt-3  mx-auto" style="width: 23rem;">
                            <div class="card-body">
                                <h3 class="card-title">Welcome <strong>{{ Auth::user()->name }}</strong></h3>
                                <p class="card-text">Selamat Datang <strong>{{ Auth::user()->name }}</strong> Di Website kami Zuans Post's </p>
                                <br>
                                <p class="card-text">Email Kamu : <strong>{{ Auth::user()->email }}</strong></p>
                                <p class="card-text">Dibuat : <strong>{{ Auth::user()->created_at->diffForHumans() }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('img/hi.jpg') }}" class="img-welcome w-100 mx-auto" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection