@extends('front.layout.app')
@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">LoGO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('storylist') }}" class="nav-link">Story</a></li>
                    <li class="nav-item"><a href="{{ route('gallery') }}" class="nav-link">Gallery</a></li>
                    <li class="nav-item"><a href="{{ route('newslist') }}" class="nav-link">News</a></li>
                    <li class="nav-item active"><a href="{{ route('teamlist') }}" class="nav-link">Commitee</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('header')
    <a href="{{ route('teamlist') }}">Team</a>
    /{{ $team->name }}
@endsection
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <div class="team-image">
                        <img src="{{ asset($team->image) }}" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-md-7">
                    <h4>{{ $team->name }}</h4>
                    <h6>{{ $team->designation }}</h6>
                    <div style="word-wrap: break-word">
                        {!! $team->desc !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 class="heading-section">INFORMATION</h3>
                    <ul>
                        <li>
                            <a target="_blank"
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($team->addr) }}">
                                <span class="icon icon-map-marker"></span>
                                <span class="text">{{ $team->addr }}</span>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="tel:{{ $team->phone }}">
                                <span class="icon icon-phone"></span>
                                <span class="text">{{ $team->phone }}</span>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="mailto:{{ $team->email }}">
                                <span class="icon icon-envelope"></span>
                                <span class="text">{{ $team->email }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
