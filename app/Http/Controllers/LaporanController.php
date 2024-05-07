<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LaporanController extends Controller
{
    const FILE_NAME = 'laporan_nilai_';
    public function laporan()
    {
        return view('guru.datalaporan');
    }
    
    
    public function exportData()
    {
        $user = auth()->user();
    
        $data = DB::table('users')
            ->select('users.nama', 'siswa.kelas', 'latihan_soal.bab as bab', 'latihan_soal.nama as latihan', 'submisi.nilai')
            ->join('siswa', 'siswa.users_id', '=', 'users.id')
            ->join('submisi', 'submisi.users_id', '=', 'users.id')
            ->join('latihan_soal', 'latihan_soal.id', '=', 'submisi.latihan_soal_id')
            ->where('latihan_soal.guru_id', $user->id)
            ->orderBy('users.nama')
            ->orderBy('siswa.kelas')
            ->orderBy('latihan_soal.nama')
            ->get();
    
        $data1 = DB::table('users')
            ->select('latihan_soal.nama')
            ->join('siswa', 'siswa.users_id', '=', 'users.id')
            ->join('submisi', 'submisi.users_id', '=', 'users.id')
            ->join('latihan_soal', 'latihan_soal.id', '=', 'submisi.latihan_soal_id')
            ->where('latihan_soal.guru_id', $user->id)
            ->orderBy('users.nama')
            ->orderBy('siswa.kelas')
            ->orderBy('latihan_soal.nama')
            ->distinct()
            ->pluck('nama');    

        $spreadsheet = new Spreadsheet();
    
        foreach ($data1 as $latihan_soal) {
            $data_for_sheet = $data->where('latihan', $latihan_soal);
    
            if ($data_for_sheet->isEmpty()) {
                continue;
            }
    
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle($latihan_soal);
            $sheet->setCellValue('A1', 'Nama')->setCellValue('B1', 'Kelas')->setCellValue('C1', 'Latihan')->setCellValue('D1', 'Bab')->setCellValue('E1', 'Nilai');
            
            $current_latihan_soal_id = null;
            $row = 2;
    
            foreach ($data_for_sheet as $item) {
                if ($current_latihan_soal_id !== $item->latihan) {
                    $sheet->setCellValue('A' . $row, $item->nama)->setCellValue('B' . $row, $item->kelas)->setCellValue('C' . $row, $item->latihan)->setCellValue('D' . $row, $item->bab)->setCellValue('E' . $row, $item->nilai);
                    $current_latihan_soal_id = $item->latihan;
                    $row++;
                } else {
                    $sheet->setCellValue('A' . $row, $item->nama)->setCellValue('B' . $row, $item->kelas)->setCellValue('C' . $row, '')->setCellValue('D' . $row, '')->setCellValue('E' . $row, $item->nilai);
                    $row++;
                }
            }
        }
    
        $spreadsheet->removeSheetByIndex(0);

        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . self::FILE_NAME . date('dmY_His') . '".xlsx');
        $writer->save('php://output');
        exit();
    }

    public function exportData2()
    {
        $user = auth()->user();
    
        $data = DB::table('users')
            ->select('users.nama', 'siswa.kelas', 'kuis.bab as bab', 'kuis.nama as kuis', 'hasil.nilai')
            ->join('siswa', 'siswa.users_id', '=', 'users.id')
            ->join('hasil', 'hasil.users_id', '=', 'users.id')
            ->join('kuis', 'kuis.id', '=', 'hasil.kuis_id')
            ->where('kuis.guru_id', $user->id)
            ->where('kuis.jenis', 'pilgan')
            ->orderBy('users.nama')
            ->orderBy('siswa.kelas')
            ->orderBy('kuis.nama')
            ->get();
    
        $data1 = DB::table('users')
            ->select('kuis.nama')
            ->join('siswa', 'siswa.users_id', '=', 'users.id')
            ->join('hasil', 'hasil.users_id', '=', 'users.id')
            ->join('kuis', 'kuis.id', '=', 'hasil.kuis_id')
            ->where('kuis.guru_id', $user->id)
            ->where('kuis.jenis', 'pilgan')
            ->orderBy('users.nama')
            ->orderBy('siswa.kelas')
            ->orderBy('kuis.nama')
            ->distinct()
            ->pluck('nama');
    
        $spreadsheet = new Spreadsheet();
    
        foreach ($data1 as $kuis) {
            $data_for_sheet = $data->where('kuis', $kuis);
    
            if ($data_for_sheet->isEmpty()) {
                continue;
            }
    
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle($kuis);
            $sheet->setCellValue('A1', 'Nama')->setCellValue('B1', 'Kelas')->setCellValue('C1', 'Kuis')->setCellValue('D1', 'Bab')->setCellValue('E1', 'Nilai');
            
            $current_kuis_id = null;
            $row = 2;
    
            foreach ($data_for_sheet as $item) {
                if ($current_kuis_id !== $item->kuis) {
                    $sheet->setCellValue('A' . $row, $item->nama)->setCellValue('B' . $row, $item->kelas)->setCellValue('C' . $row, $item->kuis)->setCellValue('D' . $row, $item->bab)->setCellValue('E' . $row, $item->nilai);
                    $current_kuis_id = $item->kuis;
                    $row++;
                } else {
                    $sheet->setCellValue('A' . $row, $item->nama)->setCellValue('B' . $row, $item->kelas)->setCellValue('C' . $row, '')->setCellValue('D' . $row, '')->setCellValue('E' . $row, $item->nilai);
                    $row++;
                }
            }
        }
    
        $spreadsheet->removeSheetByIndex(0);
    
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . self::FILE_NAME . date('dmY_His') . '".xlsx');
        $writer->save('php://output');
        exit();
    }

    public function exportData3()
    {
        $user = auth()->user();
    
        $data = DB::table('users')
            ->select('users.nama', 'siswa.kelas', 'kuis.bab as bab', 'kuis.nama as kuis', 'hasil.nilai')
            ->join('siswa', 'siswa.users_id', '=', 'users.id')
            ->join('hasil', 'hasil.users_id', '=', 'users.id')
            ->join('kuis', 'kuis.id', '=', 'hasil.kuis_id')
            ->where('kuis.guru_id', $user->id)
            ->where('kuis.jenis', 'bacaan')
            ->orderBy('users.nama')
            ->orderBy('siswa.kelas')
            ->orderBy('kuis.nama')
            ->get();
    
        $data1 = DB::table('users')
            ->select('kuis.nama')
            ->join('siswa', 'siswa.users_id', '=', 'users.id')
            ->join('hasil', 'hasil.users_id', '=', 'users.id')
            ->join('kuis', 'kuis.id', '=', 'hasil.kuis_id')
            ->where('kuis.guru_id', $user->id)
            ->where('kuis.jenis', 'bacaan')
            ->orderBy('users.nama')
            ->orderBy('siswa.kelas')
            ->orderBy('kuis.nama')
            ->distinct()
            ->pluck('nama');
    
        $spreadsheet = new Spreadsheet();
    
        foreach ($data1 as $kuis) {
            $data_for_sheet = $data->where('kuis', $kuis);
    
            if ($data_for_sheet->isEmpty()) {
                continue;
            }
    
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle($kuis);
            $sheet->setCellValue('A1', 'Nama')->setCellValue('B1', 'Kelas')->setCellValue('C1', 'Kuis')->setCellValue('D1', 'Bab')->setCellValue('E1', 'Nilai');
            
            $current_kuis_id = null;
            $row = 2;
    
            foreach ($data_for_sheet as $item) {
                if ($current_kuis_id !== $item->kuis) {
                    $sheet->setCellValue('A' . $row, $item->nama)->setCellValue('B' . $row, $item->kelas)->setCellValue('C' . $row, $item->kuis)->setCellValue('D' . $row, $item->bab)->setCellValue('E' . $row, $item->nilai);
                    $current_kuis_id = $item->kuis;
                    $row++;
                } else {
                    $sheet->setCellValue('A' . $row, $item->nama)->setCellValue('B' . $row, $item->kelas)->setCellValue('C' . $row, '')->setCellValue('D' . $row, '')->setCellValue('E' . $row, $item->nilai);
                    $row++;
                }
            }
        }
    
        $spreadsheet->removeSheetByIndex(0);
    
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . self::FILE_NAME . date('dmY_His') . '".xlsx');
        $writer->save('php://output');
        exit();
    }
}