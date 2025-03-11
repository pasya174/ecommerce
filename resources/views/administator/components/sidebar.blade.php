<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>E-Commerce</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            {{-- <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div> --}}
            <div class="profile_info d-flex align-items-center">
                <span>Welcome,</span>
                <h2 class="ml-2">{{ auth()->user()->username }}</h2>
            </div>
        </div>

        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('product.index') }}">Products</a></li>
                    <li><a href="{{ route('category.index') }}">Categories</a></li>
                    <li><a href="{{ route('transaction.index') }}">Transaction</a></li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Laporan</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('laporan.index') }}">Laporan</a></li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>History</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('history.index') }}">History</a></li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Layout</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('header.index') }}">Header</a></li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Perbandingan</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('perbandingan.index') }}">Perbandingan</a></li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Revenue</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('revenue.index') }}">Revenue</a></li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>
