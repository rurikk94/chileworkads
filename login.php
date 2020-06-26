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
        <script src="https://kit.fontawesome.com/0786957a7f.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?=__URL__?>css/material-icons.css">
        <link rel="stylesheet" href="<?=__URL__?>css/css.css">
        <script src="<?=__URL__?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__?>js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body>
<div class="container">
  <div class="row">
      <div class="col-sm-9 col-md-3 mx-auto">
      <img  src="<?=__URL__?>logo.png" class="img-fluid" alt="logo">
      </div>
    </div>
</div>
    <div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
        <h1>Login</h1>
        <?php isset($modal) ? modal($modal) :'' ?>
        <a name="btn-register" id="btn-register" class="btn btn-primary" href="./register.php" role="button">Registrarse</a>
        <a name="btn-recovery" id="btn-recovery" class="btn btn-primary" href="./recovery.php" role="button">Recuperar Contraseña</a>
        <fieldset style="border:1px">
        <legend>Ingrese sus datos</legend>
        <form method="post">
            <div class="form-group">
                <label for="correo">Email</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="Ingrese su email" required value="<?=(isset($_POST["correo"]) ? $_POST["correo"]:'')?>">
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        </fieldset>
        </div>
    </div>
    </div>
</body>
</html>