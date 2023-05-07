@extends('front.layout.app')
@section('meta')
    @includeIf('admin.setting.template.meta')
@endsection
@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">GiveHope</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('storylist') }}" class="nav-link">Story</a></li>
                    <li class="nav-item"><a href="{{ route('gallery') }}" class="nav-link">Gallery</a></li>
                    <li class="nav-item active"><a href="{{ route('newslist') }}" class="nav-link">News</a></li>
                    <li class="nav-item"><a href="{{ route('teamlist') }}" class="nav-link">Committees</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection
@section('header')
    <div class="block-31" style="position: relative;">
        <div class="owl-carousel loop-block-31 ">
            <div class="block-30 block-30-sm item" style="background-image: url('images/bg_1.jpg');"
                data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center text-center">
                        <div class="col-md-12">
                            <h2 class="heading mb-5">News
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('content')
    @includeIf('front.pages.list.news')
@endsection
