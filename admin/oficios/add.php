<?php require_once("../../functions.php"); ?>
<?php is_admin();?>
<?php

if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_FILES["photo"])){
$config["upload_path"] = "uploads/images/";
$config["allowed_type"] = ["jpg","png","jpeg","gif","webp","svg"];
$config["max_size"] = 10*1000000;//*1Mb

$subida = new Upload($config);
/* if(!isset($_POST["submit"])) {
    echo "no mando nada por post";
    die();
} */
if (isset($_FILES["photo"])){
    if ($subida->do_upload($_FILES["photo"]))
    {
        $oficio = new Oficio();
        $oficio->setOficio_nombre($_POST["nombre"]);
        $oficio->setOficio_icon($subida->nombre_archivo_subido);
        $oficio->setCategoria($_POST["categoria"]);
        if($oficio->insertar())
            header("Location: ./index.php");
            die();
    }
}
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
    <?php echo adminmenu("oficios"); ?>
              <a name="btn-volver" id="btn-add" class="btn btn-primary" href="../index.php" role="button">Volver</a>
              <form method="post" enctype="multipart/form-data">
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" name="photo" id="photo" required>
                      <label class="custom-file-label" for="customFile">Subir Foto</label>
                  </div>
                  <div class="form-group">
                    <label for="nombre">Nombre Oficio</label>
                    <input type="text"
                      class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del Oficio" required>
                    <small id="helpId" class="form-text text-muted">Nombre del Oficio</small>
                  </div>
                  <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <input type="text"
                      class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoria del Oficio" required>
                    <small id="helpId" class="form-text text-muted">Categoria del Oficio</small>
                  </div>

                  <input type="submit" value="Agregar" name="submit">
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