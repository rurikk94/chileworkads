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
            <div class="row">
                <?php foreach($favoritos as $u) : ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <div class="card shadow my-1">
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 my-auto">
                                    <img class="img-fluid rounded" src="<?=__URL__."uploads/images/".$u->getFoto()?>"  alt="Foto de <?=$u->getNombres()?>">
                                </div>
                                <div class="col-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 my-auto">
                                    <h4 class="card-title"><?=$u->getNombres()?></h4>
                                </div>
                                <div class="col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 my-auto">
                                    <div class="btn-group-vertical" role="group" aria-label="opciones">
                                                <a  data-toggle="tooltip" title="Ver el perfil de <?=$u->getNombres()?>" name="btn-detail" id="btn-detail" class="btn btn-info" href="../profile/index.php?id=<?=$u->getId_favorito()?>" role="button"><span class="material-icons">account_circle</span> <span>Ver Perfil</span></a>
                                            <a name="btn-fav" id="btn-fav" title="Eliminar de favoritos el perfil de <?=$u->getNombres()?>" class="btn btn-danger" onclick="return confirm('¿Está seguro?')" href="./toggle.php?id=<?=$u->getId_favorito()?>" role="button">Eliminar Favorito</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>