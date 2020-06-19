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
    //-------------------------------------------------
    require_once("./vendor/phpmailer/PHPMailerAutoload.php");
    /*Lo primero es añadir al script la clase phpmailer desde la ubicación en que esté*/
    //require '../class.phpmailer.php';

    //Crear una instancia de PHPMailer
    $mail = new PHPMailer();
    //Definir que vamos a usar SMTP
    $mail->IsSMTP();
    //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
    // 0 = off (producción)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug  = 0;
    $mail->Host       = 'smtp.gmail.com';
    $mail->Port       = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true;
    $mail->Username   = "videojuegos01vina@gmail.com";
    $mail->Password   = "videojuegos01";
    $mail->SetFrom('ChileWorkAds@gmail.com', 'ChileWorkAds');
    $mail->AddAddress($correo,$nombre);
    $mail->Subject = 'ChileWorkAds Bienvenido!';
    $mail->Body = 'Gracias por registrarse, su nombre es '.$nombre;
    if(!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
    } else {
    echo "Enviado!";
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
    <title>Register</title>
</head>
<body>
<div class="container">
<h1>Register</h1>
<a name="btn-login" id="btn-login" class="btn btn-primary" href="./login.php" role="button">Login</a>
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