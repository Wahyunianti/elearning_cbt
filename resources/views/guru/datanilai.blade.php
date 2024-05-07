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
                                    <p class="text-sm" style="font-size: 15px; color: #fff; font-weight: bold;">Bab {{ $dataInfo->bab }} - {{ $dataInfo->nama }} Kelas {{ $kls }}</p>
                                </div>
                            </div>                            
                        </div>
                        <hr style="border-top: 1px solid #683678">
                        <div class="col" style="margin-top: 10px; color: #fff; font-size: 14px;">
                        <div class="row align-items-center">
                        <input type="hidden" id="idKey" name="idKey" value="{{ $id }}">
                        <p class="text-sm" style="font-size: 15px; color: #8e5f9d; text-align: left;">Keterangan : {{ $dataInfo->keterangan }}</p>
                            </div>
                            <div class="row align-items-center">
                        <p class="text-sm" style="font-size: 15px; color: #683678; text-align: left; font-weight: bold;">Tenggat : {{ Carbon\Carbon::parse($dataInfo->tenggat)->isoFormat('D MMMM YYYY [Jam ] HH:mm') }}</p>
                            </div>
                            <div class="row align-items-center">
                            <p class="text-sm" style="font-size: 15px; color: #8e5f9d; text-align: left; margin-top:8px;">Detail : <br> <?php
                                $text = $dataInfo->detail;
                                $text_with_links = preg_replace("/(https?:\/\/[^\s]+)/", '<a href="$1" style="font-size: 15px; color: #cc44db; text-align: left; margin-top:8px;" target="_blank">$1</a>', $text);

                                echo "$text_with_links";
                                ?> 
                        </p>                    
                    </div>
                            
                        <div class="row align-items-center">
                        <p class="text-sm" style="font-size: 15px; color: #683678; text-align: left; margin-top:8px; font-weight: bold;">File : </p>
                        </div>
                            @foreach ($latsolF as $duta) 
                            <div class="row mt-3 shop-cart-top" style="background: #0d0310; padding: 8px;">
                            
                                <div class="col" style="align-self: center;">                                
                                <div style="display: flex; align-items: center;">                            
                                    <p class="text-sm" style="font-size: 15px; color: #372243; font-weight: bold;">{{ Str::after($duta->file, '_') }}</p>
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


                        <div class="shop-cart-top" id="menilai" style="background-color: #14051d;">
                        <form class="form-horizontal" action="{{ route('nilaiSub') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                            <div class="row" style="height: auto;">                            
                                <div class="col-lg-3">
                                <div class="single-input">
                                            <p id="nama">Pilih Siswa</p>
                                            <p id="jam" style="font-size: 12px; color: rgb(187 103 184);">Waktu</p>
                                            <input class="text-sm" type="text" id="id" style="visibility: hidden; position: absolute;"
                                                name="id">
                                        </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <input class="text-sm" type="text" placeholder="Beri nilai" id="nilai"
                                                style="background: #0d0310;color: #757575; border: 1px solid #81407d;border-radius: 5px; height: 55px;"
                                                name="nilai">

                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="cmn-btn btn-sm float-right" style="color: #fff; margin-top: 5px; font-size: 14px;"> 
                                                <i class="fas fa-add"></i>simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>                             

                            </div>
                            </form>
                        </div>
                        
                        @include('layouts.alert-flash-message')
                        <div class="table-responsive" >
                            <table class="table">
                                <thead style="background-color: #0d0310;">
                                    <tr>
                                        <th scope="col" style="width: 15%">Nama</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col">Aksi</th>
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
                                        <td>{{$data->tenggat}}</td>
                                        <td><i class="fas fa-file-pdf"></i><span style="margin-left:5px; margin-right:5px;"><a href="{{ route('tampilSubmisi', ['id' => $data->submisi_id]) }}" target="_blank" style="font-size: 14px;">{{ Str::after($data->lampiran, '_') }}</a></span><i class="fas fa-external-link-alt"></i></td>
                                        <td>{{$data->nilai}}</td>
                                        <td> 
                                            <button type="button" id="edit-btn" class="cmn-btn btn-sm edit-btn" style="color: #fff; margin-top: 5px; font-size: 14px;" data-id="{{$data->submisi_id}}" data-nama="{{$data->nama}}" data-nilai="{{$data->nilai}}" data-jam="{{ Carbon\Carbon::parse($data->tenggat)->isoFormat('D MMMM YYYY [Jam ] HH:mm') }}"> 
                                                nilai
                                            </button>                                 
                                        </td>
                                    </tr>      
                                @endforeach
                                @foreach ($submisis2 as $data)
                                    <tr >
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
                                        <td style="color: #626262;">-                            
                                        </td>
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
    var jam =  $(this).data('jam');
    document.getElementById('nilai').style.color = '#fff';


    $('#id').val(id);
    $('#nama').text(nama);
    $('#nilai').val(nilai);
    $('#jam').text(jam);

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