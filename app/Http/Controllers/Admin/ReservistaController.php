<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReservistaController extends Controller
{  
    public function findAll()
    {
        return view('admin.reservista.selecionar');
    }
}
