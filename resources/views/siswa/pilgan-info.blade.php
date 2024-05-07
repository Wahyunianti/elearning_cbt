<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0C041C">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Darul Ulum - Media Pembelajaran Bahasa Arab</title>

    <link rel="icon" href="{{ asset('img/baru.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


</head>

<body>

    <div class="preloader" id="preloader"></div>

    <section id="shop-cart-section" class="pt-120 pb-120" style="padding-top: 200px;">
        <div class="overlay">
            <div class="container">
                <form style="background: #0c040f;
    border: 9px solid rgb(165 57 171 / 20%);
    border-radius: 0px;
    padding: 30px 20px;
    margin-bottom: 40px;    
    margin-top: 20px;">
                    <div class="heading-info">
                        <div class="top-area">
                            <div class="row">
                                <div
                                    class="col-lg-12 col-md-12 col-sm-12 d-flex align-items-center justify-content-sm justify-content-center">
                                    <div class="mid-area text-center">
                                        <h5 style="margin-top: 10px;">Bab {{ $dataInfo->bab }} - {{ $dataInfo->nama }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-area" style="padding-top: 30px;">
                            <div class="bottom">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-auto d-grid">
                                    <h6>Tenggat : {{ Carbon\Carbon::parse($dataInfo->tenggat)->isoFormat('D MMMM YYYY [(] HH:mm [)]') }}</h6>

                                        <div class="title-bottom d-flex">
                                            <div class="time-area bg" style="margin-top: 10px;">
                                                <img src="{{ asset('images/waitng-icon.png') }}" alt="image">
                                                <span>Waktu</span>

                                                <span class="time">{{ $dataInfo->duration }} Menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto justify-content-end float-right" style="text-align: center;">
                                        <h5 class="dollar">{{ $dataInfo->no_questions }} Soal</h5>
                                        <a href="{{ route('quiz.startgan', ['id' => $id]) }}" 
                                            style="margin-top: 10px;" class="cmn-btn btn-sm text-sm ">Mulai</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>


    <!-- footer-section start -->


    <!-- footer-section end -->

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>