<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function getData()
    {
        $dataUser = User::orderBy('nama')->get();

        return view('guru.datauser', [
            "dataUser" => $dataUser,
        ]);
    }

    public function Cari(Request $request)
    {
        $query = $request->input('query');
        $dataUser = User::where('nama', 'LIKE', "%$query%")
                    ->orWhere('username', 'LIKE', "%$query%")
                    ->orWhere('no_induk', 'LIKE', "%$query%")
                    ->orWhereHas('roles', function ($innerQuery) use ($query) {
                        $innerQuery->where('role_name', 'LIKE', "%$query%");
                    })
                    ->orWhereHas('siswa', function ($innerQuery) use ($query) {
                        $innerQuery->where('kelas', 'LIKE', "%$query%");
                    })
                    ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                    ->leftJoin('siswa', 'users.id', '=', 'siswa.users_id')
                    ->select('users.*', 'roles.role_name', 'siswa.kelas')
                    ->orderBy('users.nama')
                    ->get();

        return view('guru.datauser', ['dataUser' => $dataUser]);
    }

    public function create(Request $request)
    {
        $message = [
            'no_induk.unique' => 'Nomor Induk sudah digunakan',
            'no_induk.required' => 'Nomor Induk tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
        ];

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'no_induk' => 'required',
        ], $message);

        $data = User::find($request->id);
        $id = $request->id;
        $id_kelas = $request->id_kelas;
        $uid = mt_rand(100000, 999999);
        $klas = $request->input('kelas');

        if ($data) {
            $data->nama = $request->nama;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->no_induk = $request->no_induk;
            if ($request->has('password') && !empty($request->password))  {
            $data->password = Hash::make($request->password);
            }
            $data->role_id = $request->role_id;
    
            if ($request->role_id == 1) {
                $data1 = Guru::find($id);
                
                if ($data1) {
                    $datao = Kelas::where('guru_id', $id);
                    $datao->delete();
                    foreach ($klas as $klass) {                    
                        $data2 = new Kelas();
                        $data2->kelas = $klass;
                        $data2->guru_id = $data1->id;
                        $data2->save();                    
                    }
                }else{
                    $data->siswa()->delete();
                    $data3 = new Guru();
                    $data3->id = $id;
                    $data3->users_id = $id;
                    $data3->save();
                    foreach ($klas as $klass) {
                        $data2 = new Kelas();
                        $data2->kelas = $klass;
                        $data2->guru_id = $data1->id;
                        $data2->save();
                    }
                }
            } elseif ($request->role_id == 2) {
                $data0 = Siswa::find($id);                
                $isFirstIteration = true; 
                if ($data0) {
                foreach ($klas as $klass) {
                    if ($isFirstIteration) {
                        $data0->kelas = $klass;
                        $data0->save();
                        
                        $isFirstIteration = false;
                    }
                }} else {
                    $data->guru()->delete();
                    foreach ($klas as $klass) {
                        if ($isFirstIteration) {
                            $data0 = new Siswa();
                            $data0->id = $id;
                            $data0->kelas = $klass;
                            $data0->users_id = $id;
                            $data0->save();
                            
                            $isFirstIteration = false;
                        }
                    }
                }
            }
            $data->save();
        } else {
            $data = new User();
            $data->id = $uid;
            $data->nama = $request->nama;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->no_induk = $request->no_induk;
            $pwGenerate = $request->no_induk."mtsn2";
            $data->password = Hash::make($pwGenerate);
            $data->role_id = $request->role_id;          
            $data->save();

            if ($request->role_id == 1) {
                $data1 = new Guru();
                $data1->id = $uid;
                $data1->users_id = $data->id;
                $data1->save();

                foreach ($klas as $klass) {
                    $data2 = new Kelas();
                    $data1->id = $uid;
                    $data2->kelas = $klass;
                    $data2->guru_id = $data1->id;
                    $data2->save();
                }
            } elseif ($request->role_id == 2) {
                $isFirstIteration = true; 
                foreach ($klas as $klass) {
                    if ($isFirstIteration) {
                        $data0 = new Siswa();
                        $data0->id = $uid;
                        $data0->kelas = $klass;
                        $data0->users_id = $data->id;
                        $data0->save();                        
                        $isFirstIteration = false;
                    }
                }
            }            

        }
    
        return redirect('/dataUsers')->with('berhasil', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/dataUsers')->with('berhasil', 'Data berhasil dihapus');
    }
   
}