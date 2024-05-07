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

    <!-- start preloader -->
    <div class="preloader" id="preloader"></div>

    <!-- header-section start -->

    <section id="checkout" class="pt-120 pb-120 text-sm">

        <div class="overlay">
            <div class="row" style="justify-content: center;
        align-items: center; margin-top: 20px;">
                <form class="col-lg-10 " method="POST" action="{{ route('selesai') }}" style="background: #0c040f; margin-right: 20px;
    margin-left: 20px;
    border: 3px solid rgb(165 57 171 / 20%);
    border-radius: 0px;
    padding: 30px 20px;
    margin-bottom: 40px;    
    margin-top: 20px;">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="head-area top" style="margin-bottom: 0px;">
                                    <div class="payment-container billing question q">
                                        <div class="head-area">
                                            <div class="row">
                                                <div class="col text-sm">
                                                    <h5 style="font-weight: bold;">Hasil Kuis
                                                    </h5>
                                                    <input type="hidden" id="idKey" name="idKey" value="{{ $kuis }}">
                                                    <input type="hidden" id="nilai" name="nilai" value="<?php
                                                            $benar = $result->correct;
                                                            $soal = $result->questions->count();
                                                            if($tgl){
                                                                $hasil = ($benar / $soal) * (100-10);
                                                            }else{
                                                                $hasil = ($benar / $soal) * 100;
                                                            }
                                                            echo $hasil;
                                                        ?>">
                                                    <p style="margin-top: 0px; font-size: 14px">Total Pertanyaan : {{
                                                        $result->questions->count() }}</p>
                                                    <p style="margin-top: 0px; font-size: 14px; color: #46b57c">Jawaban
                                                        Benar : {{
                                                        $result->correct }}</p>
                                                    <p style="margin-top: 0px; font-size: 14px; color: #a1283b">Jawaban
                                                        Salah : {{
                                                        $result->incorrect }}</p>
                                                    

                                                </div>
                                                <div class="col">
                                                <h5 class="" style="margin-top: 20px; text-align: -webkit-right;">Nilai :
                                                        <?php
                                                            $benar = $result->correct;
                                                            $soal = $result->questions->count();
                                                            
                                                            if($tgl){
                                                                $hasil = ($benar / $soal) * (100 - 10);
                                                            }else{
                                                                $hasil = ($benar / $soal) * 100;
                                                            }
                                                            echo number_format($hasil, 0);
                                                        ?>
                                                    </h5>
                                                    <p class="" style="margin-top: 0px; text-align: -webkit-right; color: #a29aa9;">Status :
                                                        <?php
                                                            if($tgl){
                                                                echo 'lewat tenggat';
                                                            }else{
                                                                echo 'tepat waktu';
                                                            }                                                            
                                                        ?>
                                                    </p>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @foreach ($result->questions as $question)
                                    <div class="billing-method question q{{ ++$loop->index }}">
                                        <p style=" margin-bottom: 10px; font-size: 14px; margin-left: 20px;">
                                            <?php print_r($loop->index); ?>. {{ $question->question }}
                                        </p>
                                        @foreach ($question->options as $key => $option)
                                        <div class="form-group col-md-12">
                                            <div class="custom-control custom-checkbox">
                                                <input id="{{ $option }}" 
                                                type="checkbox" 
                                                name="{{ $question->id }}" 
                                                @if ($key==$question->correctOption)
                                                @checked(true)                                                
                                                @endif
                                                class="custom-control-input
                                                @if (!$question->correct AND $key == $question->choosedAnswer)
                                                {{ " is-invalid" }}
                                                @endif
                                                @if ($question->correct AND $key == $question->correctOption)
                                                {{ " is-valid" }}
                                                @endif
                                                "
                                                >
                                                <label for="{{ $option }}" class="custom-control-label">({{ Str::lower($key)}})
                                                    {{ $option }}</label>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <div class="payment-container">
                                    <div class="row">
                                        <div class="col" style="text-align: right;">
                                            <button type="submit" class="cmn-btn btn-sm float-right"
                                                style="color: #fff; margin-top: 0px;">Selesai</button>
                                        </div>
                                    </div>
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