<?php
namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class contoh extends Controller
{
public function exportData()
{
    // Query data untuk setiap tabel
    $data1 = DB::table('table1')->select('column1', 'column2')->get();
    $data2 = DB::table('table2')->select('column3', 'column4')->get();
    // ...

    // Membuat objek Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Menulis data ke lembar kerja pertama
    $sheet1 = $spreadsheet->getActiveSheet();
    $sheet1->setTitle('Sheet1');
    $sheet1->setCellValue('A1', 'Column1')->setCellValue('B1', 'Column2');
    $row = 2;
    foreach ($data1 as $item) {
        $sheet1->setCellValue('A' . $row, $item->column1)->setCellValue('B' . $row, $item->column2);
        $row++;
    }

    // Menulis data ke lembar kerja kedua
    $sheet2 = $spreadsheet->createSheet();
    $sheet2->setTitle('Sheet2');
    $sheet2->setCellValue('A1', 'Column3')->setCellValue('B1', 'Column4');
    $row = 2;
    foreach ($data2 as $item) {
        $sheet2->setCellValue('A' . $row, $item->column3)->setCellValue('B' . $row, $item->column4);
        $row++;
    }

    // ...

    // Eksport ke file Excel
    $writer = new Xlsx($spreadsheet);
    $writer->save(public_path('exports/data.xlsx'));
}
}
