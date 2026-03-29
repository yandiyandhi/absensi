<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function approval_cuti(Request $request)
    {
        return view('cuti.approval.index');
    }
}
