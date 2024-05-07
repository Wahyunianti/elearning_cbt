@if(session('berhasil'))
<div id="success-alert" style="padding-left: 0px; padding-right: 0px; margin-bottom: 10px;text-align:center; background-color: #14051d; color: #81407d; border: 1px solid #81407d; z-index: 2000;" class="alert alert-success alert-dismissable fade show">
    <i class="far fa-check-circle"></i> {{ session('berhasil') }}
</div>
@endif

@if(session('warning'))
<div id="warning-alert" class="alert alert-warning alert-dismissable fade show">
    <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }}
</div>
@endif 

@if($errors->any())
<div id="errorO-alert" style="padding-left: 0px; padding-right: 0px; margin-bottom: 10px;text-align:center; background-color: #14051d; color: #81407d; border: 1px solid #81407d; z-index: 2000;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-triangle" ></i>
    <strong >Gagal !</strong>
    <ul>
        <div class="row justify-content-center" style="margin-top:3px;">
            @foreach($errors->all() as $pesan)
            <div class="col-md-12" style="margin-bottom: 10px">
                <li style="color: #81407d;">{{ $pesan }}</li>
            </div>
            @endforeach
        </div>
    </ul>   
</div>
@endif

<script>
    setTimeout(function() {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }

        var warningAlert = document.getElementById('warning-alert');
        if (warningAlert) {
            warningAlert.style.display = 'none';
        }

        var errorlo = document.getElementById('errorO-alert');
        if (errorlo) {
            errorlo.style.display = 'none';
        }
    }, 5000);
</script>
