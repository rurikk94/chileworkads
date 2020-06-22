<?php require_once("../functions.php"); ?>
<?php is_login();?>
<?php
    $regiones = regiones();
if (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET["id"])){
    $u = usuarios(["id"=>$_GET["id"]])[0];
    $favorito = favoritos(["user"=>is_login(false),"persona"=>$u->getId()]);
    $fav = new Favorito();
    $fav->setId_persona(is_login(false));
    $fav->setId_favorito($u->getId());
    if(is_null($favorito))
        $fav->insertar();
    else
        $fav->eliminar();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}
?>