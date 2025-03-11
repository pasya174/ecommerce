@extends('website.components.master')
@section('title')

@section('container')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('leaderboard.index') }}">Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="product-area shop-sidebar shop section">
        <div class="container">
            <div class="row table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Total Prices</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <th>{{ $item->updated_at }}</th>
                                <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                <td>{{ format_rupiah($item->total_amount) }}</td>
                                <td>{{ $item->payment_status == true ? 'Accepted' : 'Rejected' }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                        data-target="#{{ $item->payment_status == true ? 'modalDetail' : 'modalPayment' }}{{ $item->id }}">
                                        {{ $item->payment_status == true ? 'Review' : 'Payment' }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @foreach ($data as $item)
        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                                aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="quickview-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Review</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_detail->where('transaction_id', $item->id) as $row)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <th>
                                                        <img src="{{ asset('storage/uploads/images/products') . '/' . $row->image }}"
                                                            alt="" style="max-height: 100px;">
                                                    </th>
                                                    <th>{{ $row->name }}</th>
                                                    <th>{{ $row->price }}</th>
                                                    <th>{{ $row->quantity }}</th>
                                                    <th>
                                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#modalReview{{ $item->id }}">
                                                            Review
                                                        </button>
                                                    </th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_detail as $item)
        <div class="modal fade" id="modalPayment{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                                aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="quickview-content">
                                    <p>Untuk melakukan pembayaran dapat transfer rekening dibawah
                                        028884899390003</p>
                                    <form action="{{ route('order.reorder') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mt-5">
                                            <label for="">Proof of Payment</label>
                                            <input type="number" name="id" value="{{ $item->transaction_id }}"
                                                hidden>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                        <div class="add-to-cart">
                                            <button type="submit" class="btn">Checkout</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_detail as $item)
        <div class="modal fade" id="modalReview{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                class="ti-close" aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="quickview-content">
                                    <form action="{{ route('order.review') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Give a Review</label>
                                            <textarea name="review" class="form-control" id="" cols="30" rows="10"></textarea>
                                            <input type="number" name="id" value="{{ $item->id }}" hidden>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('website.components.modal-footer')
@endsection
@push('head')
    <style>
        .modal-dialog .modal-content {
            margin: 50px 60px;
        }

        @media only screen and (max-width: 991px) {
            .modal-dialog .modal-content {
                margin: 50px 100px;
            }
        }

        @media only screen and (max-width: 768px) {
            .modal-dialog .modal-content {
                margin: 50px 25px;
            }
        }

        .shop.checkout .form .form-group input {
            line-height: 25px !important;
            padding: 7px 20px !important;
        }

        .modal-dialog .modal-content .modal-body {
            max-height: 500px;
        }
    </style>
@endpush
