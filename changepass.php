<?php require_once("./functions.php"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == 'GET'){
    $conn = new Db();
    $id=$conn->validar($_GET["id"]);
    $pass=$conn->validar($_GET["hash"]);
    $user = $conn->seleccionar(
        "SELECT * FROM  persona
        WHERE contrasena = '$pass';",NULL);
    if(sizeof($user)==0)
    {
        header("location:".__URL__."recovery.php");
    }
}
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $conn = new Db();
    $id=$conn->validar($_POST["id"]);
    $hash=$conn->validar($_POST["hash"]);
    $correo=$conn->validar($_POST["correo"]);
    $contrasena=$conn->validar($_POST["contrasena"]);
    $user = $conn->seleccionar(
        "SELECT * FROM  persona
        WHERE contrasena = '$hash';",NULL);
    if(sizeof($user)==0)
    {
        header("location:".__URL__."recovery.php");
    }
    $contrasenaCodificada = password_hash($contrasena, PASSWORD_DEFAULT);

    $update = $conn->update(
        "UPDATE persona SET contrasena = '$contrasenaCodificada'
        WHERE
            id='$id'
            AND contrasena='$hash'
            AND correo='$correo';"
    );
    if ($update)
    {
        header("Location: login.php");
        exit();
    }else{
        header("Location: error.php");
        exit();

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
    <title>Cambiar Contraseña</title>
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
                <h1>Cambiar Contraseña</h1>
                <a name="btn-login" id="btn-login" class="btn btn-primary" href="./login.php" role="button">Login</a>
                <form method="post">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="hidden" name="hash" value="<?=$pass?>">
                    <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="text"
                    class="form-control" name="correo" id="correo" required>
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <input type="password" class="form-control" name="contrasena" id="contrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>