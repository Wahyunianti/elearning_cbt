<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Pilgan;
use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\Pilgan as ModelsQuestion;
use App\Models\utility\Question;
use App\Models\utility\Quiz as UtilityQuiz;
use App\Models\utility\Result;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class KuisPilganController extends Controller
{

    public function Kuispg()
    {
        $now = Carbon::now();
        $user = auth()->user();

        $dataKuis = Kuis::Join('guru', 'guru.id', '=', 'kuis.guru_id')   
        ->Join('kelas', 'kelas.guru_id', '=', 'guru.id')
        ->Join('siswa', 'siswa.kelas', '=', 'kelas.kelas')             
        ->select('kuis.*')
        ->where('siswa.id', $user->id)
        ->where('jenis', 'pilgan')
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
        return view('siswa.kuis-pilgan', [
            "dataKuis" => $dataKuis,
        ]);
    }

    public function Cari(Request $request)
    {
        $now = Carbon::now();
        $query = $request->input('query');
        $dataKuis = Kuis::where('tenggat', '>', $now)
        ->where('nama', 'LIKE', "%$query%")->get();

        return view('siswa.kuis-pilgan', ['dataKuis' => $dataKuis]);
    }

    public function getInfo(Request $request)
    {
        $id = $request->id;
        $dataInfo = Kuis::findOrFail($id);
        return view('siswa.pilgan-info', compact('dataInfo', 'id'));
    }

    public function startQuiz(Request $request)
    {

        $quizId = $request->id;


        $quiz = Kuis::find($quizId);

        $questions = $this->prepareQuestions($quiz);

        $thisQuiz = $this->prepareQuiz($quiz);

        session()->put('quiz', $thisQuiz);
        session()->put('questions', $questions);

        return view('siswa.mulai-pilgan', ['quiz' => $thisQuiz, 'questions' => $questions]);

    }

    public function prepareQuestions(Kuis $quiz)
    {
        return $quiz->questions->map(function ($question) use ($quiz) {
            $que = new Question();

            $que->id = $question->id;
            $que->question = $question->question;
            $que->foto = $question->foto;
            $que->options = $this->prepareOptions($question);
            $que->correctOption = $question->correct_option;

            return $que;
        })->shuffle()->all();
    }

    public function prepareQuiz(Kuis $quiz)
    {

        $qu = new UtilityQuiz();

        $qu->nama = $quiz->nama;
        $qu->bab = $quiz->bab;
        $qu->foto = $quiz->foto;
        $qu->duration = $quiz->duration;
        $qu->id = $quiz->id;

        return $qu;
    }

    public function prepareOptions(ModelsQuestion $question)
    {

        $allOptions = [];

        $options = explode('|', $question->options);
        $start = 65;

        for ($i = 0; $i < count($options); $i++) {
            $allOptions[chr($start + $i)] = $options[$i];
        }

        return $allOptions;
    }

    public function submit(Request $request)
    {
        $now = Carbon::now();
        $answers = $request->all();
        $kuis = $request->id;
        $answeredQuestions = [];
        $dataInfo = Kuis::findOrFail($kuis);
        
        $tenggat = Carbon::parse($dataInfo->tenggat);

        $tgll = $now->greaterThan($tenggat);

        $realQuestions = session()->get('questions');

        foreach ($realQuestions as $que) {

            $an = $answers[$que->id] ?? false;

            if ($an) {
                $que->choosedAnswer = $answers[$que->id];
            }
            $que->correct = $que->choosedAnswer == $que->correctOption;
        }

        $correctQuestions = collect($realQuestions)->filter(function ($va) {
            return $va->correct;
        });
        $incorrectQuestions = collect($realQuestions)->filter(function ($va) {
            return !$va->correct;
        });
        $unansweredQuestions = collect($realQuestions)->filter(function ($va) {
            return $va->choosedAnswer == "0";
        });

        $result = new Result();

        $result->questions = collect($realQuestions);
        $result->incorrect = $incorrectQuestions->count();
        $result->correct = $correctQuestions->count();
        $result->unAnswered = $unansweredQuestions->count();

        return view('siswa.selesai-kuis', ['result' => $result, 'kuis' => $kuis, 'tgl' => $tgll]);
    }

    public function selesai(Request $request)
    {
        $siswaId = auth()->user()->id;
        $kuisId = $request->idKey;
        $hasil = Hasil::where('kuis_id', $kuisId)
            ->where('users_id', $siswaId)
            ->first();

        if ($hasil) {
            $hasil->update(['nilai' => $request->nilai]);
        } else {
            $data = new Hasil();
            $data->nilai = $request->nilai;
            $data->users_id = $siswaId;
            $data->kuis_id = $kuisId;
            $data->save();
        }

        return redirect('/Kegiatan');
    }

    public function getData()
    {        
        $user = auth()->user()->id;
        $dataKuis = Kuis::where('guru_id', $user)->where('jenis', 'pilgan')->get();
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

        return view('guru.datapilgan', compact('dataKuis', 'guruA'));
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
            ->leftJoin('hasil', function ($join) use ($id) {
                $join->on('users.id', '=', 'hasil.users_id')
                    ->where('hasil.kuis_id', '=', $id);
            })
            ->select('kelas.kelas', 'users.nama as nama', 'siswa.foto', 'hasil.nilai as nilai', 'hasil.updated_at as date')
            ->where('kuis.id', $id)
            ->where('kelas.kelas', $kls)
            ->groupBy('kelas.kelas', 'users.nama', 'siswa.foto', 'hasil.nilai', 'hasil.updated_at')
            ->get();
    
        $submisis = $results->filter(function ($item) {
            return !is_null($item->nilai);
        });
    
        $submisis2 = $results->filter(function ($item) {
            return is_null($item->nilai);
        });

        return view('guru.datahasil', compact('dataInfo', 'id', 'submisis', 'submisis2', 'kls'));
    }

    public function create(Request $request)
    {

        $message = [
            'nama.required' => 'Nama tidak boleh kosong',
            'duration.required' => 'Durasi tidak boleh kosong',
            'tenggat.required' => 'Tenggat tidak boleh kosong',
        ];

        $this->validate($request, [
            'nama' => 'required',
            'duration' => 'required',
            'tenggat' => 'required'
        ], $message);

            $data = Kuis::find($request->id);
            $id = $request->id;  

        if ($data) {
            $data->bab = $request->bab;
            $data->nama = $request->nama;
            $data->tenggat = $request->tenggat;
            $data->ubah = $request->ubah;
            $data->duration = $request->duration;
            $data->save();
            
        } else {            
            $data = new Kuis();       
            $data->bab = $request->bab;
            $data->nama = $request->nama;
            $data->jenis = "pilgan";
            $data->tenggat = $request->tenggat;
            $data->ubah = $request->ubah;     
            $data->duration = $request->duration;
            $data->guru_id = $request->guru_id;
            $data->save();
        }
    
        return redirect('/dataPilgan')->with('berhasil', 'Data berhasil disimpan');
    }

    public function getDataSoal(Request $request)
    {        
        $id = $request->id;
        $kuis = Kuis::findOrFail($request->id);
        $dataPilgan = Pilgan::where('kuis_id', $id)
        ->get();
        $hitung = Pilgan::where('kuis_id', $id)->count();
        return view('guru.datasoalpilgan', compact('dataPilgan', 'id', 'kuis', 'hitung'));
    }

    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->delete();

        return redirect('/dataLatihan')->with('berhasil', 'Data berhasil dihapus');
    } 


}