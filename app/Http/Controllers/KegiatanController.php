<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Submit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class KegiatanController extends Controller
{

    public function kegiatan()
{
    $user = auth()->user();
    $dataHs = Hasil::join('kuis', 'hasil.kuis_id', '=', 'kuis.id')
            ->where('hasil.users_id', $user->id)
            ->select('hasil.*', 'kuis.nama as kuis_nama', 'kuis.jenis as jns', 'kuis.bab as babs', 'hasil.updated_at as update',  DB::raw("DATE_FORMAT(hasil.updated_at, '%d/%m/%Y') as tgl"))
            ->get();

    $dataSb = Submit::join('latihan_soal', 'submisi.latihan_soal_id', '=', 'latihan_soal.id')
            ->where('submisi.users_id', $user->id)
            ->select('submisi.*', 'latihan_soal.nama as kuis_nama', 'latihan_soal.bab as babs', 'submisi.updated_at as update',  DB::raw("DATE_FORMAT(submisi.updated_at, '%d/%m/%Y') as tgl"))
            ->get();

    $dataHs = $dataHs->map(function ($item) {
        $item['jenis'] = 'Kuis';
        return $item;
    });

    $dataSb = $dataSb->map(function ($item) {
        $item['jenis'] = 'Latihan Soal';
        return $item;
    });

    $kegiatan = collect([$dataHs, $dataSb])->collapse();

    $kegiatan = $kegiatan->map(function ($item) {
        $item['jenis_kuis'] = $item['jns'];
        return $item;
    });

    $kegiatan = $kegiatan->sortByDesc('update');

    return view('siswa.kegiatan', [
        'dataKg' => $kegiatan,
    ]);

}


}