<?php

namespace App\Http\Controllers;

use App\Models\Submit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Latihan_soal;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NotifikasiLatihan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;



class LatihanController extends Controller
{

    public function latsol()
    {
        $now = Carbon::now('Asia/Jakarta');
        $user = auth()->user();

        $dataLatsol = Latihan_soal::Join('guru', 'guru.id', '=', 'latihan_soal.guru_id')   
                ->Join('kelas', 'kelas.guru_id', '=', 'guru.id')
                ->Join('siswa', 'siswa.kelas', '=', 'kelas.kelas')             
                ->select('latihan_soal.*')
                ->where('siswa.id', $user->id)
                ->orderBy('nama', 'asc')
                ->get();

        foreach ($dataLatsol as $latihan) {
            $submisis = Submit::where('users_id', $user->id)
                            ->where('latihan_soal_id', $latihan->id)
                            ->get();
            $latihan->submisis = $submisis;

            $tenggat = Carbon::parse($latihan->tenggat);

            $latihan->belum_lewat_tenggat = $now->lessThan($tenggat->endOfDay());
            $latihan->sudah_lewat_tenggat = $now->isAfter($tenggat->endOfDay());
        }


        return view('siswa.latsol', compact('dataLatsol'));

    }

    public function cari(Request $request)
    {
        $now = Carbon::now();
        $searchQuery = $request->input('query');
        
        $user = auth()->user();
        
        $dataLatsol = Latihan_soal::Join('guru', 'guru.id', '=', 'latihan_soal.guru_id')
            ->Join('kelas', 'kelas.guru_id', '=', 'guru.id')
            ->Join('siswa', 'siswa.kelas', '=', 'kelas.kelas')
            ->select('latihan_soal.*')
            ->where('siswa.id', $user->id)
            ->where(function($query) use ($searchQuery) {
                $query->where('latihan_soal.nama', 'LIKE', "%$searchQuery%")
                      ->orWhere('latihan_soal.bab', 'LIKE', "%$searchQuery%")
                      ->orWhere('latihan_soal.keterangan', 'LIKE', "%$searchQuery%")
                      ->orWhere('latihan_soal.detail', 'LIKE', "%$searchQuery%");
            })
            ->orderBy('nama', 'asc')
            ->distinct()
            ->get();
        foreach ($dataLatsol as $latihan) {
            $submisis = Submit::where('users_id', $user->id)
                            ->where('latihan_soal_id', $latihan->id)
                            ->get();
            $latihan->submisis = $submisis;

            $tenggat = Carbon::parse($latihan->tenggat);

            $latihan->belum_lewat_tenggat = $now->lessThan($tenggat->endOfDay());
            $latihan->sudah_lewat_tenggat = $now->isAfter($tenggat->endOfDay());
        }

        return view('siswa.latsol', [
            "dataLatsol" => $dataLatsol,
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $user = auth()->user();
        $dataInfo = Latihan_soal::findOrFail($id);
        $submisis = Submit::where('users_id', $user->id)
                   ->where('latihan_soal_id', $dataInfo->id)
                   ->get();
        $latsolF = $dataInfo->files;
        return view('siswa.submisi', compact('dataInfo', 'id','submisis', 'latsolF'));
    }

    public function view($id)
    {
        $view = File::find($id);

        if (!$view) {
            abort(404);
        }
        $filePath = public_path('storage/latsol/' . $view->file);

        return response()->file($filePath, ['Content-Type' => 'application/pdf']);
    }

    public function download($id)
    {
        $download = File::find($id);
        $path = Storage::disk('public')->path('latsol/' . $download->file);
        return response()->download($path, $download->file);
    }

    public function submisi(Request $request)
    {
        $siswaId = auth()->user()->id;
        $latId = $request->idKey;
        $data = Latihan_soal::find($latId);

        $hasil = Submit::where('latihan_soal_id', $latId)
            ->where('users_id', $siswaId)
            ->first();
            

        if ($hasil) {
            if ($request->hasFile('file')) {
                $oldFileName = $hasil->lampiran;
                if ($oldFileName && Storage::exists('public/lampiran/' . $oldFileName)) {
                    Storage::delete('public/lampiran/' . $oldFileName);
                }
        
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/lampiran', $fileName);
        
                $hasil->update(['lampiran' => $fileName]);
            }
        } else {
            $data = new Submit();
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/lampiran', $fileName);    
                $data->lampiran = $fileName;
            }  
                    
            $data->users_id = $siswaId;
            $data->latihan_soal_id = $latId;
            $data->save();
        }

        return redirect('/Kegiatan');
    }

    public function getData()
    {
        $user = auth()->user()->id;
        $dataLatihan = Latihan_soal::where('guru_id', $user)->get();
        $guruA = DB::table('guru')        
        ->where('users_id', $user)
        ->get();

        foreach ($dataLatihan as $latihan) {
            $results = DB::table('kelas')
                ->leftJoin('guru', 'kelas.guru_id', '=', 'guru.id')
                ->leftJoin('latihan_soal', 'latihan_soal.guru_id', '=', 'guru.id')
                ->select('kelas.kelas')
                ->selectRaw('(SELECT COUNT(*) FROM siswa WHERE siswa.kelas = kelas.kelas) AS jumlah_siswa')
                ->selectRaw('(SELECT COUNT(*) FROM submisi 
                            JOIN users ON submisi.users_id = users.id
                            JOIN siswa ON siswa.users_id = users.id
                            WHERE siswa.kelas = kelas.kelas AND submisi.latihan_soal_id = ?) AS jumlah_submisi', [$latihan->id])
                ->groupBy('kelas.kelas')
                ->where('guru.id',$user)
                ->get();

        
            $latihan->results = $results;

        }
        
        return view('guru.datalatihan', compact('dataLatihan', 'guruA'));

    }

    public function nilaiData(Request $request)
    {
        $id = $request->id;
        $kls = $request->kelas;
        $user = auth()->user();
        $dataInfo = Latihan_soal::findOrFail($id);
    
        $results = DB::table('kelas')
            ->leftJoin('guru', 'kelas.guru_id', '=', 'guru.id')
            ->leftJoin('latihan_soal', 'latihan_soal.guru_id', '=', 'guru.id')
            ->leftJoin('siswa', 'kelas.kelas', '=', 'siswa.kelas')
            ->leftJoin('users', 'siswa.users_id', '=', 'users.id')
            ->leftJoin('submisi', function ($join) use ($id) {
                $join->on('users.id', '=', 'submisi.users_id')
                    ->where('submisi.latihan_soal_id', '=', $id);
            })
            ->select('kelas.kelas', 'users.nama', 'siswa.foto', 'submisi.lampiran', 'submisi.nilai', 'submisi.updated_at as tenggat', 'submisi.id AS submisi_id')
            ->where('latihan_soal.id', $id)
            ->where('kelas.kelas', $kls)
            ->groupBy('kelas.kelas', 'users.nama', 'siswa.foto', 'submisi.lampiran', 'submisi.nilai', 'submisi.updated_at', 'submisi.id')
            ->get();
    
        $submisis = $results->filter(function ($item) {
            return !is_null($item->submisi_id);
        });
    
        $submisis2 = $results->filter(function ($item) {
            return is_null($item->submisi_id);
        });
    
        $latsolF = $dataInfo->files;
    
        return view('guru.datanilai', compact('dataInfo', 'id', 'submisis2', 'submisis', 'latsolF', 'kls'));
    }  

    public function create(Request $request)
    {

        $message = [
            'nama.required' => 'Nama tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'tenggat.required' => 'Tenggat tidak boleh kosong',
        ];

        $this->validate($request, [
            'nama' => 'required',
            'keterangan' => 'required',
            'tenggat' => 'required'
        ], $message);

            $data = Latihan_soal::find($request->id);
            $id = $request->id;
            $uid = mt_rand(100000, 999999);
            $files =  $request->file('file');    

        if ($data) {
            $data->bab = $request->bab;
            $data->nama = $request->nama;
            $data->keterangan = $request->keterangan;
            $data->detail = $request->detail;
            $data->tenggat = $request->tenggat;
            $data->ubah = $request->ubah;
            $data->save();

            if ($request->hasFile('file')) {
                foreach ($files as $file) {
                    $dataFile = new File();
                    $filee = $file;
                    $fileName = time() . '_' . $filee->getClientOriginalName();
                    $filee->storeAs('public/latsol', $fileName);   
                    $dataFile->file = $fileName;
                    $dataFile->latihan_soal_id =  $id;
                    $dataFile->save();
                }                
            } 
            
        } else {            
            $data = new Latihan_soal();  
            $data->id = $uid;        
            $data->bab = $request->bab;
            $data->nama = $request->nama;
            $data->keterangan = $request->keterangan;
            $data->detail = $request->detail;
            $data->tenggat = $request->tenggat;
            $data->ubah = $request->ubah;      
            $data->guru_id = $request->guru_id;
            $data->save();
            if ($request->hasFile('file')) {
                foreach ($files as $file) {
                    $dataFile = new File();
                    $filee = $file;
                    $fileName = time() . '_' . $filee->getClientOriginalName();
                    $filee->storeAs('public/latsol', $fileName);   
                    $dataFile->file = $fileName;
                    $dataFile->latihan_soal_id =  $data->id;
                    $dataFile->save();
                }                
            } 
            
        }

        $users = User::where('no_induk', '2131730117')->get();
        $datatxt =  $request->nama;
        $datawkt =  $request->tenggat;
        foreach ($users as $user) {
            Mail::send([], [], function ($message) use ($user, $datatxt, $datawkt) {
                $message->to($user->email)
                        ->subject($user->nama.' Ada Latihan Baru')
                        ->text($datatxt.'. Cek aplikasi sekarang juga. Tenggat '.$datawkt);
            });
        }        
    
        return redirect('/dataLatihan')->with('berhasil', 'Data berhasil disimpan');
    }

    public function cari2(Request $request)
    {
        $query = $request->input('query');
        $user = auth()->user()->id;
        $guruA = DB::table('guru')        
        ->where('users_id', $user)
        ->get();
        $dataLatihan = Latihan_soal::where('guru_id', $user)
                    ->where('nama', 'LIKE', "%$query%")
                    ->orWhere('bab', 'LIKE', "%$query%")
                    ->orWhere('keterangan', 'LIKE', "%$query%")
                    ->orWhere('detail', 'LIKE', "%$query%")
                    ->orderBy('tenggat', 'asc')
                    ->get();

        foreach ($dataLatihan as $latihan) {
            $results = DB::table('kelas')
                ->leftJoin('guru', 'kelas.guru_id', '=', 'guru.id')
                ->leftJoin('latihan_soal', 'latihan_soal.guru_id', '=', 'guru.id')
                ->leftJoin('siswa', 'kelas.kelas', '=', 'siswa.kelas')
                ->leftJoin('users', 'siswa.users_id', '=', 'users.id')
                ->leftJoin('submisi', 'users.id', '=', 'submisi.users_id')
                ->select('kelas.kelas', 
                        DB::raw('COUNT(DISTINCT submisi.id) AS jumlah_submisi'), 
                        DB::raw('COUNT(DISTINCT siswa.id) AS jumlah_siswa'))
                ->where('latihan_soal.id', $latihan->id)
                ->where('submisi.latihan_soal_id', $latihan->id)
                ->groupBy('kelas.kelas')
                ->get();
            
            $latihan->results = $results;
        }

        return view('guru.datalatihan', compact('dataLatihan', 'guruA'));
    }

    public function destroy_file($id)
    {
        $file = File::findOrFail($id);
        $oldFileName = $file->file;
                if ($oldFileName && Storage::exists('public/latsol/' . $oldFileName)) {
                    Storage::delete('public/latsol/' . $oldFileName);
                }
        $file->delete();

        return redirect('/dataLatihan')->with('berhasil', 'Data berhasil dihapus');
    }


    public function destroy($id)
    {
        $latsol = Latihan_soal::findOrFail($id);
        $latsol->delete();

        return redirect('/dataLatihan')->with('berhasil', 'Data berhasil dihapus');
    }   


    public function nilai(Request $request)
    {
        $message = [
            'id.required' => 'Siswa tidak boleh kosong',
        ];

        $this->validate($request, [
            'id' => 'required',
        ], $message);

        $data = Submit::find($request->id);  

        $data->nilai = $request->nilai;
 
        $data->save();
        return redirect()->back()->with('berhasil', 'Data berhasil dinilai');
    }

    public function viewSubmisi($id)
    {
        $view = Submit::find($id);

        if (!$view) {
            abort(404);
        }
        $filePath = public_path('storage/lampiran/' . $view->lampiran);
        return response()->file($filePath, ['Content-Type' => 'application/pdf']);
    }
}