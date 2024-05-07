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
                        <h1>الدَّرْسُ الثالث </h1>
                        <div class="breadcrumb-area">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb d-flex justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bab 3</li>
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
                <h4 class="head-area" style="text-align:center;">Perlengkapan Sekolah (الْأَدَوَاتُ الْمَدْرَسِيَّةُ)</h4>
                <div class="magnific-area">
                    <img src="img/video.png" alt="image">
                    <a href="{{ asset('video/bab1.mp4') }}" target="_blank" class="mfp-iframe popupvideo">
                        <img src="images/play-icon-2.png" alt="image">
                    </a>
                </div>

                <div class="info-area">
                    <div class="single-info">
                        <p>Pada proses pembelajaran kali ini kita akan belajar tentang topik peralatan sekolah dalam
                            Bahasa Arab.
                            Pernahkan kalian menyebutkan peralatan sekolah dan warna-warna dengan
menggunakan bahasa arab. Tentu akan sangat sulit jika kalian tidak memahami
mufrodatnya bukan ? apalagi kalau tidak tahu bunyi kata dan bentuk kata jenis
mudzakar (laki-Laki) atau muannas (perempuan). Dalam Bahasa arab sangatlah
penting mengetahui bentuk-bentuk tersebut. Kira-kira sudah seperti apakah yang
kalian ketahui, apakah kalian sudah tahu mufrodat tentang fasilitas sekolah dan
warna-warna ? apakah kalian bisa memberikan contoh kata tersebut dalam
kalimat?. Apakan kalian tahu struktur kata dalam kalimat bahasa arab yang
menggunakan mufrodat tentang peralatan sekolah dan warna ? Tanpa
mengetahui itu semua tentu sangatlah sulit untuk kalian memahami bahasa arab. Untuk itu simak baik baik pembelajaran yang disampaikan ya semuanya.
                        </p>
                    </div>
                    <div class="single-info">
                        <h5>Kosa Kata (الْمُفْرَدَات)</h5>
                        <p>Berikut ini akan dijelaskan arti dan kosa kata seputar peralatan sekolah.
                        </p><br>
                        <h5>Peralatan Sekolah (الْأَدَوَاتُ الْمَدْرَسِيَّةُ)</h5>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5  mx-auto">
                                <img src="img/bab3/1.png" alt="image3" class="mx-auto d-block">
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5  mx-auto">
                                <img src="img/bab3/2.png" alt="image3" class="mx-auto d-block">
                            </div>
                        </div><br>
                        <h5>Perangkat Keras (الْأَدَوَاتُ فِي الْفَصْلِ)</h5>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5  mx-auto">
                                <img src="img/bab3/3.png" alt="image3" class="mx-auto d-block">
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5  mx-auto">
                                <img src="img/bab3/4.png" alt="image3" class="mx-auto d-block">
                            </div>
                        </div><br>                        
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