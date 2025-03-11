@extends('administator.components.master')
@section('title')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>History</h3>
                </div>

                {{-- <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <form id="filter-form" method="get" style="float: right;"
                            class="d-flex justify-content-center align-items-center">
                            <input type="date" class="form-control mr-2 rounded" name="date"
                                value="{{ !empty($filter_date) ? $filter_date : null }}" id="dateInput">
                            <button type="submit" class="btn btn-primary mt-1">Filter</button>
                        </form>
                    </div>
                </div> --}}
            </div>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Price</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->product_details[0]->product[0]->name }}</td>
                                                    <td>{{ number_format($item->product_details[0]->product[0]->price) }}
                                                    </td>
                                                    <td>{{ $item->product_details[0]->size }}</td>
                                                    <td>{{ $item->product_details[0]->color }}</td>
                                                    <td>{{ $item->quantity }}</td>
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
    </div>
    <!-- /page content -->

@endsection

@push('head-admin')
    <style>
        .img {
            max-width: 750px;
        }

        @media only screen and (max-width: 991px) {
            .img {
                max-width: 450px;
            }
        }

        @media only screen and (max-width: 500px) {
            .img {
                max-width: 450px;
            }
        }
    </style>
@endpush

@include('administator.scripts.datatables')
