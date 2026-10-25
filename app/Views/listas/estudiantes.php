<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title><?= esc($titulo) ?></title>
</head>

<body>
    <h1><?= esc($titulo) ?></h1>

    <?php foreach ($estudiantes as $estudiante): ?>
        <!--
        foreach significa:
        "por cada elemento de $estudiantes,
        guarda temporalmente ese elemento en $estudiante".
        -->

        <p>
            <?= esc($estudiante['nombre']) ?>
            <!-- Mostramos el nombre del estudiante actual. -->
        </p>

    <?php endforeach ?>
    <!-- Termina el recorrido. -->

</body>

</html>
