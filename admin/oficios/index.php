<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
$oficios = oficios();
/*
$conn = new Db();
$oficios = $conn->seleccionar("SELECT * FROM region;"); */

?>
<!DOCTYPE html>
<html lang="en">
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
        <h1>Oficios</h1>
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
        <a name="btn-add" id="btn-add" class="btn btn-success" href="./add.php" role="button">Agregar</a>
        <?php if (is_null($oficios)): ?>
            <h2>No hay Regiones</h2>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:130px">Imagen</th>
                        <th>Oficio</th>
                        <th>Categoría</th>
                        <th>Cantidad Trabajadores</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($oficios as $o) : ?>
                    <tr>
                        <td><img src="<?=__URL__."uploads/images/".$o->getOficio_icon()?>" class="img-fluid rounded-circle img-thumbnail w-100" alt=""></td>
                        <td><?=$o->getOficio_nombre()?></td>
                        <td><?=$o->getCategoria()?></td>
                        <td><?=$o->getCant()?></td>
                        <td><a name="btn-mod" id="btn-mod" class="btn btn-primary" href="./edit.php?id=<?=$o->getId()?>" role="button">Modificar</a>
                        <a name="btn-del" id="btn-del" class="btn btn-danger" onclick="return confirm('¿Está seguro?')" href="./delete.php?id=<?=$o->getId()?>" role="button">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>