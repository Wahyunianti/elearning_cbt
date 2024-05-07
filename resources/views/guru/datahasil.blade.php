@extends('guru.main')

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
                <div class="row"  style="margin-top: 15px;">
                <div class="col-lg-12">
                <div class="shop-cart-top" style="background-color: #14051d;">
                        <div class="row align-items-center">
                            <div class="col-sm-8" style="padding-bottom: 10px;">
                                <div class="shop-cart-left">
                                    <p class="text-sm" style="font-size: 15px; color: #fff; font-weight: bold;">Bab {{ $dataInfo->bab }} ({{ $dataInfo->nama}})</p>
                                </div>
                            </div>                            
                        </div>
                        <hr style="border-top: 1px solid #683678">
                        <div class="col" style="margin-top: 10px; color: #fff; font-size: 14px;">
                        <div class="row align-items-center">
                        <p class="text-sm" style="font-size: 15px; color: #8e5f9d; text-align: left;">Kelas : {{ $kls }}</p>
                        </div>
                        <div class="row align-items-center">
                        <p class="text-sm" style="font-size: 15px; color: #8e5f9d; text-align: left;">Tenggat : {{ $dataInfo->tenggat }}</p>
                        </div>
                                          
                        </div>
                    </div>
                        
                        @include('layouts.alert-flash-message')
                        <div class="table-responsive" >
                            <table class="table">
                                <thead style="background-color: #0d0310;">
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col">Waktu Pengumpulan</th>

                                    </tr>
                                </thead>
                                <tbody id="tableBody" style="background-color: #14051d;">
                                @foreach ($submisis as $data)
                                    <tr>
                                        <th scope="row">
                                        @if(!empty($data->foto))
                                            <img src="{{ asset('storage/foto/' . $data->foto) }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 50px; height: 50px; margin: 5px;">
                                        @else
                                            <img src="{{ asset('img/user.png') }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 60px; height: 60px; margin-right: 5px;">
                                        @endif
                                        <span>{{$data->nama}}</span>
                                        </th>
                                        <td>{{$data->kelas}}</td>
                                        <td>{{$data->nilai}}</td>
                                        <td>{{$data->date}}</td>

                                    </tr>      
                                @endforeach
                                @foreach ($submisis2 as $data)
                                    <tr>
                                        <th scope="row">
                                        @if(!empty($data->foto))
                                            <img src="{{ asset('storage/foto/' . $data->foto) }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 50px; height: 50px; margin: 5px; opacity: 0.5; mix-blend-mode: luminosity;">
                                        @else
                                            <img src="{{ asset('img/user2.png') }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 60px; height: 60px; margin-right: 5px;">
                                        @endif
                                        <span style="color: #626262;">{{$data->nama}}</span>
                                        </th>
                                        <td style="color: #626262;">-</td>
                                        <td style="color: #626262;">-</td>
                                        <td style="color: #626262;">-</td>
                                    </tr>      
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                        <div class="payment-container">
                        <div class="row">
                            <div class="col">
                                <button type="button" id="prevBtn" class="cmn-btn btn-sm float-left"
                                    style="color: #fff; margin-top: 0px;" onclick="prevRow()">Sebelumnya</button>
                            </div>
                            <div class="col" style="text-align: right;">
                                <button type="button" id="nextBtn" class="cmn-btn btn-sm float-right"
                                    style="color: #fff; margin-top: 0px;" onclick="nextRow()">Selanjutnya</button>
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
$(document).ready(function() {
  $('.edit-btn').click(function() {
    var id = $(this).data('id');
    var nama =  $(this).data('nama');
    var nilai =  $(this).data('nilai');
    document.getElementById('nama').style.color = '#fff';
    document.getElementById('nilai').style.color = '#fff';


    $('#id').val(id);
    $('#nama').text(nama);
    $('#nilai').val(nilai);

    $('#menilai').css('box-shadow', '0 0 10px 5px rgb(202 0 255 / 50%)').fadeIn();
  });
});
</script>


<script>
    var currentRow = 0;
    var rowsPerPage = 4;
    var maxRows = document.querySelectorAll("#tableBody tr").length;

    function showCurrentRows() {
        var rows = document.querySelectorAll("#tableBody tr");
        var startIndex = currentRow * rowsPerPage;
        var endIndex = Math.min(startIndex + rowsPerPage, maxRows);
        rows.forEach(function(row, index) {
            if (index >= startIndex && index < endIndex) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

    function prevRow() {
        currentRow = Math.max(0, currentRow - 1);
        showCurrentRows();
        toggleButtons();
    }

    function nextRow() {
        currentRow = Math.min(Math.ceil(maxRows / rowsPerPage) - 1, currentRow + 1);
        showCurrentRows();
        toggleButtons();
    }

    function toggleButtons() {
        if (currentRow === 0) {
            document.getElementById('prevBtn').style.display = 'none';
        } else {
            document.getElementById('prevBtn').style.display = 'block';
        }

        if (currentRow === Math.ceil(maxRows / rowsPerPage) - 1) {
            document.getElementById('nextBtn').style.display = 'none';
        } else {
            document.getElementById('nextBtn').style.display = 'block';
        }
    }
    showCurrentRows();
    toggleButtons();
</script>



@endsection