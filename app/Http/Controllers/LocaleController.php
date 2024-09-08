<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LocaleController extends Controller
{
    public function store(Request $request)
    {
        // Validasi dan simpan status switch ke database atau proses sesuai kebutuhan
        $status = $request->input('status');

        // Misalnya, simpan ke dalam database
        // Contoh: Auth::user()->profile->update(['is_eng' => $status]);

        // Simpan locale baru berdasarkan status
        $locale = $status ? 'en' : 'id';

        // Simpan locale baru ke dalam sesi atau cookie jika diperlukan
        session()->put('locale', $locale);

        return response()->json(['message' => 'Switch status saved successfully.', 'locale' => $locale]);
    }

    public function updateLocale(Request $request)
    {
        // Ambil locale dari request
        $locale = $request->input('locale');

        // Validasi dan simpan locale ke dalam sesi atau cookie
        session()->put('locale', $locale);

        return response()->json(['message' => 'Locale updated successfully.']);
    }
}
