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
    <!-- header-section end -->


    <section id="checkout" class="pt-120 pb-120" style="padding-top: 40px">
        
            <div class="overlay">
            <div class="row" style="justify-content: center;
        align-items: center; margin-top: 20px;">
            <form id="quizForm" class="col-lg-10 " target="_blank" action="{{ route('quiz.submit', ['id' => $quiz->id]) }}" style="background: #0c040f; margin-right: 20px;
    margin-left: 20px;
    border: 5px solid rgb(165 57 171 / 20%);
    border-radius: 0px;
    padding: 30px 20px;
    margin-bottom: 40px;    
    margin-top: 20px;">
                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                    <div class="col float-left">
                        <img src="{{ asset('img/baru2.png') }}" style="width: 70px;" alt="">
                    </div>
                    <div class="col float-right" style="text-align: right;">
                        <button type="submit" class="cmn-btn btn-sm" style="margin-top: 0; color: #fff;" onclick="submitForm()">Finish</button>
                        <p id="countdown" data-value="{{ $quiz->duration }}" data-unit="minutes" class="text-sm"
                            style="margin-top: 20px;">{{ $quiz->duration }}</p>
                    </div>

                </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="head-area top" style="margin-bottom: 0px;">
                                    @foreach ($questions as $question)
                                    <div class="payment-container billing question q{{ ++$loop->index }}"
                                        style="display: none">
                                        <div class="head-area">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h5>No.
                                                        <?php print_r($loop->index); ?>
                                                    </h5>
                                                    <p style="margin-top: 20px;">{{ $question->question }}</p>
                                                </div>

                                            </div>
                                            @if($question->foto)
                                            <div class="row">
                                                <div class="col-lg-12 align-items-center" style="text-align: center; margin-top: 10px">
                                                <img src="{{ asset('storage/soal/' . $question->foto) }}" style="width: 300px;" alt="">                                            
                                                </div>
                                            </div>
                                            @else
                                            @endif
                                        </div>
                                        <div class="billing-method">
                                            @foreach ($question->options as $key => $option)

                                            <div class="single-area">
                                                <div class="form-check">
                                                    <div class="radio-area">
                                                        <input type="radio" id="{{ $option }}" value="{{ $key }}"
                                                            name="{{ $question->id }}" class="form-check-input">
                                                        <span class="checkmark fedex"></span>
                                                    </div>
                                                    <label for="{{ $option }}" style="cursor: pointer;"
                                                        class="d-flex justify-content-between align-items-center">
                                                        <span class="head">({{ Str::lower($key)}}) {{ $option }}</span>

                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
        </form>
        <div class="payment-container">
            <div class="row">
                <div class="col">
                    <button type="button" id="prevBtn" class="cmn-btn btn-sm float-left"
                        style="color: #fff; margin-top: 0px;">Sebelumnya</button>
                </div>
                <div class="col" style="text-align: right;">
                    <button type="button" id="nextBtn" class="cmn-btn btn-sm float-right"
                        style="color: #fff; margin-top: 0px;">Selanjutnya</button>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

        </div>
        </div>
    </section>
    <script>
    
    function submitForm(event) {        
        setTimeout(function() {
            window.close();
        }, 1000);

        event.preventDefault();
        var form = document.getElementById('quizForm');
        form.submit();   
                  
    }
     
    </script>
    <script>
        let currentQuestion = "q1";

        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const allQuestions = document.querySelectorAll('.question');
        const totalQuestions = allQuestions.length;

        sessionStorage.setItem('question', currentQuestion);
        prevBtn.style.display = 'none';


        document.querySelector(`.${currentQuestion}`).style.display = "block";

        nextBtn.addEventListener('click', () => {

            let que = sessionStorage.getItem('question');
            let next = que.substring(1, que.length);

            next = next * 1 + 1;

            if (next == totalQuestions) {
                nextBtn.style.display = 'none';
            }

            sessionStorage.setItem('question', `q${next}`);
            next = sessionStorage.getItem('question')

            prevBtn.style.display = 'block';

            document.querySelector(`.${next}`).style.display = "block";
            document.querySelector(`.${que}`).style.display = "none";

        });

        prevBtn.addEventListener('click', () => {

            let que = sessionStorage.getItem('question');
            let next = que.substring(1, que.length);

            next = next * 1 - 1;

            if (next == 1) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'block';
            }

            nextBtn.style.display = 'block';

            sessionStorage.setItem('question', `q${next}`);
            next = sessionStorage.getItem('question')

            document.querySelector(`.${next}`).style.display = "block";
            document.querySelector(`.${que}`).style.display = "none";
        });
    </script>

    <!-- time -->

    <script>
        var countdownElement = document.getElementById('countdown');
        var id = document.getElementById('idkey');
        var countdownValue = countdownElement.getAttribute('data-value');
        var endTime = new Date();
        endTime.setSeconds(endTime.getSeconds() + parseInt(countdownValue) * 60); // Menambahkan menit ke waktu sekarang
        function updateCountdown() {
            var now = new Date();
            var distance = endTime - now;

            var minutes = Math.floor(distance / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
            var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

            if (minutes > 0) {
                countdownElement.innerHTML = formattedMinutes + ":" + formattedSeconds + " Menit Lagi";
            }

            if (seconds > 0 && minutes == 0) {
                countdownElement.innerHTML = formattedMinutes + ":" + formattedSeconds + " Detik Lagi";
            }


            if (distance < 0) {
                clearInterval(interval);
                countdownElement.innerHTML = "00:00";
                alert("Waktu sudah habis!");
                var form = document.getElementById('quizForm');
                form.submit();
            }

        }

        var interval = setInterval(updateCountdown, 1000);
    </script>



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