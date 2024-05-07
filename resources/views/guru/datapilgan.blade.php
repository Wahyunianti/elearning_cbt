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
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6">
                        <div class="shop-cart-top" style="background-color: #14051d;">
                            <div class="row align-items-center">
                                <div class="col">
                                    <form id="btncari" action="{{ route('searchLatihan') }}" method="GET" class="d-flex">
                                        <div class="single-input">
                                            <input class="text-sm" type="text" placeholder="Cari nama.." style="background: #0d0310;color: #fff; border: 1px solid #81407d;border-radius: 5px;" name="query">
                                        </div>
                                        <a href="#" class="cmn-btn ml-2 btn-sm" onclick="event.preventDefault(); document.getElementById('btncari').submit();" style="border-radius: 7px;">Cari</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="shop-cart-top" style="background-color: #14051d; color: #fff;">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-lg-12">
                                    <div class="mb-3" style="background-color: #2E1440; height: 777px;">
                                        <div class="inner-container">
                                            @foreach ($dataKuis as $data)
                                            <div class="shop-cart-top" style="background-color: #14051d; color: #fff; font-size: 14px;">
                                                <div class="row">
                                                    <div class="col">
                                                        <p>Bab {{ $data->bab }}</p>
                                                        <p>Kuis : {{ $data->nama }}</p>
                                                        <p>Tenggat : {{ Carbon\Carbon::parse($data->tenggat)->isoFormat('D MMMM YYYY [Jam ] HH:mm') }}</p>
                                                        <p style="margin-bottom:5px;">Data Terkumpul : </p>
                                                        <div class="row">
                                                        @foreach ($data->results as $dati)
                                                            <div class="col-md-4">
                                                                <div class="shop-cart-top" style="background-color: #2e1440; padding-top: 2px; padding-bottom: 2px; padding-right: 2px; padding-left: 2px; height: 60px;">
                                                                    <div class="col">
                                                                        <a href="{{ route('hasil_submisi', ['id' => $data->id, 'kelas' => $dati->kelas]) }}" style="text-align:center;">
                                                                            <p style="color: #fff; font-size: 14px; margin-left: 5px;">{{ $dati->kelas }}</p>
                                                                            <h6 style="text-align:center;">{{ $dati->jumlah_submisi }}/{{ $dati->jumlah_siswa }}</h6>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="row" style="width: -webkit-fill-available; margin-left: 0px; margin-right: 0px">
                                                        <div class="col-lg-4">
                                                            <button type="button" style="color: #fff; margin-left: 0px" class="cmn-btn edit-btn" data-id="{{ $data->id }}" data-bab="{{ $data->bab }}" data-nama="{{ $data->nama }}" data-tenggat="{{ $data->tenggat }}" data-ubah="{{ $data->ubah }}" data-duration="{{ $data->duration }}">Edit</button>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <a href="{{ route('dataSoal', ['id' => $data->id]) }}" style="color: #fff; font-size:14px;" class="cmn-btn">Soal</a>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <form class="hapusyuk" action="{{ route('delete_pilgan', $data->id) }}" method="POST">
                                                                @csrf
                                                                <button type="button" class="cmn-btn hapusdeh" style="color: #fff; margin-right: 0px">Hapus</button>
                                                            </form>
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
                                <div id="edtEbook" style="display: none;" class="col">
                                    <h6>Edit Kuis</h6><span><h6 style="margin-left:5px;" id="latihann"></h6></span>
                                </div>
                                <div id="tbhEbook" class="col">
                                    <h6>Tambah Kuis Pilihan Ganda</h6>
                                </div>
                            </div>
                        </div>
                        @include('layouts.alert-flash-message')
                        <div class="shop-cart-top" id="menilai" style="background-color: #14051d; color: #fff;">
                            <form class="form-horizontal" id="myForm" action="{{ route('createPilgan') }}" method="post" enctype="multipart/form-data">
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
                                            <input class="text-sm" type="text" value="{{ $dato->id }}" id="guru" style="visibility: hidden; position: absolute;" name="guru_id">
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lname">Nama Kuis</label>
                                        <input style="background: rgb(13, 3, 16);" type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kuis">
                                        <input class="text-sm" type="text" id="id" style="visibility: hidden; position: absolute;" name="id">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tenggat">Tenggat</label>
                                        @php
                                            $now = \Carbon\Carbon::now('Asia/Jakarta');
                                            $formattedTenggat = $now->format('Y-m-d\TH:i');
                                        @endphp
                                        <input style="background: rgb(13, 3, 16); font-size: 16px;" type="datetime-local" class="form-control" name="tenggat" id="tenggat" placeholder="Tenggat" value="{{ $formattedTenggat }}">
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
                                        <label for="email">Durasi</label><span><p style="font-size:14px; color: #816489; margin-left:5px;">*(menit)</p></span>
                                        <input oninput="checkInputLength(this)" style="background: rgb(13, 3, 16); margin-bottom: 15px;" type="number" class="form-control" id="duration" name="duration" placeholder="Durasi" max="99">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <button type="button" class="cmn-btn btn-sm clear-btn float-left" style="color: #fff; margin-top: 0px;">Clear</button>
                                    </div>
                                    <div class="col">
                                        <button type="submit" name="submit" id="proses" class="cmn-btn btn-sm float-right" style="color: #fff; margin-top: 0px;">Tambah</button>
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
    var bab = $(this).data('bab');
    var nama = $(this).data('nama');
    var ubah =  $(this).data('ubah');
    var tenggat =  $(this).data('tenggat');
    var duration =  $(this).data('duration');

    $('#menilai').css('box-shadow', '0 0 10px 5px rgb(202 0 255 / 50%)').fadeIn();


    let tenggatTidakTz = tenggat.slice(0, 16);

    document.getElementById('nama').style.color = '#fff';
    document.getElementById('bab').style.color = '#fff';
    document.getElementById('tenggat').style.color = '#fff';
    document.getElementById('duration').style.color = '#fff';
    document.getElementById('ubah').style.color = '#fff';

    $('#id').val(id);
    $('#nama').val(nama);
    $('#bab').val(bab);
    $('#tenggat').val(tenggatTidakTz);
    $('#duration').val(duration);
    $('#ubah').val(ubah);
    $('#latihann').text(nama);   
    $('#proses').text('edit');  

  });  
  $('.clear-btn').click(function() {
    document.getElementById('tbhEbook').style.display = 'flex';    
    document.getElementById('edtEbook').style.display = 'none';
    $('#menilai').css('box-shadow', 'none');

    document.getElementById('nama').style.color = '#757575';
    document.getElementById('bab').style.color = '#757575';
    document.getElementById('tenggat').style.color = '#757575';
    document.getElementById('duration').style.color = '#757575';
    document.getElementById('ubah').style.color = '#757575';
    
    $('#id').val('');
    $('#nama').val('');
    $('#bab').val('1');
    $('#tenggat').val('');
    $('#duration').val('');
    $('#ubah').val('ya');
    $('#latihann').text('');   
    $('#proses').text('tambah'); 

  });
});
function checkInputLength(input) {
        if (input.value.length > 2) {
            input.value = input.value.slice(0, 2);
        }
    }
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
document.getElementById("add-btn").addEventListener("click", function() {
        if (inputCount < maxInputs) {
            var inputKeterangan = document.getElementById("link");
            var newInput2 = document.createElement("input");
            newInput2.type = "text";
            newInput2.name = "link[]";
            newInput2.className = "form-control";
            newInput2.placeholder = "Link";
            newInput2.style.marginTop = "15px";

            var deleteButton2 = document.createElement("button");
            deleteButton2.textContent = "X";
            
            deleteButton2.className = "cmn-btn btn-sm";
            deleteButton2.style.color = "#fff";
            deleteButton2.style.background = "rgb(118 36 58)";
            deleteButton2.style.paddingLeft = "10px";
            deleteButton2.style.paddingRight = "10px";
            deleteButton2.style.paddingTop = "5px";
            deleteButton2.style.paddingBottom = "5px";

            deleteButton2.addEventListener("click", function() {
                newInput2.parentNode.removeChild(newInput2);
                deleteButton2.parentNode.removeChild(deleteButton2);
                inputCount--;
            });

            inputKeterangan.insertAdjacentElement("afterend", newInput2);
            inputKeterangan.insertAdjacentElement("afterend", deleteButton2);

            inputCount++;
        } else {
        }
});

</script>


@endsection