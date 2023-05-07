@extends('front.layout.app')
@section('meta')
    @includeIf('admin.setting.template.meta')
@endsection
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
                    <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('storylist') }}" class="nav-link">Story</a></li>
                    <li class="nav-item"><a href="{{ route('gallery') }}" class="nav-link">Gallery</a></li>
                    <li class="nav-item"><a href="{{ route('newslist') }}" class="nav-link">News</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="{{ route('teamlist') }}" class="nav-link">Team</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('header')
    @includeIf('front.pages.template.slider')
@endsection

@section('content')
    @includeIf('front.pages.team.list')
@endsection
