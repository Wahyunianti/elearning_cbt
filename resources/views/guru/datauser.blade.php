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
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-8">
                        <div class="shop-cart-top" style="background-color: #14051d;">
                            <div class="row">
                            <div class="col align-item-center">
                            <div class="shop-cart-left float-left">
                            <h6>Data Pengguna</h6>
                            </div>
                            </div>
                                <div class="col float-right">
                                    <form id="btncari" action="{{ route('searchUsers') }}" method="GET" class="d-flex">
                                        <div class="single-input">
                                            <input class="text-sm" type="text" placeholder="Cari.."
                                                style="background: #0d0310;color: #fff; border: 1px solid #81407d;border-radius: 5px;"
                                                name="query">
                                        </div>
                                        <a href="#" class="cmn-btn ml-2 btn-sm"
                                            onclick="event.preventDefault(); document.getElementById('btncari').submit();" style="border-radius: 7px;">Cari</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @include('layouts.alert-flash-message')
                        <div class="table-responsive" >
                            <table class="table">
                                <thead style="background-color: #0d0310;">
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No Induk</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Level</th>
                                        <th colspan="2" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" style="background-color: #14051d;">
                                @foreach ($dataUser as $data)
                                    <tr>
                                        <th scope="row">
                                        @if(!empty($data->guru->foto))
                                            <img src="{{ asset('storage/foto/' . $data->guru->foto) }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 50px; height: 50px; margin: 5px;">
                                        @elseif(!empty($data->siswa->foto))
                                            <img src="{{ asset('storage/foto/' . $data->siswa->foto) }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 50px; height: 50px; margin: 5px;">
                                        @else
                                            <img src="{{ asset('img/user.png') }}" class="avatar-img rounded-circle" style="object-fit: cover; object-position: center top; width: 60px; height: 60px; margin-right: 5px;">
                                        @endif
                                        <span>{{$data->nama}}</span>
                                        </th>
                                        <td>{{$data->no_induk}}</td>
                                        <td>
                                        @if ($data->role_id === 2)
                                                    {{ $data->siswa->kelas }}
                                        @else
                                                @foreach ($data->guru->kelaseh as $guru)
                                                {{ $guru->kelas }}
                                                @if (!$loop->last)
                                                ,
                                                @endif
                                                @endforeach
                                        @endif

                                        </td>
                                        <td>{{$data->roles->role_name}}</td>
                                        <td><button type="button" id="edit-btn" class="cart-dismiss edit-btn" data-id="{{$data->id}}" data-email="{{$data->email}}" data-name="{{$data->nama}}" data-username="{{$data->username}}" data-noinduk="{{$data->no_induk}}" data-name="{{$data->nama}}" 
                                        @if ($data->role_id === 2)
                                        data-kelas="{{$data->siswa->kelas}}"
                                        @else
                                        @foreach ($data->guru->kelaseh as $guru)
                                        data-kelas="{{$guru->kelas}}"
                                        @break
                                        @endforeach
                                        @endif
                                        data-role="{{$data->role_id}}">
                                            <i class="fas fa-edit"></i>
                                        </button></td>
                                        <td>        
                                        
                                        <form action="{{ route('delete_user', $data->id) }}" method="POST">
                                            @csrf
                                            <button type="button" class="cart-dismiss hapusdeh">
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

                    <div class="col-lg-4">
                    <div class="shop-cart-top" style="background-color: #14051d;">
                            <div class="row ">
                                <div id="edtEbook" style="display: none;" class="col ">
                                    <h6>Edit User</h6><span><h6 style="margin-left:5px;" id="nune"></h6></span>
                                </div>
                                <div id="tbhEbook" class="col ">
                                    <h6>Tambah User</h6>
                                </div>

                            </div>
                        </div>
                    <div class="shop-cart-top" id="menilai" style="background-color: #14051d; color: #fff;">
                    <form class="form-horizontal" action="{{ route('createUser') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                            <div class="form-row" style="height: auto;">
                                <div class="form-group col-md-6">
                                    <label for="fname">Nama</label>
                                    <input type="text" style="background: rgb(13, 3, 16); font-size: 16px;" class="form-control" name="nama" id="name" value="" placeholder="Nama User">
                                    <input class="text-sm" type="text" id="id" style="visibility: hidden; position: absolute;" name="id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Username</label>
                                    <input type="text" style="background: rgb(13, 3, 16); font-size: 16px;" class="form-control" name="username" id="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" style="background: rgb(13, 3, 16)" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">No Induk</label>
                                    <input type="number" style="background: rgb(13, 3, 16)" class="form-control" id="noinduk" name="no_induk" placeholder="Nomor Induk">
                                </div>
                            </div>
                            <div class="form-row" id="passwordField" style="display: none;">
                                <div class="form-group col-lg-12">
                                    <label for="email">Password</label><span><p style="font-size:14px; color: #816489; margin-left:5px;">*(opsional)</p></span>
                                    <input type="text" style="background: rgb(13, 3, 16); font-size: 16px;" class="form-control" name="password" placeholder="Ganti Password">
                                </div>
                            </div>
                            <div class="form-row">     
                                <div class="form-group col-md-6">
                                    <div class="row" style="margin-left: 0px; margin-right: 0px; text-align: center;">
                                    <label for="">Kelas</label>
                                    <select class="form-select" name="kelas[]" id="kelas" style="display: flex;">
                                    <option value="7A" selected>7A</option>
                                    <option value="7B">7B</option>
                                    <option value="7C">7C</option>
                                    <option value="7D">7D</option>
                                    <option value="7E">7E</option>
                                    <option value="7F">7F</option>
                                    <option value="7G">7G</option>
                                    <option value="7H">7H</option>
                                    <option value="7I">7I</option>
                                    <option value="7J">7J</option>
                                    <option value="7K">7K</option>
                                    <option value="7L">7L</option>
                                    <option value="7M">7M</option>
                                    <option value="7N">7N</option>
                                    </select>
                                    <button type="button" id="add-btn" class="cmn-btn btn-sm add-btn float-left" style="color: #fff; margin-top: 5px; font-size: 14px; padding-left: 14px; padding-right: 16px;"> 
                                                <i class="fas fa-plus"></i>
                                        </button>    
                                    </div>                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="row" style="margin-left: 0px; margin-right: 0px; text-align: center;">
                                    <label for="level" style="text-align: center;">Level</label>
                                    <select class="form-select" name="role_id" id="role" style="display: flex;">
                                    <option value="1" selected>Guru</option>
                                    <option value="2">Siswa</option>
                                    </select>
                                    </div> 
                                </div>                     
                            </div>
                            <div class="form-row">     
                            <div class="col">
                    <button type="button" class="cmn-btn btn-sm clear-btn float-left" id="clear-btn" style="color: #fff; margin-top: 0px;">Clear</button>              
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
    document.getElementById('passwordField').style.display = 'flex';
    document.getElementById('tbhEbook').style.display = 'none';    
    document.getElementById('edtEbook').style.display = 'flex';
    var id = $(this).data('id');
    var email = $(this).data('email');
    var name =  $(this).data('name');
    var username =  $(this).data('username');
    var noinduk =  $(this).data('noinduk');
    var kelas =  $(this).data('kelas');
    var role =  $(this).data('role');
    $('#menilai').css('box-shadow', '0 0 10px 5px rgb(202 0 255 / 50%)').fadeIn();

    document.getElementById('name').style.color = '#fff';
    document.getElementById('email').style.color = '#fff';
    document.getElementById('username').style.color = '#fff';
    document.getElementById('kelas').style.color = '#fff';
    document.getElementById('noinduk').style.color = '#fff';
    document.getElementById('role').style.color = '#fff';

    $('#id').val(id);
    $('#name').val(name);
    $('#email').val(email);
    $('#username').val(username);
    $('#noinduk').val(noinduk);
    $('#kelas').val(kelas);
    $('#role').val(role);
    $('#nune').text(username);   
    $('#proses').text('edit');   


  });

  $('.clear-btn').click(function() {
    
    document.getElementById('passwordField').style.display = 'none';
    document.getElementById('tbhEbook').style.display = 'flex';    
    document.getElementById('edtEbook').style.display = 'none';
    $('#id').val('');
    $('#name').val('');
    $('#email').val('');
    $('#username').val('');
    $('#noinduk').val('');
    $('#kelas').val('7A');
    $('#role').val('1');
    $('#proses').text('tambah');   
    $('#menilai').css('box-shadow', 'none');

    document.getElementById('name').style.color = '#757575';
    document.getElementById('email').style.color = '#757575';
    document.getElementById('username').style.color = '#757575';
    document.getElementById('kelas').style.color = '#757575';
    document.getElementById('noinduk').style.color = '#757575';
    document.getElementById('role').style.color = '#757575';

  });
});
</script>

