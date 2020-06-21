<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php
    $ciudades = ciudades();
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST["nombre"]) && isset($_POST["ciudad"])){
    $poblacion = new Poblacion();
    $poblacion->setNombre_poblacion($_POST["nombre"]);
    $poblacion->setCiudad_id($_POST["ciudad"]);
    if($poblacion->insertar())
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
    <h1>Agregar Población</h1>
        <a name="btn-add" id="btn-add" class="btn btn-primary" href="./index.php" role="button">Volver</a>
        <form method="post">
        <div class="form-group">
          <label for="">Nombre de la Población</label>
          <input type="text"
            class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese un nombre para la población" required maxlength="100">
          <small id="helpId" class="form-text text-muted">Nombre de la Población</small>
        </div>
        <div class="form-group">
            <label for="ciudad">Población</label>
            <select class="form-control" name="ciudad" id="ciudad" required>
              <option value="">Seleccione una ciudad</option>
              <?php foreach ($ciudades as $r): ?>
              <option value="<?=$r->getId_ciudad()?>">
                <?=$r->getNombre_ciudad()?>
              </option>
              <?php endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
</body>
</html>