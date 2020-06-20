<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $comuna = comunas($filtro[]=["id"=>$_GET["id"]]);
    $regiones = regiones();
}
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["id"]) && isset($_POST["nombre_comuna"]) && isset($_POST["region"])){
    $comuna = new Comuna();
    $comuna->setId($_POST["id"]);
    $comuna->setNombreComuna($_POST["nombre_comuna"]);
    $comuna->setRegionId($_POST["region"]);
    if($comuna->actualizar())
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
    <h1>Editar Comuna</h1>
        <a name="btn-add" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
        <form method="post">
        <input type="hidden" name="id" value="<?=$comuna[0]->getId()?>">
        <div class="form-group">
          <label for="">Nombre de la Comuna</label>
          <input type="text"
            class="form-control" name="nombre_comuna" id="nombre_comuna" aria-describedby="helpId" placeholder="Ingrese un nombre para la comuna" required maxlength="100" value="<?=$comuna[0]->getNombreComuna()?>">
          <small id="helpId" class="form-text text-muted">Nombre de la comuna</small>
        </div>
        <div class="form-group">
            <label for="region">Región</label>
            <select class="form-control" name="region" id="region" required>
              <option value="">Seleccione una Región</option>
              <?php foreach ($regiones as $r): ?>
              <option value="<?=$r->getId()?>" <?=($r->getId()==$comuna[0]->getRegionId()) ? 'selected="selected"':''?>>
                <?=$r->getNombreRegion()?>
              </option>
              <?php endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Editar</button>
        </form>
    </div>
</body>
</html>