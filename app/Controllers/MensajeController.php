<?php

namespace App\Controllers;
// "namespace" indica en qué cajón virtual está guardada esta clase.

class MensajeController extends BaseController
// "extends" permite heredar herramientas de CodeIgniter.
{
    public function index()
    {
        $data = [
            // Esta es un "arreglo de datos".

            'titulo' => 'Mi primera página',
            // En la vista existirá una variable llamada $titulo.

            'mensaje' => 'El controlador preparó este texto.',
            // En la vista existirá una variable llamada $mensaje.
        ];

        return view('mensajes/index', $data);
        // Abre app/Views/mensajes/index.php
        // y entrega el arreglo $data a la vista.
    }
}
