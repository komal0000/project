@extends('front.layout.app')
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
                    <li class="nav-item"><a href="{{ route('newslist') }}" class="nav-link">News</a></li>
                    <li class="nav-item"><a href="{{ route('teamlist') }}" class="nav-link">Commitee</a></li>
                    <li class="nav-item active"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>

                </ul>
            </div>
        </div>
    </nav>
@endsection
@section('header')
    <div class="block-31" style="position: relative;">
        <div class="owl-carousel loop-block-31 ">
            <div class="block-30 block-30-sm item" style="background-image: url('images/bg_2.jpg');"
                data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 text-center">
                            <h2 class="heading">Contact</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-6 pr-md-5">
                    <h2 class="mb-4">
                        Leave Us A Messege
                    </h2>
                    <form action="{{ route('contact') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control px-3 py-3" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control px-3 py-3" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control px-3 py-3" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="" cols="30" rows="7" class="form-control px-3 py-3"
                                placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
                <div class="col-md-6 pr-md-5">
                    <h2 class="mb-4">
                        Contact Details
                    </h2>
                    @includeIf('front.include.address')
                    @includeIf('front.include.map')
                </div>
            </div>
        </div>
    </div>
@endsection
