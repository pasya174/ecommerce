@foreach ($products_modal as $item)
    <div class="modal fade" id="modalDetail{{ $item->product[0]->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                            aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    @foreach ($products_modal->where('product_id', $item->product[0]->id) as $row)
                                        <div class="single-slider">
                                            <img src="{{ asset('storage/uploads/images/products/') . '/' . $row->image }}"
                                                style="width: 450px; height: 510px;" alt="#">
                                        </div>
                                    @endforeach
                                    <div class="single-slider">
                                        <img src="https://img.freepik.com/free-vector/hand-drawn-scarf-logo-design_23-2149502576.jpg"
                                            alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <form action="{{ route('add-cart') }}" method="post">
                                @csrf
                                <div class="quickview-content">
                                    <input type="text" name="product_details_id" value="{{ $item->id }}" hidden>
                                    <h2>{{ $item->product[0]->name }}</h2>
                                    <h3>{{ format_rupiah($item->product[0]->price) }}</h3>
                                    <div class="quickview-peragraph">
                                        <p>{{ $item->product[0]->description }}</p>
                                    </div>
                                    <div class="size">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <h5 class="title">Size</h5>
                                                <select name="size">
                                                    @foreach ($products_modal->where('product_id', $item->product[0]->id)->groupBy('size') as $row)
                                                        <option value="{{ $row[0]->size }}">{{ $row[0]->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <h5 class="title">Color</h5>
                                                <select name="color">
                                                    @foreach ($products_modal->where('product_id', $item->product[0]->id)->groupBy('color') as $row)
                                                        <option value="{{ $row[0]->color }}">{{ $row[0]->color }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quantity">
                                        <!-- Input Order -->
                                        <div class="input-group">
                                            {{-- <div class="button minus">
                                                <button type="button" class="btn btn-primary btn-number"
                                                    disabled="disabled" data-type="minus" data-field="quant[1]">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div> --}}
                                            <input type="number" name="quantity" class="input-number" data-min="1"
                                                data-max="1000" value="1">
                                            {{-- <div class="button plus">
                                                <button type="button" class="btn btn-primary btn-number"
                                                    data-type="plus" data-field="quant[1]">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </div> --}}
                                        </div>
                                        <!--/ End Input Order -->
                                    </div>
                                    <div class="add-to-cart">
                                        <button type="submit" class="btn">Add to cart</button>
                                    </div>
                                </div>
                            </form>
                            @foreach ($product_review->where('product_id', $item->product[0]->id) as $row)
                                <div class="reviews-members pt-4 pb-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="reviews-members-header">
                                                <h6 class="mb-1"><a class="text-black"
                                                        href="#">{{ $row->username }}</a>
                                                </h6>
                                            </div>
                                            <div class="reviews-members-body">
                                                <p>{{ $row->review }}</p>
                                            </div>
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
@endforeach

<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ti-close" aria-hidden="true"></span>
                </button>
            </div>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="quickview-content">
                        <h2>Register</h2>
                        <div class="from-group mt-4 mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="from-group mt-4 mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name">
                        </div>
                        <div class="from-group mt-4 mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="from-group mt-4 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="from-group mt-4">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn">Add to cart</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('head')
    <style>
        .reviews-members .media .mr-3 {
            width: 56px;
            height: 56px;
            object-fit: cover;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        .total-like-user {
            border: 2px solid #fff;
            height: 34px;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
            width: 34px;
        }

        .total-like-user-main a {
            display: inline-block;
            margin: 0 -17px 0 0;
        }

        .total-like {
            border: 1px solid;
            border-radius: 50px;
            display: inline-block;
            font-weight: 500;
            height: 34px;
            line-height: 33px;
            padding: 0 13px;
            vertical-align: top;
        }

        .restaurant-detailed-ratings-and-reviews hr {
            margin: 0 -24px;
        }

        .graph-star-rating-header .star-rating {
            font-size: 17px;
        }

        .progress {
            background: #f2f4f8 none repeat scroll 0 0;
            border-radius: 0;
            height: 30px;
        }

        .rating-list {
            display: inline-flex;
            margin-bottom: 15px;
            width: 100%;
        }

        .rating-list-left {
            height: 16px;
            line-height: 29px;
            width: 10%;
        }

        .rating-list-center {
            width: 80%;
        }

        .rating-list-right {
            line-height: 29px;
            text-align: right;
            width: 10%;
        }

        .restaurant-slider-pics {
            bottom: 0;
            font-size: 12px;
            left: 0;
            z-index: 999;
            padding: 0 10px;
        }

        .restaurant-slider-view-all {
            bottom: 15px;
            right: 15px;
            z-index: 999;
        }

        .progress {
            background: #f2f4f8 none repeat scroll 0 0;
            border-radius: 0;
            height: 30px;
        }
    </style>
@endpush
