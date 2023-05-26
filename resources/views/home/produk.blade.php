@extends('layout.home')

@section('title', 'Products')

@section('content')
    <!-- Single Product -->
    <section class="section-wrap pb-40 single-product">
        <div class="container-fluid semi-fluid">
            <div class="row">

                <div class="col-md-6 col-xs-12 product-slider mb-60">

                    <div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">

                        <div class="gallery-cell">
                            <a href="/uploads/{{ $produk->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $produk->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>

                        {{-- <div class="gallery-cell">
                            <a href="/uploads/{{ $produk->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $produk->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                        <div class="gallery-cell">
                            <a href="/uploads/{{ $produk->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $produk->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                        <div class="gallery-cell">
                            <a href="/uploads/{{ $produk->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $produk->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                        <div class="gallery-cell">
                            <a href="/uploads/{{ $produk->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $produk->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div> --}}

                    </div> 
                    <!-- end gallery main -->

                    {{-- <div class="gallery-thumbs">
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $produk->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $produk->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $produk->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $produk->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $produk->gambar }}" alt="" />
                        </div>
                    </div>  --}}
                    <!-- end gallery thumbs -->

                </div> <!-- end col img slider -->

                <div class="col-md-6 col-xs-12 product-description-wrap">
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a
                                href="/produks/{{ $produk->id_subkategori }}">{{ $produk->subcategory->nama_subkategori }}</a>
                        </li>
                        <li class="active">
                            Catalog
                        </li>
                    </ol>
                    <h1 class="product-title">{{ $produk->nama_barang }}</h1>
                    <span class="price">
                        <ins>
                            <span class="amount">Rp.{{ number_format($produk->harga) }}</span>
                        </ins>
                    </span>
                    <p class="short-description">{{ $produk->deskripsi }}</p>

                    <div class="color-swatches clearfix">
                        <span>Color:</span>
                        @php
                            $colors = explode(',', $produk->warna);
                        @endphp
                        @foreach ($colors as $color)
                            <input type="radio" name="colors" id="{{ $color }}" value="{{ $color }}"
                                class="color">
                            <label for="{{ $color }}" style="margin-right: 15px">{{ $color }}</label>
                        @endforeach
                    </div>

                    <div class="size-options clearfix">
                        <span>Size:</span>
                        @php
                            $sizes = explode(',', $produk->ukuran);
                        @endphp
                        @foreach ($sizes as $size)
                            <input type="radio" name="sizes" id="{{ $size }}" value="{{ $size }}"
                                class="size">
                            <label for="{{ $size }}" style="margin-right: 15px">{{ $size }}</label>
                        @endforeach
                    </div>

                    <div class="product-actions">
                        <span>Qty:</span>

                        <div class="quantity buttons_added">
                            <input type="number" step="1" min="0" value="1" title="Qty"
                                class="input-text qty text jumlah" />
                            <div class="quantity-adjust">
                                <a href="#" class="plus">
                                    <i class="fa fa-angle-up"></i>
                                </a>
                                <a href="#" class="minus">
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </div>
                        </div>

                        <a href="#" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></a>

                    </div>


                    <div class="product_meta">
                        <span class="sku">SKU : <a href="#">{{ $produk->sku }}</a></span>
                        <span class="brand_as">Category : <a
                                href="#">{{ $produk->category->nama_kategori }}</a></span>
                        <span class="posted_in">Tags : <a href="#">{{ $produk->tags }}</a></span>
                    </div>

                    <!-- Accordion -->
                    <div class="panel-group accordion mb-50" id="accordion">
                        <div class="panel">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                    class="minus">Description<span>&nbsp;</span>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body desc-product">
                                    {{ $produk->deskripsi }}
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-heading ">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                    class="plus">Information<span>&nbsp;</span>
                                </a>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body desc-product">
                                    <table class="table shop_attributes">
                                        <tbody>
                                            <tr>
                                                <th>Size:</th>
                                                <td>{{ $produk->ukuran }}</td>
                                            </tr>
                                            <tr>
                                                <th>Colors:</th>
                                                <td>{{ $produk->warna }}</td>
                                            </tr>
                                            <tr>
                                                <th>Fabric:</th>
                                                <td>{{ $produk->bahan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="panel">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                    class="plus">Reviews<span>&nbsp;</span>
                                </a>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="reviews">
                                        <ul class="reviews-list">
                                            <li>
                                                <div class="review-body">
                                                    <div class="review-content">
                                                        <p class="review-author"><strong>Alexander Samokhin</strong> - May
                                                            6, 2014 at 12:48 pm</p>
                                                        <div class="rating">
                                                            <a href="#"></a>
                                                        </div>
                                                        <p>This template is so awesome. I didn’t expect so many features
                                                            inside. E-commerce pages are very useful, you can launch your
                                                            online store in few seconds. I will rate 5 stars.</p>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="review-body">
                                                    <div class="review-content">
                                                        <p class="review-author"><strong>Christopher Robins</strong> - May
                                                            6, 2014 at 12:48 pm</p>
                                                        <div class="rating">
                                                            <a href="#"></a>
                                                        </div>
                                                        <p>This template is so awesome. I didn’t expect so many features
                                                            inside. E-commerce pages are very useful, you can launch your
                                                            online store in few seconds. I will rate 5 stars.</p>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div> <!--  end reviews -->
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <div class="socials-share clearfix">
                        <span>Share:</span>
                        <div class="social-icons nobase">
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-google"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div> --}}
                </div> <!-- end col product description -->
            </div> <!-- end row -->

        </div> <!-- end container -->
    </section> <!-- end single product -->


    <!-- Related Products -->
    <section class="section-wrap pt-0 shop-items-slider">
        <div class="container">
            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    <h2 class="heading bottom-line">
                        Latest Products
                    </h2>
                </div>
            </div>

            <div class="row">

                <div id="owl-related-items" class="owl-carousel owl-theme">

                    @foreach ($latest_produks as $produk)
                        <div class="product">
                            <div class="product-item hover-trigger">
                                <div class="product-img">
                                    <a href="/produk/{{ $produk->id }}">
                                        <img src="/uploads/{{ $produk->gambar }}" alt="">
                                        <img src="/uploads/{{ $produk->gambar }}" alt="" class="back-img">
                                    </a>
                                    {{-- <div class="hover-2">
                                        <div class="product-actions">
                                            <a href="#" class="product-add-to-wishlist">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </div>
                                    </div> --}}
                                    <a href="/produk/{{ $produk->id }}" class="product-quickview">More</a>
                                </div>
                                <div class="product-details">
                                    <h3 class="product-title">
                                        <a href="/produk/{{ $produk->id }}l">{{ $produk->nama_barang }}</a>
                                    </h3>
                                    <span class="category">
                                        <a
                                            href="/produk/{{ $produk->id_subkategori }}">{{ $produk->subcategory->nama_subkategori }}</a>
                                    </span>
                                </div>
                                <span class="price">
                                    <ins>
                                        <span class="amount">Rp.{{ number_format($produk->harga) }}</span>
                                    </ins>
                                </span>
                            </div>
                        </div>
                    @endforeach

                </div> <!-- end slider -->

            </div>
        </div>
    </section> <!-- end related products -->
@endsection

@push('js')
    <script>
        $(function(){
            $('.add-to-cart').click(function(e) {
                e.preventDefault();
    
                const id_member = {{ Auth::guard('webmember')->user()->id }}
                const id_barang = {{ $produk->id }}
                const jumlah = $('.jumlah').val()
                const color = $('.color').val()
                const size = $('.size').val()
                const total = {{ $produk->harga }} * jumlah
                const is_checkout = 0
    
                $.ajax({
                    url: "/add_to_cart",
                    method: "POST",
                    data: {
                        id_member,
                        id_barang,
                        jumlah,
                        size,
                        color,
                        total,
                        is_checkout,
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        window.location.href = '/cart';
                    }
                });
    
            });
        })
    </script>
@endpush
