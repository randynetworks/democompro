<?php

namespace App\Http\Controllers;

use App\Models\FileTataKelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class fileTataKelolaController extends Controller
{
    protected $direktori = 'cms.menejemen_beranda.tata_kelola';

    public function edit_tatakelola(string $id)
    {
        $data = FileTataKelola::where('id', $id)->first();
        return view($this->direktori . '.edit_tatakelola', compact('data'));
    }

    public function update_tatakelola(Request $request, string $id)
    {
        $profil = FileTataKelola::findOrFail($id);

        if ($request->hasFile('tata_kelola')) {
            $image = $request->file('tata_kelola');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/tatakelola');
            // Hapus file lama jika ada
            if ($profil->tata_kelola) {
                $oldImagePath = $destinationPath . '/' . $profil->tata_kelola;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName);

            $profil->tata_kelola = $imageName;
        }
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('manajemen-tata-kelola');
    }

    public function edit_risiko(string $id)
    {
        $data = FileTataKelola::where('id', $id)->first();
        return view($this->direktori . '.edit_risiko', compact('data'));
    }

    public function update_risiko(Request $request, string $id)
    {
        $profil = FileTataKelola::findOrFail($id);

        if ($request->hasFile('risiko')) {
            $image = $request->file('risiko');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/tatakelola');
            // Hapus file lama jika ada
            if ($profil->risiko) {
                $oldImagePath = $destinationPath . '/' . $profil->risiko;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName);

            $profil->risiko = $imageName;
        }
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('manajemen-tata-kelola');
    }
}
