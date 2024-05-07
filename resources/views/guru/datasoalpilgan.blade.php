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
                        <h5>Bab {{ $kuis->bab }} {{ $kuis->nama }} ({{ $hitung }} Soal)</h5>
                    </div>


                        <div class="shop-cart-top" id="menilai" style="background-color: #14051d; color: #fff;">
                <form class="form-horizontal" id="myForm" action="{{ route('createDataSoal2') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row" id="gambar" style="display: none;">
                                <div class="form-group col" style="text-align: -webkit-center;">
                                        <img id="fotoSoal" src="" style="width: 300px;">
                                </div>                                                                                                        
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                        <label id="tbhlink" for="email">Pertanyaan</label>
                                        <textarea style="background: rgb(13, 3, 16);"  class="form-control" name="question" id="question"
                                            placeholder="Tulis Pertanyaan"
                                            value=""></textarea> 
                                </div>                                                                                                        
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                        <label id="tbhlink" for="email">Jawaban</label>
                                        <input style="background: rgb(13, 3, 16); margin-bottom: 15px;"  type="text" class="form-control" id="options1" name="options[0]" placeholder="Jawaban A" >
                                        <input style="background: rgb(13, 3, 16); margin-bottom: 15px;"  type="text" class="form-control" id="options2" name="options[1]" placeholder="Jawaban B" >
                                        <input style="background: rgb(13, 3, 16); margin-bottom: 15px;"  type="text" class="form-control" id="options3" name="options[2]" placeholder="Jawaban C" >
                                        <input style="background: rgb(13, 3, 16); margin-bottom: 15px;"  type="text" class="form-control" id="options4" name="options[3]" placeholder="Jawaban D" >
                                </div>                                                                                                        
                            </div>
                            <div class="form-row" style="height: auto;">
                                <div class="form-group col-md-6">
                                    <div class="row" style="margin-left: 0px; margin-right: 0px; text-align: center;">
                                    <label for="kelas">Kunci Jawaban</label>
                                    <select class="form-select" name="correct_option" id="correct_option" style="display: flex; font-size: 16px; height: 55px">
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    </select>     
                                    <input class="text-sm" type="text" id="id" style="visibility: hidden; position: absolute;" name="id">
                                    </div> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="lbfoto" for="lname">Sematkan Foto</label>
                                    <input class="text-sm" type="file" accept="image/*" id="foto" accept="image/*"  placeholder="Pilih Foto" style="background: #0d0310;color: #757575; border-radius: 5px; margin-bottom: 15px;" name="foto">
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
                                    <input class="text-sm"  value="{{$id}}" type="text" style="visibility: hidden; position: absolute;" name="kuis_id">
                                    
                                </div>
                            </div>
                           
                            <div class="form-row">     
                            <div class="col">
                                <button type="button" class="cmn-btn btn-sm clear-btn float-left" style="color: #fff; margin-top: 0px;">Clear</button>              
                            </div>
                            <div class="col">
                            <button type="submit" class="cmn-btn btn-sm float-right" id="tambahButton" style="color: #fff; margin-top: 0px;">Tambah</button>              
                            <button type="button" id="editButton" class="cmn-btn btn-sm float-right" style="color: #fff; margin-top: 0px; display:none;">Edit</button></div>
                                
                        </div>            
                            </div>

                </form>
                        </div>
                <div class="col-lg-12">
                        
                        @include('layouts.alert-flash-message')
                        <div class="table-responsive" >
                            <table class="table ">
                                <thead style="background-color: #0d0310;">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Pertanyaan</th>
                                        <th scope="col">Kunci</th>
                                        <th scope="col">Foto</th>
                                        <th colspan="2" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" style="background-color: #14051d;">
                                @foreach ($dataPilgan as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>                                        
                                        <th scope="row">
                                        <img src="{{asset('img/question.png')}}" alt="image" style="width: 60px; height: 60px; object-position: center top; margin :5px;">
                                        <span>{{ $data->question }}</span>
                                        </th>
                                        <td>{{ $data->correct_option }}</td>                                        
                                        <td>
                                        @if (!is_null($data->foto))
                                        {{ Str::after($data->foto, '_') }}
                                        @else
                                            -
                                        @endif
                                        </td>                                        
                                        <td><button type="button" id="edit-btn" class="cart-dismiss edit-btn" data-id="{{$data->id}}" data-question="{{$data->question}}" data-options="{{$data->options}}" data-foto="{{$data->foto}}" data-correct_option="{{$data->correct_option}}">
                                            <i class="fas fa-edit"></i>
                                        </button></td>
                                        <td>       
                                        
                                        <form action="{{ route('delete_user', $data->id) }}" method="POST">
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
        </div>

    </section>

    <script>
document.getElementById('editButton').addEventListener('click', function() {
        document.getElementById('myForm').action = "{{ route('createDataSoal') }}";
        document.getElementById('myForm').submit();
    });
$(document).ready(function() {
  $('.edit-btn').click(function() {
    var id = $(this).data('id');
    var question =  $(this).data('question');
    var options =  $(this).data('options');
    var correct_option =  $(this).data('correct_option');  
    $('#fotoSoal').css('display', 'none');
    document.getElementById('question').style.color = '#fff';
    document.getElementById('options1').style.color = '#fff';
    document.getElementById('options2').style.color = '#fff';
    document.getElementById('options3').style.color = '#fff';
    document.getElementById('options4').style.color = '#fff';    
    document.getElementById('correct_option').style.color = '#fff';

    var foto = $(this).data('foto');

    if (foto === '') {
        document.getElementById('gambar').style.display = 'flex';
        $('#fotoSoal').css('display', 'none');
    } else {
        document.getElementById('gambar').style.display = 'flex';        
        var fotoSoal = '{{ asset('storage/soal/') }}' + '/' + foto;
        $('#fotoSoal').css('display', 'flex');
        $('#fotoSoal').attr('src', fotoSoal);
    }
    var separatedOptions = options.split('|');

    var options1 = separatedOptions[0];
    var options2 = separatedOptions[1];
    var options3 = separatedOptions[2];
    var options4 = separatedOptions[3];

    $('#editButton').css('display', 'flex');
    $('#tambahButton').css('display', 'none');

    $('#id').val(id);
    $('#question').val(question);
    $('#options1').val(options1);
    $('#options2').val(options2);
    $('#options3').val(options3);
    $('#options4').val(options4);
    $('#lbfoto').text('Ganti Foto ');
    $('#proses').text('Edit');
    $('#correct_option').val(correct_option);
 
    $('#menilai').css('box-shadow', '0 0 10px 5px rgb(202 0 255 / 50%)').fadeIn();
  });
  $('.clear-btn').click(function() {
    document.getElementById('gambar').style.display = 'none';
    $('#fotoSoal').attr('src', '');
    $('#fotoSoal').css('display', 'none');
    $('#editButton').css('display', 'none');
    $('#tambahButton').css('display', 'flex');

    document.getElementById('question').style.color = '#757575';
    document.getElementById('options1').style.color = '#757575';
    document.getElementById('options2').style.color = '#757575';
    document.getElementById('options3').style.color = '#757575';
    document.getElementById('options4').style.color = '#757575';   
    document.getElementById('correct_option').style.color = '#757575';

    $('#menilai').css('box-shadow', 'none');

    $('#id').val('');
    $('#question').val('');
    $('#options1').val('');
    $('#options2').val('');
    $('#options3').val('');
    $('#options4').val('');
    $('#proses').text('Tambah');
    $('#lbfoto').text('Sematkan Foto ');
    $('#correct_option').val('A');

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