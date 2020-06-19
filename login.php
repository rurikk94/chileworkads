<?php require_once("./functions.php"); ?>
<?php


if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $email=$_POST["correo"];
    $pass=$_POST["contrasena"];
    $asd=login($email,$pass);
    if($asd){
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
<div class="container">
<h1>Login</h1>
<a name="btn-register" id="btn-register" class="btn btn-primary" href="./register.php" role="button">Registrarse</a>
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