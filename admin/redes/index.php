<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
$redes = redesSociales();

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
    <?php echo adminmenu("redes"); ?>
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
        <a name="btn-add" id="btn-add" class="btn btn-success" href="./add.php" role="button">Agregar</a>
        <?php if (is_null($redes)): ?>
            <h2>No hay Redes Sociales</h2>
        <?php else: ?>
            <input id="myInput" class="form-control" type="text" placeholder="Buscar Red Social...">
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:130px">Imagen</th>
                        <th>Red</th>
                        <th>Url</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                <?php foreach($redes as $c) : ?>
                    <tr>
                        <td><img src="<?=__URL__."uploads/images/".$c->getIcono_red()?>" class="img-fluid rounded w-100" alt=""></td>
                        <td><?=$c->getNombre_red()?></td>
                        <td><?=$c->getUrl_red()?></td>
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
        <script>
            $('.nav-link').hover(function() {
            $(this).toggleClass('bg-info text-light');
            });
        </script>
        <script src="<?=__URL__?>js/tablafiltro.js"></script>
    </div>
</body>
</html>