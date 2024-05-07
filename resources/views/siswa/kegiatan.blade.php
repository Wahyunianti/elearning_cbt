@extends('layouts.main')

@section('content')
@include('sweetalert::alert')
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
                                    <li class="breadcrumb-item" style="font-weight: bold;">Kegiatan</li>
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
                @foreach ($dataKg as $data)
                    <div class="shop-cart-top" style="background-color: #14051d;">
                        
                        <div class="row" style="color: #fff; font-size: 8px;">
                            <div class="col">
                                <a href="javascript:void(0)" onclick="showMessage('{{ $data->nilai }}', '<?php echo ucwords($data->kuis_nama);?>', '{{ $data->jenis }}', '{{ $data->babs }}', '<?php echo ucwords($data->jns);?> ')">
                                    <img src="img/exammm.png" alt="image"> <span><p style=" font-size: 14px;"> Menyelesaikan {{ $data->jenis }} <?php echo ucwords($data->jns);?> 
                                    <?php echo ucwords($data->kuis_nama);?></p>      </span>
                                </a>
                            </div>
                            <div class="col">
                                <p class="float-right" style=" color: #757372; font-size: 14px;">{{$data->tgl}}</p>                                
                            </div>
                        </div>                       

                        <script>
                            function showMessage(nilai, nama, jenis, bab, jns) {
                                Swal.fire({
                                title: jenis + " "+ jns + " " + nama + " Bab " + bab,
                                text: "Nilai kamu "+ nilai,
                                width: 600,
                                padding: "3em",
                                color: "#0D0310",
                                confirmButtonColor: '#3f2d5c',
                                customClass: {
                                    confirmButton: 'cmn-btn',
                                }
                                })
                                ;                                
                            }
                        </script>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


@endsection