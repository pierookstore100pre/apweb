<?php

namespace App\Controllers;
// Indica en qué espacio de nombres vive esta clase.
// En CodeIgniter 4, los controladores van en App\Controllers.

class SaludoController extends BaseController
// "extends" permite heredar utilidades de BaseController.
{
    public function index()
    {
        $data = [
            'titulo' => 'Saludo desde CodeIgniter',
            'mensaje' => 'La ruta GET llegó correctamente al controlador.',
        ];

        return view('saludo/index', $data);
        // Carga la vista app/Views/saludo/index.php
        // y le envía el arreglo $data.
    }
}
