<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwitchStatusController extends Controller
{
    public function store(Request $request)
    {
        // Validasi dan simpan status switch ke database atau proses sesuai kebutuhan
        $status = $request->input('status');
    }
}
