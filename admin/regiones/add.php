<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["nombre_region"])){
    $region = new Region();
    $region->setNombreRegion($_POST["nombre_region"]);
    if($region->insertar())
        header("Location: ./index.php");
        die();

}
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
    <?php echo adminmenu("regiones"); ?>
                <a name="btn-add" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
                <form method="post">
                    <div class="form-group">
                    <label for="">Nombre de la Región</label>
                    <input type="text"
                        class="form-control" name="nombre_region" id="nombre_region" aria-describedby="helpId" placeholder="Ingrese un nombre para la región" required maxlength="100">
                    <small id="helpId" class="form-text text-muted">Nombre de la region</small>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </form>
            </div>
        </div>
        <script>
            $('.nav-link').hover(function() {
            $(this).toggleClass('bg-info text-light');
            });
        </script>
    </div>
</body>
</html>