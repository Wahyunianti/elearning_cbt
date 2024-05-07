<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\Pilgan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Materi extends Controller
{

    public function __invoke(): View
    {
        return view('index');
    }

    public function Materi()
    {
        $now = Carbon::now();
        $user = auth()->user();
        $dataEbook = Ebook::Join('guru', 'guru.id', '=', 'e-book.guru_id')   
        ->Join('kelas', 'kelas.guru_id', '=', 'guru.id')
        ->Join('siswa', 'siswa.kelas', '=', 'kelas.kelas')             
        ->select('e-book.*')
        ->where('siswa.id', $user->id)
        ->orderBy('judul', 'asc')
        ->get();

        return view('siswa.materi', [
            "dataEbook" => $dataEbook,
        ]);

    }

    public function view($id)
    {
        $view = Ebook::find($id);

        if (!$view) {
            abort(404);
        }
        $filePath = public_path('storage/ebook/' . $view->file);

        return response()->file($filePath, ['Content-Type' => 'application/pdf']);
    }

    public function download($id)
    {
        $download = Ebook::find($id);
        $path = Storage::disk('public')->path('ebook/' . $download->file);
        return response()->download($path, $download->file);
    }

    public function Materi1()
    {
        return view('materi.bab1');
    }

    public function Materi2()
    {
        return view('materi.bab2');
    }

    public function Materi3()
    {
        return view('materi.bab3');
    }

    public function Materi4()
    {
        return view('materi.bab4');
    }

    public function Materi5()
    {
        return view('materi.bab5');
    }

    public function Materi6()
    {
        return view('materi.bab6');
    }

    public function createSoalPilgann(Request $request)
    {

        $message = [
            'question.required' => 'Pertanyaan tidak boleh kosong',
            'options.required' => 'Jawaban tidak boleh kosong',
        ];

        $this->validate($request, [
            'question' => 'required',
            'options.*' => 'required',
        ], $message);

        $file = Pilgan::findOrFail($request->id);

        $data = Pilgan::find($request->id);  
        $options = implode('|', $request->input('options'));

        if ($data) {
            $data->question = $request->question;
            $data->options = $options;
            if ($request->hasFile('foto')) {
                $oldFileName = $file->foto;
                if ($oldFileName && Storage::exists('public/soal/' . $oldFileName)) {
                    Storage::delete('public/soal/' . $oldFileName);
                }
                $foto =  $request->file('foto');    
                $fileName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('public/soal', $fileName);  
                $data->foto = $fileName;
            }  
            $data->correct_option = $request->correct_option;
            $data->save();
            
        } else {            
            $data1 = new Pilgan();       
            $data1->question = $request->question;
            $data1->options = $options;
            if ($request->hasFile('foto')) {
                    $foto =  $request->file('foto');    
                    $fileName = time() . '_' . $foto->getClientOriginalName();
                    $foto->storeAs('public/soal', $fileName);  
                    $data1->foto = $fileName;
                }                
            $data1->kuis_id = $request->kuis_id;
            $data1->correct_option = $request->correct_option;
            $data1->save();
        }
    
        return redirect()->back()->with('berhasil', 'Data berhasil disimpan');
    }

    public function createSoalPilgann2(Request $request)
    {

        $message = [
            'question.required' => 'Pertanyaan tidak boleh kosong',
            'options.required' => 'Jawaban tidak boleh kosong',
        ];

        $this->validate($request, [
            'question' => 'required',
            'options.*' => 'required',
        ], $message);


        $options = implode('|', $request->input('options'));          
            $data1 = new Pilgan();       
            $data1->question = $request->question;
            $data1->options = $options;
            if ($request->hasFile('foto')) {
                    $foto =  $request->file('foto');    
                    $fileName = time() . '_' . $foto->getClientOriginalName();
                    $foto->storeAs('public/soal', $fileName);  
                    $data1->foto = $fileName;
                }                
            $data1->kuis_id = $request->kuis_id;
            $data1->correct_option = $request->correct_option;
            $data1->save();
    
        return redirect()->back()->with('berhasil', 'Data berhasil disimpan');
    }
}