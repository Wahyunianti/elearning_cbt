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
                                    <li class="breadcrumb-item" style="font-weight: bold;">Materi Bahasa Arab</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="all-trophies" class="pb-120" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="overview-tab">                    
                    <div class="statistics-area">
                        <div class="row">
                            <div class="col">
                                <div class="total-area">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="fortnite-tab" data-toggle="tab" href="#fortnite" role="tab" aria-controls="fortnite" aria-selected="true">Materi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="warzone-tab" data-toggle="tab" href="#warzone" role="tab" aria-controls="warzone" aria-selected="false">E-book</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContents">
                                        <div class="tab-pane fade active show" id="fortnite" role="tabpanel" aria-labelledby="fortnite-tab">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-item text-center">
                                                        <img src="img/books.png" alt="image">
                                                        <p>BAB 1 - Perkenalan</p>
                                                        <a href="{{ route('mat1') }}"class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px;">Pelajari</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-item text-center">
                                                        <img src="img/books.png" alt="image">
                                                        <p>BAB 2 - Perkenalan</p>
                                                        <a href=""class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px;">Pelajari</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-item text-center">
                                                        <img src="img/books.png" alt="image">
                                                        <p>BAB 3 - Perkenalan</p>
                                                        <a href=""class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px;">Pelajari</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-item text-center">
                                                        <img src="img/books.png" alt="image">
                                                        <p>BAB 4 - Perkenalan</p>
                                                        <a href=""class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px;">Pelajari</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-item text-center">
                                                        <img src="img/books.png" alt="image">
                                                        <p>BAB 5 - Perkenalan</p>
                                                        <a href=""class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px;">Pelajari</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-item text-center">
                                                        <img src="img/books.png" alt="image">
                                                        <p>BAB 6 - Perkenalan</p>
                                                        <a href=""class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px;">Pelajari</a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="warzone" role="tabpanel" aria-labelledby="warzone-tab">
                                            <div class="row">
                                            @foreach ($dataEbook as $data)
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-item text-center">
                                                        <img src="img/filesebook.png" style="width: 60px" alt="image">
                                                        <p>{{ $data->judul }}</p>
                                                        <div class="row" style="margin-right: -2px">
                                                            <div class="col">
                                                            
                                                            <a href="{{ route('downloadEb', ['id' => $data->id]) }}"class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px; border-radius: 8px;"><img src="{{asset('img/download2.png')}}" style="width: 30px;" alt="image"></a>
                                                    
                                                            </div>
                                                            <div class="col">
                                                            <a href="{{ route('viewEb', ['id' => $data->id]) }}" target="_blank" class="cmn-btn ml-2 btn-sm" style="text-transform: Capitalize; margin-top: 8px; border-radius: 8px;"><img src="{{asset('img/external-link2.png')}}" style="width: 30px;" alt="image"></a>
                                                    
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>  
                                            @endforeach                                              
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