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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->where('payment_status', true) as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user[0]->username }}</td>
                                                    <td>
                                                        <a href="{{ route('history.detail', $item->user_id) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fa fa-info-circle"></i>
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
