@extends('layouts.main')

@section('content')
@include('sweetalert::alert')
<section id="banner-section" style="background: #1a052a; padding-bottom: 0px; padding-top: 80px;" class="inner-banner profile features shop">
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
<form action="{{ route('editSis') }}" method="post" enctype="multipart/form-data">
                        @csrf
    <div class="overlay">
        <div class="container">
            <div class="row">                
                <div class="col-lg-4">
                    <div class="shop-cart-top" style="background-color: #2e1440;">
                    <div class="col">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-12 text-center">
                                <p >Edit Profil</p>
                                @if($dataUser->siswa->foto)
                                <img id="previewImage" src="{{ asset('storage/foto/' . $dataUser->siswa->foto) }}" alt="Default Foto Profil" style="margin-top: 20px; object-fit: cover; width: 100px; height: 100px; object-position: center top;" class="img-fluid img-thumbnail">
                                @else
                                <img id="previewImage" src="{{ asset('img/user.png') }}" alt="Default Foto Profil" style="margin-top: 20px; object-fit: cover; width: 100px; height: 100px; object-position: center top;" class="img-fluid img-thumbnail">
                                @endif
                                <div class="col-lg-12">
                                <button type="button" onclick="document.getElementById('file').click()"  class="cmn-btn btn-sm clear-btn float-left" style="color: #fff; margin-bottom: 15px; margin-top: 20px; margin-right: 20px; margin-left: 20px; width: -webkit-fill-available;">Ganti Foto</button>              
                                </div>
                                <input onchange="previewFile()" class="text-sm" type="file" accept="image/*" id="file" placeholder="Pilih Foto" style="background: #0d0310;color: #757575; border-radius: 5px; margin-bottom: 15px; margin-top: 20px; visibility: hidden; position: absolute;" name="foto">
                                <style>
                                    input[type=file]::-webkit-file-upload-button {
                                        visibility: hidden;
                                        background: #81407d;
                                        color: #fff;
                                        border: 1px solid #81407d;
                                        border-radius: 5px;
                                        padding: 5px 10px;
                                        cursor: pointer;
                                    }
                                </style>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="shop-cart-top" style="background-color: #0d0310;">
                                <input class="text-sm" type="text" id="name" placeholder="{{$dataUser->nama}}" style="background: #2e1440;color: #0b0410;border-radius: 5px;margin-bottom: 15px;margin-top: 10px;text-align: center;" name="name" disabled>
                                <input class="text-sm" type="text" id="role" placeholder="<?php echo ucwords($dataUser->roles->role_name);?>" style="background: #2e1440;color: #0b0410;border-radius: 5px;margin-bottom: 15px;margin-top: 10px;text-align: center;" name="role" disabled>
                                <input class="text-sm" type="text" id="email" placeholder="{{$dataUser->email}}" style="background: #2e1440;color: #0b0410;border-radius: 5px;margin-bottom: 15px;margin-top: 10px;text-align: center;" name="email" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="shop-cart-top" style="background-color: #2e1440; color: #fff;">
                            @include('layouts.alert-flash-message')
                            <div class="form-row" style="height: auto;">
                                <div class="form-group col-md-12">
                                    <label for="fname">Nama</label>
                                    <input type="text" style="background: rgb(13, 3, 16); font-size: 16px;" class="form-control" name="nama" id="name" value="{{$dataUser->nama}}" placeholder="Nama User">
                                    <input class="text-sm" type="text" id="id" style="visibility: hidden; position: absolute;" name="id">
                                </div>
                            </div>
                            <div class="form-row">                                
                                <div class="form-group col-md-12">
                                    <label for="lname">Username</label>
                                    <input type="text" style="background: rgb(13, 3, 16); font-size: 16px;" class="form-control" name="username" id="username" value="{{$dataUser->username}}" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-row">                           
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" style="background: rgb(13, 3, 16)" class="form-control" id="email" name="email" value="{{$dataUser->email}}" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="phone">No Induk</label>
                                    <input type="number" style="background: rgb(13, 3, 16)" class="form-control" id="noinduk" name="no_induk" value="{{$dataUser->no_induk}}" placeholder="Nomor Induk">
                                </div>
                            </div>
                            <div class="form-row" id="passwordField" >
                                <div class="form-group col-lg-12">
                                    <label for="email">Password</label><span><p style="font-size:14px; color: #816489; margin-left:5px;">*(opsional)</p></span>
                                    <input type="text" style="background: rgb(13, 3, 16); font-size: 16px;" class="form-control" name="password" placeholder="Ganti Password">
                                </div>
                            </div>                            
                            <div class="form-row"> 
                            <div class="col">
                                <button type="submit" name="submit" id="proses" class="cmn-btn btn-sm float-right" style="color: #fff; margin-top: 10px;">Simpan</button>              
                            </div>            
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
</section>

<script>
    function previewFile() {
        var preview = document.getElementById('previewImage');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('img/user.png') }}";
        }
    }
</script>
@endsection
