<?php require_once("../functions.php"); ?>
<?php is_login();?>
<?php
    $u = usuarios(["id"=>is_login(false)])[0];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=__URL__?>css/bootstrap.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>Editar Mi Perfil</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
<h1>Editar Mi Perfil</h1>
<?php echo var_dump($u);?>

</body>
</html>