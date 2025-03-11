@extends('administator.components.master')
@section('title')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Perbandingan</h3>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xl-6 col-sm-12">
                                <p>Transaksi Lama</p>
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered bulk_action" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Customer</th>
                                                <th>Provinsi</th>
                                                <th>Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_old as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user[0]->username }}</td>
                                                    <td>{{ $item->province }}</td>
                                                    <td>{{ $item->city }}</td>
                                                    <td>{{ $item->kecamatan }}</td>
                                                    <td>{{ $item->kelurahan }}</td>
                                                    <td>
                                                        <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                            data-target="#modalDetail{{ $item->id }}"><i
                                                                class="fa fa-info"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12">
                                <p>Transaksi Baru</p>
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered bulk_action" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Customer</th>
                                                <th>Provinsi</th>
                                                <th>Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_now as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user[0]->username }}</td>
                                                    <td>{{ $item->province }}</td>
                                                    <td>{{ $item->city }}</td>
                                                    <td>{{ $item->kecamatan }}</td>
                                                    <td>{{ $item->kelurahan }}</td>
                                                    <td>
                                                        <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                            data-target="#modalDetail{{ $item->id }}"><i
                                                                class="fa fa-info"></i></button>
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
    <!-- /page content -->


    @foreach ($data_now as $item)
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
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_detail_now->where('transaction_id', $item->id) as $row)
                                        <tr>
                                            {{-- <td>pokkeke</td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->price }}</td>
                                            <td>{{ $row->size }}</td>
                                            <td>{{ $row->color }}</td>
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

    @foreach ($data_old as $item)
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
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_detail_old->where('transaction_id', $item->id) as $row)
                                        <tr>
                                            {{-- <td>pokkeke</td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->price }}</td>
                                            <td>{{ $row->size }}</td>
                                            <td>{{ $row->color }}</td>
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
