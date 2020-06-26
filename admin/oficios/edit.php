<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php

if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
$oficio=oficios($filtros=["id"=>$_GET["id"]]);
$o=$oficio[0];
}
if (($_SERVER["REQUEST_METHOD"] == 'POST')){
  if (isset($_FILES["photo"]) && ($_FILES["photo"]["size"]>0)){
      $config["upload_path"] = "uploads/images/";
      $config["allowed_type"] = ["jpg","png","jpeg","gif","webp","svg"];
      $config["max_size"] = 10*1000000;//*1Mb

      $subida = new Upload($config);
      if (!$subida->do_upload($_FILES["photo"]))
      {
        header("Location: ./index.php");
        die();
      }
    }
    $oficio=oficios($filtros=["id"=>$_GET["id"]])[0];
    $oficio->setOficio_nombre($_POST["nombre"]);
    if(isset($subida) && !is_null($subida->nombre_archivo_subido))
      $oficio->setOficio_icon($subida->nombre_archivo_subido);
    $oficio->setCategoria($_POST["categoria"]);
    if($oficio->actualizar())
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
        <h1>Editar Oficio</h1>
        <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$_GET["id"]?>">
  <div class="row">
    <div class="col-2">
      <img style="width:130px" src="<?=__URL__."uploads/images/".$o->getOficio_icon()?>" class="img-fluid rounded-circle img-thumbnail w-100">
    </div>
    <div class="col-10">
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="photo" id="photo">
        <label class="custom-file-label" for="customFile">Cambiar Foto</label>
    </div>
    </div>
    </div>
    <div class="form-group">
      <label for="nombre">Nombre Oficio</label>
      <input type="text"
        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del Oficio" required value="<?=$o->getOficio_nombre()?>">
      <small id="helpId" class="form-text text-muted">Nombre del Oficio</small>
    </div>
    <div class="form-group">
      <label for="categoria">Categoria</label>
      <input type="text"
        class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoria del Oficio" required value="<?=$o->getCategoria()?>">
      <small id="helpId" class="form-text text-muted">Categoria del Oficio</small>
    </div>

    <input type="submit" value="Editar" name="submit">
</form>
</div>

</body>
</html>