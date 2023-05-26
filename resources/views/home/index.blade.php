@extends('layout.home')

@section('content')
    <!-- Hero Slider -->
    <section class="hero-wrap text-center relative">
        <div id="owl-hero" class="owl-carousel owl-theme light-arrows slider-animated">
            @foreach ($sliders as $slider)
                <div class="hero-slide overlay" style="background-image:url(uploads/{{ $slider->gambar }})">
                    <div class="container">
                        <div class="hero-holder">
                            <div class="hero-message">
                                <h1 class="hero-title nocaps">{{ $slider->nama_slider }}</h1>
                                <h2 class="hero-subtitle lines">{{ $slider->deskripsi }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section> <!-- end hero slider -->

    <!-- Promo Banners -->
    <section class="section-wrap promo-banners pb-30" id="promo">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-xs-4 col-xxs-12 mb-30 promo-banner">
                        <a href="#promo">
                            <img src="uploads/{{ $category->gambar }}" alt="">
                            <div class="overlay"></div>
                            <div class="promo-inner valign">
                                <h2>{{ $category->nama_kategori }}</h2>
                                <span>{{ $category->deskripsi }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section> <!-- end promo banners -->


    <!-- Trendy Products -->
    <section class="section-wrap-sm new-arrivals pb-50">
        <div class="container">

            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    <span class="subheading">Hot items of this year</span>
                    <h2 class="heading bottom-line">
                        trendy products
                    </h2>
                </div>
            </div>

            <div class="row items-grid">
                @foreach ($produks as $produk)
                <div class="col-md-3 col-xs-6">
                    <div class="product-item hover-trigger">
                        <div class="product-img">
                            <a href="/frontend/shop-single.html">
                                <img src="uploads/{{$produk->gambar}}" alt="">
                            </a>
                            <div class="hover-overlay">
                                <div class="product-details valign">
                                    <span class="category">
                                        <a href="produks/{{$produk->id_subkategori}}">{{$produk->subcategory->nama_subkategori}}</a>
                                    </span>
                                    <h3 class="product-title">
                                        <a href="produk/{{$produk->id}}">{{$produk->nama_barang}}</a>
                                    </h3>
                                    <span class="price">
                                        <ins>
                                            <span class="amount">Rp.{{number_format($produk->harga)}}</span>
                                        </ins>
                                    </span>
                                    <div class="btn-quickview">
                                        <a href="produk/{{$produk->id}}" class="btn btn-md btn-color">
                                            <span>More</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> <!-- end row -->
        </div>
    </section> <!-- end trendy products -->

    <!-- Testimonials -->
    {{-- <section class="section-wrap relative testimonials bg-parallax overlay"
        style="background-image:url(/frontend/img/testimonials/testimonial_bg.jpg);">
        <div class="container relative">

            <div class="row heading-row mb-20">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2 class="heading white bottom-line">Happy Clients</h2>
                </div>
            </div>

            <div id="owl-testimonials" class="owl-carousel owl-theme text-center">
                @foreach ($testimonies as $testimoni)
                    <div class="item">
                        <div class="testimonial">
                            <p class="testimonial-text">{{$testimoni->deskripsi}}</p>
                            <span>{{$testimoni->nama_testimoni}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>  --}}
    <!-- end testimonials -->

@endsection
