@extends('website.components.master')
@section('title')

@section('container')
    <!-- Slider Area -->
    <section class="hero-slider">
        <!-- Single Slider -->
        <div class="single-slider">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-9 offset-lg-3 col-12">
                        <div class="text-inner">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <div class="hero-text">
                                        <h1>Happy</h1>
                                        <p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find
                                            it
                                            pereri <br> odiy maboriosm.</p>
                                        <div class="button">
                                            <a href="{{ route('catalogue') }}" class="btn">Shop Now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Single Slider -->
    </section>
    <!--/ End Slider Area -->

    <!-- Start Small Banner  -->
    <section class="small-banner section">
        <div class="container-fluid">
            <div class="row">
                @foreach ($header as $item)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-banner">
                            <img src="{{ asset('storage/uploads/images/headers') . '/' . $item->image }}" alt=""
                                style="width: 455px; height: 300px;">
                            <div class="content">
                                <h3>{{ $item->name }}</h3>
                                <a href="{{ route('catalogue') }}">Discover Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- End Small Banner -->

    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all"
                                        role="tab">All Products</a></li>
                                @foreach ($categories as $item)
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#{{ $item->name }}"
                                            role="tab">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @foreach ($products_all as $row)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <a href="javascript:void">
                                                            <img class="default-img"
                                                                src="{{ asset('storage/uploads/images/products/') . '/' . $row->image }}"
                                                                alt="#" style="width: 230px; height: 250px;">
                                                            <img class="hover-img"
                                                                src="{{ asset('storage/uploads/images/products/') . '/' . $row->image }}"
                                                                alt="#" style="width: 230px; height: 250px;">
                                                        </a>
                                                        <div class="button-head">
                                                            <div class="product-action">
                                                                <a data-toggle="modal"
                                                                    data-target="#modalDetail{{ $row->product[0]->id }}"
                                                                    title="Quick View" href="#"><i
                                                                        class=" ti-eye"></i><span>Quick Shop</span></a>
                                                            </div>
                                                            <div class="product-action-2">
                                                                <a data-toggle="modal"
                                                                    data-target="#modalDetail{{ $row->product[0]->id }}"
                                                                    title="Add to cart" href="#">Add to Cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="javascript:void">{{ $row->product[0]->name }}</a>
                                                        </h3>
                                                        <div class="product-price">
                                                            <span>{{ format_rupiah($row->product[0]->price) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @foreach ($categories as $item)
                                <div class="tab-pane fade show" id="{{ $item->name }}" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="row">
                                            @foreach ($products->where('category_id', $item->id) as $row)
                                                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <a href="javascript:void">
                                                                <img class="default-img"
                                                                    src="{{ asset('storage/uploads/images/products/') . '/' . $row->image }}"
                                                                    alt="#" style="width: 230px; height: 250px;">
                                                                <img class="hover-img"
                                                                    src="{{ asset('storage/uploads/images/products/') . '/' . $row->image }}"
                                                                    alt="#" style="width: 230px; height: 250px;">
                                                            </a>
                                                            <div class="button-head">
                                                                <div class="product-action">
                                                                    <a data-toggle="modal"
                                                                        data-target="#modalDetail{{ $row->product[0]->id }}"
                                                                        title="Quick View" href="#"><i
                                                                            class=" ti-eye"></i><span>Quick Shop</span></a>
                                                                </div>
                                                                <div class="product-action-2">
                                                                    <a data-toggle="modal"
                                                                        data-target="#modalDetail{{ $row->product[0]->id }}"
                                                                        title="Add to cart" href="#">Add to Cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <h3><a href="javascript:void">{{ $row->product[0]->name }}</a>
                                                            </h3>
                                                            <div class="product-price">
                                                                <span>{{ format_rupiah($row->product[0]->price) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->
    @include('website.components.modal-footer')
@endsection
