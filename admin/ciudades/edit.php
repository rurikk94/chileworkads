<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $ciudad = ciudades($filtro[]=["id"=>$_GET["id"]]);
    $comunas = comunas();
}
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["comuna"])){
    $ciudad = new Ciudad();
    $ciudad->setId_ciudad($_POST["id"]);
    $ciudad->setNombre_ciudad($_POST["nombre"]);
    $ciudad->setComuna_id($_POST["comuna"]);
    if($ciudad->actualizar())
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
    <title>Admin</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
    <div class="container">
    <h1>Editar Ciudad</h1>
        <a name="btn-add" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
        <form method="post">
        <input type="hidden" name="id" value="<?=$ciudad[0]->getId()?>">
        <div class="form-group">
          <label for="">Nombre de la ciudad</label>
          <input type="text"
            class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese un nombre para la ciudad" required maxlength="100" value="<?=$ciudad[0]->getNombre_ciudad()?>">
          <small id="helpId" class="form-text text-muted">Nombre de la ciudad</small>
        </div>
        <div class="form-group">
            <label for="comuna">Comuna</label>
            <select class="form-control" name="comuna" id="comuna" required>
              <option value="">Seleccione una Comuna</option>
              <?php foreach ($comunas as $c): ?>
              <option value="<?=$c->getId()?>" <?=($c->getId()==$ciudad[0]->getComuna_id()) ? 'selected="selected"':''?>>
                <?=$c->getNombreComuna()?>
              </option>
              <?php endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Editar</button>
        </form>
    </div>
</body>
</html>