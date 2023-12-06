@extends('administator.components.master')
@section('title')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Products Management</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modalAdd">Add
                            Product</button>
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
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td><button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                            data-target="#modalDetail{{ $item->id }}"><i
                                                                class="fa fa-info"></i></button>
                                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                            data-target="#modalDelete{{ $item->id }}"><i
                                                                class="fa fa-trash"></i></button>
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

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    </div>

    @foreach ($data as $item)
        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div class="flex-start">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h5>
                        </div>
                        <div class="flex-end">
                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                data-target="#modalAddDetail{{ $item->id }}"><i class="fa fa-plus"></i></button>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
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
                                        <th>Description</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_detail->where('product_id', $item->id) as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->product[0]->name }}</td>
                                            <td>{{ $row->product[0]->price }}</td>
                                            <td>{{ $row->product[0]->description }}</td>
                                            <td>{{ $row->size }}</td>
                                            <td>{{ $row->color }}</td>
                                            <td>{{ $row->stock }}</td>
                                            <td>
                                                <button class="btn btn-outline-warning btn-sm" data-toggle="modal"
                                                    data-target="#modalEdit{{ $row->id }}"><i
                                                        class="fa fa-edit"></i></button>
                                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                    data-target="#modalDetailDelete{{ $row->id }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
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
        <div class="modal fade" id="modalAddDetail{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Detail Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.add-detail') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name:</label>
                                <input type="text" name="id" value="{{ $item->id }}" hidden readonly>
                                <input type="text" class="form-control mt-1" name="name" placeholder="Name"
                                    value="{{ $item->name }}" required readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control mt-1" id="" cols="10" rows="4" required
                                    readonly>{{ $item->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control mt-1" name="price" placeholder="Price"
                                    required value="{{ $item->price }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="color">Color:</label>
                                <input type="text" class="form-control mt-1" name="color" placeholder="color"
                                    required value="{{ old('color') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="stock">Stock:</label>
                                <input type="number" class="form-control mt-1" name="stock" placeholder="stock"
                                    required value="{{ old('stock') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Image Products:</label>
                                <input type="file" class="form-control mt-1" name="image" placeholder="image"
                                    required value="{{ old('image') }}">
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
                                    <option {{ old('size') == 'xl' ? 'selected' : '' }} value="xl">XL</option>
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
        </div>
    @endforeach

    @foreach ($data_detail as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name:</label>
                                <input type="text" name="id" value="{{ $item->id }}" hidden>
                                <input type="text" class="form-control mt-1" name="name" placeholder="Name"
                                    value="{{ $item->product[0]->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control mt-1" id="" cols="10" rows="4" required>{{ $item->product[0]->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control mt-1" name="price" placeholder="Price"
                                    required value="{{ $item->product[0]->price }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="color">Color:</label>
                                <input type="text" class="form-control mt-1" name="color" placeholder="color"
                                    required value="{{ $item->color }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="stock">Stock:</label>
                                <input type="number" class="form-control mt-1" name="stock" placeholder="stock"
                                    required value="{{ $item->stock }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="image_product">Image Products:</label>
                                <input type="file" class="form-control mt-1" name="image_product" placeholder="image"
                                    required value="{{ old('image_product') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="category_id">Category:</label>
                                <select name="category_id" id="category_id" class="custom-select" required>
                                    <option selected hidden>Choose category</option>
                                    @foreach ($categories as $row)
                                        <option {{ $item->category_id == $row->id ? 'selected' : '' }}
                                            value="{{ $row->id }}">{{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="size">Size:</label>
                                <select name="size" id="size" class="custom-select" required>
                                    <option selected hidden>Choose size</option>
                                    <option {{ $item->size == 'm' ? 'selected' : '' }} value="m">M</option>
                                    <option {{ $item->size == 'l' ? 'selected' : '' }} value="l">L</option>
                                    <option {{ $item->size == 'xl' ? 'selected' : '' }} value="xl">XL</option>
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
        </div>
    @endforeach

    @foreach ($data as $item)
        <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete details Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.delete') }}" method="post">
                            @csrf
                            <input type="text" name="id" value="{{ $item->id }}" hidden>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_detail as $item)
        <div class="modal fade" id="modalDetailDelete{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete details Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product-detail.delete') }}" method="post">
                            @csrf
                            <input type="text" name="id" value="{{ $item->id }}" hidden>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection

@include('administator.scripts.datatables')
