<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Telkomedika - @yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets-template/images/favicon.ico"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets-template/images/telkomedika-ico.ico" />

    <!-- CSS
	============================================ -->
    <!-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets-template/css/vendor/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets-template/css/vendor/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets-template/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets-template/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="assets-template/css/vendor/cryptocurrency-icons.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets-template/css/plugins/plugins.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="assets-template/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets-template/css/style.css">

    <!-- Custom Style CSS Only For Demo Purpose -->
    <link id="cus-style" rel="stylesheet" href="assets-template/css/style-primary.css">
    @yield('style')

</head>

<body>

    <div class="main-wrapper">
        <!-- Header Section Start -->
        <div class="header-section">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center">

                    <!-- Header Logo (Header Left) Start -->
                    <div class="header-logo col-auto">
                        <a href="#">
                            <div class="row">

                                <img id="logo-laviola-header" src="images/telkomedika.png" alt="" style="width: 64px;">
                                <!-- <h2>D-Rheka</h2> -->
                            </div>
                        </a>
                    </div><!-- Header Logo (Header Left) End -->

                    <!-- Header Right Start -->
                    <div class="header-right flex-grow-1 col-auto">
                        <div class="row justify-content-between align-items-center">

                            <!-- Side Header Toggle & Search Start -->
                            <div class="col-auto">
                                <div class="row align-items-center">

                                    <!--Side Header Toggle-->
                                    <div class="col-auto"><button class="side-header-toggle"><i
                                                class="zmdi zmdi-menu"></i></button></div>

                                    <!--Header Search-->
                                    <div class="col-auto">

                                        <div class="header-search">

                                            <button class="header-search-open d-block d-xl-none"><i
                                                    class="zmdi zmdi-search"></i></button>

                                            <!-- <div class="header-search-form">
                                                <form action="#">
                                                    <input type="text" placeholder="Search Here">
                                                    <button><i class="zmdi zmdi-search"></i></button>
                                                </form>
                                                <button class="header-search-close d-block d-xl-none"><i class="zmdi zmdi-close"></i></button>
                                            </div> -->

                                        </div>
                                    </div>

                                </div>
                            </div><!-- Side Header Toggle & Search End -->

                            <!-- Header Notifications Area Start -->
                            <div class="col-auto">

                                <ul class="header-notification-area">


                                    <!--User-->
                                    <li class="adomx-dropdown col-auto">
                                        <a class="toggle" href="#">
                                            <span class="user">
                                                <span class="name mr-3" id="acc-name">{{ Auth::user()->name }}</span>
                                                <span class="avatar">
                                                    <img src="assets-template/images/profile-pic.jpeg" alt="">
                                                    <span class="status"></span>
                                                </span>
                                            </span>
                                            
                                        </a>
                                        

                                        <!-- Dropdown -->
                                        <div class="adomx-dropdown-menu dropdown-menu-user">
                                            <!-- <div class="head">
                                                <h5 class="name"><a href="#">Madison Howard</a></h5>
                                                <a class="mail" href="#">mailnam@mail.com</a>
                                            </div> -->
                                            <div class="body">
                                                <ul>
                                                    <!-- <li>Masuk sebagai {{ Auth::user()->role }}</li> -->
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                            <i class="zmdi zmdi-lock-open mr-2"> </i>
                                                            {{ __('Log Out') }}
                                                        </x-responsive-nav-link>
                                                    </form>
                                                    <!-- <li><a href="#" id="logout"><i class="zmdi zmdi-lock-open"></i>Sign out</a></li> -->
                                                </ul>
                                                <!-- <ul>
                                                    <li><a href="#"><i class="zmdi zmdi-paypal"></i>Payment</a></li>
                                                    <li><a href="#"><i class="zmdi zmdi-google-pages"></i>Invoice</a>
                                                    </li>
                                                </ul> -->
                                            </div>
                                        </div>

                                    </li>

                                </ul>

                            </div><!-- Header Notifications Area End -->

                        </div>
                    </div><!-- Header Right End -->

                </div>
            </div>
        </div><!-- Header Section End -->
        <!-- Side Header Start -->
        <div class="side-header show">
            <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
            <!-- Side Header Inner Start -->
            <div class="side-header-inner custom-scroll">

                <nav class="side-header-menu" id="side-header-menu">
                    <ul>
                        <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}"><a href="/dashboard"><i
                                    class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="{{ (request()->is('scan')) ? 'active' : '' }}"><a href="/scan"><i
                                    class="zmdi zmdi-scanner"></i> <span>Pindai Pasien</span></a>
                        </li>

                    </ul>
                </nav>
            </div><!-- Side Header Inner End -->
            <div class="ml-3 ">Masuk sebagai {{ Auth::user()->role === 'receptionist' ? 'resepsionis' : 'dokter' }}</div>
        </div><!-- Side Header End -->

        <!-- Content Body Start -->
        @yield('content')
        <div class="spinner-bg"></div>
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
        <!-- Content Body End -->

        <!-- Footer Section Start -->
        <div class="footer-section">
            <div class="container-fluid">

                <div class="footer-copyright text-center">
                    <p class="text-body-light" id="copyright-footer"></p>
                </div>

            </div>
        </div><!-- Footer Section End -->

    </div>
    <script src="assets-template/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets-template/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets-template/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets-template/js/vendor/popper.min.js"></script>
    <script src="assets-template/js/vendor/bootstrap.min.js"></script>
    <script src="assets-template/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets-template/js/plugins/tippy4.min.js.js"></script>
    <script src="assets-template/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function () {

            loadingFalse = () => {
                $('html, body').removeAttr('style');
                $(".spinner").css("display", "none");
                $(".spinner-bg").css("display", "none");
            }

            loadingTrue = () => {
                $('html, body').css({
                    'overflow': 'hidden',
                    'height': '100%',
                    'cursor': 'wait'
                })
                $(".spinner").css("display", "block");
                $(".spinner-bg").css("display", "block");
            }
            // console.log("ready!");

            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
            var currentTime = new Date()

            var yearNow = currentTime.getFullYear();
            $('#copyright-footer').html(`${yearNow} &copy; <b>Capstone Design</b>`);

            function checkCookie() {
                var username = getCookie("name");
                var role = getCookie("role_id");
                if (username != "") {
                    // console.log(username)
                    if (role == 5) {
                        $('#admin').hide()
                        $('#analyzer').hide()
                        $('#report').hide()
                    }
                    $('#acc-name').html(username)
                    // $('#acc-name').html('Naufalia')
                    // alert("Welcome again " + username);
                } else {
                    location.href = '/login'
                }
            }
            // checkCookie();

            $('#logout').click(function () {
                document.cookie = "username=token; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";

                function setCookie(cname, cvalue, exdays) {
                    var d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }
                setCookie('', '', 0);
                location.href = '/login'

            })
        });

    </script>
    @yield('script')

</body>

</html>
