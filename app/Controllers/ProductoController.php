<?php
// Abre el archivo PHP. Todo lo que sigue será interpretado por PHP.

// "namespace" es una etiqueta de ubicación.
// Le dice a PHP que esta clase vive en el "cajón virtual" App\Controllers.
namespace App\Controllers;

// Declaramos la clase ProductoController.
// "extends BaseController" significa herencia:
// esta clase adopta herramientas que CodeIgniter ya preparó,
// como $this->request y $this->response.
class ProductoController extends BaseController
{
    // Creamos un arreglo privado con productos temporales.
    // "private" significa que estos datos se usarán dentro de esta clase.
    // En esta sesión reemplaza a una base de datos, porque la sesión
    // todavía no incluye Model ni persistencia.
    private array $productos = [
        // La clave 1 funciona como ID temporal del primer producto.
        1 => [
            // "nombre" guarda el texto que mostraremos en la vista.
            'nombre' => 'Teclado',
            // "precio" guarda un valor numérico sencillo para el ejemplo.
            'precio' => 45.00,
        ],

        // Segundo producto del catálogo temporal.
        2 => [
            'nombre' => 'Mouse',
            'precio' => 25.00,
        ],

        // Tercer producto del catálogo temporal.
        3 => [
            'nombre' => 'Monitor',
            'precio' => 480.00,
        ],
    ];

    // index() atenderá la ruta GET /productos.
    // Su trabajo es preparar la lista completa y enviarla a una vista.
    public function index()
    {
        // $data es nuestra "matriz de datos".
        // Empaquetamos variables para enviarlas a la pantalla.
        $data = [
            // "titulo" será una variable disponible dentro de la vista.
            'titulo'   => 'Catálogo de productos',
            // Enviamos todo el arreglo de productos.
            'productos' => $this->productos,
            // "busqueda" inicia en null porque todavía no se hizo un filtro.
            'busqueda' => null,
        ];

        // view() abre la vista productos/index.php.
        // El segundo parámetro ($data) es el arreglo que viaja a la vista.
        return view('productos/index', $data);
    }

    // detalle($id) recibe un número capturado desde la URL.
    // Ejemplo: /producto/2 hace que $id valga 2.
    public function detalle($id)
    {
        // Buscamos el producto cuyo índice coincide con el ID.
        // "?? null" significa: si no existe, usar null en vez de producir error.
        $producto = $this->productos[$id] ?? null;

        // Preguntamos si no encontramos el producto.
        if ($producto === null) {
            // $this->response representa lo que el servidor devolverá.
            // setStatusCode(404) indica "recurso no encontrado".
            return $this->response
                ->setStatusCode(404)
                // setBody() define un mensaje sencillo para el navegador.
                ->setBody('Producto no encontrado.');
        }

        // Preparamos el arreglo de datos para detalle.php.
        $data = [
            'titulo'   => 'Detalle del producto',
            'id'       => $id,
            'producto' => $producto,
        ];

        // Enviamos los datos a la vista de detalle.
        return view('productos/detalle', $data);
    }

    // buscar() atenderá una búsqueda enviada por query string.
    // Ejemplo: /buscar?nombre=mouse
    public function buscar()
    {
        // $this->request es el "receptor" de la solicitud.
        // getGet('nombre') atrapa el valor que viaja después del signo ?.
        $nombre = $this->request->getGet('nombre');

        // Convertimos el resultado a texto.
        // Si no llegó nada, usamos una cadena vacía.
        $nombre = trim((string) $nombre);

        // Preparamos un arreglo vacío para guardar coincidencias.
        $resultados = [];

        // Solo buscamos si el estudiante escribió algo.
        if ($nombre !== '') {
            // Recorremos uno por uno los productos del arreglo temporal.
            foreach ($this->productos as $id => $producto) {
                // stripos() busca texto sin diferenciar mayúsculas/minúsculas.
                // !== false significa "sí encontró una coincidencia".
                if (stripos($producto['nombre'], $nombre) !== false) {
                    // Guardamos el producto encontrado conservando su ID.
                    $resultados[$id] = $producto;
                }
            }
        }

        // Preparamos el arreglo para reutilizar index.php.
        $data = [
            'titulo'    => 'Resultado de búsqueda',
            'productos' => $resultados,
            'busqueda'  => $nombre,
        ];

        // Mostramos nuevamente la vista index, ahora con resultados filtrados.
        return view('productos/index', $data);
    }

    // formulario() solo muestra la pantalla del formulario.
    // Se accede mediante GET /producto/nuevo.
    public function formulario()
    {
        // Preparamos el título de la pantalla.
        $data = [
            'titulo' => 'Registrar producto',
        ];

        // Mostramos la vista del formulario.
        return view('productos/formulario', $data);
    }

    // guardar() atenderá la ruta POST /producto/guardar.
    // Esta sesión solo demostrará cómo leer el POST.
    // No guardará en base de datos porque ese contenido no está en el material.
    public function guardar()
    {
        // getPost('nombre') es el "receptor" del campo nombre.
        // Atrapa lo que el usuario escribió en el formulario.
        $nombre = $this->request->getPost('nombre');

        // Hacemos lo mismo con el campo precio.
        $precio = $this->request->getPost('precio');

        // Convertimos el nombre a texto y quitamos espacios sobrantes.
        $nombre = trim((string) $nombre);

        // Validación básica y clara:
        // comprobamos que el nombre no esté vacío.
        if ($nombre === '') {
            // Si el nombre está vacío, devolvemos un mensaje de error sencillo.
            return $this->response
                ->setStatusCode(400)
                ->setBody('El nombre del producto es obligatorio.');
        }

        // Comprobamos que precio tenga un valor y sea numérico.
        if ($precio === null || $precio === '' || ! is_numeric($precio)) {
            // Si el precio no es válido, devolvemos un error 400.
            return $this->response
                ->setStatusCode(400)
                ->setBody('El precio debe ser numérico.');
        }

        // En esta sesión NO insertamos en base de datos.
        // El objetivo es comprobar que el POST llegó correctamente.

        // redirect()->to(...) envía al usuario a otra ruta.
        // Analogía: después de atenderlo, lo acompañamos de regreso al catálogo.
        return redirect()->to(site_url('productos'));
    }
}
