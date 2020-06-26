<?php require_once("../functions.php"); ?>
<?php is_login();?>
<?php
    $favoritos = favoritos(["user"=>is_login(false)]);
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
    <title>Favoritos</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
        <h1>Favoritos</h1>
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
        <?php if (is_null($favoritos)): ?>
            <h2>No hay Favoritos</h2>
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
                <?php foreach($favoritos as $u) : ?>
                    <tr>
                        <td><img src="<?=__URL__."uploads/images/".$u->getFoto()?>" class="img-fluid rounded-circle img-thumbnail w-100" alt=""></td>
                        <td><?=$u->getNombres()?></td>
                        <td>
                            <a name="btn-detail" id="btn-detail" class="btn btn-info" href="../profile/index.php?id=<?=$u->getId_favorito()?>" role="button">Perfil</a>
                            <a name="btn-fav" id="btn-fav" class="btn btn-danger" onclick="return confirm('¿Está seguro?')" href="./toggle.php?id=<?=$u->getId_favorito()?>" role="button">Eliminar Favorito</a>
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