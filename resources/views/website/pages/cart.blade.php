@extends('website.components.master')
@section('title')



    @push('head')
    @endpush

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
                                                    <a href="{{ url('add-quantity' . '/' . $item->id . '/' . 'min') }}"
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
                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-8 col-md-5 col-12">
                                    <div class="left">
                                        <div class="coupon">
                                            <form>
                                                {{-- <input name="point" id="point" max="10" type="number"
                                                    placeholder="Enter Your Poin"> --}}
                                                <select name="point" id="point" class="form-select">
                                                    <option selected hidden>Pilih Discount</option>
                                                    @if ($point_user >= 500 && $point_user < 1000)
                                                        <option value="20">Discount 20%</option>
                                                    @elseif ($point_user >= 1000 && $point_user < 5000)
                                                        <option value="20">Discount 20%</option>
                                                        <option value="30">Discount 30%</option>
                                                    @elseif ($point_user >= 5000)
                                                        <option value="20">Discount 20%</option>
                                                        <option value="30">Discount 30%</option>
                                                        <option value="50">Discount 50%</option>
                                                    @endif
                                                </select>
                                                <button class="btn" type="button" id="submit_point">Apply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Cart Subtotal<span
                                                    id="total_amount">{{ format_rupiah($total_amount) }}</span></li>
                                            <input type="number" value="{{ $point_user }}" id="point_user" hidden>
                                            <li>You Save<span id="point_use">0</span></li>
                                            <li class="last">You Pay<span id="total_price"></span></li>
                                        </ul>
                                        <div class="button5">
                                            <form action="{{ route('cart.store') }}" method="post">
                                                @csrf
                                                <input type="number" name="point_use_checkout" id="point_use_checkout"
                                                    hidden>
                                                <button type="submit" class="btn">Checkout</button>
                                            </form>
                                            <a href="{{ route('catalogue') }}" class="btn">Continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            let point = 0;
            let point_user = parseInt($('#point_user').val())
            $('#total_price').text($('#total_amount').text());

            $(document).ready(function() {

                function formatRupiah(angka, prefix) {
                    var number_string = angka.toString().replace(/[^,\d]/g, ''),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix === undefined ? rupiah : rupiah ? 'Rp ' + rupiah : '';
                }

                $('#submit_point').on('click', function() {
                    point = parseInt($('#point').val());

                    if (point > point_user) {
                        alert('Poin Tidak Cukup')
                        point = point_user;
                        $('#point').val(point)

                    }
                    $('#point_use_checkout').val(point);

                    var totalPriceElement = $('#total_amount');
                    var totalPriceValue = parseFloat(totalPriceElement.text().replace(/\D/g, ''));
                    totalAmount = totalPriceValue
                    $('#point_use').text(formatRupiah(totalPriceValue * (point / 100), 'Rp '))

                    var totalPay = totalAmount - totalPriceValue * (point / 100);

                    $('#total_price').text('Rp ' + totalPay);
                });
            });
        </script>
    @endpush


@endsection
