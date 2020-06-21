<?php require_once("../functions.php"); ?>
<?php is_admin();?>
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
<?php require_once(__BASE__."nav.php");?>
<div class="container">
<h1>Administrar</h1>
<a name="" id="" class="btn btn-primary" href="./usuarios/index.php" role="button">Usuarios</a>
<a name="" id="" class="btn btn-primary" href="./regiones/index.php" role="button">Regiones</a>
<a name="" id="" class="btn btn-primary" href="./comunas/index.php" role="button">Comunas</a>
<a name="" id="" class="btn btn-primary" href="./ciudades/index.php" role="button">Ciudades</a>
<a name="" id="" class="btn btn-primary" href="./poblaciones/index.php" role="button">Poblaciones</a>
<a name="" id="" class="btn btn-primary" href="./oficios/index.php" role="button">Oficios</a>
</div>
</body>
</html>