@extends('guru.main')

@section('content')
<style>
    .inner-container {
        width: 100%;
        height: 100%;
        overflow-y: auto;
        padding: 10px;
    }
    .inner-container::-webkit-scrollbar {
        width: 10px;
    }
    .inner-container::-webkit-scrollbar-track {
        background: pink;
    }
    .inner-container::-webkit-scrollbar-thumb {
        background: #C169AC;
    }
    .inner-container::-webkit-scrollbar-thumb:hover {
        background: #A34A91;
    }
</style>

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
                <div class="col-lg-6" >
                    <div class="shop-cart-top" style="background-color: #14051d;">
                            <div class="row align-items-center">
                                <div class="col">
                                <form id="btncari" action="{{ route('searchLatihan') }}" method="GET" class="d-flex">
                                    <div class="single-input">
                                        <input class="text-sm" type="text" placeholder="Cari.."
                                            style="background: #0d0310;color: #fff; border: 1px solid #81407d;border-radius: 5px;"
                                            name="query" id="searchInput">
                                    </div>
                                    <a href="#" class="cmn-btn ml-2 btn-sm"
                                        onclick="event.preventDefault(); filterAndSubmitForm();" style="border-radius: 7px;">Cari</a>
                                </form>
                                </div>
                            </div>
                        </div>
                    <div class="shop-cart-top" style="background-color: #14051d; color: #fff;">
                    <div class="row">
                <div class="col-lg-12 col-md-12 col-lg-12">
                    <div class="mb-3" style="background-color: #2E1440; height: 637px;">
        <div class="inner-container">
            
            @foreach ($dataLatihan as $data)
            <div class="shop-cart-top" style="background-color: #14051d; color: #fff; font-size: 14px;">
            
                    <div class="row">
                        <div class="col">
                        <p>Bab {{ $data->bab }} - {{ $data->nama }} </p>
                        <p >Tenggat : {{ Carbon\Carbon::parse($data->tenggat)->isoFormat('D MMMM YYYY [Jam ] HH:mm') }}</p>
                        <p style="margin-bottom:5px;">File Terkait : </p>
                                        @foreach ($data->files as $dati)
                                                <div class="shop-cart-top" style="background-color: #2e1440; padding-top: 2px; padding-bottom: 2px; padding-right: 2px;">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <p style="color: #fff; font-size: 14px;">{{ Str::after($dati->file, '_') }}</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                        <form action="{{ route('delete_file', $dati->id) }}" method="POST">
                                                             @csrf
                                                            <button type="submit" class="cart-dismiss float-right" style="background: none; border: none;">
                                                                <i class="fas fa-times" style="box-sizing: border-box; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px;color: var(--body-color); width: 30px;"></i>
                                                            </button>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                        <p style="margin-bottom:5px; ">Data Terkumpul : </p>    
                                        <div class="row">
                                        @foreach ($data->results as $datu)
                                            <div class="col-md-4">
                                                <div class="shop-cart-top" style="background-color: #2e1440; padding-top: 2px; padding-bottom: 2px; padding-right: 2px; padding-left: 2px; height: 60px;">
                                                <div class="col">
                                                <a href="{{ route('nilai_submisi', ['id' => $data->id, 'kelas' => $datu->kelas]) }}" style="text-align:center;">
                                                    <p style="color: #fff; font-size: 14px; margin-left: 5px;">{{ $datu->kelas }}</p>
                                                    <h6 style="text-align:center;">{{ $datu->jumlah_submisi }}/{{ $datu->jumlah_siswa }}</h6>
                                                </a>
                                                </div>                                                                                        
                                                </div>
                                            </div>  
                                        @endforeach
                                        </div>
                                        
                        <div class="row">
                            <div class="col">
                          
                            <button type="button" style="color: #fff;" class="cmn-btn float-left edit-btn"  data-jmlfile="{{$data->files->count()}}" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-tenggat="{{$data->tenggat}}" data-bab="{{$data->bab}}" data-keterangan="{{$data->keterangan}}" data-detail="{{$data->detail}}" data-ubah="{{$data->ubah}}" >Edit</button>
                           
                            </div>
                            <div class="col">
                            <form class="hapusyuk" action="{{ route('delete_latsol', $data->id) }}" method="POST">
                                @csrf
                                <button type="button" class="cmn-btn float-right hapusdeh" style="color: #fff;">Hapus</button>        
                            </form>         
                            </div>
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
                    <div class="col-lg-6">
                    <div class="shop-cart-top" style="background-color: #14051d; color: #fff;">
                    <div class="row">
                        <div id="edtEbook" style="display: none;" class="col ">
                                    <h6>Edit Latihan</h6><span><h6 style="margin-left:5px;" id="latihann"></h6></span>
                                </div>
                                <div id="tbhEbook" class="col ">
                                    <h6>Tambah Latihan</h6>
                                </div>
                    </div>
                    </div>
                    @include('layouts.alert-flash-message')
                    <div class="shop-cart-top" id="menilai" style="background-color: #14051d; color: #fff;">
                    <form class="form-horizontal" action="{{ route('createLatihan') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                            <div class="form-row" style="height: auto;">
                                <div class="form-group col-md-6">
                                    <div class="row" style="margin-left: 0px; margin-right: 0px; text-align: center;">
                                    @foreach ($guruA as $dato)
                                    <label for="kelas">Bab</label>
                                    <select class="form-select" name="bab" id="bab" style="display: flex; font-size: 16px;">
                                    <option value="1" selected>Bab 1</option>
                                    <option value="2">Bab 2</option>
                                    <option value="3">Bab 3</option>
                                    <option value="4">Bab 4</option>
                                    <option value="5">Bab 5</option>
                                    <option value="6">Bab 6</option>
                                    </select>                                    
                                    <input class="text-sm" type="text" id="guru" value="{{$dato->id}}" style="visibility: hidden; position: absolute;" name="guru_id">
                                    @endforeach    
                                    </div> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Judul Latihan</label>
                                    <input style="background: rgb(13, 3, 16);" type="text" class="form-control" name="nama" id="nama" placeholder="Judul Latihan">
                                    <input class="text-sm" type="text" id="id" style="visibility: hidden; position: absolute;" name="id">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                        <label for="email">Keterangan Latihan</label>
                                        <input style="background: rgb(13, 3, 16);"  type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                                </div>                                                                  
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                        <label for="email">Detail Latihan</label><span><p style="font-size:14px; color: #816489; margin-left:5px;">*(opsional)</p></span>
                                        <textarea style="background: rgb(13, 3, 16);"  class="form-control" name="detail" id="detail"
                                            placeholder="Tulis Detail Latihan"
                                            value=""></textarea>                               
                                </div>                                                                  
                            </div>
                            <div class="form-row">     
                            <div class="form-group col-md-6">
                                <label for="tenggat">Tenggat</label>
                                @php
                                    $now = \Carbon\Carbon::now('Asia/Jakarta');
                                    $formattedTenggat = $now->format('Y-m-d\TH:i');
                                @endphp
                                <input style="background: rgb(13, 3, 16); font-size: 16px;"  type="datetime-local" class="form-control" name="tenggat" id="tenggat" placeholder="Tenggat" value="{{ $formattedTenggat }}">
                            </div>
                                <div class="form-group col-md-6">
                                    <div class="row" style="margin-left: 0px; margin-right: 0px; text-align: center;">
                                        <label for="ubah" style="text-align: center;">Akses Edit</label>
                                        <select class="form-select ubah" name="ubah" id="ubah" style="display: flex; font-size: 16px;">
                                        <option value="ya" selected>Dapat diedit</option>
                                        <option value="tidak">Tidak dapat diedit</option>
                                        </select>
                                    </div> 
                                </div>                     
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                        
                                <label id="tbhfile" for="email">File Terkait</label><span><p style="font-size:14px; color: #816489; margin-left:5px;">*(opsional)</p></span>
       
                                        <input class="text-sm" type="file" id="file" accept="application/pdf" placeholder="Pilih File" style="background: #0d0310;color: #757575; border-radius: 5px; margin-bottom: 15px;" name="file[]">
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

                                        <button type="button" id="addf-btn" class="cmn-btn btn-sm add-btn float-left" style="color: #fff; margin-top: 5px; font-size: 14px; padding-left: 14px; padding-right: 16px;"> 
                                                <i class="fas fa-plus"></i>
                                        </button>
                                </div>                                                                  
                            </div>
                            <div class="form-row">     
                            <div class="col">
                                <button type="button" class="cmn-btn btn-sm clear-btn float-left" style="color: #fff; margin-top: 0px;">Clear</button>              
                            </div>
                            <div class="col">
                    <button type="submit" name="submit" id="proses" class="cmn-btn btn-sm float-right" style="color: #fff; margin-top: 0px;">Tambah</button>              
                                </div>            
                            </div>

                </form>
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
    var pile = $(this).data('jmlfile');
    var nama =  $(this).data('nama');
    var tenggat =  $(this).data('tenggat');
    var bab =  $(this).data('bab');
    var detail =  $(this).data('detail');
    var keterangan =  $(this).data('keterangan');
    var ubah =  $(this).data('ubah');

    var text1 = "File saat ini ada "+ pile + ", Tambah lagi?";
    $('#menilai').css('box-shadow', '0 0 10px 5px rgb(202 0 255 / 50%)').fadeIn();


    let tenggatTidakTz = tenggat.slice(0, 16);

    document.getElementById('nama').style.color = '#fff';
    document.getElementById('bab').style.color = '#fff';
    document.getElementById('detail').style.color = '#fff';
    document.getElementById('tenggat').style.color = '#fff';
    document.getElementById('keterangan').style.color = '#fff';
    document.getElementById('ubah').style.color = '#fff';

    $('#id').val(id);
    $('#nama').val(nama);
    $('#bab').val(bab);
    $('#detail').val(detail);
    $('#tenggat').val(tenggatTidakTz);
    $('#keterangan').val(keterangan);
    $('#ubah').val(ubah);
    $('#latihann').text(nama);   
    $('#proses').text('edit');  
    $('#tbhfile').text(text1);  

  });  
  $('.clear-btn').click(function() {
    document.getElementById('tbhEbook').style.display = 'flex';    
    document.getElementById('edtEbook').style.display = 'none';
    $('#menilai').css('box-shadow', 'none');

    document.getElementById('nama').style.color = '#757575';
    document.getElementById('bab').style.color = '#757575';
    document.getElementById('detail').style.color = '#757575';
    document.getElementById('tenggat').style.color = '#757575';
    document.getElementById('keterangan').style.color = '#757575';
    document.getElementById('ubah').style.color = '#757575';
    
    $('#id').val('');
    $('#guru').val('');
    $('#nama').val('');
    $('#bab').val('1');
    $('#detail').val('');
    $('#tenggat').val('');
    $('#keterangan').val('');
    $('#file').val('');
    $('#ubah').val('ya');
    $('#latihann').text('');   
    $('#proses').text('tambah');  
    $('#tbhfile').text('File Terkait');   

  });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.hapusdeh');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                document.body.classList.add('swal2-shown');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda ingin menghapus data latihan soal?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yakin!',
                    confirmButtonColor: "#14051d",
                    cancelButtonText: 'Batal',
                    cancelButtonColor: "#814062"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Hapus Data',
                            text: "Data akan dihapus secara permanen",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            confirmButtonColor: "#14051d",
                            cancelButtonText: 'Batal',
                            cancelButtonColor: "#814062"

                        }).then((result) => {
                            if (result.isConfirmed) {
                                button.parentElement.submit();
                            }
                        });
                    }
                }).finally(() => {
                    document.body.classList.remove('swal2-shown');
                });
            });
        });
    });
