<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comments;

class Comentarios extends Controller
{
    public function index()
    { 

        $comentarios = comments::all();
    
        return view('comentarios', ['comentarios' => $comentarios]);
}
}
