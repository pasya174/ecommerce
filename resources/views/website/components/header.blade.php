<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    {{-- <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
                            <li><i class="ti-email"></i> support@ecommerce.com</li>
                        </ul>
                    </div> --}}
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="right-content">
                        <ul class="list-main">
                            @if (!empty(auth()->user()))
                                <li><i class="ti-user"></i> <a href="#">My Poin: {{ auth()->user()->points }}</a>
                                </li>
                            @endif
                            <li><i class="ti-power-off"></i> <a href="#">
                                    <div class="sinlge-bar shopping">
                                        <a href="#" class="single-icon"> <span
                                                class="total-count">{{ !empty(auth()->user()) ? 'Hallo, ' . auth()->user()->username : 'Login' }}</span></a>
                                        @if (empty(auth()->user()))
                                            <div class="shopping-item">
                                                <form action="{{ route('post-login.user') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" id="email" name="email"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="text" id="password" name="password"
                                                            class="form-control">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Login</button>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalRegister">
                                                        Register
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="shopping-item">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-primary">Logout</button>
                                                    </center>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}"
                                alt="logo"></a>
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    @if (!empty(auth()->user()))
                        <div class="right-bar">
                            <div class="sinlge-bar shopping">
                                <a href="#" class="single-icon"><i class="ti-bag"></i> <span
                                        class="total-count">{{ count($cart) }}</span></a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count($cart) }} Items</span>
                                        <a href="{{ route('cart') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @php
                                            $array_total = [];
                                        @endphp
                                        @foreach ($cart as $item)
                                            <li>
                                                <a href="#" class="remove" title="Remove this item"><i
                                                        class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img
                                                        src="{{ asset('storage/uploads/images/products/') . '/' . $item->image }}"
                                                        height="70" width="70" alt="#"></a>
                                                <h4><a href="#">{{ $item->name }}</a></h4>
                                                <p class="quantity">{{ $item->quantity }}x - <span
                                                        class="amount">{{ format_rupiah($item->price) }}</span></p>
                                            </li>
                                            @php
                                                $total = $item->price * $item->quantity;
                                                array_push($array_total, $item->price * $item->quantity);
                                            @endphp
                                        @endforeach
                                    </ul>
                                    @if (!empty($cart[0]))
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span
                                                    class="total-amount">{{ format_rupiah(array_sum($array_total)) }}</span>
                                            </div>
                                            <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
                                        </div>
                                    @endif
                                </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{ $active == 'home' ? 'active' : '' }}"><a
                                                    href="{{ route('home') }}">Home</a></li>
                                            <li class="{{ $active == 'product' ? 'active' : '' }}"><a
                                                    href="{{ route('catalogue') }}">Product</a></li>
                                            <li class="{{ $active == 'cart' ? 'active' : '' }}"><a
                                                    href="{{ route('cart') }}">Cart</a></li>
                                            <li class="{{ $active == 'leaderboard' ? 'active' : '' }}"><a
                                                    href="{{ route('leaderboard.index') }}">Leaderboard</a></li>
                                            @if (!empty(auth()->user()))
                                                <li class="{{ $active == 'order' ? 'active' : '' }}"><a
                                                        href="{{ route('order.index') }}">Order</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
