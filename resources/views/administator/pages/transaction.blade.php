@extends('administator.components.master')
@section('title')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Transaction Management</h3>
                </div>

                {{-- <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modalAdd">Add
                            Product</button>
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
                                                <th>Nama Customer</th>
                                                <th>Provinsi</th>
                                                <th>Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                                <th>Detail</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->where('payment_status', false) as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user[0]->username }}</td>
                                                    <td>{{ $item->province }}</td>
                                                    <td>{{ $item->city }}</td>
                                                    <td>{{ $item->kecamatan }}</td>
                                                    <td>{{ $item->kelurahan }}</td>
                                                    <td>{{ $item->user[0]->username }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#modalImage{{ $item->id }}">
                                                            <img src="{{ asset('storage/uploads/images/checkout/') . '/' . $item->proof_of_payment }}"
                                                                alt="" style="height: 250px;">
                                                        </a>
                                                    </td>
                                                    <td><button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                            data-target="#modalDetail{{ $item->id }}"><i
                                                                class="fa fa-info"></i></button>
                                                        <button class="btn btn-outline-success btn-sm" data-toggle="modal"
                                                            data-target="#modalAccept{{ $item->id }}">Accept</button>
                                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                            data-target="#modalReject{{ $item->id }}">Reject</button>
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

    {{-- <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control mt-1" name="name" placeholder="Name"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control mt-1" id="" cols="10" rows="4" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control mt-1" name="price" placeholder="Price" required
                                value="{{ old('price') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="color">Color:</label>
                            <input type="text" class="form-control mt-1" name="color" placeholder="color" required
                                value="{{ old('color') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="stock">Stock:</label>
                            <input type="number" class="form-control mt-1" name="stock" placeholder="stock" required
                                value="{{ old('stock') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image Products:</label>
                            <input type="file" class="form-control mt-1" name="image" placeholder="image" required
                                value="{{ old('image') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id">Category:</label>
                            <select name="category_id" id="category_id" class="custom-select" required>
                                <option selected hidden>Choose category</option>
                                @foreach ($categories as $item)
                                    <option {{ old('category_id') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="size">Size:</label>
                            <select name="size" id="size" class="custom-select" required>
                                <option selected hidden>Choose size</option>
                                <option {{ old('size') == 'm' ? 'selected' : '' }} value="m">M</option>
                                <option {{ old('size') == 'l' ? 'selected' : '' }} value="l">L</option>
                                <option {{ old('size') == 'xl' ? 'selected' : '' }} value="xl">xl</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div> --}}

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
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // dd($data_detail->where('transaction_id', $item->id));
                                    @endphp
                                    @foreach ($data_detail->where('transaction_id', $item->id) as $row)
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
