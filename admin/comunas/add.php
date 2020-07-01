<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
    $regiones = regiones();
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["nombre_comuna"]) && isset($_POST["region"])){
    $comuna = new Comuna();
    $comuna->setNombreComuna($_POST["nombre_comuna"]);
    $comuna->setRegionId($_POST["region"]);
    if($comuna->insertar())
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
    <?php echo adminmenu("comunas"); ?>
              <a name="btn-add" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
              <form method="post">
                <div class="form-group">
                  <label for="">Nombre de la Comuna</label>
                  <input type="text"
                    class="form-control" name="nombre_comuna" id="nombre_comuna" aria-describedby="helpId" placeholder="Ingrese un nombre para la comuna" required maxlength="100">
                  <small id="helpId" class="form-text text-muted">Nombre de la comuna</small>
                </div>
                <div class="form-group">
                    <label for="region">Región</label>
                    <select class="form-control" name="region" id="region" required>
                      <option value="">Seleccione una Región</option>
                      <?php foreach ($regiones as $r): ?>
                      <option value="<?=$r->getId()?>">
                        <?=$r->getNombreRegion()?>
                      </option>
                      <?php endforeach;?>
                    </select>
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