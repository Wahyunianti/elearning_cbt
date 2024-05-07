<?php

namespace App\Http\Controllers;

use FFI;
use PythonBridge;
use Illuminate\Http\Request;
use App\Models\Bacaan;
use App\Models\Hasil;
use App\Models\Kuis;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KuisBacaanController extends Controller
{
    public function Kuisbc()
    {
        $now = Carbon::now();
        $user = auth()->user();

        $dataKuis = Kuis::Join('guru', 'guru.id', '=', 'kuis.guru_id')   
        ->Join('kelas', 'kelas.guru_id', '=', 'guru.id')
        ->Join('siswa', 'siswa.kelas', '=', 'kelas.kelas')             
        ->select('kuis.*')
        ->where('siswa.id', $user->id)
        ->where('jenis', 'bacaan')
        ->orderBy('nama', 'asc')
        ->get();

        foreach ($dataKuis as $latihan) {
            $hasil = Hasil::where('users_id', $user->id)
                            ->where('kuis_id', $latihan->id)
                            ->get();
            $latihan->hasil = $hasil;

            $tenggat = Carbon::parse($latihan->tenggat);

            $latihan->belum_lewat_tenggat = $now->lessThan($tenggat->endOfDay());
            $latihan->sudah_lewat_tenggat = $now->isAfter($tenggat->endOfDay());
        }
        
        return view('siswa.kuis-bacaan', [
            "dataKuis" => $dataKuis,
        ]);

    }

    public function getInfo(Request $request)
    {
        $id = $request->id;
        $dataInfo = Kuis::findOrFail($id);
        return view('siswa.bacaan-info', compact('dataInfo', 'id'));
    }

    public function startQuiz(Request $request)
    {

        $quizId = $request->id;


        $quiz = Kuis::find($quizId);
        $bacaan = Bacaan::where('kuis_id', $quizId)->get();


        return view('siswa.mulai-bacaan', ['soal' => $bacaan, 'kuis' => $quiz]);

    }

    public function Kuiskor(Request $request,$id)
    {
        $user = auth()->user()->id;
        $kuis = $id;
        $sentence = $request->koreksi;
        $text1 = json_decode('"'.$sentence.'"');
        $now = Carbon::now();
        $dataInfo = Kuis::findOrFail($kuis);
        
        $tenggat = Carbon::parse($dataInfo->tenggat);

        $tgll = $now->greaterThan($tenggat);

        $readings = Bacaan::where('kuis_id', $kuis)->pluck('jawaban')->first();
        $text2 = json_decode('"'.$readings.'"');

        $inputWords = explode(' ', $text1);
        $databaseWords = explode(' ', $text2);



        $totalPoints = 0;

        $foundWords = [];

        foreach ($inputWords as $word) {
            if (in_array($word, $databaseWords)) {
                $totalPoints++;
                $foundWords[] = $word;
            }
        }

        $wordCount = count(explode(' ', $text2))-1;

        if($tgll){
            $nilai = (100-10)/$wordCount * ($totalPoints);
        }else{
            $nilai = 100/$wordCount * ($totalPoints);
        }

        $hasil = Hasil::where('kuis_id', $kuis)
            ->where('users_id', $user)
            ->first();

        if ($hasil) {
            $hasil->update(['nilai' => $nilai]);
        } else {
            $data = new Hasil();
            $data->nilai = $nilai;
            $data->users_id = $user;
            $data->kuis_id = $kuis;
            $data->save();
        }

        echo "Total points: " . $totalPoints . "\n"  . $nilai . "\n"  . $wordCount ;
        echo "Kata-kata yang ditemukan dalam database: " . implode(', ', $foundWords);
        echo "DB : " . implode(', ', $databaseWords);

        return response()->json();
        // return redirect('/Kegiatan');
    }

    public function getData()
    {        
        $user = auth()->user()->id;
        $dataKuis = Kuis::where('guru_id', $user)->where('jenis', 'bacaan')->get();
        $guruA = DB::table('guru')        
        ->where('users_id', $user)
        ->get();

        foreach ($dataKuis as $latihan) {
            $results = DB::table('kelas')
                ->leftJoin('guru', 'kelas.guru_id', '=', 'guru.id')
                ->leftJoin('kuis', 'kuis.guru_id', '=', 'guru.id')
                ->select('kelas.kelas')
                ->selectRaw('(SELECT COUNT(*) FROM siswa WHERE siswa.kelas = kelas.kelas) AS jumlah_siswa')
                ->selectRaw('(SELECT COUNT(*) FROM hasil 
                            JOIN users ON hasil.users_id = users.id
                            JOIN siswa ON siswa.users_id = users.id
                            WHERE siswa.kelas = kelas.kelas AND hasil.kuis_id = ?) AS jumlah_submisi', [$latihan->id])
                ->groupBy('kelas.kelas')
                ->where('guru.id',$user)
                ->get();
            
            $latihan->results = $results;
        }

        return view('guru.databacaan', compact('dataKuis', 'guruA'));

    }

    public function hasilData(Request $request)
    {
        $id = $request->id;
        $kls = $request->kelas;
        $dataInfo = Kuis::findOrFail($id);
        $results = DB::table('kelas')
            ->leftJoin('guru', 'kelas.guru_id', '=', 'guru.id')
            ->leftJoin('kuis', 'kuis.guru_id', '=', 'guru.id')
            ->leftJoin('siswa', 'kelas.kelas', '=', 'siswa.kelas')
            ->leftJoin('users', 'siswa.users_id', '=', 'users.id')
            ->leftJoin('hasil', 'users.id', '=', 'hasil.users_id')
            ->select('kelas.kelas', 'users.nama as nama', 'hasil.nilai as nilai', 'hasil.updated_at as date')
            ->where('kuis.id', $id)
            ->where('hasil.kuis_id', $id)
            ->where('kelas.kelas', $kls )
            ->groupBy('kelas.kelas', 'users.nama', 'hasil.nilai', 'hasil.updated_at')
            ->get();

        $submisis = $results;
        return view('guru.datahasil', compact('dataInfo', 'id', 'submisis', 'kls'));
    }

    public function create(Request $request)
    {

        $message = [
            'nama.required' => 'Nama tidak boleh kosong',
            'duration.required' => 'Durasi tidak boleh kosong',
            'tenggat.required' => 'Tenggat tidak boleh kosong',
            'soal.required' => 'Soal tidak boleh kosong',
            'jawaban.required' => 'Jawaban tidak boleh kosong',
        ];

        $this->validate($request, [
            'nama' => 'required',
            'duration' => 'required',
            'tenggat' => 'required',
            'soal' => 'required',
            'jawaban' => 'required',
        ], $message);

            $data = Kuis::find($request->id);
            $uid = mt_rand(100000, 999999);
            $bacaan = $request->bacaan_id;
            $kuis_id = $uid;

        if ($data) {
            $data->bab = $request->bab;
            $data->nama = $request->nama;
            $data->tenggat = $request->tenggat;
            $data->ubah = $request->ubah;
            $data->duration = $request->duration;
            $data->save();

            $data0 = Bacaan::find($bacaan);     
            $data0->soal = $request->soal;
            $data0->jawaban = $request->jawaban;
            if ($request->hasFile('foto')) {
                $oldFileName = $data0->foto;
                if ($oldFileName && Storage::exists('public/soal/' . $oldFileName)) {
                    Storage::delete('public/soal/' . $oldFileName);
                } 
                $foto =  $request->file('foto');    
                $fileName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('public/soal', $fileName);  
                $data0->foto = $fileName;
            }  
            $data0->save();
            
        } else {            
            $data = new Kuis();   
            $data->id = $kuis_id;
            $data->bab = $request->bab;
            $data->nama = $request->nama;
            $data->jenis = "bacaan";
            $data->tenggat = $request->tenggat;
            $data->ubah = $request->ubah;     
            $data->duration = $request->duration;
            $data->guru_id = $request->guru_id;
            $data->save();

            $data0 = new Bacaan();  
            $data0->soal = $request->soal;
            $data0->jawaban = $request->jawaban;
            if ($request->hasFile('foto')) {
                $foto =  $request->file('foto');    
                $fileName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('public/soal', $fileName);  
                $data0->foto = $fileName;
            } 
            $data0->kuis_id = $kuis_id;
            $data0->save();
        }
        return redirect('/dataBacaan')->with('berhasil', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->delete();

        return redirect('/dataBacaan')->with('berhasil', 'Data berhasil dihapus');
    } 

}