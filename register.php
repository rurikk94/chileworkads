<?php require_once("./functions.php"); ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    $nombre = $_POST["nombre"];
    $correo=$_POST["correo"];
    $contrasena=$_POST["contrasena"];
    $contrasenaCodificada = password_hash($contrasena, PASSWORD_DEFAULT);

    $conn = new Db();
    $insertado = $conn->insertar(
        "INSERT INTO  persona (nombres,correo,contrasena)
        VALUES ('$nombre','$correo','$contrasenaCodificada');"
    );

    if (!$insertado)
    {
        header("Location: error.php");
        exit();
    }
        $account["host"]='smtp.gmail.com';
        $account["port"]='587';
        $account["username"]='videojuegos01vina@gmail.com';
        $account["password"]='videojuegos01';
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
    if(enviar_email($account,$message)){
        $modal["titulo"]="Registrar Cuenta.";
        $modal["cuerpo"]="Se ha enviado un email a su correo.";}
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
<h1>Registrarse</h1>
<?php isset($modal) ? modal($modal) :'' ?>
<a name="btn-login" id="btn-login" class="btn btn-primary" href="./login.php" role="button">Login</a>
<a name="btn-recovery" id="btn-recovery" class="btn btn-primary" href="./recovery.php" role="button">Recuperar Contraseña</a>
<form method="post">
<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre">
<label for="correo">Correo</label>
<input type="email" name="correo" id="correo">
<label for="contrasena">Contraseña</label>
<input type="password" name="contrasena" id="contrasena">
<button type="submit" class="btn btn-primary">Crear Cuenta</button>
</form>
</div>
</body>
</html>