<?php require_once("./functions.php"); ?>
<?php
$modal=[];
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $conn = new Db();
    $pass=$conn->validar($_GET["id"]);
    $user = $conn->seleccionar(
        "SELECT * FROM  persona
        WHERE contrasena = '$pass';",NULL);
    if(sizeof($user)==0)
    {
        $modal["titulo"]="Error al activar.";
        $modal["cuerpo"]="El usuario no existe.";
    }else{
        $conn2 = new Db();
        $wea = $conn2->update(
            "UPDATE persona SET enable = '2'
            WHERE contrasena='$pass';");
        if ($wea)
        {
            $modal["titulo"]="Cuenta activada.";
            $modal["cuerpo"]="Cuenta activada, por favor, entre.";
        }
            //exit();
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
    <title>ChileWorkAds</title>
</head>
<body>
<div class="container">
<h1>ChileWorkAds</h1>
<?php isset($modal) ? modal($modal) :'' ?>
<a name="btn-login" id="btn-login" class="btn btn-primary" href="./login.php" role="button">Login</a>
</div>
</body>
</html>