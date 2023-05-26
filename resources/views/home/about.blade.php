@extends('layout.home')

@section('title', 'About')

@section('content')
    <!-- Intro -->
    <section class="section-wrap intro pb-0">
        <div class="container bg-dark mb-100 border-container">
            <div class="row ">
                <div class="col-sm-12 mb-50 margin-about">
                    <h2 class="intro-heading about-text">about our shop</h2>
                    <p style="text-align:center;line-height:1.6em ; font-size:20px; letter-spacing:1px">{{ $about->deskripsi }}</p>
                </div>
            </div>
        </div>
    </section> <!-- end intro -->

    <!-- Promo Section -->
    {{-- <section class="section-wrap promo-bg" style="background-image:url(/frontend/img/promo_2_bg.jpg);">
        <div class="container text-center">
            <div class="table-box">
                <h2 class="heading-frame white">The best ideas</h2>
            </div>
        </div>
    </section>  --}}
    <!-- end promo section -->

@endsection
