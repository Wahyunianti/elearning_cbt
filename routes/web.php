<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Materi;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\KuisPilganController;
use App\Http\Controllers\KuisBacaanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EditProfilController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    
    return view('index');
});

//Login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    //Dashboard
    Route::get('Sdashboard', Dashboard::class)->name('Sdashboard');
    Route::get('Gdashboard', [Dashboard::class, 'dashboard'])->name('Gdashboard');
});

Route::middleware('isSiswa')->group(function () {

    //Materi
    Route::get('materi', [Materi::class, 'Materi'])->name('materi');
    Route::get('/viewEb/{id}', [Materi::class, 'view'])->name('viewEb');
    Route::get('/downloadEb/{id}', [Materi::class, 'download'])->name('downloadEb');

    //Latihan
    Route::get('latsol', [LatihanController::class, 'latsol'])->name('latsol');
    Route::get('carilatsol', [LatihanController::class, 'cari'])->name('carilatsol');
    Route::get('tampil/{id}', [LatihanController::class, 'show'])->name('tampil');
    Route::get('/viewlat/{id}', [LatihanController::class, 'view'])->name('viewLat');
    Route::get('/downloadlat/{id}', [LatihanController::class, 'download'])->name('downloadLat');
    Route::post('submision', [LatihanController::class, 'submisi'])->name('submision');
    Route::get('/tampilSubmisis/{id}', [LatihanController::class, 'viewSubmisi'])->name('tampilSubmisis');

    //Pilgan
    Route::get('getKuis', [Dashboard::class, 'getKuis'])->name('getKuis');
    Route::get('Kuispg', [KuisPilganController::class, 'Kuispg'])->name('Kuispg');
    Route::get('search', [KuisPilganController::class, 'Cari'])->name('search');    
    Route::post('selesai', [KuisPilganController::class, 'selesai'])->name('selesai');
    
    //Bacaan
    Route::get('Kuisbc', [KuisBacaanController::class, 'Kuisbc'])->name('Kuisbc');
    Route::post('Kuiskor/{id}', [KuisBacaanController::class, 'Kuiskor'])->name('Kuiskor');


    Route::prefix('quiz')->group(function() {

        //Pilgan
        Route::get('/infogan/{id}', [KuisPilganController::class, 'getInfo'])
            ->name('quiz.infogan');

        Route::get('/startgan/{id}', [KuisPilganController::class, 'startQuiz'])
            ->name('quiz.startgan');

        Route::get('/submit/{id}', [KuisPilganController::class, 'submit'])
            ->name('quiz.submit');

        Route::post('/selesai', [KuisPilganController::class, 'selesai'])
            ->name('quiz.selesai');

        //Bacaan
        Route::get('/infocan/{id}', [KuisBacaanController::class, 'getInfo'])
            ->name('quiz.infocan');

        Route::get('/startcan/{id}', [KuisBacaanController::class, 'startQuiz'])
            ->name('quiz.startcan');
    });

    //Kegiatan
    Route::get('Kegiatan', [KegiatanController::class, 'kegiatan'])->name('kg');

    //Profil
    Route::get('editProfilSis', [EditProfilController::class, 'getSiswa'])->name('editProfilSis');
    Route::post('editSis', [EditProfilController::class, 'editSiswa'])->name('editSis');

});

Route::middleware('isGuru')->group(function () {

    //Data User
    Route::get('dataUsers', [UserController::class, 'getData'])->name('dataUsers');
    Route::post('createUser', [UserController::class, 'create'])->name('createUser');     
    Route::get('searchUsers', [UserController::class, 'Cari'])->name('searchUsers');
    Route::post('delete_user/{id}', [UserController::class, 'destroy'])->name('delete_user');  

    //Data Ebook
    Route::get('dataEbook', [EbookController::class, 'getData'])->name('dataEbook');
    Route::post('createEbook', [EbookController::class, 'create'])->name('createEbook');   
    Route::post('delete_ebook/{id}', [EbookController::class, 'destroy'])->name('delete_ebook'); 
    
    //Data Latihan
    Route::get('dataLatihan', [LatihanController::class, 'getData'])->name('dataLatihan');
    Route::post('createLatihan', [LatihanController::class, 'create'])->name('createLatihan');  
    Route::get('searchLatihan', [LatihanController::class, 'cari2'])->name('searchLatihan');
    Route::post('delete_file/{id}', [LatihanController::class, 'destroy_file'])->name('delete_file');  
    Route::post('delete_link/{id}', [LatihanController::class, 'destroy_link'])->name('delete_link');  
    Route::post('delete_latsol/{id}', [LatihanController::class, 'destroy'])->name('delete_latsol');  
    Route::get('nilai_submisi/{id}/{kelas}', [LatihanController::class, 'nilaiData'])->name('nilai_submisi');
    Route::post('nilaiSub', [LatihanController::class, 'nilai'])->name('nilaiSub');  
    Route::get('/tampilSubmisi/{id}', [LatihanController::class, 'viewSubmisi'])->name('tampilSubmisi');
    Route::get('/viewlat/{id}', [LatihanController::class, 'view'])->name('viewLat');
    Route::get('/downloadlat/{id}', [LatihanController::class, 'download'])->name('downloadLat');

    //Data Pilihan Ganda
    Route::get('dataPilgan', [KuisPilganController::class, 'getData'])->name('dataPilgan');
    Route::post('createPilgan', [KuisPilganController::class, 'create'])->name('createPilgan');  
    Route::get('dataSoal/{id}', [KuisPilganController::class, 'getDataSoal'])->name('dataSoal');
    Route::post('createDataSoal', [Materi::class, 'createSoalPilgann'])->name('createDataSoal'); 
    Route::post('createDataSoal2', [Materi::class, 'createSoalPilgann2'])->name('createDataSoal2');  

    Route::get('hasil_submisi/{id}/{kelas}', [KuisPilganController::class, 'hasilData'])->name('hasil_submisi');
    Route::post('delete_pilgan/{id}', [KuisPilganController::class, 'destroy'])->name('delete_pilgan');  

    //Data Bacaan
    Route::get('dataBacaan', [KuisBacaanController::class, 'getData'])->name('dataBacaan');
    Route::post('createBacaan', [KuisBacaanController::class, 'create'])->name('createBacaan');  
    Route::post('delete_bacaan/{id}', [KuisBacaanController::class, 'destroy'])->name('delete_bacaan');  

    //Data Cetak Laporan
    Route::get('dataLaporan', [LaporanController::class, 'laporan'])->name('dataLaporan');
    Route::get('/cetak/export', [LaporanController::class, 'exportData'])->name('cetak.export');
    Route::get('/cetak/export2', [LaporanController::class, 'exportData2'])->name('cetak.export2');
    Route::get('/cetak/export3', [LaporanController::class, 'exportData3'])->name('cetak.export3');

    //Data Profil
    Route::get('editProfilAdm', [EditProfilController::class, 'getAdmin'])->name('editProfilAdm');
    Route::post('editAdm', [EditProfilController::class, 'editAdmin'])->name('editAdm');

});

//Materi
Route::get('mat1', [Materi::class, 'Materi1'])->name('mat1');
Route::get('mat2', [Materi::class, 'Materi2'])->name('mat2');
Route::get('mat3', [Materi::class, 'Materi3'])->name('mat3');
Route::get('mat4', [Materi::class, 'Materi4'])->name('mat4');
Route::get('mat5', [Materi::class, 'Materi5'])->name('mat5');
Route::get('mat6', [Materi::class, 'Materi6'])->name('mat6');



