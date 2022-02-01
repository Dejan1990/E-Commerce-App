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
                                    <small>Basket</small>
                                    <span>3 items</span>
                                </div>
                            </a>
                        </div>
                        <!-- widget .// -->
                        <div class="widget-header dropdown">
                            <a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
                                <div class="icon-wrap icon-xs bg2 round text-secondary">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="text-wrap">
                                    <small>Hello.</small>
                                    <span>Login <i class="fa fa-caret-down"></i></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form class="px-4 py-3">
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" placeholder="email@example.com">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </form>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="#">Have account? Sign up</a>
                                <a class="dropdown-item" href="#">Forgot password?</a>
                            </div>
                            <!--  dropdown-menu .// -->
                        </div>
                        <!-- widget  dropdown.// -->
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