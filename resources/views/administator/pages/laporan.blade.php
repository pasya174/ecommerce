@extends('administator.components.master')
@section('title')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Laporan</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <form id="filter-form" method="get" style="float: right;"
                            class="d-flex justify-content-center align-items-center">
                            <input type="date" class="form-control mr-2 rounded" name="date"
                                value="{{ !empty($filter_date) ? $filter_date : null }}" id="dateInput">
                            <button type="submit" class="btn btn-primary mt-1">Filter</button>
                        </form>
                    </div>
                </div>
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
                                                <th>Nama Customer</th>
                                                <th>Provinsi</th>
                                                <th>Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                                <th>Total</th>
                                                <th>Detail</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->where('payment_status', true) as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user[0]->username }}</td>
                                                    <td>{{ $item->province }}</td>
                                                    <td>{{ $item->city }}</td>
                                                    <td>{{ $item->kecamatan }}</td>
                                                    <td>{{ $item->kelurahan }}</td>
                                                    <td>{{ number_format($item->total_amount) }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                                                            data-target="#modalDetail{{ $item->id }}">
                                                            <i class="fa fa-info-circle"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('laporan.print', $item->id) }}"
                                                            class="btn btn-success btn-sm" target="_blank">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                    </td>
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
    </div>
    <!-- /page content -->

    @foreach ($data as $item)
        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-box table-responsive">
                            <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // dd($data_detail->where('transaction_id', $item->id));
                                    @endphp
                                    @foreach ($data_detail->where('transaction_id', $item->id) as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->price }}</td>
                                            <td>{{ $row->size }}</td>
                                            <td>{{ $row->color }}</td>
                                            <td>{{ number_format($row->price) }}</td>
                                            <td>{{ $row->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data as $item)
        <div class="modal fade" id="modalImage{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-box ">
                            <center>
                                <img src="{{ asset('storage/uploads/images/checkout/') . '/' . $item->proof_of_payment }}"
                                    alt="" class="img">
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data as $item)
        <div class="modal fade" id="modalAccept{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div class="flex-start">
                            <p>Accept Order{{ $item->user[0]->username }}?</p>
                        </div>
                        <div class="flex-end">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="card-box d-flex justify-content-center align-items-center">
                            <form action="{{ route('transaction.is-accept') }}" method="post">
                                @csrf
                                <input type="number" value="{{ $item->id }}" name="id" hidden>
                                <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                <button type="submit" class="btn btn-outline-success">Accept</button>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data as $item)
        <div class="modal fade" id="modalReject{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div class="flex-start">
                            <p>Reject Order{{ $item->user[0]->username }}?</p>
                        </div>
                        <div class="flex-end">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="card-box d-flex justify-content-center align-items-center">
                            <form action="{{ route('transaction.is-reject') }}" method="post">
                                @csrf
                                <input type="number" value="{{ $item->id }}" name="id" hidden>
                                <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                <button type="submit" class="btn btn-outline-danger">Reject</button>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach

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
