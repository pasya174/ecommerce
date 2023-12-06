@extends('website.components.master')
@section('title')

@section('container')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('catalogue') }}">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            @if (!empty($cart[0]))
                <div class="row">
                    <div class="col-12">
                        <!-- Shopping Summery -->
                        <table class="table shopping-summery">
                            <thead>
                                <tr class="main-hading">
                                    <th>PRODUCT</th>
                                    <th>NAME</th>
                                    <th class="text-center">UNIT PRICE</th>
                                    <th class="text-center">QUANTITY</th>
                                    <th class="text-center">TOTAL</th>
                                    <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td class="image" data-title="No"><img
                                                src="{{ asset('storage/uploads/images/products') . '/' . $item->image }}"
                                                alt="#"></td>
                                        <td class="product-des" data-title="Description">
                                            <p class="product-name"><a href="#">{{ $item->name }}</a></p>
                                            <p class="product-des">{{ $item->description }}</p>
                                        </td>
                                        <td class="price" data-title="Price"><span>{{ format_rupiah($item->price) }}</span>
                                        </td>
                                        <td class="qty" data-title="Qty">
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <a href="{{ url('add-quantity' . '/' . $item->id . '/' . 'plus') }}"
                                                        class="btn btn-primary">
                                                        <i class="ti-minus" style="margin-left: 20px;"></i>
                                                    </a>
                                                </div>
                                                <input type="text" name="quantity" id="quantity" class="input-number"
                                                    data-max="100" value="{{ $item->quantity }}">
                                                <div class="button plus">
                                                    <a href="{{ url('add-quantity' . '/' . $item->id . '/' . 'plus') }}"
                                                        class="btn btn-primary">
                                                        <i class="ti-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-amount" data-title="Total"><span
                                                id="price">{{ format_rupiah($item->price * $item->quantity) }}</span>
                                        </td>
                                        <td class="action" data-title="Remove"><a
                                                href="{{ route('delete-detail', $item->id) }}"><i
                                                    class="ti-trash remove-icon"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--/ End Shopping Summery -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Total Amount -->
                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-8 col-md-5 col-12">
                                    <div class="left">
                                        <div class="coupon">
                                            <form action="#" target="_blank">
                                                <input name="Coupon" placeholder="Enter Your Poin">
                                                <button class="btn">Apply</button>
                                            </form>
                                        </div>
                                        {{-- <div class="checkbox">
                                        <label class="checkbox-inline" for="2"><input name="news"
                                                id="2" type="checkbox"> Shipping (+10$)</label>
                                    </div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Cart Subtotal<span>$330.00</span></li>
                                            <li>Shipping<span>Free</span></li>
                                            <li>You Save<span>$20.00</span></li>
                                            <li class="last">You Pay<span>$310.00</span></li>
                                        </ul>
                                        <div class="button5">
                                            <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                            <a href="{{ route('catalogue') }}" class="btn">Continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ End Total Amount -->
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <p>Data Not Found</p>
                </div>
            @endif

        </div>
    </div>

    @push('script')
        <script>
            let quantity = $('#quantity').val()
            // alert(quantity)
        </script>
    @endpush


@endsection
