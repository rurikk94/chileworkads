<?php require_once("./functions.php"); ?>
<?php
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $conn = new Db();
    $pass=$conn->validar($_GET["id"]);
    $user = $conn->seleccionar(
        "SELECT * FROM  persona
        WHERE contrasena = '$pass';",NULL);
    if(sizeof($user)==0)
    {
        echo "el usuario no existe";exit();
    }
    header("location:".__URL__."changepass.php?id=".$user[0]["id"]."&hash=".$pass);


}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $conn = new Db();
    $email=$conn->validar($_POST["correo"]);
    $user = $conn->seleccionar(
        "SELECT nombres, contrasena FROM  persona
        WHERE correo = '$email';",NULL);
    if(sizeof($user)==0)
    {
        echo "el usuario no existe";exit();
    }
    $account["host"]='smtp.gmail.com';
    $account["port"]='587';
    $account["username"]='videojuegos01vina@gmail.com';
    $account["password"]='videojuegos01';
    $message["byEmail"]='ChileWorkAds@gmail.com';
    $message["byName"]='ChileWorkAds';
    $message["forEmail"]=$email;
    $message["forName"]=$user[0]["nombres"];
    $message["Titulo"]='ChileWorkAds Contraseña Recuperar';
    $message["Body"]="<html><body>"
    ."<h1>ChileWorkAds</h1>"
    ."<p>Recupere su contraseña en el siguiente link</p><br/> "
    ."<a href='". __URL__."recovery.php?id=".$user[0]["contrasena"]."'>CAMBIAR CONTRASEÑA</a>"
    ."</body></html>";
    if(enviar_email($account,$message)){
        $modal["titulo"]="Recuperar Contraseña.";
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
    <title>Recuperar Contraseña</title>
</head>
<body>
<?php require_once(__BASE__."nav.php");?>
<div class="container">
<h1>Recuperar Contraseña</h1>
<?php isset($modal) ? modal($modal) :'' ?>
<a name="btn-login" id="btn-login" class="btn btn-primary" href="./login.php" role="button">Login</a>
<a name="btn-register" id="btn-register" class="btn btn-primary" href="./register.php" role="button">Registrarse</a>
<form method="post">
<label for="email">Correo</label>
<input type="email" name="correo" id="correo">
<button type="submit">Recuperar</button>
</form>
</div>
</body>
</html>