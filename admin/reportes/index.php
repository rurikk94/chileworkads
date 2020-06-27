<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
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
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
        <?php
        $reportes = reportes();
        if (is_null($reportes))
            echo ("<h2>No hay Reportes</h2>");
        else {
            echo '<h2>Reportes</h2>';
            foreach($reportes as $r) :
                ?>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-9 col-md-2 text-center">
                                <img style="max-width:100px;" class="card-img-top rounded-circle img-thumbnail" src="<?=__URL__?>uploads/images/<?=$r["quien_resena_foto"]?>" alt="Card image cap">
                            </div>
                            <div class="col-sm-9 col-md-10">
                                <p><a href="<?=__URL__?>profile?id=<?=$r["quien_resena_id"]?>"><?=$r["quien_resena_nombre"]?> <?=$r["quien_resena_apellidos"]?> </a><span class="text-muted fecha"><?=$r["resena_fecha"]?></span></p>
                            <?php $nota = $r["evaluacion"];
                            if($nota>6):?>
                            <span class="material-icons md-48">star</span><?=$nota?>
                            <?php elseif($nota>3): ?>
                            <i class="material-icons md-36">star_half</i><?=$nota?>
                            <?php elseif($nota>0): ?>
                            <i class="material-icons md-18">star_outline</i><?=$nota?>
                            <?php endif; ?>
                                <h6 class="card-title"><?=$r["texto"]?></h6>
                            </div>
                        </div>
                    </div>
                    <?php if(is_admin(false)) : ?>
                        <div class="card-footer text-center text-muted">
                                <a href="<?=__URL__?>profile?id=<?=$r["perfil_resena_id"]?>#resena_<?=$r["resena_id"]?>"><i class="btn btn-outline-info"  resena="<?=$r["resena_id"]?>"><small><span class="material-icons">visibility</span>Ver Perfil Reseñado</small></i></a>
                                <i class="btn btn-outline-danger" onclick="eliminarResena('<?=$r['resena_id']?>')" resena="<?=$r["resena_id"]?>"><small><span class="material-icons">delete</span>Eliminar Reseña</small></i>
                                <?php if($r["revisado"]) : ?>
                                <i class="btn btn-outline-success" id="btn-estado-reporte-<?=$r['resena_id']?>" onclick="cambiarEstadoReporte('<?=$r['resena_id']?>')" resena="<?=$r["resena_id"]?>"><small><span class="material-icons">done</span>Marcar como Revisado</small></i>
                                <?php else : ?>
                                <i class="btn btn-outline-warning" id="btn-estado-reporte-<?=$r['resena_id']?>" onclick="cambiarEstadoReporte('<?=$r['resena_id']?>')" resena="<?=$r["resena_id"]?>"><small><span class="material-icons">clear</span>Marcar como No Revisado</small></i>
                                <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php } ?>
    </div>
    <script>const __URL__ = '<?=__URL__?>';</script>
    <script src="<?=__URL__?>js/reporte.js"></script>
</body>
</html>