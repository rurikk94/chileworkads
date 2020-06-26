<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
    $comunas = comunas();
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["nombre"]) && isset($_POST["comuna"])){
    $ciudad = new Ciudad();
    $ciudad->setNombre_ciudad($_POST["nombre"]);
    $ciudad->setComuna_id($_POST["comuna"]);
    if($ciudad->insertar())
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
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>Admin</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
    <h1>Agregar Ciudad</h1>
        <a name="btn-add" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
        <form method="post">
        <div class="form-group">
          <label for="">Nombre de la Ciudad</label>
          <input type="text"
            class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese un nombre para la ciudad" required maxlength="100">
          <small id="helpId" class="form-text text-muted">Nombre de la Ciudad</small>
        </div>
        <div class="form-group">
            <label for="comuna">Comuna</label>
            <select class="form-control" name="comuna" id="comuna" required>
              <option value="">Seleccione una Comuna</option>
              <?php foreach ($comunas as $r): ?>
              <option value="<?=$r->getId()?>">
                <?=$r->getNombreComuna()?>
              </option>
              <?php endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
</body>
</html>