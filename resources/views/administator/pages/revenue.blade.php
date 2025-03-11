@extends('administator.components.master')
@section('title')
@section('container')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Laporan Pendapatan</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <form id="filter-form" method="get" class="d-flex justify-content-center align-items-center"
                            style="float: right;">
                            <input type="month" class="form-control mr-2 rounded" name="date"
                                value="{{ !empty($filter_date) ? $filter_date : null }}" id="dateInput">
                            <button type="submit" class="btn btn-primary mt-1">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
            <center>
                <div class="row" style="display: inline-block;">
                    <div class="tile_count">
                        <div class="tile_stats_count">
                            <span class="count_top"><i class="fa fa-clock-o"></i> Pendapatan Kotor</span>
                            <div class="count">{{ number_format($pendapatan_kotor) }}</div>
                        </div>
                        <div class="tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Pendapatan Bersih</span>
                            <div class="count green">{{ number_format($pendapatan_bersih) }}</div>
                        </div>
                    </div>

                </div>
            </center>

        </div>
    </div>
@endsection

@push('head-admin')
    <style>
        .tile_count {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            height: 80vh;
        }

        .tile_stats_count {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-width: 150px;
        }

        .count {
            font-size: 24px;
            font-weight: bold;
            white-space: nowrap;
        }
    </style>
@endpush

@push('script-admin')
    <script src="{{ asset('administator/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('administator/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('administator/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('administator/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('administator/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('administator/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('administator/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('administator/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('administator/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('administator/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('administator/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('administator/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('administator/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('administator/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('administator/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('administator/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('administator/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('administator/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('administator/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush

</body>

</html>
