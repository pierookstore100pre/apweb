<?php

namespace App\Controllers;

class ListaController extends BaseController
{
    public function index()
    {
        // Arreglo con tres estudiantes.
        $estudiantes = [
            ['nombre' => 'Ana'],
            ['nombre' => 'Mario'],
            ['nombre' => 'Carla'],
        ];

        $data = [
            'titulo' => 'Lista de estudiantes',

            'estudiantes' => $estudiantes,
            // La vista recibirá una variable $estudiantes.
        ];

        return view('listas/estudiantes', $data);
    }
}
