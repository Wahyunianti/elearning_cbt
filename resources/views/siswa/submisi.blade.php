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
                                    <li class="breadcrumb-item" style="font-weight: bold;">Submit Latihan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="shop-cart-section" class="pt-120 pb-120" style="padding-top: 20px;">
    <div class="overlay" >
        <div class="row" style="justify-content: center;
        align-items: center; ">
    <form class="col-lg-10 " method="POST" action="{{ route('submision') }}" enctype="multipart/form-data" style="background: content-box; margin-right: 20px;
    margin-left: 20px;
    padding: 30px 20px;
    margin-bottom: 40px;    
    margin-top: 20px;">
                    @csrf
        <div class="container">
        <div class="row">
                                        <div class="col" style="text-align: left;">
                                            <a href="javascript:history.go(-1);" class="btn-md float-left"
                                                style="background: #3a1c57; color: #000; margin-bottom: 20px; border-radius: 3px; font-size: 14px; padding: 8px;">
                                                <img src="{{asset('img/left-arrow.png')}}" style="width: 27px;" alt="">
</a>
                                        </div>
                                    </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-cart-top" style="background-color: #fff;">
                        <div class="row align-items-center">
                            <div class="col-sm-8" style="padding-bottom: 10px;">
                                <div class="shop-cart-left">
                                    <p class="text-sm" style="font-size: 15px; color: #000; font-weight: bold;">Bab {{ $dataInfo->bab }} - {{ $dataInfo->nama }}</p>
                                </div>
                            </div>                            
                        </div>
                        <hr style="border-top: 1px solid #61396f">
                        <div class="col" style="margin-top: 10px; color: #fff; font-size: 14px;">
                        <div class="row align-items-center">
                        <input type="hidden" id="idKey" name="idKey" value="{{ $id }}">
                        <p class="text-sm" style="font-size: 15px; color: #000; text-align: left;">Keterangan : {{ $dataInfo->keterangan }}</p>
                            </div>
                            <div class="row align-items-center">
                        <p class="text-sm" style="font-size: 15px; color: #61396f; text-align: left; font-weight: bold;">Tenggat : {{ Carbon\Carbon::parse($dataInfo->tenggat)->isoFormat('D MMMM YYYY [Jam ] HH:mm') }}</p>
                            </div>
                            <div class="row align-items-center">
                            <p class="text-sm" style="font-size: 15px; color: #000; text-align: left; margin-top:8px;">Detail :
                        </p>
                        <p class="text-sm" style="font-size: 15px; color: #000; text-align: left; margin-top:8px; padding-left: 20px;">
                        <?php
                            $text = $dataInfo->detail;
                            $text_with_links = preg_replace("/(https?:\/\/[^\s]+)/", '<a href="$1" style="font-size: 15px; color: #7145c6; text-align: left; margin-top:8px;" target="_blank">$1</a>', $text);

                            echo "$text_with_links";
                            ?> 
                        </p>
                    
                    </div>                            
                            @foreach ($latsolF as $duta) 
                            <div class="row mt-3 shop-cart-top" style="background: #fff; padding: 8px;">
                            
                                <div class="col" style="align-self: center;">                                
                                <div style="display: flex; align-items: center;">                                
                                    <img src="{{asset('img/files.png')}}" style="width: 40px;" alt="image">
                                    <p class="text-sm" style="font-size: 15px; color: #372243; margin-left: 10px; font-weight: bold;">{{ $duta->file }}</p>
                                </div>
                                </div>
                            
                                <div class="col" style="align-self: center;">
                                <div class="float-right" style="display: flex; align-items: center;">
                                    <a href="{{ route('downloadLat', ['id' => $duta->id]) }}" style="margin-right: 14px;">
                                        <img src="{{asset('img/download.png')}}" style="width: 32px;" alt="image">
                                    </a>
                                    <a href="{{ route('viewLat', ['id' => $duta->id]) }}" target="__blank">
                                        <img src="{{asset('img/external-link.png')}}" style="width: 22px;" alt="image">
                                    </a>                             
                                    
                                </div>
                                </div>
                            </div>          
                            @endforeach                 
                        </div>
                    </div>

                    <div class="shop-cart-top" style="background-color:#fff;">
                        
                        <div class="col" style="margin-top: 10px; color: #fff; font-size: 14px;">
                        <div class="row align-items-center">
                        <p class="text-sm" style="font-size: 15px; color: #000;">Lampirkan Jawaban</p>
                            </div>    
                            <div class="row mt-3 shop-cart-top" style="background: #eae8ea; padding: 8px;">

                            <div class="col">
                                <label for="lampiran" style="display: inline-block; cursor: pointer;">
                                    <input type="file" id="lampiran" accept="application/pdf" name="file" class="form-control"style="display: none;" onchange="displayFileName(this)">
                                    <span id="file-name"  name="file" class="btn" style="color:#000; margin-bottom: 15px; margin-top: 15px; border: 0px solid #311e3c; background-color: #fff;">Upload File</span>
                                    @if($submisis)
                                    @foreach ($submisis as $subm) 
                                    <a href="{{ route('tampilSubmisis', ['id' => $subm->id]) }}" target="_blank"><span><p id="namafile" class="text-sm" style="font-size: 15px; color: #372243; margin-left: 10px;  margin-right: 10px; font-weight: bold">
                                    {{ Str::after($subm->lampiran, '_') }}
                                    </p></span><i style="font-size: 15px; color: #372243;" class="fas fa-external-link-alt"></i></a>        
                                    @endforeach
                                    @else
                                    @endif
                                    <span id="change-file" class="btn" style="color:#fff; display: none; margin-bottom: 15px; margin-top: 15px; border: 0px solid #311e3c; background-color: rgb(55 34 67);" onclick="resetFile()">Ganti File</span>
                                </label>
                            </div>

                            </div>                           

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                                        <div class="col" style="text-align: right;">
                                            <button type="submit" class="cmn-btn btn-sm float-right"
                                                style="color: #fff; margin-top: 0px; border-radius: 8px;">Kirimkan</button>
                                        </div>
                                    </div>
        </div>
        </form>
        </div>
    </div>
</section>
<script>
    function displayFileName(input) {
        var fileName = input.files[0].name;
        document.getElementById('file-name').textContent = fileName;
        document.getElementById('change-file').style.display = 'inline-block';
        document.getElementById('namafile').style.display = 'none';
    }

    function resetFile() {
        var fileInput = document.getElementById('lampiran');
        fileInput.value = '';
        var fileName = input.files[0].name;
        document.getElementById('change-file').textContent = fileName;
        document.getElementById('change-file').style.display = 'inline-block';
        document.getElementById('namafile').style.display = 'none';
    }
</script>

@endsection