</script>

<script>
var maxInputs = 2;
var inputCount = 0;
var maxInputse = 2;
var inputCounte = 0;
document.getElementById("addf-btn").addEventListener("click", function() {
    if (inputCounte < maxInputse) {
        var inputFile = document.getElementById("file");
        var newInput = document.createElement("input");
        newInput.type = "file";
        newInput.name = "file[]";
        newInput.className = "form-control";
        newInput.style.background = "#0d0310";
        newInput.style.height = "55px";
        newInput.style.color = "#757575";
        newInput.style.borderRadius = "5px";
        newInput.style.marginBottom = "15px";
        newInput.style.paddingTop = "10px";
        newInput.style.paddingBottom = "10px";
        newInput.style.paddingLeft = "25px";
        newInput.style.paddingRight = "25px";
        newInput.style.fontSize = "14px";

        var deleteButton = document.createElement("button");
        deleteButton.textContent = "X";
        
        deleteButton.className = "cmn-btn btn-sm";
        deleteButton.style.color = "#fff";
        deleteButton.style.background = "rgb(118 36 58)";
        deleteButton.style.paddingLeft = "10px";
        deleteButton.style.paddingRight = "10px";
        deleteButton.style.paddingTop = "5px";
        deleteButton.style.paddingBottom = "5px";

        deleteButton.addEventListener("click", function() {
            newInput.parentNode.removeChild(newInput);
            deleteButton.parentNode.removeChild(deleteButton);
            inputCounte--;
        });

        inputFile.insertAdjacentElement("afterend", newInput);
        inputFile.insertAdjacentElement("afterend", deleteButton);

        inputCounte++;
    } else {
    }
});

</script>

<script>
    function filterAndSubmitForm() {
        var inputValue = document.getElementById("searchInput").value.trim();

        if (inputValue.toLowerCase().startsWith("bab")) {
            var splitValue = inputValue.split(" ");
            if (splitValue.length === 2 && !isNaN(parseInt(splitValue[1]))) {
                document.getElementById("searchInput").value = splitValue[1];
            }
        }

        var form = document.getElementById("btncari");
        var queryString = form.getAttribute("action") + "?query=" + encodeURIComponent(inputValue);
        form.setAttribute("action", queryString);

        form.submit();
    }
</script>

@endsection