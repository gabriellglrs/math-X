<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function generateExercises(Request $request)
    {
        echo 'Gerar exercícios';
    }

    public function printExercises()
    {
        echo "imprimir exercicios no navegador";
    }

    public function exportExercises()
    {
        echo "exportar exercicios para um arquivo de texto";
    }
}
