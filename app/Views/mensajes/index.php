<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title><?= esc($titulo) ?></title>
</head>

<body>
    <h1><?= esc($titulo) ?></h1>
    <!-- $titulo existe porque el controlador envió la clave 'titulo'. -->

    <p><?= esc($mensaje) ?></p>
    <!-- $mensaje existe porque el controlador envió la clave 'mensaje'. -->
</body>

</html>
