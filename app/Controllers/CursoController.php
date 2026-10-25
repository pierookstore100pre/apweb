<?php
namespace App\Controllers;

class CursoController extends BaseController
{
    private array $cursos = [
        1 => 'Programación Web',
        2 => 'Base de Datos',
        3 => 'Seguridad de Redes',
    ];

    public function detalle($id)
    {
        $curso = $this->cursos[$id] ?? null;
        if ($curso === null) {
            return $this->response->setStatusCode(404)->setBody('Curso no encontrado.');
        }
        $data = [
            'titulo' => 'Detalle del curso',
            'id' => $id,
            'curso' => $curso
        ];
        return view('cursos/detalle', $data);
    }
}
