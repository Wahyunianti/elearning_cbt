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
                    <div class="col-lg-12">
                        <div class="shop-cart-top" style="background-color: #14051d;">
                            <div class="row">
                            <div class="col align-item-center">
                            <div class="shop-cart-left float-left">
                            <h6>Data Laporan</h6>
                            </div>
                            </div>

                            </div>
                        </div>
                        
                        @include('layouts.alert-flash-message')
                        <div class="table-responsive" >
                            <table class="table">
                                <thead style="background-color: #0d0310;">
                                    <tr>
                                        <th scope="col">Data</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" style="background-color: #14051d;">
                                    <tr>
                                        <th scope="row">
                                            <img src="img/graph.png" alt="image" style="border-radius: 50%; object-fit: cover; width: 60px; height: 60px; object-position: center top; margin :5px;">
                                            <span>Laporan Nilai Latihan</span>
                                        </th>
                                        <td><i class="fas fa-file-excel"></i><span style="margin-left:5px; margin-right:5px;"><a href="{{route('cetak.export')}}" style="font-size: 14px;">Unduh Excel</a></span><i class="fas fa-download"></i></td>

                                    </tr> 
                                    <tr>
                                        <th scope="row">
                                            <img src="img/graph.png" alt="image" style="border-radius: 50%; object-fit: cover; width: 60px; height: 60px; object-position: center top; margin :5px;">
                                            <span>Laporan Nilai Kuis Pilihan Ganda</span>
                                        </th>
                                        <td><i class="fas fa-file-excel"></i><span style="margin-left:5px; margin-right:5px;"><a href="{{route('cetak.export2')}}" style="font-size: 14px;">Unduh Excel</a></span><i class="fas fa-download"></i></td>

                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <img src="img/graph.png" alt="image" style="border-radius: 50%; object-fit: cover; width: 60px; height: 60px; object-position: center top; margin :5px;">
                                            <span>Laporan Nilai Kuis Bacaan</span>
                                        </th>
                                        <td><i class="fas fa-file-excel"></i><span style="margin-left:5px; margin-right:5px;"><a href="{{route('cetak.export3')}}" style="font-size: 14px;">Unduh Excel</a></span><i class="fas fa-download"></i></td>

                                    </tr>       
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