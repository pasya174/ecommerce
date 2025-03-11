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
                            <li class="active"><a href="{{ route('leaderboard.index') }}">Leaderboard</a></li>
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
                            <th scope="col">Name</th>
                            <th scope="col">Point</th>
                            <th scope="col">Badge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->points }}</td>
                                <td>
                                    @if ($item->points < 500)
                                        Perunggu
                                    @elseif ($item->points >= 500 && $item->points < 1000)
                                        Perak
                                    @elseif ($item->points >= 1000 && $item->points < 2000)
                                        Emas
                                    @else
                                        Diamond
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @include('website.components.modal-footer')
@endsection
