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
                            <li class="active"><a href="{{ route('checkout') }}">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <form class="form" method="post" action="{{ route('checkout.store') }}">
                <div class="row">
                    @csrf
                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Make Your Checkout Here</h2>
                            <p>Please register in order to checkout more quickly</p>
                            <!-- Form -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>First Name<span>*</span></label>
                                        <input type="number" value="{{ $data->id }}" name="id" hidden>
                                        <input type="text" name="first_name"
                                            value="{{ empty(old('first_name')) ? auth()->user()->first_name : old('first_name') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Last Name<span>*</span></label>
                                        <input type="text" name="last_name"
                                            value="{{ empty(old('last_name')) ? auth()->user()->last_name : old('last_name') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email Address<span>*</span></label>
                                        <input type="email" name="email"
                                            value="{{ empty(old('email')) ? auth()->user()->email : old('email') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number<span>*</span></label>
                                        <input type="number" name="phone_number" value="{{ old('phone_number') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Province<span>*</span></label>
                                        <select name="province" id="province" class="form-control" required>
                                            <option selected hidden>Select Province</option>
                                            @foreach ($province as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>City<span>*</span></label>
                                        <select id="city" name="city" class="form-control" disabled required>
                                            <option>Pilih</option>
                                            <!-- Daftar kota akan dimuat di sini -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Kecamatan<span>*</span></label>
                                        <select id="kecamatan" name="kecamatan" class="form-control" disabled required>
                                            <option>Pilih</option>
                                            <!-- Daftar kota akan dimuat di sini -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Kelurahan<span>*</span></label>
                                        <select id="kelurahan" name="kelurahan" class="form-control" disabled required>
                                            <option>Pilih</option>
                                            <!-- Daftar kota akan dimuat di sini -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Address<span>*</span></label>
                                        <input type="text" name="address" value="{{ old('address') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Postal Code<span>*</span></label>
                                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" required>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Form -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>CART TOTALS</h2>
                                <div class="content">
                                    <ul>
                                        <li>Sub Total<span>{{ format_rupiah($total_amount) }}</span></li>
                                        <li>(-) Point
                                            Use<span>{{ format_rupiah(($total_amount * $data->temp_points_used) / 100) }}</span>
                                        </li>
                                        <li class="last">
                                            Total<span>{{ format_rupiah($total_amount - ($total_amount * $data->temp_points_used) / 100) }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Payments</h2>
                                <div class="content">
                                    <div class="checkbox">
                                        <label class="checkbox-inline" for="1"><input name="updates" id="1"
                                                type="checkbox"> Check Payments</label>
                                        <label class="checkbox-inline" for="2"><input name="news" id="2"
                                                type="checkbox"> Cash On Delivery</label>
                                        <label class="checkbox-inline" for="3"><input name="news" id="3"
                                                type="checkbox"> PayPal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <input type="number"
                                            value="{{ $total_amount - ($total_amount * $data->temp_points_used) / 100 }}"
                                            name="total_amount" hidden>
                                        <button type="submit" class="btn">proceed to checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ End Checkout -->

    @push('script')
        <script>
            $(document).on('change', '#province', function() {
                var provinceId = $(this).val();
                var citySelect = $('#city');

                console.log(provinceId)
                citySelect.empty();

                if (provinceId) {
                    $.get('/data/city/' + provinceId, function(data) {
                        $.each(data, function(index, city) {
                            var option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            citySelect.append(option);
                        });

                        citySelect.prop('disabled', false);
                    });
                } else {
                    citySelect.prop('disabled', true);
                }
            });
        </script>
        <script>
            $(document).on('change', '#city', function() {
                var cityId = $(this).val();
                var kecamatanSelect = $('#kecamatan');
                kecamatanSelect.empty();
                if (cityId) {
                    $.get('/data/district/' + cityId, function(data) {
                        $.each(data, function(index, kecamatan) {
                            var option = document.createElement('option');
                            option.value = kecamatan.id;
                            option.textContent = kecamatan.name;
                            kecamatanSelect.append(option);
                        });
                        kecamatanSelect.prop('disabled', false);
                    });
                } else {
                    kecamatanSelect.prop('disabled', true);
                }
            });
        </script>
        <script>
            $(document).on('change', '#kecamatan', function() {
                var kecamatanId = $(this).val();
                var kecamatanSelect = $('#kelurahan');
                kecamatanSelect.empty();
                if (kecamatanId) {
                    $.get('/data/village/' + kecamatanId, function(data) {
                        $.each(data, function(index, city) {
                            var option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            kecamatanSelect.append(option);
                        });
                        kecamatanSelect.prop('disabled', false);
                    });
                } else {
                    kecamatanSelect.prop('disabled', true);
                }
            });
        </script>
    @endpush
@endsection
