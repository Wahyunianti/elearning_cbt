<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class EditProfilController extends Controller
{

    public function getAdmin()
    {
        $user = auth()->user();

        return view('guru.editprofil', [
            "dataUser" => $user,
        ]);
    }

    public function editAdmin(Request $request){
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

        $user = auth()->user();

        $data = User::find($user->id);
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->username = $request->username;
        $data->no_induk = $request->no_induk;
        if ($request->has('password') && !empty($request->password))  {
            $data->password = Hash::make($request->password);
        }
        $data->save();

        $guru = $data->guru;

        if ($request->hasFile('foto')) {
            $oldFileName = $guru->foto;
            if ($oldFileName && Storage::exists('public/foto/' . $oldFileName)) {
                Storage::delete('public/foto/' . $oldFileName);
            }
    
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $fileName);
    
            $guru->update(['foto' => $fileName]);
        }
        return redirect()->back()->with('berhasil', 'Data berhasil disimpan');
    }

    public function getSiswa()
    {
        $user = auth()->user();

        return view('siswa.editprofil', [
            "dataUser" => $user,
        ]);
    }

    public function editSiswa(Request $request){
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

        $user = auth()->user();

        $data = User::find($user->id);
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->username = $request->username;
        $data->no_induk = $request->no_induk;
        if ($request->has('password') && !empty($request->password))  {
            $data->password = Hash::make($request->password);
        }
        $data->save();

        $siswaa = $data->siswa;

        if ($request->hasFile('foto')) {
            $oldFileName = $siswaa->foto;
            if ($oldFileName && Storage::exists('public/foto/' . $oldFileName)) {
                Storage::delete('public/foto/' . $oldFileName);
            }
    
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $fileName);
    
            $siswaa->update(['foto' => $fileName]);
        }
        return redirect()->back()->with('berhasil', 'Data berhasil disimpan');
    }
}