<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
$usuarios = usuarios();
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
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>Admin</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
    <?php echo adminmenu("usuarios"); ?>
                <?php if (is_null($usuarios)): ?>
                    <h2>No hay Usuarios</h2>
                <?php else: ?>
                <input id="myInput" class="form-control" type="text" placeholder="Buscar Usuario...">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:130px">Imagen</th>
                                <th>Usuario</th>
                                <th>Tipo User</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        <?php foreach($usuarios as $u) : ?>
                            <tr>
                                <td><img src="<?=__URL__."uploads/images/".$u->getFoto_file()?>" class="img-fluid rounded-circle img-thumbnail w-100" alt=""></td>
                                <td><?=$u->getNombres()?></td>
                                <td><?=tipoUsuario($u->getTipoUser())?></td>
                                <td>
                                    <a name="btn-detail" id="btn-detail" class="btn btn-info" href="./detail.php?id=<?=$u->getId()?>" role="button">Detalles</a>
                                </td>
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