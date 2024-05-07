@extends('layouts.main')

@section('content')
@include('sweetalert::alert')
<!-- banner-section start -->
<section id="banner-section">
    <div class="banner-content d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="top-area justify-content-center text-center">
                            <h3>Media Pembelajaran</h3>
                            <h1>Bahasa Arab</h1>
                            <p>Kelas VII MTsN 2 Kota Kediri</p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row justify-content-center" style="margin-left: 40px;  margin-right: 40px;">
                                    <div class="col-lg-6">
                                        <div class="bottom-area text-center">
                                            <a href="#available-game-section" class="mimik">
                                                <img src="img/versus.png" alt="banner-vs">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ani-illu">
                <img class="left-1 wow fadeInUp" src="img/left-banner.png" alt="image">
                <img class="right-2 wow fadeInUp" src="img/right-banner.png" alt="image">
            </div>
        </div>
    </div>
</section>
<!-- banner-section end -->

<!-- Available Game In start -->
<section id="available-game-section">
    <div class="overlay pb-120">
        <div class="container wow fadeInUp">
            <div class="main-container" style="
    margin-bottom: -8;
    padding-bottom: 20px;
    padding-top: 70px;">
                <div class="row justify-content-between">
                    <div class="col-lg-10">
                        <div class="section-header">
                            <h2 class="title">Materi</h2>
                            <p>Kelas 7 kurikulum 2020</p>
                        </div>
                    </div>
                </div>
                <div class="available-game-carousel">
                    <div class="single-item">
                        <a href="{{ route('mat1') }}"><img src="img/mat1.png" alt="image"></a>
                    </div>
                    <div class="single-item">
                        <a href="{{ route('mat2') }}"><img src="img/mat2.png" alt="image"></a>
                    </div>
                    <div class="single-item">
                        <a href="{{ route('mat3') }}"><img src="img/mat3.png" alt="image"></a>
                    </div>
                    <div class="single-item">
                        <a href="{{ route('mat4') }}"><img src="img/mat4.png" alt="image"></a>
                    </div>
                    <div class="single-item">
                        <a href="{{ route('mat5') }}"><img src="img/mat5.png" alt="image"></a>
                    </div>
                    <div class="single-item">
                        <a href="{{ route('mat6') }}"><img src="img/mat6.png" alt="image"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Available Game In end -->
@guest
<!-- Features In start -->
<section id="features-section">
    <div class="overlay pt-120">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-header text-center">
                        <h2 class="title">Yuk Kita Belajar</h2>
                        <p>حدد النشاط الذي تريد القيام به</p>
                    </div>
                </div>
            </div>
            <div class="row pm-none">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-item text-center">
                        <a href="#" onclick="showMessage()">
                            <div class="img-area">
                                <img src="img/features-icon-1.png" alt="image">
                            </div>
                            <h5>Materi</h5>
                        </a>
                        <p>Berisi Video, Materi Pembelajaran & E-book</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-item text-center">
                        <a href="#" onclick="showMessage()">
                            <div class="img-area">
                                <img src="img/features-icon-2.png" alt="image">
                            </div>
                            <h5>Latihan Soal</h5>
                        </a>
                        <p>Berisi Latihan-latihan Soal dari Guru</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-item text-center">
                        <a href="#" onclick="showMessage()">
                            <div class="img-area">
                                <img src="img/features-icon-3.png" alt="image">
                            </div>
                            <h5>Kuis</h5>
                        </a>
                        <p>Berisi Kuis Pilihan Ganda & Bacaan</p>
                    </div>
                </div>
                <script>
                    function showMessage() {
                        document.body.style.overflow = 'hidden';
                        Swal.fire({
                            title: "Maaf, fitur khusus pengguna",
                            text: "Silahkan Login Terlebih Dahulu",
                            imageUrl: "{{ asset('img/baru.png') }}",
                            imageHeight: "auto",
                            imageWidth: "120px",
                            imageAlt: "Mohon Login Dulu",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#08052A",
                            imageClass: 'swal2-image-center'
                        }).then(() => {
                            document.body.style.overflow = '';
                        });
                    }
                </script>
            </div>
        </div>
    </div>

</section>
@else
@if (auth()->user()->isSiswa())
<section id="features-section">
    <div class="overlay pt-120">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-header text-center">
                        <h2 class="title">Yuk Kita Belajar</h2>
                        <p>حدد النشاط الذي تريد القيام به</p>
                    </div>
                </div>
            </div>
            <div class="row pm-none">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-item text-center">
                        <a href="{{ route('materi') }}">
                            <div class="img-area">
                                <img src="img/features-icon-1.png" alt="image">
                            </div>
                            <h5>Materi</h5>
                        </a>
                        <p>Berisi Video, Materi Pembelajaran & E-book</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-item text-center">
                        <a href="{{ route('latsol') }}">
                            <div class="img-area">
                                <img src="img/features-icon-2.png" alt="image">
                            </div>
                            <h5>Latihan Soal</h5>
                        </a>
                        <p>Berisi Latihan-latihan Soal dari Guru</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-item text-center">
                        <a href="{{ route('getKuis') }}">
                            <div class="img-area">
                                <img src="img/features-icon-3.png" alt="image">
                            </div>
                            <h5>Kuis</h5>
                        </a>
                        <p>Berisi Kuis Pilihan Ganda & Bacaan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endif
@endguest
<!-- Features In end -->
<footer id="footer-section" >
        <div class="footer-mid pt-120">
            <div class="container">
                <div class="row d-flex">
                    <div
                        class="col-lg-8 col-md-8 d-flex justify-content-md-between justify-content-center align-items-center cus-grid">
                        <div class="logo-section">
                            <a class="site-logo site-title" href="index.html"><img src="img/logo.png"
                                    alt="site-logo"></a>
                        </div>
                        <ul class="menu-side d-flex align-items-center">
                            <li><a href="https://mtsn2kotakediri.sch.id/" target="_blank">MTsN 2 Kota Kediri - Ngronggo</a></li>
                        </ul>
                    </div>
                    <div
                        class="col-lg-4 col-md-4 d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="right-area">
                            <ul class="d-flex">
                                <li><a href="https://api.whatsapp.com/send?phone=6289527684270" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="https://www.youtube.com/c/MADTSANDACHANNEL" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="https://www.instagram.com/mtsn2_kotakediri/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="main-content">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-lg-12 col-md-6">
                            <div class="left-area text-center">
                                <p>Copyright &copy; 2024. Media Pembelajaran Bahasa Arab. <a target="_blank"
                                        href="https://sc.chinaz.com/moban/" style="color: violet;">MTsN2</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection