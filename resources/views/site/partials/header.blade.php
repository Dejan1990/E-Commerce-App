<header class="section-header">
    <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-wrap">
                        <img class="logo" src="{{ asset('frontend/images/logo-dark.png') }}">
                        <h2 class="logo-text">LOGO</h2>
                    </div>
                    <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-6">
                    <form action="#" class="search-wrap">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- search-wrap .end// -->
                </div>
                <!-- col.// -->
                <div class="col-lg-3 col-sm-6">
                    <div class="widgets-wrap d-flex justify-content-end">
                        <div class="widget-header">
                            <a href="#" class="icontext">
                                <div class="icon-wrap icon-xs bg2 round text-secondary">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="text-wrap">
                                    <small>3 items</small>
                                </div>
                            </a>
                        </div>
                        <!-- widget .// -->
                        @guest
                            <div class="widget-header">
                                <a href="/login" class="ml-3 icontext">
                                    <div class="icon-wrap icon-xs bg-primary round text-white">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="text-wrap">
                                        <span>Login</span>
                                    </div>
                                </a>
                            </div>
                            <div class="widget-header">
                                <a href="/register" class="ml-3 icontext">
                                    <div class="icon-wrap icon-xs bg-success round text-white">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="text-wrap">
                                        <span>Register</span>
                                    </div>
                                </a>
                            </div>
                        @else
                            <ul class="navbar-nav ml-auto">                               
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ auth()->user()->full_name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Orders</a>
                                        <a 
                                            href="{{ route('logout') }}" 
                                            class="dropdown-item" 
                                            onclick="event.preventDefault(); 
                                                document.getElementById('logout-form').submit();"
                                        >
                                            Logout
                                        </a>
                                        <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                        <!-- widget.// -->
                    </div>
                    <!-- widgets-wrap.// -->
                </div>
                <!-- col.// -->
            </div>
            <!-- row.// -->
        </div>
        <!-- container.// -->
    </section>
    <!-- header-main .// -->

    @include('site.partials.nav')

</header>
<!-- section-header.// -->