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
                <div class="col-lg-4">
                    <div class="shop-cart-top" style="background-color: #14051d;">
                            <div class="row align-items-center">
                                <div id="edtEbook" style="display: none;" class="col ">
                                    <h6>Edit Ebook</h6>
                                </div>
                                <div id="tbhEbook" class="col ">
                                    <h6>Tambah Ebook</h6>
                                </div>
                                <div class="col ">
                                    <button type="button" id="clear-btn" class="cmn-btn btn-sm clear-btn float-right" style="color: #fff; margin-top: 5px; font-size: 14px; padding-left: 14px; padding-right: 16px;"> 
                                                <i class="fas fa-add"></i>clear
                                            </button>
                                </div>
                            </div>
                    </div>
                    <div class="shop-cart-top" style="background-color: #14051d; color: #fff;">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-lg-12">
                    <div class="mb-3" style="background-color: #2e1440; height: 370px;">
                        <iframe id="pdf-iframe" src="" width="100%"
                            height="100%"></iframe>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-8">
                        <div class="shop-cart-top" id="menilai" style="background-color: #14051d;">
                        <form class="form-horizontal" action="{{ route('createEbook') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                            <div class="row" style="height: auto">
                            
                                <div class="col-lg-4">
                                <div class="single-input">
                                            <input class="text-sm" type="text" placeholder="Tambah Judul Ebook" id="name"
                                                style="background: #0d0310;color: #757575; border: 1px solid #81407d;border-radius: 5px; height: 55px;"
                                                name="judul">
                                            <input class="text-sm" type="text" id="id" style="visibility: hidden; position: absolute;"
                                                name="id">
                                        </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <input class="text-sm" accept="application/pdf" type="file" id="file" placeholder="Pilih File" style="background: #0d0310;color: #757575; border: 1px solid #81407d;border-radius: 5px;" name="file">
                                        <style>
                                            input[type=file]::-webkit-file-upload-button {
                                                background: #81407d;
                                                color: #fff;
                                                border: 1px solid #81407d;
                                                border-radius: 5px;
                                                padding: 5px 10px;
                                                cursor: pointer;
                                            }
                                        </style>

                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="cmn-btn btn-sm" style="color: #fff; margin-top: 5px; font-size: 14px;"> 
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
                                        <th scope="col">Nama</th>
                                        <th scope="col">File</th>
                                        <th colspan="2" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" style="background-color: #14051d;">
                                @foreach ($dataEbook as $data)
                                    <tr>
                                        <th scope="row">
                                        <img src="img/buku.png" alt="image" style="border-radius: 50%; object-fit: cover; width: 60px; height: 60px; object-position: center top; margin :5px;">
                                            <span>{{$data->judul}}</span>
                                        </th>
                                        <td> {{ Str::after($data->file, '_') }}</td>
                                        <td><button type="button" id="edit-btn" class="cart-dismiss edit-btn" data-id="{{$data->id}}" data-name="{{$data->judul}}" data-file="{{$data->file}}">
                                            <i class="fas fa-edit"></i>
                                        </button></td>
                                        <td>        
                                        
                                        <form action="{{ route('delete_ebook', $data->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="cart-dismiss">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>                                  
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
    document.getElementById('tbhEbook').style.display = 'none';    
    document.getElementById('edtEbook').style.display = 'flex';
    var id = $(this).data('id');
    var name =  $(this).data('name');
    var file =  $(this).data('file');
    const pdfIframe = document.getElementById("pdf-iframe");
    $('#menilai').css('box-shadow', '0 0 10px 5px rgb(202 0 255 / 50%)').fadeIn();

    $('#id').val(id);
    $('#name').val(name);
    document.getElementById('name').style.color = '#fff';
    pdfIframe.src = "{{ asset('storage/ebook/') }}" + '/' + file;
  });
  $('.clear-btn').click(function() {
    document.getElementById('tbhEbook').style.display = 'flex';    
    document.getElementById('edtEbook').style.display = 'none';
    const pdfIframe = document.getElementById("pdf-iframe");
    document.getElementById('name').style.color = '#757575';
    $('#menilai').css('box-shadow', 'none');

    
    $('#id').val('');
    $('#name').val('');
    
    pdfIframe.src = '';

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