<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
$ciudades = ciudades();
$comunas = comunas();
$regiones = regiones();
/* foreach ($ciudades as $c){
    $c->getComuna($c->getComuna_id());
    $c->getRegion($c->getRegionId());
} */
/*
$conn = new Db();
$regiones = $conn->seleccionar("SELECT * FROM region;"); */

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=__URL__?>css/bootstrap.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>Admin</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
        <h1>Ciudades</h1>
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
        <a name="btn-add" id="btn-add" class="btn btn-success" href="./add.php" role="button">Agregar</a>
        <?php if (is_null($ciudades)): ?>
            <h2>No hay Ciudades</h2>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Ciudad</th>
                        <th>Comuna</th>
                        <th>Región</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($ciudades as $c) : ?>
                    <tr>
                        <td><?=$c->getNombre_ciudad()?></td>
                        <td><?=$c->sP($comunas,$c->getComuna_id())->getNombreComuna()?></td>
                        <td><?=$c->sP($regiones,$c->p->getRegionId())->getNombreRegion()?></td>
                        <td><a name="btn-mod" id="btn-mod" class="btn btn-primary" href="./edit.php?id=<?=$c->getId()?>" role="button">Modificar</a>
                        <a name="btn-del" id="btn-del" class="btn btn-danger" onclick="return confirm('¿Está seguro?')" href="./delete.php?id=<?=$c->getId()?>" role="button">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>