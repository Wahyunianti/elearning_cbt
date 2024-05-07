@extends('guru.main')

@section('content')
@include('sweetalert::alert')
<section id="banner-section" style="background: #1a052a; padding-bottom: 0px; padding-top: 80px;" class="inner-banner profile features shop">
    <div class="banner-content d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="main-content">
                        <div class="breadcrumb-area">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb d-flex justify-content-center">
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="shop-cart-section" class="pt-120 pb-120">
    <div class="overlay">
        <div class="container">
            <div class="shop-cart-top" style="background-color: #2e1440;">
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4">
                        <div class="shop-cart-top" style="background-color: #14051d; color: #fff;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3" style="background-color: #2e1440; height: 200px;">
                                        <span><i class="fas fa-add"></i></span>
                                        <p style="text-align: center;">Siswa</p>
                                        <div class="row" >
                                            <div class="col-lg-12">
                                                <div style="background-color: #14051d;margin: 10px;">
                                                    <span><i class="fas fa-add"></i></span>
                                                    <p style="text-align: center;height: 80px;margin-top: 20px; font-size: 25px;">{{ $siswa }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="shop-cart-top" style="background-color: #14051d; color: #fff;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3" style="background-color: #2e1440; height: 200px;">
                                        <span><i class="fas fa-add"></i></span>
                                        <p style="text-align: center;">Guru</p>
                                        <div class="row" >
                                            <div class="col-lg-12">
                                                <div style="background-color: #14051d;margin: 10px;">
                                                    <span><i class="fas fa-add"></i></span>
                                                    <p style="text-align: center;height: 80px;margin-top: 20px; font-size: 25px;">{{ $guru }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="shop-cart-top" style="background-color: #14051d; color: #fff;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3" style="background-color: #2e1440; height: 200px;">
                                        <span><i class="fas fa-add"></i></span>
                                        <p style="text-align: center;">Latihan</p>
                                        <div class="row" >
                                            <div class="col-lg-12">
                                                <div style="background-color: #14051d;margin: 10px;">
                                                    <span><i class="fas fa-add"></i></span>
                                                    <p style="text-align: center;height: 80px;margin-top: 20px; font-size: 25px;">{{ $latsol }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
