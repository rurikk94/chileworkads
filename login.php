<?php require_once("./functions.php"); ?>
<?php is_login(false); ?>
<?php


if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $email=$_POST["correo"];
    $pass=$_POST["contrasena"];
    $l = login($email,$pass);
            if($l === 0){
                $modal["titulo"]="Error";
                $modal["cuerpo"]="Contraseña incorrecta";
            }
            if($l === 1)
            {
                $modal["titulo"]="Error";
                $modal["cuerpo"]="Usuario no activado";
            }
            if($l === false)
            {
                $modal["titulo"]="Error";
                $modal["cuerpo"]="Usuario no existe";
            }
            if(is_null($l))
            {
                $modal["titulo"]="Error";
                $modal["cuerpo"]="No envió datos";
            }
            if(is_login(false))
            {
                header("location:".__URL__."index.php");
                die();
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
    <title>Login</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
<div class="container">
<h1>Login</h1>
<?php isset($modal) ? modal($modal) :'' ?>
<a name="btn-register" id="btn-register" class="btn btn-primary" href="./register.php" role="button">Registrarse</a>
<a name="btn-recovery" id="btn-recovery" class="btn btn-primary" href="./recovery.php" role="button">Recuperar Contraseña</a>
<form method="post">
<label for="email">email</label>
<input type="email" name="correo" id="correo">
<label for="contrasena">Contraseña</label>
<input type="password" name="contrasena" id="contrasena">
<input type="submit" value="entrar">
</form>
</div>
</body>
</html>