<?php require_once("./functions.php"); ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    $nombre = $_POST["nombre"];
    $correo=$_POST["correo"];
    $u = usuarios(["correo"=>$correo]);
    if(sizeof($u)!=0)
    {
        $modal["titulo"]="Error al registrar cuenta.";
        $modal["cuerpo"]="El email ya está registrado.";
    }else{

        $contrasena=$_POST["contrasena"];
        $contrasenaCodificada = password_hash($contrasena, PASSWORD_DEFAULT);

        $conn = new Db();
        $insertado = $conn->insertar(
            "INSERT INTO  persona (nombres,foto_file,correo,contrasena)
            VALUES ('$nombre','user.png','$correo','$contrasenaCodificada');"
        );

        if (!$insertado)
        {
            header("Location: error.php");
            exit();
        }
            $message["byEmail"]='ChileWorkAds@gmail.com';
            $message["byName"]='ChileWorkAds';
            $message["forEmail"]=$correo;
            $message["forName"]=$nombre;
            $message["Titulo"]='ChileWorkAds Bienvenido!';
            $message["Body"]="<html><body>"
            ."<h1>ChileWorkAds</h1>"
            ."<p>Gracias por registrarse.</p><br/>"
            ."<p>Siga el siguiente link para activar la cuenta.</p><br/>"
            ."<a href='". __URL__."activar.php?id=".$contrasenaCodificada."'>ACTIVAR CUENTA</a>"
            ."</body></html>";
        if(enviar_email($message)){
            $modal["titulo"]="Registrar Cuenta.";
            $modal["cuerpo"]="Se ha enviado un email a su correo.";}
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=__URL__.'/'?>css/bootstrap.css">
        <script src="<?=__URL__.'/'?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=__URL__.'/'?>js/bootstrap.min.js"></script>
    <title>Registrarse</title>
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
<h1>Registrarse</h1>
<?php isset($modal) ? modal($modal) :'' ?>
<a name="btn-login" id="btn-login" class="btn btn-primary" href="./login.php" role="button">Login</a>
<a name="btn-recovery" id="btn-recovery" class="btn btn-primary" href="./recovery.php" role="button">Recuperar Contraseña</a>
<form method="post">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text"
            class="form-control" name="nombre" id="nombre" required>
    </div>
    <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" required>
        <small id="emailHelpId" class="form-text text-muted">Se le enviará un email para activar la cuenta</small>
    </div>
    <div class="form-group">
        <label for="contrasena">Contraseña</label>
        <input type="password" class="form-control" name="contrasena" id="contrasena" required>
    </div>
    <button type="submit" class="btn btn-primary">Crear Cuenta</button>
</form>
</div>
</div>
</div>
</body>
</html>