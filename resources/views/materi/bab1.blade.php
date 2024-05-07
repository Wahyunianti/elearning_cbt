@extends('layouts.main')

@section('content')
<section id="banner-section" class="inner-banner tournaments">
    <div class="ani-img">
        <img class="img-2" src="img/banner-circle-2.png" alt="icon">
        <img class="img-3" src="img/banner-circle-2.png" alt="icon">
    </div>
    <div class="banner-content d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="main-content">
                        <h1>الدَّرْسُ الْأَوَّلُ</h1>
                        <div class="breadcrumb-area">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb d-flex justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bab 1</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner-section end -->

<!-- Testimonials Content Start -->
<section id="tournaments-content">
    <div class="container pb-120">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h4 class="head-area" style="text-align:center;">Perkenalan (التَّعَارُفُ)</h4>
                <div class="magnific-area">
                    <img src="img/video.png" alt="image">
                    <a href="{{ asset('video/bab1.mp4') }}" target="_blank" class="mfp-iframe popupvideo">
                        <img src="images/play-icon-2.png" alt="image">
                    </a>
                </div>

                <div class="info-area">
                    <div class="single-info">
                        <p>Pada proses pembelajaran kali ini kita akan belajar tentang topik perkenalan diri dalam
                            Bahasa Arab.
                            Apa sajakah itu, yang termasuk kedalam materi pembelajaran kali ini adalah kita akan
                            mempelajari kosa kata, kata tanya, sapaan,
                            profesi dan arah. Untuk itu simak baik baik pembelajaran yang disampaikan ya semuanya.
                        </p>
                    </div>
                    <h4>Kosa Kata</h4>
                    <div class="single-info">
                        <p>Kosa kata (الْمُفْرَدَات) terbagi menjadi 5 bagian utama diantaranya adalah kosa kata itu
                            sendiri, kata tanya (الْإِسْتِفْهَام), sapaan,
                            profesi dan arah. Berikut akan dijelaskan dan diberikan contoh kalimat dalam Bahasa Arab.
                        </p>
                    </div>
                    <div class="single-info">
                        <h5>Kosa Kata (الْمُفْرَدَات)</h5>
                        <p>Saat kita akan berkenalan dengan teman baru, pasti kita akan menggunakan kalimat seperti
                            "Siapa nama mu?" atau "Nama saya, dia, mereka.." bukan?.
                            Nah untuk itu kata-kata berikut ini akan membantu kita dalam melakukan perkenalan kedalam
                            Bahasa Arab.
                        </p><br>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 zindex" style="margin-bottom: 10px;">
                                <img src="img/bab_1.png" alt="image">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 zindex" style="margin-bottom: 10px;">
                                <img src="img/reco.png" alt="image2">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 zindex" style="margin-bottom: 10px;">
                                <img src="img/oke.png" alt="image3">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9  mx-auto">
                                <img src="img/kku.png" alt="image3" class="mx-auto d-block">
                            </div>
                        </div><br>
                        <h5>Arti</h5>
                        <ul>
                            <li>Siapa kamu (lk)? Saya seorang siswa. Namaku Azzam</li>
                            <li>Siapa kamu (pr)? Saya seorang siswi. Namaku Helya</li>
                            <li>Siapa ini (lk)? ini adalah temanku (lk) . dia adalah siswa</li>
                            <li>Siapa ini (pr)? ini adalah temanku (pr) . dia adalah siswa</li>

                        </ul>
                    </div>

                    <div class="single-info">
                        <h5>Kata Tanya (الْإِسْتِفْهَام)</h5>
                        <p>Tentunya saat akan bertanya kita memerlukan kata-kata tanya siapa, dimana, kapan dan sebagainya. Berikut adalah contoh dari kata
                            tanya.
                        </p><br>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4  mx-auto">
                                <img src="img/kikuk.png" alt="image3" class="mx-auto d-block">
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

        </div>

    </div>

</section>
<!-- Testimonials Content End -->
<footer id="footer-section">
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
                            <li><a href="about-us.html">MTsN 2 Kota Kediri - Ngronggo</a></li>
                        </ul>
                    </div>
                    <div
                        class="col-lg-4 col-md-4 d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="right-area">
                            <ul class="d-flex">
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
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