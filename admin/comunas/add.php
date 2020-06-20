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
    <div class="container">
    <h1>Agregar Comuna</h1>
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
</body>
</html>