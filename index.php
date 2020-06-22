<?php require_once("./functions.php"); ?>
<?php is_login(true);?>
<?php
    $usuarios = usuarios(["tipo"=>2]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=__URL__?>css/bootstrap.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>ChileWorkAds</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
<div class="container">
<h1>ChileWorkAds</h1>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
        <h1>Trabajadores</h1>
        <?php if (is_null($usuarios)): ?>
            <h2>No hay Usuarios</h2>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:130px">Imagen</th>
                        <th>Usuario</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($usuarios as $u) : ?>
                    <tr>
                        <td><img src="<?=__URL__."uploads/images/".$u->getFoto_file()?>" class="img-fluid rounded-circle img-thumbnail w-100" alt=""></td>
                        <td><?=$u->getNombres()?></td>
                        <td>
                            <a name="btn-detail" id="btn-detail" class="btn btn-info" href="./profile/index.php?id=<?=$u->getId()?>" role="button">Perfil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>