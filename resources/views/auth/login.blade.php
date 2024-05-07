<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0C041C">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="icon" href="{{ asset('img/baru.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- start preloader -->
    <div class="preloader" id="preloader"></div>
    <!-- end preloader -->

    <!-- Login Reg In start -->
    <section id="login-reg">
        <div class="overlay pb-120" style="padding-top: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 100vh;
">
            <div class="container">
                <div class="top-area">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="/">
                                <img src="img/logo.png" alt="image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row pt-120 d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="login-reg-main text-center">
                            <h4>Login Aplikasi</h4>
                            <div class="form-area">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    @include('layouts.alert-flash-message')
                                    <div class="form-group">
                                        <label>Nomor Induk</label>
                                        <input placeholder="Ketikan Nomor Induk" type="text" name="no_induk">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 30px;">
                                        <label>Password</label>
                                        <input placeholder="Ketikan Password" type="password" name="password">

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="cmn-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Reg In end -->

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/main.js"></script>

</body>

</html>