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

    <!-- end preloader -->
    <a href="#" class="scrollToTop"><i class="fas fa-angle-double-up"></i></a>

    <!-- header-section start -->
    <header id="header-section">
        <div class="overlay">
            <div class="container">
                <div class="row d-flex header-area">
                    <div class="logo-section flex-grow-1 d-flex align-items-center">
                        <a class="site-logo site-title" href="/"><img src="{{asset('img/logo.png')}}" alt="site-logo"></a>
                    </div>
                    <button class="navbar-toggler ml-auto collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <nav class="navbar navbar-expand-lg p-0">
                        <div class="navbar-collapse collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu ml-auto">
                                @guest
                                <li><a href="{{ route('login') }}"><img src="{{asset('img/user.png')}}"> Login</a></li>
                                @else
                                @if (auth()->user()->isSiswa())
                                <li><a href="{{ route('kg') }}">Kegiatanku</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <li class="menu_has_children"><a href="#0"
                                        style="padding-top: 5px; padding-bottom: 0px; padding-right: 0px;">
                                @if(auth()->user()->siswa->foto)
                                <img src="{{ asset('storage/foto/' . auth()->user()->siswa->foto) }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 30px; height: 30px; margin-right: 5px;">
                                @else
                                <img src="{{ asset('img/user.png') }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 40px; height: 40px; margin-right: 5px;">
                                @endif 
                                        <?php
                                    $nama = auth()->user()->username;
                                    echo $nama;
                                    ?>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('editProfilSis') }}">Edit Profil</a></li>
                                        <li><a href="#"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                                @endif  
                                @if (auth()->user()->isGuru())  
                                <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="{{asset('img/user.png')}}">Logout</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endif                         
                                @endguest
                            </ul>                            
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </header>
    <!-- header-section end -->

    @yield('content')

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