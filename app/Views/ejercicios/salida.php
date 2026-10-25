<?php
$precio = 20;
$cantidad = 3;
$total = $precio * $cantidad;
?>

<p>
    Total: S/ <?= htmlspecialchars((string) $total, ENT_QUOTES, 'UTF-8') ?>
</p>