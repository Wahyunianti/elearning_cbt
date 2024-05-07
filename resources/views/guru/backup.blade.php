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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-cart-top" style="background-color: #14051d;">
                        <div class="row align-items-center">
                            <div class="col-sm-8">
                            <div class="shop-cart-left">
    <a href="#" class="cmn-btn ml-2 btn-sm" id="tambah_user_btn" data-bs-toggle="modal" data-bs-target="#tambah_user">Tambah</a>
    </div>
                            </div>
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <form id="btncari" action="{{ route('searchUsers') }}" method="GET" class="d-flex">
                                    <div class="single-input">
                                        <input class="text-sm" type="text" placeholder="Search"
                                            style="background: #0d0310;color: #fff; border: 1px solid #81407d;border-radius: 5px;"
                                            name="query">
                                    </div>
                                    <a href="#" class="cmn-btn ml-2 btn-sm"
                                        onclick="event.preventDefault(); document.getElementById('btncari').submit();">Cari</a>
                                </form>
                            </div>

                        </div>
                        </div>
                        <div class="table-responsive" >
                            <table class="table">
                                <thead style="background-color: #14051d;">
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No Induk</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                @foreach ($dataUser as $data)
                                    <tr>
                                        <th scope="row">
                                            <img src="images/cart-image.png" alt="image" style="border-radius: 50%; object-fit: cover; width: 60px; height: 60px; object-position: center top; margin :5px;">
                                            <span>{{$data->nama}}</span>
                                        </th>
                                        <td>{{$data->no_induk}}</td>
                                        <td>{{$data->kelas}}</td>
                                        <td>{{$data->roles->role_name}}</td>
                                        <td>
    
                                        <button type="button" id="edit-user-btn" class="cart-dismiss edit-user-btn" data-userid="{{ $data->id }}" data-username="{{ $data->username }}" data-email="{{ $data->email }}">
    <i class="fas fa-edit"></i>
</button>

                                            <button type="button" class="cart-dismiss">
                                                <i class="fas fa-times"></i>
                                            </button>
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

    <div class="modal fade" id="tambah_user" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background-color: #170f2b; color: #fff;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('createUser') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fname">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="fname" placeholder="Nama User" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Username</label>
                                    <input type="text" class="form-control" name="username" id="lname" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">No Induk</label>
                                    <input type="number" class="form-control" id="phone" name="no_induk" placeholder="Nomor Induk" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="email">Password</label>
                                    <input type="text" class="form-control" id="email" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Kelas</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Level</label>                                    
                                </div>
                            </div>
                            <div class="form-row">     
                                <div class="form-group col-md-6">
                                    <select class="form-select" name="kelas" style="display: flex;">
                                    <option value="7A">7A</option>
                                    <option value="7B">7B</option>
                                    <option value="7C">7C</option>
                                    <option value="7D">7D</option>
                                    <option value="7E">7E</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    
                                    <select class="form-select" name="role_id" style="display: flex;">
                                    <option value="1">Guru</option>
                                    <option value="2">Siswa</option>
                                    </select>
                                </div>                     
                            </div>

                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn-lg btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    </section>


<script>
    $(document).ready(function () {
        $('#tambah_user_btn').click(function () {
            $('#tambah_user').modal('show');
        });
    });
</script>


<script>
    var currentRow = 0;
    var rowsPerPage = 5;
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