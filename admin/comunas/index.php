<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
$comunas = comunas();
$regiones = regiones();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=__URL__?>css/bootstrap.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/0786957a7f.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?=__URL__?>css/material-icons.css">
        <link rel="stylesheet" href="<?=__URL__?>css/css.css">
    <title>Admin</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
    <?php echo adminmenu("comunas"); ?>
                <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
                <a name="btn-add" id="btn-add" class="btn btn-success" href="./add.php" role="button">Agregar</a>
                <?php if (is_null($comunas)): ?>
                    <h2>No hay Comunas</h2>
                <?php else: ?>
                <input id="myInput" class="form-control" type="text" placeholder="Buscar Comuna...">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Comuna</th>
                                <th>Region</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        <?php foreach($comunas as $c) : ?>
                            <tr>
                                <td><?=$c->getNombreComuna()?></td>
                                <td><?=$c->sP($regiones,$c->getRegionId())->getNombreRegion()?></td>
                                <td><div class="btn-group-vertical" role="group" aria-label="Opciones"><a name="btn-mod" id="btn-mod" class="btn btn-primary" href="./edit.php?id=<?=$c->getId()?>" role="button">Modificar</a>
                                <a name="btn-del" id="btn-del" class="btn btn-danger" onclick="return confirm('¿Está seguro?')" href="./delete.php?id=<?=$c->getId()?>" role="button">Eliminar</a></div></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <script src="<?=__URL__?>js/tablafiltro.js"></script>
    </div>
</body>
</html>