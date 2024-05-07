@extends('layouts.main')

@section('content')
<section id="banner-section" style="background: #1a052a;
    padding-bottom: 0px;
    padding-top: 80px;
" class="inner-banner profile features shop">
    <div class="banner-content d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="main-content">
                        <div class="breadcrumb-area">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb d-flex justify-content-center">
                                    <li class="breadcrumb-item" style="font-weight: bold;">Kuis Bahasa Arab</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="policy-section" class="pb-120">
    <div class="container" style="padding-top: 70px;">
        <div class="main-content">
            <div class="row cus-m">
                <div class="col-lg-6 col-md-6">
                    <div class="single-box text-center">
                        <a href="{{ route('Kuispg') }}">
                        <div class="img-area text-center">
                            <img src="img/online-test.png" alt="image">
                        </div>
                        <h5>Kuis Pilihan Ganda</h5></a>
                        <p class="text-sm">Berisi Tes Cbt dengan pilihan ganda</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-box text-center">
                        <a href="{{ route('Kuisbc') }}">
                        <div class="img-area text-center">
                            <img src="img/microphone.png" alt="image">
                        </div>
                        <h5>Kuis Bacaan</h5></a>
                        <p class="text-sm">Berisi kuis bacaan dengan pengenalan suara</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection