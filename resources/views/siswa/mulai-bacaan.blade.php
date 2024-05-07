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
            <form class="col-lg-10 " action="{{route('Kuiskor', ['id' => $kuis->id]) }}" method="post" style="background: #0c040f; margin-right: 20px;
    margin-left: 20px;
    border: 5px solid rgb(165 57 171 / 20%);
    border-radius: 0px;
    padding: 30px 20px;
    margin-bottom: 40px;    
    margin-top: 20px;">
    @csrf
                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                    <div class="col float-left">
                        <img src="{{ asset('img/baru2.png') }}" style="width: 70px;" alt="">
                    </div>
                    <div class="col float-right" style="text-align: right;">
                        <button type="submit" class="cmn-btn btn-sm" style="margin-top: 0; color: #fff;" onclick="submitForm()">Finish</button>
                        <p id="countdown" data-value="{{ $kuis->duration }}" data-unit="minutes" class="text-sm"
                            style="margin-top: 20px;">{{ $kuis->duration }}</p>
                    </div>

                </div>
                <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="head-area top" style="margin-bottom: 0px;">
                                    <div class="payment-container billing question q">
                                        <div class="head-area">
                                            @foreach ($soal as $sl)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                <div class="options" style="visibility: hidden; position: absolute;">
                                                    <div class="anguage">                                                    
                                                    <select name="input-language" id="language" style="color:#fff;"><option value="ar">Arabic</option></select>
                                                    </div>
                                                </div>                                                
                                                    <p style="margin-top: 20px;" >{{$sl->soal }}</p>
                                                </div>
                                                @if($sl->foto)
                                                <div class="col-lg-12 align-items-center" style="text-align: center; margin-top: 10px">
                                                <img src="{{ asset('storage/soal/' . $sl->foto) }}" style="width: 300px;" alt="">                                            
                                                </div>
                                                @endif
                                                <div class="col-lg-12">
                                                    <button type="button" class="cmn-btn btn-sm float-left record" style="color: #fff; margin-top: 0px; text-align: center; min-width: -webkit-fill-available; margin-top: 20px;"><span><img src="{{ asset('img/bars.svg') }}" id="rec" style="width: 20px; height: 100%; margin-right: 10px; display: none;" ></span><span><i class="fas fa-microphone" id="mic" style="margin-right: 10px; "></i></span><span><p>Rekam Bacaan</p></span></button>
                                                </div>
                                            </div>
                                            
                                            @endforeach
                                        </div>
                                        <div class="billing-method">
                                            <div class="single-area" style="color: #fff;" >
                                            <input class="text-sm result" type="text"  spellcheck="false"  value=""  style="visibility: hidden; position: absolute;"  name="koreksi"><p placeholder="Bacaan akan terlihat disini" class="interim"></p>
                                            </div>
                                        </div>
                                    </div>
        </form>

        <div class="payment-container">
            <div class="row">
                <div class="col">
                    <button type="button" class="cmn-btn btn-sm float-left clear"
                        style="color: #fff; margin-top: 0px;">Clear</button>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

        </div>
        </div>
    </section>

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
    <script src="{{ asset('js/languages.js') }}"></script>

    <script>
        const recordBtn = document.querySelector(".record"),
        result = document.querySelector(".result"),
        hanam = document.querySelector("hanam"),
        inputLanguage = document.querySelector("#language"),
        clearBtn = document.querySelector(".clear");

        let SpeechRecognition =
            window.SpeechRecognition || window.webkitSpeechRecognition,
        recognition,
        recording = false;

        function populateLanguages() {
        languages.forEach((lang) => {
            const option = document.createElement("option");
            option.value = lang.code;
            option.innerHTML = lang.name;
            inputLanguage.appendChild(option);
        });
        }

        populateLanguages();

        function speechToText() {
        document.getElementById('mic').style.display = 'none';
        document.getElementById('rec').style.display = 'unset';    
        try {
            recognition = new SpeechRecognition();
            recognition.lang = inputLanguage.value;
            recognition.interimResults = true;
            recordBtn.classList.add("recording");
            recordBtn.querySelector("p").innerHTML = "Mendengar...";
            recognition.start();
            recognition.onresult = (event) => {
            const speechResult = event.results[0][0].transcript;
            if (event.results[0].isFinal) {
                result.value += " " + speechResult;  
                
                document.querySelector(".interim").innerHTML += " " + speechResult;  
            } else {
                if (!document.querySelector(".interim")) {
                const interim = document.createElement("p");
                interim.classList.add("interim");
                result.appendChild(interim);
                }                
            }
            };
            recognition.onspeechend = () => {
            speechToText();
            };
            recognition.onerror = (event) => {
            stopRecording();
            if (event.error === "no-speech") {
                alert("No speech was detected. Stopping...");
            } else if (event.error === "audio-capture") {
                alert(
                "No microphone was found. Ensure that a microphone is installed."
                );
            } else if (event.error === "not-allowed") {
                alert("Permission to use microphone is blocked.");
            } else if (event.error === "aborted") {
                alert("Listening Stopped.");
            } else {
                alert("Error occurred in recognition: " + event.error);
            }
            };
        } catch (error) {
            recording = false;
            console.log(error);
        }
        }

        recordBtn.addEventListener("click", () => {
        if (!recording) {
            speechToText();
            recording = true;
        } else {
            stopRecording();
        }
        });
        

        function stopRecording() {
            document.getElementById('mic').style.display = 'unset';
            document.getElementById('rec').style.display = 'none';
            recognition.stop();
            recordBtn.querySelector("p").innerHTML = "Rekam Bacaan";
            recordBtn.classList.remove("recording");
            recording = false;
        }

   

        clearBtn.addEventListener("click", () => {
            result.value = ""; 
            document.querySelector(".interim").innerHTML = " ";
        });

    </script>

    <script>
        var countdownElement = document.getElementById('countdown');
        var id = document.getElementById('idkey');
        var countdownValue = countdownElement.getAttribute('data-value');
        var endTime = new Date();
        endTime.setSeconds(endTime.getSeconds() + parseInt(countdownValue) * 60);
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
</body>

</html>