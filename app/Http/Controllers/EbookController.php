<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Ebook;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class EbookController extends Controller
{

    public function getData()
    {
        $user = auth()->user()->id;
        $dataEbook = Ebook::where('guru_id', $user)->get();
        

        return view('guru.dataebook', [
            "dataEbook" => $dataEbook,
        ]);
    }

    public function create(Request $request)
    {
        $user = auth()->user()->id;

        $data = Ebook::find($request->id);
        $message = [
            'judul.required' => 'Judul tidak boleh kosong',
        ];

        $this->validate($request, [
            'judul' => 'required'
        ], $message);

        if ($data) {
            $data->judul = $request->judul;
    
            if ($request->hasFile('file')) {
                $oldFileName = $data->file;
                if ($oldFileName && Storage::exists('public/ebook/' . $oldFileName)) {
                    Storage::delete('public/ebook/' . $oldFileName);
                }
        
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/ebook', $fileName);
        
                $data->update(['file' => $fileName]);
            }
            $data->save();
        } else {
            $data = new Ebook();
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/ebook', $fileName);    
                $data->file = $fileName;
            } 
            $data->judul = $request->judul;
            $data->guru_id = $user;    
            $data->save();
        }
    
        return redirect('/dataEbook')->with('berhasil', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);
        $oldFileName = $ebook->file;
                if ($oldFileName && Storage::exists('public/ebook/' . $oldFileName)) {
                    Storage::delete('public/ebook/' . $oldFileName);
                }
        $ebook->delete();

        return redirect('/dataEbook')->with('berhasil', 'Data berhasil dihapus');
    }
   
}