<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{getConfigValueFormSettingTable('phone_contact')}}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{getConfigValueFormSettingTable('email')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{getConfigValueFormSettingTable('facebooks_links')}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('trang-chu')}}"><img src="{{asset('frontend/images/home/logo.png')}}" alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="{{route('showCheckOut')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="{{route('showCart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @if (Auth::check())
                                <!-- If the user is logged in -->
                                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('developer') || Auth::user()->hasRole('content'))
                                    <!-- Display control panel link for admin, developer, or content roles -->
                                    <li><a href="{{ route('home') }}"><i class="fa fa-cog"></i> Control Panel</a></li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user"></i>{{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <!-- Add links for user profile, settings, etc. -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </li>
                            @else
                                <!-- If the user is a guest -->
                                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    @include('components.main.main_menu')
                </div>
                <div class="col-sm-3">
                    <form method="GET" action="{{ route('products.search') }}">
                    <div class="search_box pull-right">
                        <input type="text" name="keyword" placeholder="Search"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