<script>
var maxInputs = 6;
var inputCount = 0;

document.getElementById("add-btn").addEventListener("click", function() {
    if (inputCount < maxInputs) {
        var inputKeterangan = document.getElementById("kelas");

        // Create select input
        var newSelect = document.createElement("select");
        newSelect.className = "form-select";
        newSelect.name = "kelas[]";
        newSelect.style.display = "flex";
        newSelect.style.marginTop = "5px";
        var option1 = document.createElement("option");
        option1.value = "7A";
        option1.text = "7A";
        option1.selected = true;
        var option2 = document.createElement("option");
        option2.value = "7B";
        option2.text = "7B";
        var option3 = document.createElement("option");
        option3.value = "7C";
        option3.text = "7C";
        var option4 = document.createElement("option");
        option4.value = "7D";
        option4.text = "7D";
        var option5 = document.createElement("option");
        option5.value = "7E";
        option5.text = "7E";
        var option6 = document.createElement("option");
        option6.value = "7F";
        option6.text = "7F";
        var option7 = document.createElement("option");
        option7.value = "7G";
        option7.text = "7G";
        var option8 = document.createElement("option");
        option8.value = "7H";
        option8.text = "7H";
        var option9 = document.createElement("option");
        option9.value = "7I";
        option9.text = "7I";
        var option10 = document.createElement("option");
        option10.value = "7J";
        option10.text = "7J";
        var option11 = document.createElement("option");
        option11.value = "7K";
        option11.text = "7K";
        var option12 = document.createElement("option");
        option12.value = "7L";
        option12.text = "7L";
        var option13 = document.createElement("option");
        option13.value = "7M";
        option13.text = "7M";
        var option14 = document.createElement("option");
        option14.value = "7N";
        option14.text = "7N";
        newSelect.add(option1);
        newSelect.add(option2);
        newSelect.add(option3);
        newSelect.add(option4);
        newSelect.add(option5);
        newSelect.add(option6);
        newSelect.add(option7);
        newSelect.add(option8);
        newSelect.add(option9);
        newSelect.add(option10);
        newSelect.add(option11);
        newSelect.add(option12);
        newSelect.add(option13);
        newSelect.add(option14);


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
            newSelect.parentNode.removeChild(newSelect);
            deleteButton.parentNode.removeChild(deleteButton);
            inputCount--;
        });

        inputKeterangan.insertAdjacentElement("afterend", newSelect);
        inputKeterangan.insertAdjacentElement("afterend", deleteButton);

        inputCount++;
    } else {
    }
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

@endsection