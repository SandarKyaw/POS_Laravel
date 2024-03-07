<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    {{-- Font awesome link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                    <h4>Admin Dashboard Panel</h4>
                </form>
                <div class="header-button">

                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                        <img src="{{ asset('image/defaultImage.jpg') }}" alt=""
                                            class="shadow-sm">
                                    @else
                                        <img src="{{ asset('image/female_default.png') }}" alt=""
                                            class="shadow-sm">
                                    @endif
                                @else
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="John Doe" />
                                @endif

                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/defaultImage.jpg') }}" alt=""
                                                        class="shadow-sm rounded-2">
                                                @else
                                                    <img src="{{ asset('image/female_default.png') }}" alt=""
                                                        class="shadow-sm rounded-2">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    alt="John Doe" class="shadow-sm rounded-2"/>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ Auth::user()->name }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="mt-3 pl-4">
                                        <a href="{{ route('account#infoPage') }}" class="px-1 text-dark">
                                            <i class="fa-solid fa-user mr-3"></i>Account</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="mt-3 pl-4">
                                        <a href="{{ route('account#list') }}" class="px-1 text-dark">
                                            <i class="fa-solid fa-user-group  mr-3"></i>Admin List</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="my-3 pl-4">
                                        <a href="{{ route('account#pwChangePage') }}" class="px-1 text-dark">
                                            <i class="fa-solid fa-key mr-3"></i>Change Password</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <div class="my-3 pl-4">
                                            <button type="submit" class="px-1">
                                                <i class="fa-solid fa-power-off mr-3"></i> Log Out
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        <li>
                            <a href="{{ route('category#listPage') }}">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>

                        <li>
                            <a href="{{ route('products#productListPage') }}">
                                <i class="fa-solid fa-pizza-slice"></i>Products</a>
                        </li>

                        <li>
                            <a href="{{ route('order#orderListPage') }}">
                                <i class="fa-solid fa-list-check"></i>Order List</a>
                        </li>

                        <li>
                            <a href="{{ route('user#list') }}">
                                <i class="fa-solid fa-users"></i>User List</a>
                        </li>

                        <li>
                            <a href="{{ route('admin#contactList') }}">
                                <i class="fa-regular fa-clipboard"></i>Messages
                            </a>
                        </li>



                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @yield('content')
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    {{-- jquery cdn link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
@yield('scriptSource')

</html>
<!-- end document-->
