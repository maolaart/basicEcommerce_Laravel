@extends('layout.home')

@section('title','List Products')

@section('content')
       <!-- Catalogue -->
       <section class="section-wrap pt-80 pb-40 catalogue">
        <div class="container relative">

          <!-- Filter -->          
          <div class="shop-filter">
            <div class="view-mode hidden-xs">
              <span>View:</span>
              <a class="grid grid-active" id="grid"></a>
              <a class="list" id="list"></a>
            </div>
            <div class="filter-show hidden-xs">
              <span>Show:</span>
              <a href="#" class="active">12</a>
              <a href="#">24</a>
              <a href="#">all</a>
            </div>
            {{-- selecting --}}
            {{-- <form class="ecommerce-ordering">
              <select>
                <option value="default-sorting">Default Sorting</option>
                <option value="price-low-to-high">Price: high to low</option>
                <option value="price-high-to-low">Price: low to high</option>
                <option value="date">By Newness</option>
              </select>
            </form> --}}
          </div>

          <div class="row">
            <div class="col-md-12 catalogue-col right mb-50">
              <div class="shop-catalogue grid-view">

                <div class="row items-grid">

                  @foreach ($produks as $produk)
                  <div class="col-md-4 col-xs-6 product product-grid">
                    <div class="product-item clearfix">
                      <div class="product-img hover-trigger">
                        <a href="/produk/{{$produk->id}}">
                          <img src="/uploads/{{$produk->gambar}}" alt="">
                          <img src="/uploads/{{$produk->gambar}}" alt="" class="back-img">
                        </a>
                        {{-- <div class="hover-2">                    
                          <div class="product-actions">
                            <a href="#" class="product-add-to-wishlist">
                              <i class="fa fa-heart"></i>
                            </a>
                          </div>                        
                        </div> --}}
                        <a href="/produk/{{$produk->id}}" class="product-quickview">More</a>
                      </div>

                      <div class="product-details">
                        <h3 class="product-title">
                          <a href="/produk/{{ $produk->id }}l">{{ $produk->nama_barang }}</a>
                        </h3>
                        <span class="category">
                          <a href="/produk/{{$produk->id_subkategori}}">{{$produk->subcategory->nama_subkategori}}</a>
                        </span>
                      </div>

                      <span class="price">
                        <ins>
                          <span class="amount">Rp.{{number_format($produk->harga)}}</span>
                        </ins>                        
                      </span>

                      <div class="product-description">
                        <h3 class="product-title">
                          <a href="/produk/{{ $produk->id }}l">{{ $produk->nama_barang }}</a>
                        </h3>
                        <span class="price">
                          <ins>
                            <span class="amount">Rp.{{number_format($produk->harga)}}</span>
                          </ins>                        
                        </span>
                        {{-- <span class="rating">
                          <a href="#">3 Reviews</a>
                        </span> --}}
                        <div class="clear"></div>
                        <p>{{$produk->deskripsi}}</p>
                        <a href="/produk/{{$produk->id}}" class="btn btn-dark btn-md left"><span>Add to Cart</span></a>
                        {{-- <div class="product-add-to-wishlist">
                          <a href="#"><i class="fa fa-heart"></i></a>
                        </div> --}}
                      </div>                      

                    </div>
                  </div> <!-- end product -->
                  @endforeach

                </div> <!-- end row -->
              </div> <!-- end grid mode -->
              
              <!-- Pagination -->
              <div class="pagination-wrap clearfix">
                <p class="result-count">Showing: 12 of 80 results</p>                 
                <nav class="pagination right clearfix">
                  <a href="#"><i class="fa fa-angle-left"></i></a>
                  <span class="page-numbers current">1</span>
                  <a href="#">2</a>
                  <a href="#">3</a>
                  <a href="#">4</a>
                  <a href="#"><i class="fa fa-angle-right"></i></a>
                </nav>
              </div>

            </div> <!-- end col -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end catalog -->
@endsection
