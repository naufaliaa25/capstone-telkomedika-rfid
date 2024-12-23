<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Telkomedika - Login</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets-template/images/telkomedika-ico.ico" />

    <!-- CSS
	============================================ -->

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

</head>

<body>

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-1 order-lg-2 col-lg-5 col-12">
                        <div class="login-register-form-wrap" style="margin-top: 100px">

                            @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <div class="text-left"> <i class="zmdi zmdi-info"></i> <b>Gagal!</b> <br> Email dan password tidak
                                    ditemukan. <br>Silakan coba lagi.</div>
                            </div>
                            @endif

                            <div class="content mb-50 text-left">
                                <!-- <h1>Masuk</h1> -->
                                <h3>Selamat datang di Telko<span>Medika</span></h3>
                                <p style="font-size: 14px;">Sistem penyimpanan data rekam medis elektronik mahasiswa
                                    Telkom University Bandung</p>
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="login-register-form">
                                @csrf
                                <div class="mb-20"><input id="email" class="form-control" type="email"
                                        placeholder="Email" name="email" :value="old('email')" required></div>
                                <div class="mb-40"><input id="password" class="form-control" type="password"
                                        placeholder="Password" name="password" required></div>
                                <div class="mb-20">
                                    <select id="role" name="role" class="form-control" required>
                                        <option>Masuk sebagai</option>
                                        <option value="receptionist">Resepsionis</option>
                                        <option value="doctor">Dokter</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <button class="button button-primary button-outline">
                                        {{ __('Masuk') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-7 col-12">
                        <div class="column text-center" style="max-width: 570px; margin-top: 70px">
                            <img src="images/telkomedika.png" alt="" width="400px">
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- Content Body End -->

    </div>


    <!-- Global Vendor, plugins & Activation JS -->
    <script src="assets-template/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets-template/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets-template/js/vendor/popper.min.js"></script>
    <script src="assets-template/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="assets-template/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets-template/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets-template/js/main.js"></script>
    <script src="assets-template/js/plugins/sweetalert/sweetalert.min.js"></script>

</body>

<script>
    $('#submit').click(function () {
        $.post('/api/login-admin', {
                email: $('#email').val(),
                password: $('#password').val()
            },
            function (data, status) {

                function setCookie(cname, cvalue, exdays) {
                    var d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }
                setCookie("name", data.data.name, 3);
                setCookie("role_id", data.data.id_role, 3);
                setCookie("user_id", data.data.id, 3);
                location.href = '/dashboard'

            }

        ).fail(function (response) {
            swal({
                title: "Login gagal!",
                text: "Akun tidak ditemukan",
                buttons: {
                    cancel: {
                        text: "Kembali",
                        value: false,
                        visible: true,
                        className: "button button-danger",
                        closeModal: true,
                    }
                }
            })
        })
    })

</script>
<style>
    body {
        background-color: #fee9f2 !important;
    }

</style>

</html>
