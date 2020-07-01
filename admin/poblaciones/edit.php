<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $poblacion = poblaciones($filtro[]=["id"=>$_GET["id"]]);
    $ciudades = ciudades();
}
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["ciudad"])){
    $poblacion = new Poblacion();
    $poblacion->setId_poblacion($_POST["id"]);
    $poblacion->setNombre_poblacion($_POST["nombre"]);
    $poblacion->setCiudad_id($_POST["ciudad"]);
    if($poblacion->actualizar())
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
    <?php echo adminmenu("poblaciones"); ?>
        <a name="btn-add" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
        <form method="post">
        <input type="hidden" name="id" value="<?=$poblacion[0]->getId()?>">
        <div class="form-group">
          <label for="">Nombre de la poblacion</label>
          <input type="text"
            class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese un nombre para la poblacion" required maxlength="100" value="<?=$poblacion[0]->getNombre_poblacion()?>">
          <small id="helpId" class="form-text text-muted">Nombre de la poblacion</small>
        </div>
        <div class="form-group">
            <label for="ciudad">Región</label>
            <select class="form-control" name="ciudad" id="ciudad" required>
              <option value="">Seleccione una Ciudad</option>
              <?php foreach ($ciudades as $c): ?>
              <option value="<?=$c->getId()?>" <?=($c->getId()==$poblacion[0]->getCiudad_id()) ? 'selected="selected"':''?>>
                <?=$c->getNombre_ciudad()?>
              </option>
              <?php endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Editar</button>
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