<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Latihan_soal;




class Dashboard extends Controller
{

    public function __invoke(): View
    {
        return view('index');
    }

    public function dashboard()
    {
        $siswa = Siswa::count();
        $guru = Guru::count();
        $latsol = Latihan_soal::count();

        return view('guru.dashboard', compact('siswa', 'guru', 'latsol'));
    }
    public function getKuis()
    {
        return view('siswa.kuis');
    }

    public function getKuispg()
    {
        return view('siswa.kuis-pilgan');
    }
}