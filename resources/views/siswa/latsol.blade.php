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
                                    <li class="breadcrumb-item" style="font-weight: bold;">Latihan Soal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="shop-cart-section" class="pt-120 pb-120" style="
    padding-top: 55px;
">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-cart-top" style="background-color: #14051d;">
                        <div class="row align-items-center">
                            <div class="col-sm-8" style="padding-bottom: 10px;">
                                <div class="shop-cart-left">
                                    <p class="text-sm" style="font-size: 15px;">Pilih latihan yang ingin dikerjakan</p>
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <form id="btncari" action="{{ route('carilatsol') }}" method="GET" class="d-flex">
                                    <div class="single-input">
                                        <input class="text-sm" type="text" placeholder="Search"
                                            style="background: #0d0310;color: #fff; border: 1px solid #81407d;border-radius: 5px;"
                                            name="query">
                                    </div>
                                    <a href="#" class="cmn-btn ml-2 btn-sm"
                                        onclick="event.preventDefault(); document.getElementById('btncari').submit();">Cari</a>
                                </form>
                            </div>

                        </div>
                        <hr style="border-top: 1px solid black;">
                        @foreach ($dataLatsol as $data)
                        <div class="row" style="margin-top: 10px; color: #fff; font-size: 14px;">
                            <div class="col">
                                    <img src="img/examm.png" alt="image" >
                                    <span><p style="font-size: 16px;"> Bab {{ $data->bab }} - {{ $data->nama }} </p> </span>
                                    <span> <p style="text-transform: Capitalize; font-size: 16px; color: #5c3c68; margin-left:10px;">(Sampai {{ Carbon\Carbon::parse($data->tenggat)->isoFormat('D MMMM YYYY [Jam ] HH:mm') }})</p>
                                </span>
                                </div>
                            <div class="col align-items-center">
                            @if ($data->submisis->isNotEmpty())
                                @foreach ($data->submisis as $datu)                      
                                    @if ($data->ubah === 'ya' && !is_null($datu->nilai))                                
                                        <a href="{{ route('tampil', ['id' => $data->id]) }}"
                                            class="cmn-btn ml-2 btn-sm float-right" style="text-transform: capitalize; margin-top: 8px; border-radius: 8px;">Edit</a>
                                    @elseif (is_null($datu->nilai))                            
                                    <a href="{{ route('tampil', ['id' => $data->id]) }}"
                                            class="cmn-btn ml-2 btn-sm float-right" style="text-transform: capitalize; margin-top: 8px; border-radius: 8px;">Edit</a>
                                    @else                               
                                    <p class="float-right" style="text-transform: Capitalize; margin-top: 18px; font-size: 16px; color: #757372;">Selesai</p>
                                    @endif
                                @endforeach
                            @else                                
                                <a href="{{ route('tampil', ['id' => $data->id]) }}"
                                        class="cmn-btn ml-2 btn-sm float-right" style="text-transform: capitalize; margin-top: 8px; border-radius: 8px;">Kerjakan</a>
                            @endif
                            </div>
                        </div>
                        @if (!$loop->last)
                        <hr style="border-top: 1px solid black;">
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection